@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Author</h4>
    <form method="POST" action="/authors/edit/{{ $author->id }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">

            <label for="title">Author Name</label>
            <input type="text" class="form-control @error('title') border-danger @enderror" id="name" name="name"
                value="{{ $author->name }}">
            @error('name')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date Of Birth</label>
            <input type="date" class="form-control @error('date_of_birth') border-danger @enderror" id="date_of_birth"
                name="date_of_birth" value="{{ $author->date_of_birth }}">
            @error('date_of_birth')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <label for="email">Email</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="email" class="form-control @error('email') border-danger @enderror" id="email" name="email"
                value="{{ $author->email }}">
            @error('email')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" class="form-control @error('phone') border-danger @enderror" id="phone" name="phone"
                rows="6" value="{{ $author->phone }}">
            @error('phone')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="" disabled>Choose Gender</option>
                <option value="male" {{ $author->gender == 'male' ? "selected" : "" }}>Male</option>
                <option value="female" {{ $author->gender == 'female' ? "selected" : "" }}>Female</option>
                <option value="other" {{ $author->gender == 'other' ? "selected" : "" }}>Other</option>
            </select>
            @error('gender')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') border-danger @enderror" id="description"
                name="description" rows="6">{{ $author->description }}</textarea>
            @error('description')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="form-group">
            <label for="biography">Biography</label>
            <textarea class="form-control @error('biography') border-danger @enderror" id="biography" name="biography"
                rows="6">{{ $author->biography }}</textarea>
            @error('biography')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        @if ($author->profile)
        <div>
            <img src="{{ asset('/storage/'.$author->profile) }}" class="w-25"
                alt="{{config('app.name')}}-{{ $author->profile }}">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="profile">Profile</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="profile" name="profile" aria-describedby="profile">
                <label class="custom-file-label" for="profile">Upload Profile Photo</label>
            </div>
        </div>
        @else
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="profile">Profile</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="profile" name="profile" aria-describedby="profile">
                <label class="custom-file-label" for="profile">Upload Profile Photo</label>
            </div>
        </div>
        @endif

        <input type="submit" value="Update" class="btn btn-success">

    </form>



</div>
@endsection