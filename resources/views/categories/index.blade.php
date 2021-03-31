@extends('layouts.app')

@section('content')
    <table class="table table-bordered table-hover">
        <tbody>
            <tr>
                <th>No</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            @foreach ($categories as$key => $category)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $category->category_name }}</td>
                <td><a href="{{ url('/category/edit/'.$category->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ url('/category/delete/'.$category->id) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
   

@endsection