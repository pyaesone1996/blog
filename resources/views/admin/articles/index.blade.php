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

    .card {
        margin-bottom: 0px !important;
    }

</style>
@endsection

@section('dashboard')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title align-self-center mb-0 ">Articles Lists</h4>
                    <a type="button" class="btn btn-info btn-rounded text-white d-xs-block float-xs-right " href="{{ url('/admin/articles/create') }}">New Article</a>
                </div>
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

                            @if(Auth::user()->hasRole('Admin'))
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

                            @else

                            @php $count = 0; @endphp
                            @foreach ($articles as $article)
                            @if(Auth::id() == $article->author->id)
                            @php $count ++ ; @endphp
                            <tr>
                                <td>{{ $count }}</td>
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
                            @endif

                            @endforeach
                            @endif

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="d-block m-auto">{{ $articles->links() }}</div>

        </div>
    </div>
</div>

@section('script')

@endsection

@endsection
