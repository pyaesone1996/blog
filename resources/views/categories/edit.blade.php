@extends('layouts.app')

@section('content')
<div class="container">

    <form action="/category/edit/{{ $category->id }}" method="POST">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" class="form-control @error('category_name') border-danger @enderror" name="category_name" id="category_name" value="{{ $category->category_name }}">
        @error('category_name')
        <small id="category_name" class="form-text text-muted{{ $message }}">We'll never share your email with anyone else.</small>
        @enderror
    </div>
    <input type="submit" class="btn btn-success" value="Update">  
    </form>

   
</div>
@endsection