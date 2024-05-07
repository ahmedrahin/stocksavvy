@extends('backend.layout.template')
@section('page-title')
    <title>All Order List || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }} </title>
@endsection

@section('page-css')
    {{-- custom --}}
    <style>
        td p {
            margin: 0 !important;
        }
        .card-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .btn-group {
            padding: 0 !important;
  fffa      }
        a:focus {
            box-shadow: none !important;
        }
        blockquote h4{
            font-size: 13px;
            font-weight: 700;
        }
        table td a {
            color: #505d69;
            display: block;
            width: 100%;
            height: 100%;
        }
        .btn-rounded {
            font-size: 11px;
            font-weight: 800;
            padding: 2px 11px;
        }
        .ri-printer-fill{
            color: green;
            font-size: 18px;
            padding-right: 2px;
        }
    </style>
    <link href="{{asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />     
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
                                <li class="breadcrumb-item active">All Order List</li>
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
                                Manage Orders
                                <div class="btn btn-group">
                                    <a href="{{route('manage.pos')}}" class="btn btn-primary waves-effect waves-light">Create New Order</a>
                                </div>
                            </h4>
                            <div class="data">
                                @if( $orders->count() == 0 )
                                    <div class="alert alert-danger" role="alert">
                                        No Data Found!
                                    </div>
                                @else
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sl.</th>
                                                <th>Customer Name</th>
                                                <th>Total Amount</th>
                                                <th>Payment Status</th>
                                                <th>Order Status</th>
                                                <th>Date</th>
                                                <th>Issue Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $counter = 1; // Initialize counter variable
                                                // Define an array to map month numbers to their names
                                            @endphp
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{$counter++}}</td>
                                                    <td>
                                                        <a href="{{route('show.customer', $order->customer->id)}}" title="Customer Detials">
                                                            {{$order->customer->name}}
                                                        </a>
                                                    </td>
                                                    <td>{{ $order->total_amn }} .00tk</td>
                                                    <td align="middle">
                                                        @if( $order->payment_status == "Hand Cash" )
                                                            <span class="btn btn-success btn-rounded waves-effect waves-light">
                                                                {{$order->payment_status}}
                                                            </span>
                                                        @elseif( $order->payment_status == "Due" )
                                                            <span class="btn btn-danger btn-rounded waves-effect waves-light">
                                                                {{$order->payment_status}}
                                                            </span>
                                                        @else
                                                            <span class="btn btn-dark btn-rounded waves-effect waves-light">
                                                                {{$order->payment_status}}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td align="middle">
                                                        @if( $order->status == "Pending" )
                                                            <span class="btn btn-secondary btn-rounded waves-effect waves-light">
                                                                {{$order->status}}
                                                            </span>
                                                        @elseif( $order->status == "Completed" )
                                                            <span class="btn btn-success btn-rounded waves-effect waves-light">
                                                                {{$order->status}}
                                                            </span>
                                                        @elseif( $order->status == "Processing" )
                                                            <span class="btn btn-info btn-rounded waves-effect waves-light">
                                                                {{$order->status}}
                                                            </span>
                                                        @elseif( $order->status == "Cancel" )
                                                            <span class="btn btn-danger btn-rounded waves-effect waves-light">
                                                                {{$order->status}}
                                                            </span>
                                                        @elseif( $order->status == "Partially Refunded" )
                                                            <span class="btn btn-warning btn-rounded waves-effect waves-light">
                                                                {{$order->status}}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{$order->order_date}}</td>
                                                    <td>

                                                        <?php
                                                            // Get today's date
                                                            $today = date('Y-m-d');
                                                            $issueDate = $order->issue_date;
                                                            $orderStatus = ( $order->status != "Completed" && $order->status != "Cancel" ) ? "text-danger" : '';

                                                            $dateDiff = strtotime($issueDate) - strtotime($today);
                                                            $dateDiff = round($dateDiff / (60 * 60 * 24));

                                                            if ($dateDiff == 0) {
                                                                echo "<span class='btn btn-danger btn-rounded waves-effect waves-light'>Today</span>";
                                                            } else if ($dateDiff == 1) {
                                                                echo "<span class='btn btn-danger btn-rounded waves-effect waves-light'>Tomorrow</span>";
                                                            } else if ($dateDiff > 1) {
                                                                echo "<span>$issueDate</span>";
                                                            } else  {
                                                                echo "<span class='$orderStatus'>$issueDate</span>" . '<span style="display:none">time out</span>';
                                                            }
                                                        ?>
                                                    
                                                    </td>
                                                    <td class="action">
                                                        <button>
                                                            <a href="{{route('order.invoice',$order->id)}}" target="_blank">
                                                                <i class="ri-printer-fill"></i>
                                                            </a>
                                                        </button>
                                                        <button>
                                                            <a href="{{route('details.order',$order->id)}}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </button>
                                                        <button class="deleteButton" data-order-id="{{ $order->id }}">
                                                            <i class="ri-delete-bin-2-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
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
    {{-- delete order --}}
    <script>
        $(document).ready(function() {
            $('.deleteButton').click(function() {
                var deleteButton = $(this); 
                
                var Id = deleteButton.data('order-id');

                // Trigger SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this order data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    // Handle the user's response
                    if (result.isConfirmed) {
                        // Send an AJAX request to delete the customer
                        $.ajax({
                            type: 'DELETE',
                            url: '/admin/order/delete/' + Id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {    
                                // Remove the row from the table
                                deleteButton.closest('tr').fadeOut('slow', function() {
                                    $(this).remove();
                                });
                                // $('.exp_info').html(response.html)
                                setTimeout(() => {
                                    Swal.fire('Deleted!', 'Order has been deleted.', 'success');
                                }, 1000);
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                // Handle deletion error
                                Swal.fire('Error!', 'Failed to delete order.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
    
    <!-- Responsive examples -->
    <script src="{{asset('backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset('backend/js/pages/datatables.init.js')}}"></script>
    <script src="{{asset('backend/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('backend/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('backend/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

    <script src="{{asset('backend/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('backend/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>


@endsection