@extends('layouts.app')
@section('style')
<link href="{{ asset('dashboards/dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
<link href="{{ asset('dashboards/dist/css/style.min.css') }}" rel="stylesheet">
<style>
    .invalid-error {
        background-image: linear-gradient(#e11b1b, #e11b1b), linear-gradient(#e9ecef, #e9ecef) !important;
    }

</style>
@endsection

@section('content')
<section id="wrapper" class="mt-n5">
    <div class="login-register" style="background-image:url({{ asset('/dashboards/assets/images/background/login-register.jpg') }});">

        <div class="login-box card">
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" class="form-horizontal form-material" id="loginform">
                    @csrf
                    <h3 class="text-center m-b-10">Sign Up</h3>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="name" type="text" class="form-control @error('name') invalid-error @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Name">
                            @error('name')
                            <small class="text-danger pt-2">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="username" type="text" class="form-control @error('username') invalid-error @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus placeholder="Username">
                            @error('username')
                            <small class="text-danger pt-2">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control @error('email') invalid-error @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email">

                            @error('email')
                            <small class="text-danger pt-2">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control @error('password') invalid-error @enderror" name="password" autocomplete="new-password" placeholder="Password">
                            @error('password')
                            <small class="text-danger pt-2">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <select name="role_id" id="role" class="form-control @error('role_id') invalid-error @enderror custom-select">
                                <option value="" selected disabled>Register As</option>
                                <option value="2">Author</option>
                                <option value="3">User</option>
                            </select>
                        </div>
                    </div>
                    @error('role_id')
                    <small class="text-danger pt-2">{{ $message }}</small>
                    @enderror

                    <div class="form-group row my-4">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">I agree to all <a href="">Terms & Conditions</a></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center p-b-20">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-info btn-lg btn-block btn-rounded-lg text-uppercase waves-effect waves-light text-white" type="submit">Sign Up</button>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            Already have an account? <a href="{{ route('login') }}" class="text-info m-l-5"><b>Sign In</b></a>
                        </div>
                    </div>
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
