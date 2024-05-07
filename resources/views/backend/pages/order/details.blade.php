@extends('backend.layout.template')
@section('page-title')
    <title>Order Detials || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }} </title>
@endsection

@section('page-css')
    {{-- custom --}}
    <style>
        .card-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        h5 {
            font-size: 16px !important;
            font-weight: 800 !important;
        }
        .customer th {
            background: #252b3be6;
            color: white;
        }
        .p_d {
            background: #252b3be6 !important;
            color: white;
        }
        .customer {
            background: #f7f6f6;
        }
        .btn-danger {
            padding: 1px 5px;
            font-size: 11px;
            font-weight: 800;
        }
    </style>
    <!-- Responsive datatable examples -->
    <link href="{{asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />   
    <link href="{{asset('backend/libs/select2/css/select2.min.css')}}" rel="stylesheet">
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
                                <li class="breadcrumb-item active">Order Detials</li>
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
                                Order's Detials
                                <a href="{{route('manage.order')}}" class="btn btn-primary waves-effect waves-light">
                                    All Orders <i class="ri-arrow-right-line align-middle ms-2"></i> 
                                </a>
                            </h4>

                            <div class="row">
                                <div class="col-md-5 col-lg-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="information-box mb-3">
                                                <div class="table-responsive order-details">
                                                    <h5 class="h5">Customer Details</h5>
                                                    <table class="table table-bordered customer">
                                                        <thead class="">
                                                            <tr>
                                                                <th>Customer Name</th>
                                                                <td>{{$details->customer->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td>{{$details->customer->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Phone</th>
                                                                <td>{{$details->customer->phone}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <td>
                                                                    {{$details->customer->address}}
                                                                 </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Shop Name</th>
                                                                <td>{{$details->customer->shop_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bank Account</th>
                                                                <td>{{$details->customer->bank_account}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bank Name</th>
                                                                <td>{{$details->customer->bank_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>City / State</th>
                                                                <td>{{$details->customer->city}}</td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7 col-lg-7">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="information-box mb-3">
                                                <div class="table-responsive order-details">
                                                    <h5 class="h5">Product Details</h5>
                                                         <table class="table table-bordered">
                                                            <thead class="p_d">
                                                                <tr>
                                                                    <th>Sl.</th>
                                                                    <th>Product Title</th>
                                                                    <th>Unit Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php $sl = 0; @endphp
                                                                @foreach( $items as $item )
                                                                    <tr>
                                                                        <td>{{++$sl}}</td>
                                                                        <td>
                                                                            <a href="{{route('show.product', $item->product->slug)}}" style="color:#172b4d;" target="_blank" title="product details">
                                                                                {{ $item->product->title }}
                                                                            </a>
                                                                            
                                                                        </td>
                                                                        <td>৳{{ $item->product->selling_price }}</td>
                                                                        <td>{{ $item->product_quantity }}</td>
                                                                        <td>৳{{ $item->product->selling_price * $item->product_quantity }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr style="background: #F7F6F6;">
                                                                    <td colspan="3"></td>
                                                                    <th>Total Amount <span style="font-size: 12px;">{{( !is_null($details->vat) ) ? "(inc vat - $details->vat%)" : ""}}</span></th>
                                                                    <th>

                                                                        @if (!is_null($details->vat))
                                                                            @php
                                                                                $vatRate = $details->vat;
                                                                                $totalAmount = $details->total_amn;
                                                                                $vatAmount = ($vatRate / 100) * $totalAmount;
                                                                                $totalIncludingVat = $totalAmount + $vatAmount;
                                                                                $total_amn = number_format($totalIncludingVat, 2);
                                                                            @endphp
                                                                            ৳{{ $total_amn }}
                                                                        @else
                                                                            ৳{{ $details->total_amn }}.00
                                                                        @endif
                                                                    
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3"></td>
                                                                    <th>Paid Amount</th>
                                                                    <th>৳{{ $details->paid_amn }}.00</th>
                                                                </tr>
                                                                @if( !is_null($details->discount_amn) )
                                                                    <tr style="background: #F7F6F6;">
                                                                        <td colspan="3"></td>
                                                                        <th>Discount Amount</th>
                                                                        <th style="color: #ff0000c7">- ৳{{ $details->discount_amn }}.00</th>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td colspan="3"></td>
                                                                    <th>Due Amount</th>
                                                                    <th>
                                                                        @if (!is_null($details->vat))
                                                                            @php
                                                                                $vatRate = $details->vat;
                                                                                $totalAmount = $details->total_amn;
                                                                                $vatAmount = ($vatRate / 100) * $totalAmount;
                                                                                $totalIncludingVat = $totalAmount + $vatAmount;
                                                                                $total_amn = number_format($totalIncludingVat, 2);
                                                                                $dueAmount = $totalIncludingVat - $details->paid_amn - $details->discount_amn;
                                                                            @endphp
                                                                            ৳{{ $dueAmount }}
                                                                        @else
                                                                            ৳{{ $details->total_amn - $details->paid_amn - $details->discount_amn }}.00
                                                                        @endif
                                                                    </th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <h5 class="h5"></h5>
                                    
                                    <div class="card-header" style="font-size: 15px;font-weight: 700;">
                                        Update Order Status
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="card-blockquote mb-0">
                                            <form action="{{route('update.status', $details->id)}}" method="post">
                                                @csrf
                                                <select name="order_status" class="form-control select2">
                                                    <option value="Pending" {{( $details->status == "Pending" ) ? "selected" : ""}} >Pending</option>
                                                    <option value="Processing" {{( $details->status == "Processing" ) ? "selected" : ""}} >Processing</option>
                                                    <option value="Completed" {{( $details->status == "Completed" ) ? "selected" : ""}} >Completed</option>
                                                    <option value="Cancel" {{( $details->status == "Cancel" ) ? "selected" : ""}} >Cancel</option>
                                                    <option value="Partially Refunded" {{( $details->status == "Partially Refunded" ) ? "selected" : ""}} >Partially Refunded</option>
                                                </select>
                                                <button class="btn btn-primary" style="margin-top: 15px;" id="changeStatus">Save Changes</button>
                                            </form>
                                        </blockquote>
                                    </div>
                                </div>

                                <div class="col-md-7 col-lg-7">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="information-box mb-3">
                                                <div class="table-responsive order-details">
                                                    <h5 class="h5"> Order Details </h5>
                                                         <table class="table table-bordered">
                                                            <thead class="p_d">
                                                                <tr>
                                                                    <th>Order Id</th>
                                                                    <th>Order Date</th>
                                                                    <th>Issue Date</th>
                                                                    <th>Delivery Time</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                               
                                                                <tr>
                                                                    <td>#{{$details->id}}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($details->created_at)->isoFormat('DD MMM, YYYY (hh:mm A)') }}</td>
                                                                    <td>{{ $details->issue_date }}</td>
                                                                    <td>
                                                                        @if (!is_null($details->issue_date))
                                                                        @php
                                                                            $currentTime = \Carbon\Carbon::now();
                                                                            $issueDate = \Carbon\Carbon::parse($details->issue_date);
                                                                            $timeDifference = $currentTime->diff($issueDate);
                                                                            $days = $timeDifference->days;
                                                                            $hours = $timeDifference->h;
                                                                            $minutes = $timeDifference->i;
                                                                        @endphp
                                                                    
                                                                        @if ($currentTime > $issueDate)
                                                                            <span class="text-danger">Time Out</span>
                                                                            @elseif ($days > 0)
                                                                                {{ $days }} day{{ $days > 1 ? 's' : '' }} left
                                                                            @elseif ($hours > 0)
                                                                                {{ $hours }} hour{{ $hours > 1 ? 's' : '' }} left
                                                                            @endif
                                                                        @endif
                                                                    

                                                                    </td>
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

            
        </div> 
    </div>
    <!-- End Page-content -->
                
@endsection

@section('page-script')

    {{-- change order status --}}
    <script>
        $(document).ready(function(){
            $('#changeStatus').click(function(event) {
                event.preventDefault(); 
                
                var submitButton = $(this); 
                var form = submitButton.closest('form');
                
                $.ajax({
                    type: form.attr('method'), 
                    url: form.attr('action'),  
                    data: form.serialize(),   
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function(){
                        submitButton.prop('disabled', true).html(`
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        `);
                    },
                    success: function(response) {    
                        submitButton.prop('disabled', false).html(`
                            Save Changes
                        `);
                        Swal.fire('Success!', 'Order Status is Changed', 'success');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        submitButton.prop('disabled', false).html(`
                            Save Changes
                        `);
                        // Handle deletion error
                        Swal.fire('Error!', 'Failed', 'error');
                    }
                });
            });

        })
    </script>

    {{-- select box --}}
    <script src="{{asset('backend/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/form-advanced.init.js')}}"></script>

@endsection