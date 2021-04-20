<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $setting->site_description }}">
    <meta name="PowerBy" content="https://www.thecalmtech.com">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/storage').'/'.$setting->site_icon }}">
    <title>{{ $setting->site_title }} | {{$setting->site_tagline }}</title>

    @yield('style')
    <link href="{{ asset('dashboards/dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body class="skin-blue fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">{{ $setting->site_title }}</p>
        </div>
    </div>

    <div id="main-wrapper">

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">

                <div class="navbar-header">
                    <a class="d-block navbar-brand" target="_blank" href="{{ url('/') }}">
                        <img src="{{ asset('storage').'/'.$setting->site_logo }} " alt="homepage" class="logoimg" />
                        <h3 class="mb-0 text-center logotext">{{$setting->site_title }}</h3>
                    </a>
                </div>


                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" onclick="logo()"><i class="icon-menu"></i></a> </li>

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item">
                            <form class="app-search d-none d-md-block d-lg-block">
                                <input type="text" class="form-control" placeholder="Search & enter">
                            </form>
                        </li>
                    </ul>

                    <ul class="navbar-nav my-lg-0">

                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ Auth::user()->profile() }}" alt="{{ Auth::user()->username.'-image' }}" class="img-circle" height="30"> <span class="hidden-md-down">{{ Auth::user()->username }}&nbsp;<i class="fa fa-angle-down"></i></span> </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <!-- text-->
                                <a href="{{ route('admin.users.detail',['id' => Auth::id()] ) }}" class="dropdown-item"><i class="ti-user"></i> My
                                    Profile</a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i> Logout
                                </a>

                                <!-- text-->
                                {{-- <a href="javascript:void(0)" class="dropdown-item"><i class="ti-wallet"></i> My
                                    Balance</a>
                                <!-- text-->
                                <a href="javascript:void(0)" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Account
                                    Setting</a> --}}
                                <!-- text-->
                                {{-- <div class="dropdown-divider"></div> --}}
                                <!-- text-->

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <!-- text-->
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a href="{{ route('dashboard') }}"><i class="icon-speedometer"></i><span class="hide-menu">Dashboards</span></a>
                        </li>
                        <li class="nav-small-cap">--- ARTICLE</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Articles</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('admin/articles') }}">All Articles</a></li>
                                <li><a href="{{ url('admin/articles/create') }}">Create Article</a></li>
                                @if (Auth::user()->roles->pluck('name')->contains('Admin'))
                                <li><a href="{{ url('admin/categories/') }}">Categories</a></li>
                                <li><a href="#">Tag</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-small-cap">--- USER</li>

                        @if(Auth::user()->hasRole('Admin'))
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><span class="ti-user"></span>
                                <span class="hide-menu">User</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.users') }}">All</a></li>
                                <li><a href="{{ route('admin.create') }}">Create User</a></li>
                            </ul>
                        </li>
                        @endif

                        <li><a href="{{ url('admin/user/detail/'.Auth::id()) }}"><span class=" icon-home"></span> <span class="hide-menu">Your Profile</span></a></li>




                        <li class="nav-small-cap">--- SETTING</li>
                        @if(Auth::user()->hasRole('Admin'))
                        <li> <a class="waves-effect waves-dark" href="{{ url('settings') }}" aria-expanded="false"><i class="far fa-circle text-danger"></i><span class="hide-menu">Setting</span></a></li>
                        @endif

                        <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="far fa-circle text-success"></i>
                                <span class="hide-menu">Log Out</span>
                            </a>

                        </li>
                        {{-- <li> <a class="waves-effect waves-dark" href="pages-faq.html" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">FAQs</span></a></li> --}}
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            @yield('dashboard')

        </div>
        <footer class="footer">
            {{ $setting->footer_information }}
        </footer>

        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span>
                </div>
                <div class="r-panel-body">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a>
                        </li>
                        <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme working">4</a>
                        </li>
                        <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a>
                        </li>
                        <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a>
                        </li>
                        <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>

                </div>
            </div>
        </div>


    </div>


    <script src="{{ asset('dashboards/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('dashboards/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>

    <script src="{{ asset('dashboards/assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('dashboards/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboards/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('dashboards/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dashboards/dist/js/custom.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.logoimg').hide();
        });

        function logo() {
            $('.logoimg').toggle();
            $('.logotext').toggle();
        }

    </script>
    @yield('script')

</body>

</html>
