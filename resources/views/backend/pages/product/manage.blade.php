@extends('backend.layout.template')
@section('page-title')
    <title>Manage Products  || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }}</title>
@endsection

@section('page-css')
    <link href="{{asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />   
    <style>
        .text-danger{
            font-size: 11px;
            font-weight: 800;
            font-style: italic;
        }
        .user-img {
            object-fit: cover;
        }
        input[type="checkbox"]{
            opacity: 0;
        }
        input[switch]:checked+label:after {
            left: 52px !important;
        }
        input[switch]+label:after {
            height: 17px !important;
            width: 17px !important;
            top: 3px !important;
            left: 4px !important;
        }
        input[switch]+label{
            width: 73px !important;
            height: 24px !important;
            margin-bottom: 0;
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
                                <li class="breadcrumb-item active">Manage Products </li>
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

                            <h4 class="card-title">Manage Products</h4>
                            <div class="data">
                                @if( $products->count() == 0 )
                                    <div class="alert alert-danger" role="alert">
                                        No Data Found!
                                    </div>
                                @else
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sl.</th>
                                                <th>Image</th>
                                                <th>Product Title</th>
                                                <th>Category</th>
                                                <th>Supplier Name</th>
                                                <th>Qty</th>
                                                <th>Sku Code</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $counter = 1; // Initialize counter variable
                                            @endphp
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{$counter++}}</td>
                                                    <td>
                                                        @if( !is_null($product->image) )
                                                            <img src="{{asset($product->image)}}" alt="" class="user-img">
                                                        @else
                                                            <img src="{{asset('backend/images/default.jpg')}}" alt="" class="user-img">
                                                        @endif
                                                    </td>
                                                    <td>{{$product->title}}</td>
                                                    <td>
                                                        @if( isset($product->category) )
                                                            @if($product->category->status !=0)
                                                                {{$product->category->cat_name}}
                                                            @else
                                                                <span class="text-danger">Uncategorize</span>
                                                            @endif
                                                        @else
                                                            <span class="text-danger">Uncategorize</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if( isset($product->supplier) )
                                                            {{$product->supplier->name}}
                                                        @else
                                                            <div style="text-align: center">-</div>
                                                        @endif
                                                    </td>
                                                    <td>{{$product->qty}}</td>
                                                    <td>
                                                        @if( isset($product->code) )
                                                            {{$product->code}}
                                                        @else
                                                            <div style="text-align: center">-</div>
                                                        @endif
                                                    </td>
                                                    <td align="middle">
                                                        @php
                                                            $switchId = 'switch' . $counter;
                                                        @endphp
                                                        @if($product->status == 0)
                                                            <input type="checkbox" id="{{ $switchId }}" class="status-toggle" data-product-id="{{ $product->id }}" switch="success" />
                                                            <label for="{{ $switchId }}" data-on-label="Active" data-off-label="Inactive"></label>
                                                        @else
                                                            <input type="checkbox" id="{{ $switchId }}" class="status-toggle" data-product-id="{{ $product->id }}" switch="success" checked />
                                                            <label for="{{ $switchId }}" data-on-label="Active" data-off-label="Inactive"></label>
                                                        @endif
                                                    </td>
                                                    <td class="action">
                                                        <button>
                                                            <a href="{{route('show.product',$product->slug)}}" target="_blank">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </button>
                                                        <button>
                                                            <a href="{{route('edit.product',$product->id)}}">
                                                                <i class="ri-edit-2-fill"></i>
                                                            </a>
                                                        </button>
                                                        <button class="deleteButton" data-product-id="{{ $product->id }}">
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
    {{-- delete product --}}
    <script>
        $(document).ready(function() {
            $('.deleteButton').click(function() {
                var deleteButton = $(this); 
                
                var productId = deleteButton.data('product-id');

                // Trigger SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this product data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    // Handle the user's response
                    if (result.isConfirmed) {
                        // Send an AJAX request to delete the product
                        $.ajax({
                            type: 'DELETE',
                            url: '/admin/product/delete/' + productId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {    
                                // Remove the row from the table
                                deleteButton.closest('tr').fadeOut('slow', function() {
                                    $(this).remove();
                                });

                                setTimeout(() => {
                                    Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                                }, 1000);

                            },
                            error: function(xhr, textStatus, errorThrown) {
                                // Handle deletion error
                                Swal.fire('Error!', 'Failed to delete Product.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>

    {{-- change status --}}
    <script>
        $(document).ready(function() {
            // Initialize toggle switches
            $('input[type="checkbox"]').each(function() {
                $(this).bootstrapToggle({
                    on: $(this).next('label').attr('data-on-label'),
                    off: $(this).next('label').attr('data-off-label')
                });
            });
        });

        $(document).ready(function() {
            $('.status-toggle').change(function() {
                var productId = $(this).data('product-id');
                var status = $(this).prop('checked') ? 1 : 0;

                // Send AJAX request
                $.ajax({
                    type: 'PUT',
                    url: '/admin/product/update-status/' + productId, // Replace with your endpoint URL
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        // Handle success response here
                        console.log(response);
                        Swal.fire({
                            icon: response.type,
                            title: response.msg,
                            text: ''
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error here
                        console.error(xhr.responseText);
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