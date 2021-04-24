@extends('layouts.app')

@section('style')
<link href="{{ asset('/dashboards/dist/css/style.min.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="author_banner mt-n5" style="background-image:url({{$author->avatar}});">
    @include('authors.banner')
</div>
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-3 col-xlg-3 col-md-3">
            @include('authors.profile')
        </div>

        <div class="col-lg-7 col-xlg-6 col-md-7 mx-n2">
            @foreach ($articles as $article)
            <div class="card mb-3">
                <div class="px-3 py-4">
                    @if($article->featured_image)
                    <div class="d-block mb-4">
                        <img src="{{ $article->getFeaturedImage() }}" alt="" class="img-fluid mt-n2">
                    </div>
                    @endif

                    <div class="card-subtitle mb-2 small">
                        <a href="{{ url('@'.$article->author->username) }}" class="text-decoration-none text-dark">
                            <div class="d-flex justify-content-start align-items-center">
                                <img src="{{ $article->author->avatar }}" width="30" alt="" class="rounded-circle">
                                <p class="mx-2 mb-0 text-dark font-14 text-capitalize">{{ $article->author->username }}</p>
                                <p class="align-self-center mb-0  text-muted">
                                    <span class="text-info">Posted On</span> {{ $article->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </a>
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
                            @if(Auth::check())
                            @if(current_user()->is($article->author))
                            <a href='{{ url("admin/articles/edit/".$article->id) }}' class="btn btn-outline-info px-4 btn-sm ">Edit</a>
                            @endif
                            @endif
                            <a href="{{ url('/articles/detail/'.$article->id) }}" target="_blank" class=" btn btn-outline-secondary px-4 btn-sm ml-2">
                                View Detai</a>
                        </div>

                    </div>


                </div>
            </div>
            @endforeach
        </div>

        <div class="col-lg-2 col-xlg-3 col-md-2">
            @include('authors.friends-list')
        </div>

    </div>

</div>


@endsection
