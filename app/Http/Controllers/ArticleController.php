<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }
    
    public function index()
    {
        if (request('category')) {
            $categories = Category::where('category_name', request('category'))->firstOrFail()->articles()->get();
            foreach ($categories as $category) : $article_id[] = $category->id;
            endforeach;
            $articles = Article::whereIn('id', $article_id)->withlikes()->paginate(15);
        } elseif (request('author')) {
            $articles = Article::where('author_id', request('author'))->withlikes()->paginate(15);
        } else {
            $articles = Article::latest()->withlikes()->paginate(15);
        }

        return view('articles.index', ['articles' => $articles]);
    }

    public function detail($id)
    {
        $article = Article::where('id', $id)->withlikes()->first();
        return view('articles.detail', compact('article'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = User::where('role_id', 2);
        return view('articles.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $this->validateArticle();
        $articles = new Article(request(['title', 'excerpt', 'body']));
        $articles->author_id = Auth::user()->id;
        $articles->title = request()->title;
        $articles->excerpt = request()->excerpt;
        $articles->body = request()->body;
        $articles->save();

        $articles->categories()->attach(request('categories'));

        return redirect(route('articles.index'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $article = Article::find($id);

        abort_if($article->author->isNot(current_user()), 404);

        return view('articles.edit', compact('article', 'categories'));
    }

    public function update($id)
    {
        $article = Article::find($id);
        $article->title = request()->title;
        $article->excerpt = request()->excerpt;
        $article->body = request()->body;
        $article->save();

        if (request()->categories) {
            $article->categories()->sync(request('categories'));
        }

        return redirect('/articles/detail/' . $article->id);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles')->with('info', 'Article Has Been Deleted');
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
