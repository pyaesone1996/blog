@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Create New Article</h4>
    <form method="post" action="/articles">
        @csrf
        <div class="form-group">

            <label for="title">Article Title</label>
            <input type="text" class="form-control @error('title') border-danger @enderror" id="title" name="title" placeholder="{{ old('title') }}">
            @error('title')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group">
            <label for="excerpt">Shor Description</label>
            <textarea class="form-control @error('excerpt') border-danger @enderror" id="excerpt" name="excerpt" rows="3"></textarea>
            @error('excerpt')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group">
            <label for="body">Content</label>
            <textarea class="form-control @error('body') border-danger @enderror" id="body" name="body" rows="6"></textarea>
            @error('body')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>


        <div class="form-group">
            <label for="category">Cateogry</label>
            <button type="button" data-toggle="modal" data-target="#categoryForm" class="float-right btn btn-primary ">+
                Add More</button>
            </button>
            <select multiple class="form-control mt-4" id="category" name="categories[]">
                @foreach ($categories as$key => $category)
                <option {{ $category->id == 1 ? "hidden selected" : "" }} value="{{$category->id}}">
                    {{ $category->category_name}}</option>
                @endforeach
            </select>
        </div>
        
        <input type="submit" value="Create" class="btn btn-success">

    </form>
    <div class="modal fade" id="categoryForm" tabindex="-1" role="dialog" aria-labelledby="categoryForm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryForm">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/category" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control @error('category_name') border-danger @enderror" name="category_name" id="category_name">
                            @error('category_name')
                            <small id="category_name" class="form-text text-muted">you neet to fill your category
                                name</small>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="+ Add ">
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</div>
@endsection
