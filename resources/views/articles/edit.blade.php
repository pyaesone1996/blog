@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Update Article</h4>
    <form method="post" action="/articles/edit/{{ $article->id }}">
        @csrf
       
        <div class="form-group">
            <label for="title">Article Title</label>
            <input type="text" class="form-control @error('title') border-danger @enderror" id="title" name="title" value="{{ $article->title }}">
            @error('title')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group">
            <label for="excerpt">Shor Description</label>
            <textarea class="form-control @error('excerpt') border-danger @enderror" id="excerpt" name="excerpt" rows="3">{{ $article->excerpt }}</textarea>
            @error('excerpt')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
        <div class="form-group">
            <label for="body">Content</label>
            <textarea class="form-control @error('body') border-danger @enderror" id="body" name="body" rows="6">{{ $article->body }}</textarea>
            @error('body')
            <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
        </div>
       

        <div class="form-group">
            <label for="category">Cateogry</label>
           
            <select multiple class="form-control" id="category" name="categories[]">
                @foreach ($categories as $category)
                 <option @foreach($article->categories as $old_category) {{ $category->id == $old_category->id ? "selected": "" }} @endforeach value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            
        </div>
        <a href="{{ url('/articles/detail/'.$article->id)}}" class="btn btn-primary">Cancle</a>
        <input type="submit" value="Update" class="btn btn-success">
        
    </form>
   

</div>
@endsection
