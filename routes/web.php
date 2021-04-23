<?php

use App\Like;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Search Route
Route::get('/search', function () {
    $query = request('q');
    $repo = App::make('App\Repositories\ArticlesRepository');
    $articles = $query
                ? $repo->search($query)
                : $repo::getAll();

    return view('articles.index', compact('articles'));
});

//Article Route
Route::get('/', 'ArticleController@index');
Route::get('/articles', 'ArticleController@index')->name('articles.index');
Route::post('/articles', 'ArticleController@store');
Route::get('/articles/create', 'ArticleController@create')->name('articles.create');
Route::get('/articles/detail/{id}', 'ArticleController@detail');
Route::get('/articles/edit/{id}', 'ArticleController@edit');
Route::post('/articles/edit/{id}', 'ArticleController@update');
Route::get('/articles/delete/{id}', 'ArticleController@delete');

//Caegory Route
Route::get('/category', 'CategoryController@index')->name('category.index');

//Article Comment Route
Route::post('/articles/detail/{article_id}/comment/add', 'CommentController@create');
Route::get('/comment/edit/{id}', 'CommentController@edit');
Route::put('/comment/edit/{id}', 'CommentController@update');
Route::get('/articles/comment/delete/{id}', 'CommentController@delete');

//Member Route
Route::get('/authors', 'AuthorController@index')->name('authors');
Route::post('/authors', 'AuthorController@store');
Route::get('/authors/create', 'AuthorController@create');
Route::get('/@{author}', 'AuthorController@show')->name('author.detail');
Route::get('/@{name}/about', function ($name) {
    $repo = App::make('App\Repositories\AuthorsRepository');
    $author = $repo->aboutAuthor($name);
    return view('authors.about', compact('author'));
});

Route::get('/authors/edit/{id}', 'AuthorController@edit');
Route::put('/authors/edit/{id}', 'AuthorController@update');
Route::get('/authors/delete/{id}', 'AuthorController@delete');

Route::prefix('admin')->group(function () {
    //User
    Route::get('/', 'AdminController@alldata')->name('dashboard');
    Route::get('/user', 'AdminController@index')->name('admin.users');
    Route::post('/user', 'AdminController@store');
    Route::get('/user/create', 'AdminController@create')->name('admin.create');
    Route::get('/user/detail/{id}', 'AdminController@show')->name('admin.users.detail');
    Route::put('/user/edit/{id}', 'AdminController@update');
    Route::get('/user/delete/{id}', 'AdminController@delete');

    //Article
    Route::get('/articles', 'AdminController@articles');
    Route::post('/articles/create', 'AdminController@storeArticles');
    Route::get('/articles/create', 'AdminController@createArticles');
    Route::get('/articles/detail/{id}', 'AdminController@detailArticles');
    Route::get('/articles/edit/{id}', 'AdminController@editArticles');
    Route::put('/articles/edit/{id}', 'AdminController@updateArticles');
    Route::get('/articles/delete/{id}', 'AdminController@deleteArticles');

    //Like - Disklie
    Route::post('/articles/{article}/like', 'LikeController@store');
    Route::delete('/articles/{article}/like', 'LikeController@destroy');

    //Category
    Route::get('/categories', 'AdminController@categories');
    Route::post('/category', 'AdminController@storeCategory');
    Route::get('/category/create', 'AdminController@createCategory');
    Route::put('/category/edit/{id}', 'AdminController@updateCategory');
    Route::get('/category/delete/{id}', 'AdminController@deleteCategory');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/@{user:username}/follow', 'FollowsController@store');
    Route::get('/@{user:username}/following', 'FollowsController@following');

    Route::get('/settings', 'SettingsController@index');
    Route::patch('/settings/{settings}', 'SettingsController@update');
});

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/admin', 'HomeController@index')->name('home');
