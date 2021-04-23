@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($followings)>0)
    @foreach ($followings as $following)
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card mb-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="">
                        <img src="{{ $following->avatar }}" class="rounded-circle mx-4" width="100" height="100">
                    </div>
                    <div class="">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-content-center">
                                <h5 class="card-title">{{ $following->username }}</h5>
                                <p class="card-text"><small class="text-muted">Joined at {{ $following->created_at->diffForHumans() }}</small></p>
                            </div>
                            <p class="card-text">{{ $following->description }}</p>
                            @if (current_user()->isNot($following))
                            <form method="POST" action="{{'/@'.$following->username }}/follow" class="text-right">
                                @csrf
                                <button type=" submit" class="btn btn-success rounded-pill py-1 px-3">
                                    {{ auth()->user()->following($following) ? 'Unfollow ' : 'Follow' }}
                                </button>
                            </form>
                            @else
                            <a href="{{ url('admin/user/detail/'.$following->id) }}" class="text-decoration-none btn btn-info text-white rounded-pill py-1 px-3">Edit Profile</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @endforeach
    @else
    <p>You Not Following Yet!</p>
    @endif
</div>

@endsection
