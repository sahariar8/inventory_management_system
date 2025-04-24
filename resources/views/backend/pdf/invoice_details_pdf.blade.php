@extends('backend.master')
@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"> Customer Payment Report </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                        <li class="breadcrumb-item active">Customer Payment Report</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-16"><strong>Invoice No #
                                        {{ $payment['invoice']['invoice_no'] }}</strong></h4>
                                <h3>
                                    <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo"
                                        height="26" class="mb-1" />
                                    <span class="mt-2"> Shahariar Shopping Mall</span>
                                </h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-6 mt-4">
                                    <address>
                                        <strong>Sahariar Shopping Mall</strong><br>
                                        Mirpur 11.5, Dhaka-1216<br>
                                        sahariaralam8@gmail.com
                                    </address>
                                </div>
                                <div class="col-6 mt-4 text-end">
                                    <address>
                                        <strong>Invoice Date:</strong><br>
                                        {{ date('d-m-Y', strtotime($payment['invoice']['date'])) }} <br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="p-2">
                                    <h3 class="font-size-16"><strong>Customer Invoice</strong></h3>
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td><strong>Customer Name</strong></td>
                                                    <td class="text-center"><strong>Customer Mobile</strong></td>
                                                    <td class="text-center"><strong>Address</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="ml-4"> {{ $payment['customer']['name'] }}</td>
                                                    <td class="text-center">{{ $payment['customer']['mobile_no'] }}</td>
                                                    <td class="text-center">{{ $payment['customer']['email'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="p-2">

                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td class="text-center"><strong>Sl </strong></td>
                                                    <td class="text-center"><strong>Category</strong></td>
                                                    <td class="text-center"><strong>Product Name</strong>
                                                    </td>
                                                    <td class="text-center"><strong>Current Stock</strong>
                                                    </td>
                                                    <td class="text-center"><strong>Quantity</strong>
                                                    </td>
                                                    <td class="text-center"><strong>Unit Price </strong>
                                                    </td>
                                                    <td class="text-center"><strong>Total Price</strong>
                                                    </td>

                                                </tr>
                                            </thead>
                                            <tbody>


                                                @php
                                                    $total_sum = '0';

                                                    $invoice_details = App\Models\InvoiceDetails::where(
                                                        'invoice_id',
                                                        $payment->invoice_id,
                                                    )->get();
                                                @endphp
                                                @foreach ($invoice_details as $key => $details)
                                                    <tr>
                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                        <td class="text-center">{{ $details['category']['name'] }}</td>
                                                        <td class="text-center">{{ $details['product']['name'] }}</td>
                                                        <td class="text-center">{{ $details['product']['quantity'] }}</td>
                                                        <td class="text-center">{{ $details->selling_qty }}</td>
                                                        <td class="text-center">{{ $details->unit_price }}</td>
                                                        <td class="text-center">{{ $details->selling_price }}</td>

                                                    </tr>
                                                    @php
                                                        $total_sum += $details->selling_price;
                                                    @endphp
                                                @endforeach
                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-center">
                                                        <strong>Subtotal</strong>
                                                    </td>
                                                    <td class="thick-line text-center">${{ $total_sum }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>Discount Amount</strong>
                                                    </td>
                                                    <td class="no-line text-center">${{ $payment->discount_amount ? $payment->discount_amount : "0.00" }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>Paid Amount</strong>
                                                    </td>
                                                    <td class="no-line text-center">${{ $payment->paid_amount }}</td>
                                                </tr>

                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>Due Amount</strong>
                                                    </td>
                                                    <td class="no-line text-center">${{ $payment->due_amount }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>Grand Amount</strong>
                                                    </td>
                                                    <td class="no-line text-center">
                                                        <h4 class="m-0">${{ $payment->total_amount }}</h4>
                                                    </td>
                                                </tr>


             <tr>
                <td colspan="7" style="text-align: center;"><span class="fw-bold">Paid Summary</span></td>
                
            </tr>

             <tr>
                <td colspan="4" style="text-align: center;font-weight: bold;">Date </td>
                <td colspan="3" style="text-align: center;font-weight: bold;">Amount</td>
                
            </tr>
@php
$payment_details = App\Models\PaymentDetails::where('invoice_id',$payment->invoice_id)->get();

@endphp

            @foreach($payment_details as $item)
             <tr>
                <td colspan="4" style="text-align: center;">{{ date('d-m-Y',strtotime($item->date)) }}</td>
                <td colspan="3" style="text-align: center;">{{ $item->current_paid_amount }}</td>
                
            </tr>
            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-print-none">
                                        <div class="float-end">
                                            <a href="javascript:window.print()"
                                                class="btn btn-success waves-effect waves-light"><i
                                                    class="fa fa-print"></i></a>
                                            <a href="#"
                                                class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div> 
    </div> 
@endsection
