@extends('backend.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Customer</h4><br>
                      <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Customer Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                         <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Customer Email</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Customer Mobile</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="mobile_no" value="{{ old('mobile_no') }}">
                                @error('mobile_no')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Customer Address</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="address" value="{{ old('address') }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Customer Image</label>
                            <div class="col-sm-9">
                                <input  id="image" class="form-control" type="file" name="image">
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <img  id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Card image cap">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-rounded btn-primary d-flex justify-content-end">Add Customer</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });

    </script>
@endsection