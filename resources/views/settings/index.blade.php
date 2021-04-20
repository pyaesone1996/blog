@extends('layouts.dashboard')
@section('dashboard')
<div class="container-fluid p-0">
    <div class="bg-white px-3 pb-5">
        <div class="row mb-3">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">General Settings</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                @foreach($settings as $setting)
                <form method="post" action="settings/{{ $setting->id }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @if ($setting->site_logo)
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <img class="" src="{{ $setting->site_logo }}" width="50" alt="{{config('app.name')}}">
                        </div>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="site_logo" name="site_logo">
                                <label class="custom-file-label" for="site_logo" data-browse="Logo">Choose Logo</label>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($setting->site_icon)
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <img class="" src="{{ $setting->site_icon }}" width="50" alt="{{config('app.name')}}">
                        </div>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="site_icon" name="site_icon">
                                <label class="custom-file-label" for="site_icon" data-browse="Icon">Choose Icon</label>
                            </div>

                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label for="site_title" class="col-form-label col-sm-2">Site Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="site_title" name="site_title" value="{{ $setting->site_title }}">
                            <small class="text-muted">Descriped your website name!</small>
                        </div>
                        @error('site_title')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="site_tagline" class="col-form-label col-sm-2">Tagline</label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('excerpt') border-danger @enderror" id="excerpt" name="site_tagline" rows="3">{{ $setting->site_tagline }}</textarea>
                            <small class="text-muted">In a few words, explain what this site is about.</small>
                        </div>
                        @error('site_tagline')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="site_description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('site_description') border-danger @enderror" id="site_description" name="site_description" rows="6">{{ $setting->site_description }}</textarea>
                        </div>
                        @error('site_description')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2  col-form-label" for="footer_information">Footer Information</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="footer_information" name="footer_information" value="{{ $setting->footer_information }}">
                        </div>
                        @error('footer_information')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Admin Email Address</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="email" class="form-control" value="{{ $setting->email }}">
                        </div>
                        @error('site_description')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2  col-form-label" for="facebook">Facebook</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $setting->facebook }}">
                        </div>
                        @error('facebook')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2  col-form-label" for="twitter">Twitter</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $setting->twitter }}">
                        </div>
                        @error('twitter')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2  col-form-label" for="youtube">YouTube</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $setting->youtube }}">
                        </div>
                        @error('youtube')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-primary">Cancle</a>
                    <input type="submit" value="Update" class="btn btn-success">

                </form>
                @endforeach

            </div>
        </div>
    </div>
</div>




@endsection
