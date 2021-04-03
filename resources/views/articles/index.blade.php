@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('/../../../dashboards/assets/icons/font-awesome/css/all.css') }}">
@endsection
@section('content')

<div class="container">
    @if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
    @endif

    {{ $articles->links() }}

    <div class="row">
        @foreach ($articles as $article)
        <div class="col-lg-4 col-md-6 mb-4 float-left">
            <div class="card">
                <img class="card-img-top img-fluid mb-2" src=" {{ asset('dashboards/assets/images/big/img4.jpg') }} " alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mb-2 ">{{ Str::limit($article->title, 45, '...') }}</h4>
                    <small class="text-muted d-block mb-2"> <span class="text-info">Posted On </span> {{ $article->created_at->diffForHumans() }}</small>
                    @foreach ($article->categories as $category)
                    <a class="mb-2 d-inline-block badge badge-secondary text-white py-2 px-2" href="{{route('articles.index',['category' => $category->category_name])}}">{{ $category->category_name}}</a>
                    @endforeach
                    <p class="card-text text-justify mt-2">{{ $article->excerpt }}</p>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ url('authors/detail/'.$article->author->id) }}" class="align-self-center text-decoration-none">
                            <img src="{{ asset('/storage/'.$article->author->profile) }}" alt="" width="35" height="35" class="rounded-circle">
                            <p class="text-dark d-inline-block ml-2">{{ $article->author->name }}</p>
                        </a>

                        <a href='{{ url("articles/detail/$article->id") }}' class="btn btn-primary align-self-center">view<i class="fas fa-angle-double-right ml-2" aria-hidden="true"></i></a>

                    </div>
                    <div class="d-flex">
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
                    </div>


                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>
@section('script')
<script src="http://unpkg.com/turbolinks"></script>
@endsection
@endsection
