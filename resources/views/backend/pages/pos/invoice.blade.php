@extends('backend.layout.template')
@section('page-title')
    <title>Order Invoice || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }} </title>
@endsection

@section('page-css')
    {{-- custom --}}
    <style type="text/css">
        address {
            margin: 0 !important;
        }
    </style>
@endsection

@section('body-content')

    <!-- Start Page-content -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="page-title">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Stock Savvy</a></li>
                                <li class="breadcrumb-item active">Order Invoice</li>
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

                            <h4 class="card-title">
                                Order Invoice
                            </h4>

                            <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="invoice-title">
                                                    <h4 class="float-end font-size-16"><strong>Order #{{$order_invoice->id}}</strong></h4>
                                                    <h3>
                                                        <!--favicon-->
                                                        @php
                                                            $favIcon = \App\Models\Settings::shop_fav();
                                                        @endphp
                                                        @if(!is_null($favIcon))
                                                            <img src="{{ asset($favIcon->fav_icon) }}" alt="logo" height="24"/>
                                                        @endif
                                                    </h3>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <address>
                                                            <strong>Billed To:</strong><br>
                                                            {{$order_invoice->customer->name}}<br>
                                                            {{$order_invoice->customer->phone}}<br>
                                                            {{$order_invoice->customer->email}}<br>
                                                            {{$order_invoice->customer->address}}<br>
                                                            {{$order_invoice->customer->shop_name}}
                                                        </address>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <address>
                                                            <strong>Shipped To:</strong><br>
                                                            {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : ''}}<br>

                                                            {{ !is_null($shop_email = App\Models\Settings::shop_email()) ? $shop_email->email1: ''}}<br>

                                                            {{ !is_null($call_1 = App\Models\Settings::call_1()) ? $call_1->phone1  : ''}}<br>

                                                            {{ !is_null($shop_address = App\Models\Settings::shop_address()) ? $shop_address->address : ''}}<br>

                                                            {{ !is_null($city = App\Models\Settings::city()) ? $city->city . ', ' . $city->zip : '' }}<br>
                                                        </address>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mt-4">
                                                        <address>
                                                            <strong>Payment Method:</strong><br>
                                                            @if( !is_null($order_invoice->customer->bank_name) )
                                                               Bank Name: {{$order_invoice->customer->bank_name}}
                                                                <br>
                                                            @endif
                                                            
                                                            @if( !is_null($order_invoice->customer->bank_account) )
                                                                Bank Account: {{$order_invoice->customer->bank_account}}
                                                                <br>
                                                            @endif

                                                            @if( !is_null($order_invoice->payment_status) )
                                                                Payment: {{$order_invoice->payment_status}}
                                                                <br>
                                                            @endif
                                                        </address>
                                                    </div>
                                                    <div class="col-6 mt-4 text-end">
                                                        <address>
                                                            <strong>Order Date:</strong><br>
                                                            @if( !is_null($order_invoice->order_date) )
                                                                Order Date: {{$order_invoice->order_date}}
                                                                <br>
                                                            @endif

                                                            @if( !is_null($order_invoice->issue_date) )
                                                                Issue Date: {{$order_invoice->issue_date}}
                                                                <br>
                                                            @endif
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
        
                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <div class="p-2">
                                                        <h3 class="font-size-16"><strong>Order summary</strong></h3>
                                                    </div>
                                                    <div class="">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <td><strong>Sl.</strong></td>
                                                                    <td><strong>Image</strong></td>
                                                                    <td><strong>Product Title</strong></td>
                                                                    <td class="text-center"><strong>Price</strong></td>
                                                                    <td class="text-center"><strong>Quantity</strong>
                                                                    </td>
                                                                    <td class="text-end"><strong>Totals</strong></td>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                                    <?php
                                                                        $count = 1;
                                                                    ?>
                                                                    @foreach( $items as $item )
                                                                        <tr>
                                                                            <td>{{$count++}}</td>
                                                                            <td>
                                                                                @if( !is_null($item->product->image) )
                                                                                    <img src="{{asset($item->product->image)}}" alt="" class="user-img">
                                                                                @else
                                                                                    <img src="{{asset('backend/images/default.jpg')}}" alt="" class="user-img">
                                                                                @endif
                                                                            </td>
                                                                            <td>{{$item->product->title}}</td>
                                                                            <td class="text-center">{{$item->product->selling_price}}</td>
                                                                            <td class="text-center">{{$item->product_quantity}}</td>
                                                                            <td class="text-end">
                                                                                {{ $item->product->selling_price * $item->product_quantity}}tk
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4"></td>
                                                                            <td align="right">Vat(%)</td>
                                                                            <td align="right">
                                                                                @if( !is_null($order_invoice->vat) )
                                                                                    {{$order_invoice->vat}}.00%
                                                                                @else
                                                                                    0.00%
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4"></td>
                                                                            <td align="right">Paid Amount</td>
                                                                            <td align="right">
                                                                                {{$order_invoice->paid_amn}}.00tk
                                                                            </td>
                                                                        </tr>
                                                                        @if( !is_null($order_invoice->discount_amn) )
                                                                            <tr>
                                                                                <td colspan="4"></td>
                                                                                <td align="right">Discount Amount</td>
                                                                                <td align="right">
                                                                                    {{$order_invoice->discount_amn}}.00tk
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                        <tr>
                                                                            <td colspan="4"></td>
                                                                            <td align="right">Grand Total</td>
                                                                            <td align="right">
                                                                                {{ $order_invoice->total_amn + $order_invoice->vat - $order_invoice->discount_amn }}.00tk
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
        
                                                        <div class="d-print-none">
                                                            <div class="float-end">
                                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                                <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Send</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </div>
                                        </div> <!-- end row -->
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

            
        </div> 
    </div>
    <!-- End Page-content -->
                
@endsection

@section('page-script')
   
    
    


@endsection