@if(Auth::check())
<ul class="m-0 p-4  card rounded-lg">
    <h4 class="mb-3">Following Lists</h4>
    @foreach (auth()->user()->follows as $user)
    <a href="{{ url('/@'.$user->username) }}" class="text-decoration-none text-dark">
        <li class="list-style-none d-flex align-items-center mb-3">
            <img src="{{ $user->avatar }}" width="35" height="35" class="rounded-circle mr-3" alt="image">
            <p class="align-self-center mb-0">{{ $user->username }}</p>
        </li>
    </a>
    @endforeach
</ul>
@endif