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
                    <h4 class="card-title mb-2">{{ Str::limit($article->title, 45, '...') }}</h4>
                    <small class="text-muted d-block mb-2"> <span class="text-info">Posted On </span> {{ $article->created_at->diffForHumans() }}</small>
                    @foreach ($article->categories as $category)
                    <a class="mb-2 d-inline-block badge badge-secondary text-white py-2 px-2" href="{{route('articles.index',['category' => $category->category_name])}}">{{ $category->category_name}}</a>
                    @endforeach
                    <p class="card-text text-justify mt-2">{{ $article->excerpt }}</p>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center ">

                        <a href="{{ url('authors/detail/'.$article->author->id) }}" class="align-self-center text-decoration-none">
                            <img src="{{ asset('/storage/'.$article->author->profile) }}" alt="" width="35" height="35" class="rounded-circle">
                            <p class="text-dark d-inline-block ml-2">{{ $article->author->name }}</p>
                        </a>

                        <a href='{{ url("articles/detail/$article->id") }}' class="btn btn-primary align-self-center">view<i class="fas fa-angle-double-right ml-2" aria-hidden="true"></i></a>

                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>

@endsection
