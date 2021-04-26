<div class="container-fluid col-md-6 col-xs-12">
    <div class="d-flex flex-column mt-auto justify-content-center" style="height:250px;">
        <h1 class="text-center text-white text-capitalize">{{ $author->username }}</h1>
        <h6 class="text-center text-monospace text-white">{{ $author->description }}</h6>
    </div>
</div>

<div class="d-flex justify-content-center align-items-center bg-white py-3  border-bottom border-dark-50 mb-2 shadow-sm">

    @if(auth()->check())

    @if (current_user()->isNot($author))

    <form method="POST" action="{{'/@'.$author->username }}/follow">
        @csrf
        <button type="submit" class="btn btn-success rounded-pill py-1 px-3">
            {{ auth()->user()->following($author) ? 'Unfollow ' : 'Follow' }}
        </button>
    </form>

    @else

    <a href="{{ url('admin/user/detail/'.$author->id) }}" class="text-decoration-none btn btn-info text-white rounded-pill py-1 px-3">Edit Profile</a>

    @endif

    @else

    <form method="POST" action="{{'/@'.$author->username }}/follow">
        @csrf
        <button type="submit" class="btn btn-success rounded-pill py-1 px-3">
            Follow
        </button>
    </form>

    @endif

    <a href="{{ url('@'.$author->username.'/following') }}" class="text-decoration-none mx-4 text-muted"> <span class="text-muted"> {{ $author->follows->count() }}</span> Following</a>

    <a href="{{ url('@'.$author->username.'/about') }}" class="text-decoration-none text-muted">About</a>

</div>
