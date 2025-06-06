@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Customers All</h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('customer.add') }}" class="btn btn-rounded btn-primary" style="float:right"><i class="fas fa-plus-circle"> Add Customer</i></a><br><br>
                    <h4 class="card-title">Customer All Data </h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Customer Name</th>
                                <th>Image</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>Address</th>
                                <th>Action</th>

                        </thead>


                        <tbody>

                            @foreach ($allCustomer as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $item->name }} </td>
                                    <td>
                                        <img src="{{ asset($item->image) }}" height="60px" width="60px" alt="">
                                    </td>
                                    <td> {{ $item->email }} </td>
                                    <td> {{ $item->mobile_no }} </td>
                                    <td> {{ $item->address }} </td>

                                    <td>
                                        <a href="{{ route('customer.edit',$item->id) }}" class="btn btn-info sm"
                                            title="Edit Data"> <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route('customer.delete',$item->id) }}" class="btn btn-danger sm"
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
