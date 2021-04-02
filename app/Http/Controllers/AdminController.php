<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function alldata()
    {
        $roles = Role::all();
        $users = User::all();
        $articles = Article::all();

        $admins = User::whereHas('roles', function ($admin) {
            $admin->where('role_id', 1);
        })->get();

        $authors = User::whereHas('roles', function ($author) {
            $author->where('role_id', 2);
        })->get();

        $reg_users = User::whereHas('roles', function ($user) {
            $user->where('role_id', 3);
        })->get();


        return view('admin.dashboard', compact('users', 'reg_users', 'admins', 'authors', 'roles', 'articles'));
    }

    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        $admins = User::whereHas('roles', function ($admin) {
            $admin->where('role_id', 1);
        })->get();

        return view('admin.index', compact('users', 'admins', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        $profile = $request->file(['profile']);

        if (isset($profile)) {
            $profile_name = $profile->getClientOriginalName();
            $profile->storeAs('public/', $profile_name);
        } else {
            $profile_name = 'noimage.jpg';
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile = $profile_name;
        $user->save();

        $role = Role::where('id', request('role_id'))->get();

        if ($role) {
            $user->roles()->attach($role);
        } else {
            $user->roles()->attach(3);
        }

        return redirect(route('admin.users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.show', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        dd($request->all());
        $user = User::findOrFail($id);
        abort_if($user->isNot(auth()->user()), 404) ;
        $profile = $request->file(['profile']);

        if (!isset($profile)) {
            $profile_name = $user->profile;
        } else {
            $profile_name = $profile->getClientOriginalName();
            $profile->storeAs('public/', $profile_name);
            $profile_name = $profile_name;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->description = $request->description;
        $user->biography = $request->biography;
        $user->profile = $profile_name;

        $user->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return back();
    }

    //Articles
    public function articles()
    {
        if (request('category')) {
            $articles = Category::where('category_name', request('category'))->firstOrFail()->articles()->paginate(5);
        } else {
            $articles = Article::latest()->paginate(5);
        }
        return view('admin.articles.index', compact('articles'));
    }

    public function createArticles()
    {
        $categories = Category::all();
        $authors = User::where('role_id', 2);
        return view('admin/articles/create', compact('categories', 'authors'));
    }

    public function storeArtiles(Request $request)
    {
        $this->validateArticle();
        $articles = new Article(request(['title', 'excerpt', 'body']));
        $articles->author_id = Auth::user()->id;
        $articles->title = request()->title;
        $articles->excerpt = request()->excerpt;
        $articles->body = request()->body;
        $articles->save();

        $articles->categories()->attach(request('categories'));

        return redirect(url('admin/articles'));
    }

    public function editArticles($id)
    {
        $categories = Category::all();
        $article = Article::find($id);
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function updateArticles($id)
    {
        $article = Article::find($id);
        $article->title = request()->title;
        $article->excerpt = request()->excerpt;
        $article->body = request()->body;
        $article->save();

        if (request()->categories) {
            $article->categories()->sync(request('categories'));
        }

        return redirect('admin/articles/');
    }

    public function deleteArticles($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->back()->with('info', 'Article Has Been Deleted');
    }

    //Category
    public function categories()
    {
        $categories = Category::withCount('articles')->latest()->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        request()->validate([
            'category_name' => ['required', 'unique:categories'],
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        if ($request->slug) {
            $url = $request->slug;
        } else {
            $url = $request->category_name;
        }
        $category->slug = Str::slug($url, '-');
        $category->save();

        return back()->with('msg', 'Your Data Is Added!');
    }

    public function updateCategory($id)
    {
        $category = Category::find($id);
        $category->category_name = request('category_name');
        $category->slug = Str::slug(request('slug'), '-');
        $category->description = request('description');
        $category->save();

        return redirect()->back();
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back();
    }

    public function validateArticle()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'categories' => 'exists:categories,id',
        ]);
    }
}
