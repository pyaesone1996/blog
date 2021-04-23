<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Article;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

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
            'username' => ['required', 'unique:users', 'alpha_dash'],
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
        request()->validate([
            'username' => 'alpha_dash'
        ]);
        $user = User::findOrFail($id);
        abort_if($user->isNot(current_user()), 404) ;
        //Get Image File And Create Location Where To Save
        $profile = $request->file('profile');

        $path = public_path() . '/storage/profile/';

        if (!isset($profile)) {
            $profile_name = $user->profile;
        } else {
            //Create Directory to save image there
            File::exists($path) or File::makeDirectory($path);

            //Crop the image and Save existing directory
            Image::make($profile)->crop(400, 400)->save($path . $profile->getClientOriginalName());

            //Get original name and save original file
            $profile_name = $profile->getClientOriginalName();
            $profile->storeAs('public/', $profile_name);
            $profile_name = $profile_name;
        }

        $user->name = $request->name;
        $user->username = $request->username;
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
            $articles = Category::where('category_name', request('category'))->firstOrFail()->articles()->paginate(10);
        } else {
            $articles = Article::latest()->paginate(10);
        }
        return view('admin.articles.index', compact('articles'));
    }

    public function createArticles()
    {
        $categories = Category::all();
        $authors = User::where('role_id', 2);
        return view('admin/articles/create', compact('categories', 'authors'));
    }

    public function storeArticles(Request $request)
    {
        $this->validateArticle();

        if ($request->file('featured_image')) {
            $featured_image = $request->file('featured_image');
            $featured_image_name = time() . str_replace(' ', '_', $featured_image->getClientOriginalName());

            $crop_path = public_path() . '/storage/articles/';
            File::exists($crop_path) or File::makeDirectory($crop_path);

            Image::make($featured_image)->crop(700, 900)->save($crop_path . $featured_image_name);
            $featured_image->storeAs('public/', $featured_image_name);
        }

        $articles = new Article(request(['title', 'excerpt', 'body']));
        $articles->author_id = Auth::user()->id;
        $articles->title = $request->title;
        $articles->excerpt = $request->excerpt;
        $articles->body = $request->body;
        $articles->featured_image = $featured_image_name;
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

    public function updateArticles(Request $request, $id)
    {
        $article = Article::find($id);

        if ($request->file('featured_image')) {
            $featured_image = $request->file('featured_image');
            $featured_image_name = time() . str_replace(' ', '_', $featured_image->getClientOriginalName());

            $crop_path = public_path() . '/storage/articles/';
            File::exists($crop_path) or File::makeDirectory($crop_path);

            Image::make($featured_image)->crop(900, 700)->save($crop_path . $featured_image_name);
            $featured_image->storeAs('public/', $featured_image_name);
        } else {
            $featured_image_name = $article->featured_image ;
        }

        $article->title = $request->title;
        $article->excerpt = $request->excerpt;
        $article->body = $request->body;
        $article->featured_image = $featured_image_name;
        $article->save();

        if ($request->categories) {
            $article->categories()->sync(request('categories'));
        }

        return redirect('articles/detail/' . $id);
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
