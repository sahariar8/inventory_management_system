@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Products All</h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('product.add') }}" class="btn btn-rounded btn-primary" style="float:right"><i class="fas fa-plus-circle"> Add Product</i></a><br><br>
                    <h4 class="card-title">Products All Data </h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Product Name</th>
                                <th>Supplier Name</th>
                                <th>Category Name</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Action</th>

                        </thead>


                        <tbody>

                            @foreach ($products as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $item->name }} </td>
                                    <td> {{ $item->supplier->name }} </td>
                                    <td> {{ $item->category->name }} </td>
                                    <td> {{ $item->unit->name }} </td>
                                    <td> {{ $item->quantity }} </td>

                                    <td>
                                        <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info sm"
                                            title="Edit Data"> <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger sm"
                                            title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i> </a>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
