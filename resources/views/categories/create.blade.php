@extends('layouts.app')

@section('content')
<div class="container">
    <div class="background-success">
        @if($errors->any())
        <h4 class="text-white">{{$errors->first()}}</h4>
        @endif
    </div>
    <form action="/category" method="POST">
    @csrf
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" class="form-control @error('category_name') border-danger @enderror" name="category_name" id="category_name">
        @error('category_name')
        <small id="category_name" class="form-text text-muted">Please Fill Unique Category Name.</small>
        @enderror
    </div>
    <input type="submit" class="btn btn-success" value="Add">  
    </form>
    @if(session('msg'))
        <div class="background-success">
            <p class="text-white">{{ session('msg') }}</p>
        </div>
    @endif
    <div class="mt-5 mb-5">
    <table class="table table-bordered table-hover">
        <tbody>
            <tr>
                <th>No</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            @foreach ($old_cat as$key => $category)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $category->category_name }}</td>
                <td><a href="{{ url('/category/edit/'.$category->id) }}" class="btn btn-primary {{ $category->id == 1 ? 'disabled' : '' }} ">Edit</a>
                    <a href="{{ url('/category/delete/'.$category->id) }}" class="btn btn-danger {{ $category->id == 1 ? 'disabled' : '' }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
   
</div>
@endsection