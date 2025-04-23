@extends('backend.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Product</h4><br>
                      <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Supplier Name</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="supplier_id" aria-label="Default select example">
                                    <option value="" disabled selected="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                    <option  value="" disabled selected="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Unit Name</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="unit_id" aria-label="Default select example">
                                    <option  value="" disabled selected="">Select Unit</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Product Quantity</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" name="quantity" value="{{ old('quantity') }}">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-rounded btn-primary d-flex justify-content-end">Add Product</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection