@extends('layouts.dashboard')

@section('style')
<link href="{{ asset('dashboards/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboards/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('dashboards/assets/node_modules/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/admin/articles/create">
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
                            <button type="button" data-toggle="modal" data-target="#categoryForm" class="float-right btn btn-primary ">+ Add More</button>
                            </button>
                            <select class="select2 select2-multiple form-control" multiple="multiple" name="categories[]" id="category">
                                @foreach ($categories as $key => $category)
                                <option {{ $category->id == 1 ? "selected" : "" }} value="{{$category->id}}">
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
                                <form action="/admin/category" method="POST">
                                    <div class="modal-body">
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
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="{{ asset('dashboards/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboards/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboards/assets/node_modules/multiselect/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script>
    $(function() {
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();

        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                }
                , processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items
                        , pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                }
                , cache: true
            }
            , escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });

</script>
@endsection
