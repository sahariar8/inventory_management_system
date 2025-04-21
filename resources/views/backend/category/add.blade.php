@extends('backend.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Category</h4><br>
                      <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-rounded btn-primary d-flex justify-content-end">Add Category</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection