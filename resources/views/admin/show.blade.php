@extends('layouts.dashboard')

@section('style')

@endsection

@section('dashboard')

<div class="container-fluid">

    <div class="page-titles">
        <div class="row">
            <div class="col-md-5 align-self-center mb-4">
                <h4 class="text-themecolor">Contact Details</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Contact Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card"> <img class="card-img" src="/dashboards/assets/images/background/socialbg.jpg" height="456" alt="Card image">
                    <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
                        <div class="align-self-center"> <img src="{{ $user->profile() }}" class="img-circle" width="80">
                            <h4 class="card-title">{{ $user->name }}</h4>
                            <h6 class="card-subtitle mt-1">@foreach ($roles as $role )@php $name = $role->label @endphp
                                {{ $user->roles->pluck('label')->contains($name) ? $name : '' }}@endforeach</h6>
                            <p class="text-white">{{ $user->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a>
                        </li>
                        @if(Auth::id() == $user->id)
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a>
                        </li>
                        @endif
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="profile" role="tabpanel">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>Gender</strong>
                                        <br>
                                        <p class="text-muted text-capitalize">{{ $user->gender }}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->phone }}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="font-medium m-t-30">Description</h4>
                                <p class="m-t-30 text-justify">{{ $user->description }}</p>
                                <hr>
                                <h4 class="font-medium m-t-30">Biography</h4>
                                <p class="m-t-30 text-justify">{{ $user->biography }}</p>

                            </div>
                        </div>

                        <div class="tab-pane" id="settings" role="tabpanel">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="POST" action="/admin/user/edit/{{ $user->id }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">

                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" value="{{ $user->name }}">
                                        @error('name')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>

                                    <div class="form-group">

                                        <label for="username">UserName</label>
                                        <input type="text" class="form-control @error('title') border-danger @enderror" id="username" name="username" value="{{ $user->username }}">
                                        @error('username')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="date_of_birth">Date Of Birth</label>
                                        <input type="date" class="form-control @error('date_of_birth') border-danger @enderror" id="date_of_birth" name="date_of_birth" value="{{ $user->date_of_birth }}">
                                        @error('date_of_birth')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>

                                    <label for="email">Email</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                        </div>
                                        <input type="email" class="form-control @error('email') border-danger @enderror" id="email" name="email" value="{{ $user->email }}">
                                        @error('email')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="number" class="form-control @error('phone') border-danger @enderror" id="phone" name="phone" rows="6" value="{{ $user->phone }}">
                                        @error('phone')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="" disabled>Choose Gender</option>
                                            <option value="male" {{ $user->gender == 'male' ? "selected" : "" }}>Male
                                            </option>
                                            <option value="female" {{ $user->gender == 'female' ? "selected" : "" }}>
                                                Female</option>
                                            <option value="other" {{ $user->gender == 'other' ? "selected" : "" }}>Other
                                            </option>
                                        </select>
                                        @error('gender')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control @error('description') border-danger @enderror" id="description" name="description" rows="6">{{ $user->description }}</textarea>
                                        @error('description')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="biography">Biography</label>
                                        <textarea class="form-control @error('biography') border-danger @enderror" id="biography" name="biography" rows="6">{{ $user->biography }}</textarea>
                                        @error('biography')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>

                                    @if ($user->profile)
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <img class="" src="{{ $user->profile() }}" width="35" alt="{{config('app.name')}}-{{ $user->profile }}">
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profile" name="profile" aria-describedby="profile">
                                            <label class="custom-file-label" for="profile">Upload Profile Photo</label>
                                        </div>
                                    </div>
                                    @else
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="profile">Profile</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profile" name="profile" aria-describedby="profile">
                                            <label class="custom-file-label" for="profile">Upload Profile Photo</label>
                                        </div>
                                    </div>
                                    @endif

                                    <input type="submit" value="Update" class="btn btn-success">

                                </form>

                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary float-right mr-3 text-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@section('script')
<script src="{{ asset('dashboards/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('dashboards/assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>
@endsection

@endsection
