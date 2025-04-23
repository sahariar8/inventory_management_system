@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Print Invoice All</h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <a href="{{ route('invoice.add') }}" class="btn btn-rounded btn-primary" style="float:right"><i
                            class="fas fa-plus-circle"> Add Invoice</i></a><br><br> --}}
                    <h4 class="card-title">Print Invoice Data </h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Customer Name</th>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($allData as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $item->payment->customer->name }} </td>
                                    <td> # {{ $item->invoice_no }}</td>
                                    <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>
                                    <td> {{ $item->description }} </td>
                                    <td> {{ $item->payment->total_amount }}</td>
                                    <td>
                                        <a href="{{ route('print.invoice',$item->id) }}" class="btn btn-primary sm"
                                            title="priint invoice"> <i class="fa fa-print"></i> 
                                        </a>
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
