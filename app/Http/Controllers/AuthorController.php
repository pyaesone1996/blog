<?php

namespace App\Http\Controllers;

use App\Article;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::whereHas('roles', function ($author) {
            $author->where('role_id', 1)->orwhere('role_id', 2);
        })->get();
        $articles = Article::all();
        return view('authors.index', compact('authors', 'articles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('authors.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorValidation();

        $profile = $request->file(['profile']);

        if (isset($profile)) {
            $profile_name = $profile->getClientOriginalName();
            $profile->storeAs('public/', $profile_name);
        } else {
            $profile_name = 'noimage.jpg';
        }

        $author = new User();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $author->date_of_birth = $request->date_of_birth;
        $author->phone = $request->phone;
        $author->gender = $request->gender;
        $author->description = $request->description;
        $author->biography = $request->biography;
        $author->profile = $profile_name;
        $author->save();

        $role = Role::where('id', request('role_id'))->get();

        if ($role) {
            $author->roles()->attach($role);
        } else {
            $author->roles()->attach(3);
        }

        return redirect(url('authors'));
    }

    public function show($name)
    {
        $author = User::where('username', $name)->first();

        if (auth()->check()) {
            $articles = $author->timeline();
            return view('authors.detail', compact('author', 'articles'));
        } else {
            $articles = Article::where('author_id', $author->id)->withLikes()->get();
            return view('authors.detail', compact('author', 'articles'));
        }
    }

    public function edit($id)
    {
        $author = User::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $author = User::findOrFail($id);
        $profile = $request->file(['profile']);

        if (!isset($profile)) {
            $profile_name = $author->profile;
        } else {
            $profile_name = $profile->getClientOriginalName();
            $profile->storeAs('public/', $profile_name);
            $profile_name = $profile_name;
        }

        $author->name = $request->name;
        $author->email = $request->email;
        $author->date_of_birth = $request->date_of_birth;
        $author->phone = $request->phone;
        $author->gender = $request->gender;
        $author->description = $request->description;
        $author->biography = $request->biography;
        $author->profile = $profile_name;

        $author->save();

        return redirect(url('authors/detail/' . $author->id));
    }

    public function delete($id)
    {
        $author = User::findOrFail($id);
        $author->delete();

        return redirect(url('authors'))->with('msg', 'Your Data was successfully Deleted');
    }

    public function authorValidation()
    {
        request()->validate([
            'name' => 'required',
            'date_of_birth' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'description' => 'required',
            'biography' => 'required',
            'profile' => 'required',
        ]);
    }
}
