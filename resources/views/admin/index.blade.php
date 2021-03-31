@extends('layouts.dashboard')

@section('style')

@endsection

@section('dashboard')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User lists</h4>
                <h6 class="card-subtitle"></h6>
                <a href="{{ url('/admin/user/create') }}" type="button" class="btn btn-info btn-rounded m-t-10 text-white float-right" >Add New User</a>
                <div class="table-responsive">
                    <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Age</th>
                                <th>Joining date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <a href=""><img src="{{ asset('/storage/'.$user->profile) }}" alt="user" width="40" height="40" class="img-circle" /> {{ $user->name }}</a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>

                                    @if ( $user->roles->pluck('name')->contains('Admin') )
                                    <span class="label label-danger">Admin<span>
                                            @elseif ( $user->roles->pluck('name')->contains('Member') )
                                            <span class="label label-warning">Member<span>
                                                    @elseif ( $user->roles->pluck('name')->contains('User') )
                                                    <span class="label label-primary">User<span>
                                                            @else
                                                            <span class="label label-success">User<span>
                                                                    @endif
                                </td>
                                <td>{{ $user->getAge($user->date_of_birth) }}</td>
                                <td>
                                    <p class="text-center mb-2">{{ $user->created_at->format('Y-M-d') }}</p>
                                    <p class="text-center text-muted "><small class="text-right">{{ $user->created_at->diffForHumans() }}</small></p>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.detail',['id' => $user->id]) }}" class="btn btn-success">Detail</a>
                                    <a href="{{ url('admin/user/delete/'.$user->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')

@endsection

@endsection
