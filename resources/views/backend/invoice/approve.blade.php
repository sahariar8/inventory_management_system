@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Invoice Approve</h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4>Invoice No: #{{ $invoice->invoice_no }} Date: {{ date('d-m-Y', strtotime($invoice->date)) }} </h4>
                    <a href="{{ route('invoice.pending') }}" class="btn btn-rounded btn-primary" style="float:right"><i
                            class="fas fa-list"> Pending Invoice List</i></a><br><br>

                    <table class="table table-dark" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <p> Customer Info </p>
                                </td>
                                <td>
                                    <p> Name: <strong> {{ $payment->customer->name }} </strong> </p>
                                </td>
                                <td>
                                    <p> Mobile: <strong> {{ $payment->customer->mobile_no }} </strong> </p>
                                </td>
                                <td>
                                    <p> Email: <strong> {{ $payment->customer->email }} </strong> </p>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <p> Description : <strong> {{ $invoice->description }} </strong> </p>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    <form action="{{ route('approval.store',$invoice->id) }}" method="post">
                        @csrf
                        <table border="1" class="table table-dark" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center" style="background-color: #8B008B">Current Stock</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Unit Price </th>
                                    <th class="text-center">Total Price</th>
                                </tr>

                            </thead>
                            <tbody>
                                @php
                                    $total_sum = '0';
                                @endphp
                                @foreach ($invoice['invoiceDetails'] as $key => $details)
                                    <tr>
                                        <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                                        <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                                        <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{ $details->selling_qty }}">
                                        
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $details['category']['name'] }}</td>
                                        <td class="text-center">{{ $details['product']['name'] }}</td>
                                        <td class="text-center" style="background-color: #8B008B">{{ $details['product']['quantity'] }}</td>
                                        <td class="text-center">{{ $details->selling_qty }}</td>
                                        <td class="text-center">{{ $details->unit_price }}</td>
                                        <td class="text-center">{{ $details->selling_price }}</td>
                                    </tr>
                                        @php
                                            $total_sum += $details->selling_price;
                                        @endphp
                                @endforeach
                                <tr>
                                    <td colspan="6"> Sub Total </td>
                                     <td class="text-center"> {{ $total_sum }} </td>
                                </tr>
                                 <tr>
                                    <td colspan="6"> Discount </td>
                                     <td class="text-center"> {{ $payment->discount_amount }} </td>
                                </tr>
                        
                                 <tr>
                                    <td colspan="6"> Paid Amount </td>
                                     <td class="text-center">{{ $payment->paid_amount }} </td>
                                </tr>
                        
                                 <tr>
                                    <td colspan="6"> Due Amount </td>
                                     <td class="text-center"> {{ $payment->due_amount }} </td>
                                </tr>
                        
                                <tr>
                                    <td colspan="6"> Grand Amount </td>
                                     <td class="text-center">{{ $payment->total_amount }}</td>
                                </tr>
                            </tbody>
                        </table>


                        <button type="submit" class="btn btn-info">Invoice Approve </button>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
