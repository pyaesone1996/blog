@extends('layouts.dashboard')
@section('style')
<link href="{{ asset('/dashboards/assets/node_modules/css-chart/css-chart.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('dashboards/assets/node_modules/css-chart/css-chart.css') }}">
<link rel="stylesheet" href="{{ asset('dashboards/dist/css/pages/easy-pie-chart.css') }}">
<style>
    p.icon-css {
        top: 50%;
        left: 50%;
        font-size: 32px;
        color: #A6B7BF;
        transform: translate(-15px, -24px);
        position: absolute;
    }

    .chart {
        position: relative;
        margin-top: 5px;
        margin-bottom: 5px;
    }

</style>
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
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">dashboards</li>
                </ol>
                <a href="{{ url('admin/articles/create') }}" class="text-white btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>
                    Create New</a>
            </div>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="bg-white py-2 px-3">
                <div class="row">
                    <div class="col">
                        <h1 class="font-light mt-sm-3">{{ count($reg_users) + count($authors) + count($admins)  }}</h1>
                        <h6 class="text-dark">Total User</h6>
                    </div>
                    <div class="col text-right align-self-center">
                        <div class="chart easy-pie-chart-6" data-percent="{{ count($reg_users) }}">
                            <p class="icon-css">
                                <i class="mdi mdi-account-circle"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="bg-white py-2 px-3">
                <div class="row">
                    <div class="col">
                        <h1 class="font-light mt-sm-3">{{ count($authors) }}</h1>
                        <h6 class="text-dark">Total Author</h6>
                    </div>
                    <div class="col text-right align-self-center">
                        <div class="chart easy-pie-chart-4" data-percent="{{ count($authors) }}">
                            <p class="icon-css">
                                <i class="mdi mdi-briefcase-check"></i>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="bg-white py-2 px-3">
                <div class="row">
                    <div class="col">
                        <h1 class="font-light mt-sm-3">{{ count($reg_users) + count($authors) }}</h1>
                        <h6 class="text-dark text-break">Total Registration</h6>
                    </div>
                    <div class="col text-right align-self-center">
                        <div class="chart easy-pie-chart-6" data-percent="{{ count($authors) }}">
                            <p class="icon-css">
                                <i class="mdi mdi-star-circle"></i>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="bg-white py-2 px-3">
                <div class="row">
                    <div class="col">
                        <h1 class="font-light mt-sm-3">{{ count($articles) }}</h1>
                        <h6 class="text-dark">Total Article</h6>
                    </div>
                    <div class="col text-right align-self-center">
                        <div class="chart easy-pie-chart-5" data-percent="{{ count($articles) }}">
                            <p class="icon-css">
                                <i class="mdi mdi-receipt"></i>
                            </p>
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

                    @if(Auth::user()->hasRole('Admin'))

                    @foreach ($articles as $article)
                    <div class="d-flex no-block comment-row">
                        <div class="p-2"><span class="round"><img src="{{ $article->author->avatar }}" alt="{{ $article->author->username .'-image' }}" width="50"></span></div>
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
                        <div class="p-2"><span class="round"><img src="{{ $article->author->avatar }}" alt="{{ $article->author->name .'-image' }}" width="50"></span></div>
                        <div class="comment-text w-100">
                            <h5 class="font-medium">{{ $article->title }}</h5>
                            <p class="m-b-10 text-dark">{{ $article->body }}</p>
                            <div class="comment-footer">
                                <span class="text-dark pull-right">{{ $article->created_at->format('M d, Y') }}</span> <span class="action-icons">
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
                                <td>

                                    <span class="badge  badge-pill 
                                    
                                        @foreach ($roles as $role) 
                                        {{ $user->hasRole('Admin') ? 'badge-danger' : 
                                        ($user->hasRole('Member') ? 'badge-warning text-white' : 'badge-success text-white' ) }}
                                        @endforeach ">

                                        @foreach ($roles as $role)
                                        {{ $user->roles->pluck('name')->contains($role->name) == $role->name ? $role->name : ''  }}
                                        @endforeach

                                    </span>

                                </td>

                                <td class="txt-oflo">{{ $user->created_at->format('d M Y') }}</td>

                                <td>
                                    <span class="text-success">
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
                                                    ($user->hasRole('Member') ? 'badge-warning text-white' : 'badge-success text-white' ) }}
                                                    @endforeach ">

                                                    @foreach ($roles as $role)
                                                    {{ $user->roles->pluck('name')->contains($role->name) == $role->name ? $role->name : ''  }}
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

<script src="{{ asset('dashboards/assets/node_modules/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('dashboards/assets/node_modules/jquery.easy-pie-chart/easy-pie-chart.init.js') }}"></script>

@endsection
