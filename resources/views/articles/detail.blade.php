@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('/../../../dashboards/assets/icons/font-awesome/css/all.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="card mb-2">
        <div class="card-body">
            @if($article->featured_image)
            <div class="d-block mb-4">
                <img src="{{ $article->getFeaturedImage() }}" alt="" class="img-fluid">
            </div>
            @endif

            <div class="card-subtitle mb-2 small">
                <div class="d-flex justify-content-start align-middle">
                    <a href="{{ url('@'.$article->author->username) }}" class="text-decoration-none text-dark">
                        <img src="{{ $article->author->avatar }}" width="30" height="30" class="rounded-circle mr-2 align-self-center" alt="">
                        <span class="align-self-center">{{ $article->author->name}}</span>
                    </a>
                    <p class="align-self-center mb-0 ml-3 text-muted">
                        <span class="text-info">Posted On</span> {{ $article->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>

            <div class="my-3">
                @foreach($article->categories as $key => $category)
                <a href="{{ url('/?category='.$category->category_name) }}" class="badge badge-secondary px-3 py-2">{{ $category->category_name }} </a>
                @endforeach
            </div>
            <h4 class="card-title">{{ $article->title }}</h4>
            <p class="cart-text text-justify">
                {{ $article->body }}
            </p>
            <div class="d-flex justify-content-start">

                <form action="/admin/articles/{{ $article->id }}/like" method="POST">
                    @csrf
                    @if(Auth::check())
                    <button type="submit" class="p-0 btn text-decoration-none {{ $article->isLikeBy(Auth::user()) ? 'text-info' : 'text-dark'  }}">
                        @endif
                        <div class="d-flex align-items-center justify-content-start">
                            <i class=" far fa-thumbs-up align-self-center mr-2"> </i>
                            <span class="align-self-center">{{ $article->liked  ?: 0}}</span>
                        </div>
                    </button>

                </form>

                <form action="/admin/articles/{{ $article->id }}/like" method="POST">
                    @csrf
                    @method('DELETE')
                    @if(Auth::check())
                    <button type="submit" class="p-0 btn text-decoration-none {{ $article->isDislikeBy(Auth::user()) ? 'text-info' : 'text-dark'  }}">
                        @endif
                        <div class="d-flex align-items-center justify-content-start ml-3">
                            <i class=" far fa-thumbs-down align-self-center mr-2"> </i>
                            <span class="align-self-center"> {{ $article->disliked  ?: 0}}</span>
                        </div>
                    </button>

                </form>

                <div class="mt-2 ml-auto justify-content-end">
                    @if(current_user())
                    @if(current_user()->is($article->author))
                    <a href='{{ url("admin/articles/edit/".$article->id) }}' class="btn btn-outline-info px-4 btn-sm ">Edit</a>
                    @endif
                    @endif
                    <a href='{{ route("articles.index") }}' class="btn btn-outline-secondary px-4 btn-sm  ml-2">Back</a>
                </div>

            </div>


        </div>
    </div>

    @if(Auth::check())
    <div class="row">
        <div class="col-12">
            @foreach ($article->comments as $comment)
            <div class="border border-info p-3  {{ $loop->last ? '' : 'mb-4' }}  rounded-lg ">

                <p class="">{{ $comment->content }}</p>

                <div class="small">
                    By <b>{{ $comment->user->name }}</b>,
                    {{ $comment->created_at->diffForHumans() }}
                </div>

                @if(current_user()->hasRole('Admin') || Auth::id()==($comment->user_id) )
                <div class="mt-3">
                    @if(Auth::id()==($comment->user_id))
                    <a href="{{ url('comment/edit/'.$comment->id) }}" data-toggle="modal" data-target="#comment{{$comment->id}}" class="text-primary">Edit &plus; </a>
                    @endif
                    <a href="{{ url('articles/comment/delete/'.$comment->id) }}" class="text-danger">Delete &cross;</a>
                </div>
                @endif
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
