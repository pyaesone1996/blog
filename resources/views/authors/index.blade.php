@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('/dashboards/assets/icons/font-awesome/css/all.css') }}">

@endsection
@section('content')
<div class="container">
    <h1 class="mb-5">Author</h1>
    <ul class="list-unstyled">
        @foreach($authors as$key => $author)
        @if ($key % 2 == 0)
        <li class="mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <img src="{{ $author->avatar }}" alt="{{ $author->username . '-image'}}" class="img-fluid">
                        </div>
                        <div class="col-lg-9 col-md-6">
                            <div class="mt-2 text-left">
                                @php $count = 0; @endphp
                                @foreach ($articles as $article)
                                @if ( $author->id == $article->author_id)
                                @php $count++ @endphp
                                @endif
                                @endforeach
                                <div class="d-flex align-middle ">
                                    <h4 class="mr-3">{{$author->name}} </h4>
                                    <small style="font-size:12px" class="text-muted "> ( Joined {{ $author->created_at->diffForHumans() }} )</small>
                                </div>

                                <a href="{{ url('/?author='.$author->id) }}"> {{ $count }} Articles Posted</a>
                            </div>
                            <p class="text-justify mt-2">{{ $author->biography }}</p>
                            <div class="social-links">
                                <a href=""><i class="fab fa-facebook"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                                <a href=""><i class="fab fa-youtube"></i></a>

                            </div>
                            <a href="{{ url('@'.$author->username) }}" class="btn btn-info float-right text-white">Detail </a>
                        </div>
                    </div>

                </div>
            </div>
        </li>
        @else
        <li class="mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9 col-md-6">
                            <div class="mt-2 text-left">
                                @php $count = 0; @endphp
                                @foreach ($articles as $article)
                                @if ( $author->id == $article->author_id)
                                @php $count++ @endphp
                                @endif
                                @endforeach
                                <h4 class="">{{$author->name}}
                                    <small style="font-size:12px" class="text-muted"> ( Joined {{ $author->created_at->diffForHumans() }} )</small>
                                </h4>
                                <a href="{{ url('/?author='.$author->id) }}"> {{ $count }} Articles Posted</a>
                            </div>
                            <p class="text-justify mt-2">{{ $author->biography }}</p>
                            <div class="social-links">
                                <a href=""><i class="fab fa-facebook"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                                <a href=""><i class="fab fa-youtube"></i></a>

                            </div>
                            <a href="{{ url('@'.$author->username) }}" class="mt-3 btn btn-info float-left text-white">Detail </a>

                        </div>

                        <div class="col-lg-3 col-md-6">
                            <img src="{{ $author->avatar }}" alt="{{ $author->username.'-image' }}" class="img-fluid">
                        </div>



                    </div>

                </div>
            </div>
        </li>

        @endif

        @endforeach
    </ul>


</div>

@endsection

@section('script')
<script src=" {{ asset('/dashboards/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('/dashboards/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }} "></script>
@endsection
