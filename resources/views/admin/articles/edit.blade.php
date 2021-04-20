@extends('layouts.dashboard')

@section('style')
<link href="{{ asset('dashboards/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboards/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('dashboards/assets/node_modules/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('dashboards/assets/node_modules/dropify/dist/css/dropify.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('dashboards/dist/css/style.min.css') }}" type="text/css">

@endsection

@section('dashboard')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">New Articles </h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">New Articles </li>
                </ol>
                <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>
                    Create New</button>
            </div>
        </div>
    </div>

</div>

<div class="container-fluid bg-white py-4">

    <form method="post" action="/admin/articles/edit/{{ $article->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-9">

                <div class="form-group">
                    <label for="title">Article Title</label>
                    <input type="text" class="form-control @error('title') border-danger @enderror" id="title" name="title" value="{{ $article->title}}">
                    @error('title')
                    <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="excerpt">Shor Description</label>
                    <textarea class="form-control @error('excerpt') border-danger @enderror" id="excerpt" name="excerpt" rows="3"> {{ $article->excerpt  }} </textarea>
                    @error('excerpt')
                    <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <textarea class="form-control @error('body') border-danger @enderror" id="body" name="body" rows="10">{{ $article->body }}
                    </textarea>
                    @error('body')
                    <p class="text-danger"><small>{{ $message }}</small></p>
                    @enderror
                </div>

            </div>
            <div class="col-sm-3">

                <div class="mb-2">
                    <label class="mb-2">Cagegories</label>
                    <div class="input-group">
                        <ul class="list-style-none">
                            @foreach ($categories as $category)
                            <li>
                                <input type="checkbox" class="check rounded" id="{{ $category->category_name }}" name="categories[]" value="{{ $category->id }}" @foreach ($article->categories as $old_category ) {{ $category->id == $old_category->id ? "checked" : "" }} @endforeach >
                                <label class="ml-2" for="{{ $category->category_name }}">{{ $category->category_name }}</label>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>

                <div class="form-group">
                    <label for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" id="featured_image" class="dropify" data-heigh="500" data-default-file="{{ asset('/storage/articles'). '/' .$article->featured_image }}" />
                </div>


                <input type="submit" value="UPDATE" class="btn btn-info btn-sm btn-block">

            </div>
        </div>

    </form>

</div>


@endsection

@section('script')
<script src="{{ asset('dashboards/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboards/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboards/assets/node_modules/multiselect/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src=" {{ asset('dashboards/assets/node_modules/dropify/dist/js/dropify.min.js') }}"></script>
<script src="{{ asset('dashboards/assets/node_modules/multiselect/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez'
                , replace: 'Glissez-déposez un fichier ou cliquez pour remplacer'
                , remove: 'Supprimer'
                , error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });

</script>

@endsection
