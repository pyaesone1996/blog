@extends('layouts.dashboard')
@section('style')
<link href="{{ asset('/dashboards/assets/node_modules/css-chart/css-chart.css') }}" rel="stylesheet">
@endsection

@section('dashboard')

<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">{{ Auth::user()->name }}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">dashboards 1</li>
                </ol>
                <a type="button" href="{{ url('admin/articles/create') }}" class="text-white btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>

                    Create New</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row p-t-10 p-b-10">
                        <!-- Column -->
                        <div class="col p-r-0">
                            <h1 class="font-light">{{ count($reg_users) }}</h1>
                            <h6 class="text-muted">Total User</h6>
                        </div>
                        <!-- Column -->
                        <div class="col text-right align-self-center">
                            <div data-label="20%" class="css-bar m-b-0 css-bar-success css-bar-20"><i class="mdi mdi-account-circle"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row p-t-10 p-b-10">
                        <!-- Column -->
                        <div class="col p-r-0">
                            <h1 class="font-light">{{ count($authors) }}</h1>
                            <h6 class="text-muted">Total Author</h6>
                        </div>
                        <!-- Column -->
                        <div class="col text-right align-self-center">
                            <div data-label="30%" class="css-bar m-b-0 css-bar-warning css-bar-20"><i class="mdi mdi-briefcase-check"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row p-t-10 p-b-10">
                        <!-- Column -->
                        <div class="col p-r-0">
                            <h1 class="font-light">{{ count($reg_users) + count($authors) }}</h1>
                            <h6 class="text-muted">Total Registration</h6>
                        </div>
                        <!-- Column -->
                        <div class="col text-right align-self-center">
                            <div data-label="40%" class="css-bar m-b-0 css-bar-primary css-bar-40"><i class="mdi mdi-star-circle"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row p-t-10 p-b-10">
                        <!-- Column -->
                        <div class="col p-r-0">
                            <h1 class="font-light">{{ count($articles) }}</h1>
                            <h6 class="text-muted">Total Article</h6>
                        </div>
                        <!-- Column -->
                        <div class="col text-right align-self-center">
                            <div data-label="60%" class="css-bar m-b-0 css-bar-info css-bar-{{ (124/4)-1  }}"><i class="mdi mdi-receipt"></i></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->hasRole('Admin'))
                    <h5 class="card-title">Recent Articles</h5>
                    @else
                    <h5 class="card-title">Your Latest Articles</h5>
                    @endif
                </div>

                <div class="comment-widgets" id="comment" style="height: 629px;position: relative;">
                    @if(Auth::user()->hasRole('Admin')):

                    @foreach ($articles as $article)
                    <div class="d-flex no-block comment-row">
                        <div class="p-2"><span class="round"><img src="{{ $article->author->profile() }}" alt="{{ $article->author->username .'-image' }}" width="50"></span></div>
                        <div class="comment-text w-100">
                            <h5 class="font-medium">{{ $article->author->name }}</h5>
                            <p class="m-b-10 text-muted">{{ $article->body }}</p>
                            <div class="comment-footer">
                                <span class="text-muted pull-right">{{ $article->created_at->format('M d, Y') }}</span> <span class="action-icons">
                                    <a target="_blank" href="{{ url('articles/detail/'.$article->id) }}"><span class="badge badge-pill badge-info">View</span> </a>


                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @else

                    @foreach ($articles as $article)
                    @if(Auth::id() == $article->author->id)
                    <div class="d-flex no-block comment-row">
                        <div class="p-2"><span class="round"><img src="{{ $article->author->profile() }}" alt="{{ $article->author->name .'-image' }}" width="50"></span></div>
                        <div class="comment-text w-100">
                            <h5 class="font-medium">{{ $article->title }}</h5>
                            <p class="m-b-10 text-muted">{{ $article->body }}</p>
                            <div class="comment-footer">
                                <span class="text-muted pull-right">{{ $article->created_at->format('M d, Y') }}</span> <span class="action-icons">
                                    <a target="_blank" href="{{ url('articles/detail/'.$article->id) }}"><span class="badge badge-pill badge-info">View</span> </a>


                                </span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach

                    @endif



                </div>
            </div>
        </div>

        @if(Auth::user()->hasRole('Admin'))
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Registration Overview</h5>
                            <h6 class="card-subtitle">Check By Monthly </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <div class="row">
                        <div class="col-6">
                            <h3>{{ now()->format('M Y')}}</h3>

                            <h5 class="font-light m-t-0">Registration for this month</h5>
                        </div>
                        <div class="col-6 align-self-center display-6 text-right">
                            <h2 class="text-success">{{ count($authors) + count($reg_users) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover no-wrap">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>NAME</th>
                                <th>STATUS</th>
                                <th>Joined DATE</th>
                                <th>Count Article</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($users as $key => $user)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="txt-oflo">{{ $user->name }}</td>
                                <td><span class="badge  badge-pill 

                                    @foreach ($roles as $role) 
                                    {{ $user->hasRole('Admin') ? 'badge-danger' : 
                                    ($user->hasRole('Author') ? 'badge-warning text-white' : 'badge-success text-white' ) }}
                                    @endforeach ">

                                        @foreach ($roles as $role)
                                        {{ $user->roles->pluck('label')->contains($role->label) == $role->label ? $role->label : ''  }}
                                        @endforeach

                                    </span></td>

                                <td class="txt-oflo">{{ $user->created_at->format('d M Y') }}</td>

                                <td><span class="text-success">
                                        @php $count = 0; @endphp
                                        @foreach ($articles as $article)
                                        @if ( $user->id == $article->author_id)
                                        @php $count++ @endphp
                                        @endif
                                        @endforeach
                                        <a class="text-center d-block text-info" target="_blank" href="{{ '/?author='.$user->id }}">{{ $count }} </a> </span></td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">Overview</h5>
                        </div>
                    </div>
                </div>
                <div class="bg-light">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover no-wrap">
                                    <tbody>

                                        @foreach ($users as $key => $user)
                                        @if($user->id == Auth::id())
                                        <tr>

                                            <td class="txt-oflo">{{ $user->name }}</td>

                                            <td>

                                                <span class="badge  badge-pill 
                                                    @foreach ($roles as $role) 
                                                    {{ $user->hasRole('Admin') ? 'badge-danger' : 
                                                    ($user->hasRole('Author') ? 'badge-warning text-white' : 'badge-success text-white' ) }}
                                                    @endforeach ">

                                                    @foreach ($roles as $role)
                                                    {{ $user->roles->pluck('label')->contains($role->label) == $role->label ? $role->label : ''  }}
                                                    @endforeach

                                                </span>

                                            </td>

                                            <td class="txt-oflo">{{ $user->created_at->format('d M Y') }}</td>

                                            <td><span class="text-success">
                                                    @php $count = 0; @endphp
                                                    @foreach ($articles as $article)
                                                    @if ( $user->id == $article->author_id)
                                                    @php $count++ @endphp
                                                    @endif
                                                    @endforeach
                                                    <a class="text-center d-block text-info" target="_blank" href="{{ '/?author='.$user->id }}">{{ $count }} </a> </span></td>

                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
        @endif

    </div>

</div>
@endsection

@section('script')

<script src="{{ asset('dashboards/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('dashboards/assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>

<!--morris JavaScript -->
<script src="{{ asset('dashboards/assets/node_modules/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('dashboards/assets/node_modules/morrisjs/morris.min.js') }}"></script>
<script src="{{ asset('dashboards/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Popup message jquery -->
<script src="{{ asset('dashboards/assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('dashboards/dist/js/dashboard1.js') }}"></script>
<script src="{{ asset('dashboards/assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
@endsection
