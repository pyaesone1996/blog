@extends('layouts.app')

@section('style')
<link href="{{ asset('/dashboards/dist/css/style.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">

    <div class="row">

        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30"> <img src="{{ asset('/storage/'.$author->profile) }}" class="img-circle" width="150" height="150" />
                        <h4 class="card-title m-t-10">{{ $author->name }}</h4>
                        <h6 class="card-subtitle">{{ $author->username }}</h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                    <font class="font-medium">254</font>
                                </a>
                            </div>
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                                    @foreach ( $articles as $article ) @endforeach
                                    <span class="font-medium">{{ count($articles) }}</span>
                                </a>
                            </div>
                        </div>
                    </center>
                </div>

                <div>
                    <hr>
                </div>

                <div class="card-body">
                    <small class="text-muted">username </small>
                    <h6>{{ "@" }}{{ $author->username }}</h6>
                    <small class="text-muted p-t-30 db">Birthday</small>
                    <h6>{{ date('d M Y',strtotime($author->date_of_birth)) }}</h6> <small class="text-muted p-t-30 db">Address</small>
                    <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                    <small class="text-muted p-t-30 db mb-2">Social Profile</small>
                    <div class="mt-2">
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">

                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>

                    <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#home" role="tab">Timeline</a> </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="profile" role="tabpanel">

                        <div class="card-body">
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
                            <hr>
                            <h4 class="font-medium m-t-30">Description</h4>
                            <p class="m-t-30">{{ $author->description }}</p>
                            <hr>
                            <h4 class="font-medium m-t-30">Biography</h4>
                            <p class="m-t-30">{{ $author->biography }}</p>

                            <hr>

                        </div>
                    </div>

                    <div class="tab-pane " id="home" role="tabpanel">
                        <div class="card-body">
                            <div class="profiletimeline">
                                @foreach ($articles as $article )
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="/dashboards/assets/images/users/1.jpg" alt="user" class="img-circle" /> </div>
                                    <div class="sl-right">
                                        <div><a href="{{ url('/articles/detail/'.$article->id) }}" class="link">{{ $article->title }}</a>
                                            <p><small>
                                                    @foreach ($article->categories as $category)
                                                    <a target="_blank" href="{{ url('/?category='.$category->category_name) }}">
                                                        {{ $category->category_name }}
                                                    </a>
                                                    @endforeach </small> <span class="sl-date"> ( {{ $article->created_at->diffForHumans() }} ) </span></p>
                                            <div class="row">
                                                <p>{{ $article->excerpt }}</p>
                                            </div>
                                            <div class="like-comm"> <a target="_blank" href="{{ url('/articles/detail/'.$article->id) }}" class="link m-r-10 text-info">View Detail</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
