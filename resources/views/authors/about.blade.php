@extends('layouts.app')

@section('style')
<link href="{{ asset('/dashboards/dist/css/style.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="author-banner mt-n5" style="background-image:url({{$author->avatar}});">
    @include('authors.banner')
</div>

<div class="col-6 mx-auto mt-5">
    <img src="{{ $author->avatar }}" class="rounded-circle mx-auto d-block aboutauthor-profile" alt="">
    <div class="bg-white p-3 rounded-lg author-content">
        <h3 class="font-medium mb-4">About {{ $author->username }}</h3>
        <p class="">{{ $author->biography }}</p>
        <hr>
        <div class="row">
            <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                <br>
                <p class="text-muted">{{ $author->name }}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                <br>
                <p class="text-muted">{{ $author->phone }}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                <br>
                <p class="text-muted">{{ $author->email }}</p>
            </div>
            <div class="col-md-3 col-xs-6"> <strong>Joined</strong>
                <br>
                <p class="text-muted">{{ $author->created_at->format('M/Y') }}</p>
            </div>
        </div>

    </div>
    <a href="{{ url('/@'.$author->username) }}" class="
                   text-danger
                   text-decoration-none 
                   mx-1 mt-3
                   d-block
                   align-self-end
                   text-right
        ">
        <i class="mdi mdi-arrow-top-left"></i> Back
    </a>

</div>


@endsection
