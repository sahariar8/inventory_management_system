@extends('backend.master')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Paid Customer All</h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('paid.customer.print.pdf') }}" class="btn btn-dark btn-rounded waves-effect waves-light" target="_black" style="float:right;"><i class="fa fa-print"> Print Paid Customer </i></a> <br>  <br>  

                    <h4 class="card-title">Paid All Data </h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Customer Name</th>
                                <th>Invoice No </th>
                                <th>Date</th>
                                <th>Due Amount</th>
                                <th>Action</th>

                        </thead>


                        <tbody>

                            @foreach ($allData as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $item['customer']['name'] }} </td>
                                    <td> {{ $item['invoice']['invoice_no'] }}</td>
                                    <td> {{ date('d-m-Y', strtotime($item['invoice']['date'])) }} </td>
                                    <td> {{ $item->due_amount }} </td>
                                    <td>
                                        <a href="{{ route('customer.invoice.details',$item->invoice_id) }}" class="btn btn-info sm" target="_black" title="Customer Details">  <i class="fa fa-eye"></i> </a>


                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
