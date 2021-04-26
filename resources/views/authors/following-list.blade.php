@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('dashboards/dist/css/style.min.css') }}">
@endsection

@section('content')

<div class="container">

    @if ( count($followings) > 0 )

    @foreach ($followings as $following)

    <div class="row">
        <div class="col-sm-8 mx-auto col-xs-12">
            <div class="card mb-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="">
                        <img src="{{ $following->avatar }}" class="rounded-circle mx-4" width="100" height="100">
                    </div>

                    <div class="card-body">

                        <a href="{{ url('@'.$following->username) }}" class="text-decoration-none text-dark d-flex justify-content-between align-content-center">
                            <h5 class="card-title">{{ $following->username }}</h5>
                            <p class="card-text"><small class="text-muted">Joined at {{ $following->created_at->diffForHumans() }}</small></p>
                        </a>
                        <p class="card-text">{{ $following->description }}</p>

                        @if (current_user()->isNot($following))

                        <form method="POST" action="{{'/@'.$following->username }}/follow" class="text-right">
                            @csrf
                            <button type=" submit" class="btn btn-success rounded-pill py-1 px-3">
                                {{ auth()->user()->following($following) ? 'Unfollow ' : 'Follow' }}
                            </button>
                        </form>

                        @else

                        <div class="text-right">
                            <a href="{{ url('admin/user/detail/'.$following->id) }}" class="text-decoration-none bg-info text-white rounded-pill py-2 px-3">Edit Profile</a>
                        </div>

                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>

    @endforeach

    @else

    <h3 class="text-center align-middle"> Nobody Following Yet!</h3>
    <a href="{{ url()->previous() }}" class="text-secondary text-center d-block mt-3 text-decoration-none"><i class="mdi mdi-arrow-top-left"></i>Back</a>

    @endif

</div>

@endsection
