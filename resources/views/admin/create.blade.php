@extends('layouts.dashboard')

@section('style')

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />

<link href="{{ asset('dashboards/dist/css/pages/file-upload.css') }}" rel="stylesheet">
@endsection

@section('dashboard')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Registration Form</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Registration Form</li>
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
                    <form class="form-horizontal form-material" method="POST" action="/admin/user" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" placeholder="">
                            @error('name')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') border-danger @enderror" id="username" name="username" placeholder="">
                            @error('username')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>


                        <label for="email">Email</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="email" class="form-control @error('email') border-danger @enderror" id="email" name="email">
                        </div>
                        @error('email')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror

                        <label for="password">Passwrod</label>
                        <div class="input-group mb-3">
                            <input class="form-control" type="password" name="password" id="password" value="Enter the password">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-eye" id="togglePassword"></i></span>
                            </div>
                            <div class="input-group-prepend">
                                <a onclick="generate()" type="button" class="input-group-text" id="basic-addon2">Generate</a>
                            </div>

                        </div>

                        @error('password')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror


                        <div class="form-group">
                            <label for="gender">Role</label>
                            <select name="role_id" id="role_id" class="form-control @error('role_id') border-danger @enderror">
                                <option value="" disabled selected>Choose For Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>

                        <input type="submit" value="Create" class="btn btn-success">

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>

<script src="{{ asset('dashboards/dist/js/pages/jasny-bootstrap.js') }}"></script>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    // Show Password  button
    togglePassword.addEventListener('click', function(e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    // Generate Password
    function generate() {
        var passwd = '';
        var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        for (i = 1; i < 18; i++) {
            var c = Math.floor(Math.random() * chars.length + 1);
            passwd += chars.charAt(c)
        };
        document.getElementById('password').value = passwd;
    }
    // Click once generate
    $(function() {
        $("#basic-addon2").click();
    });

</script>
@endsection
