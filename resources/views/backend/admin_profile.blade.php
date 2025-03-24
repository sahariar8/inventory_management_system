@extends('backend.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="col-lg-6 mx-auto">
            <div class="card"><br><br>
                <center>
                    <img class="rounded-circle avatar-xl" src="{{ !empty($user->image) ? url('upload/admin_images/'.$user->image) : url('upload/no_image.jpg') }}" alt="Card image cap">
                </center>
                <div class="card-body">
                    <h4 class="card-title">Name: <i class="text-primary">{{ $user->name }}</i></></h4><hr>
                    <h4 class="card-title">Email: <i class="text-primary">{{ $user->email }}</i></h4><hr>

                    <a href="{{ route('profile.edit') }}" class="btn btn-rounded btn-primary">Edit Profile</a>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection