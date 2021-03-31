<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        request()->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->article_id = request('article_id');
        $comment->user_id = auth()->user()->id;
        $comment->content = request('content');
        $comment->save();

        return back()->with('add', 'Add Comment Successfully!');

    }

    public function edit($id)
    {
        $old_comment = Comment::find($id);
        $article = Article::find($old_comment->article_id);
        return view('articles.detail', compact('old_comment', 'article'));
    }

    public function update($id)
    {

        request()->validate([
            'content' => 'required',
        ]);

        $comment = Comment::find($id);
        $comment->content = request('content');
        $comment->article_id = request('article_id');
        $comment->user_id = request('user_id');
        $comment->save();

        return back()->with('update', 'Data Update Successfully!');
    }

    public function delete($id)
    {

        $comment = Comment::find($id);

        if ($comment->user_id == auth()->user()->id) {

            $comment->delete();
            return back()->with('delete', 'Your Comment Was Deleted Successfully!');

        } else {

            return back()->with('error', 'Unauthorize');

        }

    }
}
