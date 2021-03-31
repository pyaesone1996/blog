@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Author</h4>
    <form method="POST" action="/authors" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="role_id" value="2">
        <div class="form-group">

            <label for="title">Author Name</label>
            <input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name"
                placeholder="">
            @error('name')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date Of Birth</label>
            <input type="date" class="form-control @error('date_of_birth') border-danger @enderror" id="date_of_birth"
                name="date_of_birth">
            @error('date_of_birth')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <label for="email">Email</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="email" class="form-control @error('email') border-danger @enderror" id="email" name="email">
        </div>
        @error('email')
        <p class="text-danger"><small>{{ $message }}</small></p>
        @enderror

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" class="form-control @error('phone') border-danger @enderror" id="phone" name="phone"
                rows="6">
            @error('phone')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control @error('gender') border-danger @enderror">
                <option value="" disabled selected>Choose Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            @error('gender')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') border-danger @enderror" id="description"
                name="description" rows="6"></textarea>
            @error('description')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="form-group">
            <label for="biography">Biography</label>
            <textarea class="form-control @error('biography') border-danger @enderror" id="biography" name="biography"
                rows="6"></textarea>
            @error('biography')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="profile">profile</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('profile') border-danger @enderror" id="profile" name="profile" aria-describedby="profile">
                <label class="custom-file-label" for="profile">Upload Profile Photo</label>
            </div>
        </div>
        @error('profile')
            <p class="text-danger"><small>{{ $message }}</small></p>
        @enderror


        <input type="submit" value="Create" class="btn btn-success">

    </form>



</div>
@endsection