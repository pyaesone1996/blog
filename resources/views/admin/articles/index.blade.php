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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User lists</h4>
                <h6 class="card-subtitle"></h6>
                    <a type="button" class="btn btn-info btn-rounded text-white m-t-10 float-right" href="{{ url('/admin/articles/create') }}">New Article</a>


                <!-- Add Contact Popup Model -->
             
                <div class="table-responsive">
                    <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Categories</th>
                                <th>Published</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $key => $article)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <a href="" class="text-dark">{{ $article->title }} </a>
                                    <p class="action mt-2 mb-0">
                                        <a href="{{ url('admin/articles/edit/'.$article->id) }}" class="text-muted">Edit</a>
                                        <a href="{{ url('admin/articles/delete/'.$article->id ) }}" class="text-danger">Delete</a>
                                        <a target="_blank" href="{{ url('/articles/detail/'.$article->id ) }}" class="text-info">View</a>
                                    </p>
                                </td>
                                <td>{{ $article->author->name}}</td>
                                <td>
                                    @foreach ($article->categories as $category)
                                    <a href="{{route('articles.index',['category' => $category->category_name])}}">{{ $category->category_name}}</a>
                                    @endforeach
                                </td>
                                <td>{{ $article->created_at->format('Y/m/d') }}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')

@endsection

@endsection
