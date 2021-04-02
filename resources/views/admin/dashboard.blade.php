@extends('layouts.dashboard')
@section('style')
<link href="{{ asset('/dashboards/assets/node_modules/css-chart/css-chart.css') }}" rel="stylesheet">
@endsection

@section('dashboard')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
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
                <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i>
                    Create New</button>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Info box -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
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
        <!-- Column -->
        <!-- Column -->
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
        <!-- Column -->
        <!-- Column -->
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
        <!-- Column -->
        <!-- Column -->
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
        <!-- Column -->
    </div>



    <div class="row">
        <!-- ============================================================== -->
        <!-- Comment widgets -->
        <!-- ============================================================== -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Articles</h5>
                </div>
                <!-- ============================================================== -->
                <!-- Comment widgets -->
                <!-- ============================================================== -->
                <div class="comment-widgets" id="comment" style="height: 629px;position: relative;">
                    @foreach ($articles as $article)
                    <div class="d-flex no-block comment-row">
                        <div class="p-2"><span class="round"><img src="{{ $article->author->profile }}" alt="user" width="50" height="50"></span></div>
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

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
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
                                    {{ $user->roles->pluck('name')->contains('Admin') ? 'badge-danger' : 
                                    ($user->roles->pluck('name')->contains('Member') ? 'badge-warning text-white' : 'badge-success text-white' ) }}
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
    </div>


    {{-- <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-40 align-items-center no-block">
                        <h5 class="card-title ">YEARLY SALES</h5>
                        <div class="ml-auto">
                            <ul class="list-inline font-12">
                                <li><i class="fa fa-circle text-cyan"></i> Iphone</li>
                                <li><i class="fa fa-circle text-primary"></i> Ipad</li>
                                <li><i class="fa fa-circle text-purple"></i> Ipod</li>
                            </ul>
                        </div>
                    </div>
                    <div id="morris-area-chart" style="height: 340px;"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-4 col-md-12">
            <div class="row">
                <!-- Column -->
                <div class="col-md-12">
                    <div class="card bg-cyan text-white">
                        <div class="card-body ">
                            <div class="row weather">
                                <div class="col-6 m-t-40">
                                    <h3>&nbsp;</h3>
                                    <div class="display-4">73<sup>°F</sup></div>
                                    <p class="text-white">AHMEDABAD, INDIA</p>
                                </div>
                                <div class="col-6 text-right">
                                    <h1 class="m-b-"><i class="wi wi-day-cloudy-high"></i></h1>
                                    <b class="text-white">SUNNEY DAY</b>
                                    <p class="op-5">April 14</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-12">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div id="myCarouse2" class="carousel slide" data-ride="carousel">
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <h4 class="cmin-height">My Acting blown <span class="font-medium">Your
                                                Mind</span> and you also
                                            <br />laugh at the moment</h4>
                                        <div class="d-flex no-block">
                                            <span><img src="/dashboards/assets/images/users/1.jpg" alt="user" width="50" class="img-circle"></span>
                                            <span class="m-l-10">
                                                <h4 class="text-white m-b-0">Govinda</h4>
                                                <p class="text-white">Actor</p>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <h4 class="cmin-height">My Acting blown <span class="font-medium">Your
                                                Mind</span> and you also
                                            <br />laugh at the moment</h4>
                                        <div class="d-flex no-block">
                                            <span><img src="/dashboards/assets/images/users/2.jpg" alt="user" width="50" class="img-circle"></span>
                                            <span class="m-l-10">
                                                <h4 class="text-white m-b-0">Govinda</h4>
                                                <p class="text-white">Actor</p>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <h4 class="cmin-height">My Acting blown <span class="font-medium">Your
                                                Mind</span> and you also
                                            <br />laugh at the moment</h4>
                                        <div class="d-flex no-block">
                                            <span><img src="/dashboards/assets/images/users/3.jpg" alt="user" width="50" class="img-circle"></span>
                                            <span class="m-l-10">
                                                <h4 class="text-white m-b-0">Govinda</h4>
                                                <p class="text-white">Actor</p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
        </div>
    </div> --}}

    {{-- <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-40 align-items-center no-block">
                        <h5 class="card-title ">SALES DIFFERENCE</h5>
                        <div class="ml-auto">
                            <ul class="list-inline font-12">
                                <li><i class="fa fa-circle text-cyan"></i> SITE A</li>
                                <li><i class="fa fa-circle text-primary"></i> SITE B</li>
                            </ul>
                        </div>
                    </div>
                    <div id="morris-area-chart2" style="height: 340px;"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-4 col-md-12">
            <div class="row">
                <!-- Column -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">SALES DIFFERENCE</h5>
                            <div class="row">
                                <div class="col-6  m-t-30">
                                    <h1 class="text-info">$647</h1>
                                    <p class="text-muted">APRIL 2017</p>
                                    <b>(150 Sales)</b>
                                </div>
                                <div class="col-6">
                                    <div id="sparkline2dash" class="text-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-12">
                    <div class="card bg-purple text-white">
                        <div class="card-body">
                            <h5 class="card-title">VISIT STATASTICS</h5>
                            <div class="row">
                                <div class="col-6  m-t-30">
                                    <h1 class="text-white">$347</h1>
                                    <p class="light_op_text">APRIL 2017</p>
                                    <b class="text-white">(150 Sales)</b>
                                </div>
                                <div class="col-6">
                                    <div id="sales1" class="text-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h5 class="card-title m-b-0">TO DO LIST</h5>
                        </div>
                        <div class="ml-auto">
                            <button class="pull-right btn btn-circle btn-success" data-toggle="modal" data-target="#myModal"><i class="ti-plus"></i></button>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- To do list widgets -->
                    <!-- ============================================================== -->
                    <div class="to-do-widget m-t-20" id="todo" style="height: 400px;position: relative;">
                        <!-- .modal for add task -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Task</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label>Task name</label>
                                                <input type="text" class="form-control" placeholder="Enter Task Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Assign to</label>
                                                <select class="custom-select form-control pull-right">
                                                    <option selected="">Sachin</option>
                                                    <option value="1">Sehwag</option>
                                                    <option value="2">Pritam</option>
                                                    <option value="3">Alia</option>
                                                    <option value="4">Varun</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                            <li class="list-group-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">
                                        <span>Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been</span> <span class="badge badge-pill badge-danger float-right">Today</span>
                                    </label>
                                </div>
                                <ul class="assignedto">
                                    <li><img src="/dashboards/assets/images/users/1.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Steave"></li>
                                    <li><img src="/dashboards/assets/images/users/2.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jessica"></li>
                                    <li><img src="/dashboards/assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                    <li><img src="/dashboards/assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                </ul>
                            </li>
                            <li class="list-group-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">
                                        <span>Lorem Ipsum is simply dummy text of the printing</span><span class="badge badge-pill badge-primary float-right">1 week
                                        </span>
                                    </label>
                                </div>
                                <div class="item-date"> 26 jun 2017</div>
                            </li>
                            <li class="list-group-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">
                                        <span>Give Purchase report to</span> <span class="badge badge-pill badge-info float-right">Yesterday</span>
                                    </label>
                                </div>
                                <ul class="assignedto">
                                    <li><img src="/dashboards/assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                    <li><img src="/dashboards/assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                </ul>
                            </li>
                            <li class="list-group-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">
                                        <span>Lorem Ipsum is simply dummy text of the printing </span> <span class="badge badge-pill badge-warning float-right">2
                                            weeks</span>
                                    </label>
                                </div>
                                <div class="item-date"> 26 jun 2017</div>
                            </li>
                            <li class="list-group-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck4">
                                    <label class="custom-control-label" for="customCheck4">
                                        <span>Give Purchase report to</span> <span class="badge badge-pill badge-info float-right">Yesterday</span>
                                    </label>
                                </div>
                                <ul class="assignedto">
                                    <li><img src="/dashboards/assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                    <li><img src="/dashboards/assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">YOU HAVE 5 NEW MESSAGES</h5>
                    <div class="message-box" id="msg" style="height: 430px;position: relative;">
                        <div class="message-widget message-scroll">
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <img src="/dashboards/assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5>Pavan kumar</h5> <span class="mail-desc">Lorem Ipsum is simply dummy
                                        text of the printing and type setting industry. Lorem Ipsum has
                                        been.</span> <span class="time">9:30 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <img src="/dashboards/assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you
                                        at</span> <span class="time">9:10 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <span class="round">A</span> <span class="profile-status away pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Arijit Sinh</h5> <span class="mail-desc">Simply dummy text of the
                                        printing and typesetting industry.</span> <span class="time">9:08
                                        AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <img src="/dashboards/assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my
                                        admin!</span> <span class="time">9:02 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <img src="/dashboards/assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5>Pavan kumar</h5> <span class="mail-desc">Welcome to the Elite
                                        Admin</span> <span class="time">9:30 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <img src="/dashboards/assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you
                                        at</span> <span class="time">9:10 AM</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CHAT</h5>
                    <div class="chat-box" id="chat" style="height: 327px;position: relative;">
                        <!--chat Row -->
                        <ul class="chat-list">
                            <!--chat Row -->
                            <li>
                                <div class="chat-img"><img src="/dashboards/assets/images/users/1.jpg" alt="user">
                                </div>
                                <div class="chat-content">
                                    <h5>James Anderson</h5>
                                    <div class="box bg-light-info">Lorem Ipsum is simply dummy text of the
                                        printing &amp; type setting industry.</div>
                                </div>
                                <div class="chat-time">10:56 am</div>
                            </li>
                            <!--chat Row -->
                            <li>
                                <div class="chat-img"><img src="/dashboards/assets/images/users/2.jpg" alt="user">
                                </div>
                                <div class="chat-content">
                                    <h5>Bianca Doe</h5>
                                    <div class="box bg-light-info">It’s Great opportunity to work.</div>
                                </div>
                                <div class="chat-time">10:57 am</div>
                            </li>
                            <!--chat Row -->
                            <li class="odd">
                                <div class="chat-content">
                                    <div class="box bg-light-inverse">I would love to join the team.</div>
                                    <br>
                                </div>
                                <div class="chat-time">10:58 am</div>
                            </li>
                            <!--chat Row -->
                            <li class="odd">
                                <div class="chat-content">
                                    <div class="box bg-light-inverse">Whats budget of the new project.</div>
                                    <br>
                                </div>
                                <div class="chat-time">10:59 am</div>
                            </li>
                            <!--chat Row -->
                            <li>
                                <div class="chat-img"><img src="/dashboards/assets/images/users/3.jpg" alt="user">
                                </div>
                                <div class="chat-content">
                                    <h5>Angelina Rhodes</h5>
                                    <div class="box bg-light-info">Well we have good budget for the project
                                    </div>
                                </div>
                                <div class="chat-time">11:00 am</div>
                            </li>
                            <!--chat Row -->
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-8">
                            <textarea placeholder="Type your message here" class="form-control border-0"></textarea>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-paper-plane"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



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
