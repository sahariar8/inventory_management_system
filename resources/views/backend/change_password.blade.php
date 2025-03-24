@extends('backend.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Change Password</h4><br>
                      <form action="{{ route('update.password') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Old Password</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="password" name="oldpassword" value="{{ old('old_password') }}">
                                @error('oldpassword')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                         <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="password" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="password" name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div> 
                        <button type="submit" class="btn btn-rounded btn-primary d-flex justify-content-end">change password</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection