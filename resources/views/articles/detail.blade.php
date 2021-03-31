@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-2">
        <div class="card-body">

            <h5 class="card-title">{{ $article->title }}</h5>
            <div class="card-subtitle mb-2 text-muted small">
                {{ $article->created_at->diffForHumans() }}
            </div>

            <p class="cart-text text-justify">
                {{ $article->body }}
            </p>
            @if ($article->author->name)
            <p class="cart-text">
                Author By :
                <span>{{ $article->author->name}}</span>
            </p>
            @endif

            @if (count($article->categories) > 0)
            Category :
            @endif

            @foreach($article->categories as $key => $category)
            <a href="{{ url('/?category='.$category->category_name) }}">{{ $category->category_name }} , </a>
            @endforeach
            <div class="mt-2">

                <a href='{{ route("articles.index") }}' class="btn btn-warning">Back</a>
                @if ( Auth::id() == $article->author_id )

                <a href='{{ url("/articles/edit/$article->id")}}' class="btn btn-success">Edit</a>
                <a href='{{ url("/articles/delete/$article->id") }}' class="btn btn-danger">Delete</a>

                @endif

            </div>
        </div>
    </div>

    @if(count($article->comments)>0)
    <div class="card">
        <div class="card-body">
            @foreach ($article->comments as $comment)
            <div class="border border-secondary p-3  {{ $loop->last ? '' : 'mb-4' }}  rounded-lg card-text">

                <p class="">{{ $comment->content }}</p>
                <div class="small">
                    By <b>{{ $comment->user->name }}</b>,
                    {{ $comment->created_at->diffForHumans() }}
                </div>
                <div class="mt-3">
                    <a href="{{ url('comment/edit/'.$comment->id) }}" data-toggle="modal" data-target="#comment{{$comment->id}}" class="text-primary">Edit &plus; </a>
                    <a href="{{ url('articles/comment/delete/'.$comment->id) }}" class="text-danger">Delete &cross;</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif


    @foreach ($article->comments as $comment)
    <div class="modal fade" id="comment{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><label for="content">Edit Your Comment</label>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('comment/edit/'.$comment->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group" class="mt-5">
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="hidden" name="user_id" value="{{ $comment->user_id }}">
                            <textarea class="form-control @error('content') border-danger @enderror" id="content" name="content" rows="5">{{ $comment->content }}</textarea>
                            @error('content')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @if (session('add'))
    <div class="bg-success mt-3 p-3 rounded-lg">
        <p class="m-0 text-white">{{ session('add') }}</p>
    </div>
    @elseif(session('delete'))
    <div class="bg-danger mt-3 p-3 rounded-lg">
        <p class="m-0 text-white">{{ session('delete') }}</p>
    </div>
    @endif

    <div class="mt-4">
        <form action="{{ url('articles/detail/'.$article->id.'/comment/add/') }}" method="POST">
            @csrf
            <div class="form-group" class="mt-5">
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <input type="hidden" name="user_id" value="{{ $comment->user_id ?? ''}}">
                <label for="content">Add Your Comment</label>
                <textarea class="form-control @error('content') border-danger @enderror" id="content" name="content" rows="5"></textarea>
                @error('content')
                <p class="text-danger"><small>{{ $message }}</small></p>
                @enderror
            </div>
            <input type="submit" value="Add Comment" class="btn btn-primary">
        </form>
    </div>

</div>


@endsection
