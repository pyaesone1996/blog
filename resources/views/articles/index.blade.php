@extends('layouts.app')

@section('content')

<div class="container">
    @if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
    @endif

    {{ $articles->links() }}

    @foreach($articles as $article)
    <div class="card mb-2">
        <div class="card-body">
            <div>
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <p class="card-text">{{ $article->excerpt }}</p>
                <p class="card-text">{{ $article->body }}</p>
            </div>
            <div>


                @if (count($article->categories) > 0)
                Type
                @endif
                @foreach ($article->categories as $category)
                <a href="{{route('articles.index',['category' => $category->category_name])}}">{{ $category->category_name}}</a>
                @endforeach

            </div>
            <a class="card-link" href='{{ url("articles/detail/$article->id") }}'>
                View Detail &raquo;
            </a>
        </div>
    </div>
    @endforeach


    <div class="row">
        @foreach ($articles as $article)
        <div class="col-lg-4 col-md-6 img-responsive">
            <div class="card">
                <img class="card-img-top img-responsive" src=" {{ asset('dashboards/assets/images/big/img4.jpg') }} " alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">{{ $article->title }}</h4>
                    <p class="card-text">{{ $article->excerpt }}</p>
                    <a href="" class="btn btn-primary"><i class="fa fa-street-view" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>

@endsection
