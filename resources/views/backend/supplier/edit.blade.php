@extends('backend.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Supplier</h4><br>
                      <form action="{{ route('supplier.update') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="{{ $supplier->id }}">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Supplier Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="name" value="{{ $supplier->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                         <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Supplier Email</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="email" name="email" value="{{ $supplier->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Supplier Mobile</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="mobile_no" value="{{ $supplier->mobile_no }}">
                                @error('mobile_no')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Supplier Address</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="address" value="{{ $supplier->address }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div> 
                        <button type="submit" class="btn btn-rounded btn-primary d-flex justify-content-end">Update Supplier</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection