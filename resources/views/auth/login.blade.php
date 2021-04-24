@extends('layouts.app')
@section('style')
<link href="{{ asset('dashboards/dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
<link href="{{ asset('dashboards/dist/css/style.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<section id="wrapper" class="mt-n5">
    <div class="login-register" style="background-image:url({{ asset('dashboards/assets/images/background/login-register.jpg') }});">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h3 class="text-center m-b-20">Sign In</h3>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input {{ old('remember') ? "checked" : " " }} class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember"> Remember Me </label>
                                </div>
                                <div class="ml-auto">
                                    <a class="btn btn-link text-muted" href="javascript:void(0)" id="to-recover">
                                        <i class="fas fa-lock m-r-5"></i> Forgot pwd?
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button type="submit" class="btn btn-block btn-lg btn-info btn-rounded text-white"> Log In </button>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            Don't have an account? <a href="{{ route('register') }}" class="text-info m-l-5"><b>Sign Up</b></a>
                        </div>
                    </div>
                </form>

                <form class="form-horizontal" id="recoverform" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light"> {{ __('Reset') }} </button>

                        </div>
                    </div>
                    <a href="{{ url()->previous() }}" class="text-right text-muted d-block">Back ?</a>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script src="{{ asset('dashboards/assets/node_modules/popper/popper.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });

</script>



@endsection
