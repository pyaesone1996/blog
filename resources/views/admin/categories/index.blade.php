@extends('layouts.dashboard')
@section('style')
<style>
    .action {
        opacity: 0;
        transition: visibility 0s, opacity 0.5s linear;
    }

    tr:hover .action {
        opacity: 1;
        cursor: pointer;
    }

</style>

@endsection

@section('dashboard')

<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">New Categories </h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">New Categories </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-4">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Category</h4>
                    <form action="category" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Name</label>
                            <input type="text" class="form-control @error('category_name') border-danger @enderror" name="category_name" id="category_name">
                            <small class="text-muted">The name is how it appears on your site.</small>
                            @error('category_name')
                            <small id="category_name" class="form-text text-muted">Please Fill Unique Category Name.</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug">
                            <small class="text-muted">The “slug” is the URL-friendly version of the name.</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                            <small class="text-muted">The description is just optional ,sometime you may show it.</small>
                        </div>
                        <input type="submit" class="btn btn-success" value="Add">
                    </form>

                </div>
            </div>

        </div>

        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover">

                        <tbody>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Slug</th>
                                <th>Count</th>

                            </tr>

                            @foreach ($categories as$key => $category)

                            <div id="verticalcenter{{ $category->id }}" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="vcenter">Edit Category</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="category/edit/{{ $category->id }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <label for="category_name">Name</label>
                                                    <input type="text" class="form-control @error('category_name') border-danger @enderror" name="category_name" id="category_name" value="{{ $category->category_name }}">
                                                    @error('category_name')
                                                    <small id="category_name" class="form-text text-muted">Please Fill Unique Category Name.</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" class="form-control" name="slug" id="slug" value="{{ $category->slug }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" class="form-control" rows="5">{{ $category->description ?? '' }}</textarea>
                                                </div>
                                                <input type="submit" class="btn btn-primary" value="Update">
                                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    {{ $category->category_name }}
                                    <p class="action mb-0 mt-1">
                                        <a href="{{ url('admin/category/edit/'.$category->id) }}" class="text-primary" data-toggle="modal" data-target="#verticalcenter{{ $category->id }}">Edit</a>

                                        <a href="{{ url('admin/category/delete/'.$category->id) }}" class="text-danger">Delete</a>
                                    </p>
                                </td>
                                <td> - </td>
                                <td>{{ $category->slug}}</td>
                                <td class="text-center"> <a href="{{ url('/admin/articles/?category='.$category->category_name) }}"> {{ $category->articles->count() }} </a></td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                    <div class="d-flex">
                        <p>{{ $categories->links() }}</p>
                        <p class="text-muted float-right ml-auto">Total Categories: {{ count($categories) }}</p>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>


@endsection
