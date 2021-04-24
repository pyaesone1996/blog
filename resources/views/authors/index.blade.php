@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('/dashboards/assets/icons/font-awesome/css/all.css') }}">

@endsection
@section('content')
<div class="container">
    <h1 class="mb-3">Author</h1>
    <div class="list-unstyled row">

        @foreach($authors as $key => $author)
        @if($author->description != null )
        <div class="col-6 mb-4 {{ $key%2 == 0 ? 'mr-n1' : 'ml-n1' }}">
            <div class="bg-white border rounded-lg px-3 py-2">
                <div class="row">
                    <div class="col-sm-3 my-auto">
                        <img src="{{ $author->avatar }}" alt="{{ $author->username . '-image'}}" class="img-fluid rounded-circle" width="100" height="100">
                    </div>
                    <div class="col-sm-9">

                        <div class="mt-2 text-left">
                            @php $count = 0; @endphp
                            @foreach ($articles as $article)
                            @if ( $author->id == $article->author_id )
                            @php $count++ @endphp
                            @endif
                            @endforeach
                            <div class="d-flex align-items-center mb-2">
                                <h4 class="mr-3 mb-0">{{$author->name}}</h4>
                                <small style="font-size:12px" class="text-muted "> ( Joined {{ $author->created_at->diffForHumans() }} )</small>
                            </div>
                            <div class="d-flex justify-content-lg-between align-items-center">
                                <a href="{{ url('/?author='.$author->id) }}"> {{ $count }} Articles Published</a>
                                <div class="social-links">
                                    <a href=""><i class="fab fa-facebook"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>

                        </div>
                        <p class="text-justify mt-2" style="min-height:90px;">{{ $author->description }}</p>
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ url('@'.$author->username) }}" class="btn btn-outline-info px-4 py-1 rounded-pill">views</a>
                            <div class="ml-2">
                                @if(auth()->check())
                                @if (current_user()->isNot($author))
                                <form method="POST" action="{{'/@'.$author->username }}/follow" class="text-right">
                                    @csrf
                                    <button type=" submit" class="btn btn-success rounded-pill px-4 py-1">
                                        {{ auth()->user()->following($author) ? 'Unfollow ' : 'Follow' }}
                                    </button>
                                </form>
                                @else
                                <div class="text-right">
                                    <a href="{{ url('admin/user/detail/'.$author->id) }}" class="text-decoration-none bg-info text-white rounded-pill py-2 px-3">Edit Profile</a>
                                </div>
                                @endif
                                @else
                                <form method="POST" action="{{'/@'.$author->username }}/follow" class="text-right">
                                    @csrf
                                    <button type=" submit" class="btn btn-success rounded-pill px-4 py-1">
                                        Follow
                                    </button>
                                </form>
                                @endif

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>


</div>

@endsection

@section('script')
<script src=" {{ asset('/dashboards/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('/dashboards/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }} "></script>
@endsection
