@extends('backend.layout.template')
@section('page-title')
    <title>Manage Suppliers  || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }}</title>
@endsection

@section('page-css')
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
                                <li class="breadcrumb-item active">Manage Suppliers </li>
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

                            <h4 class="card-title">Manage Suppliers</h4>
                            <div class="data">
                                @if( $suplliers->count() == 0 )
                                    <div class="alert alert-danger" role="alert">
                                        No Data Found!
                                    </div>
                                @else
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sl.</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone No.</th>
                                                <th>Shop Name</th>
                                                <th>Bank Name</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $counter = 1; // Initialize counter variable
                                            @endphp
                                            @foreach ($suplliers as $supllier)
                                                <tr>
                                                    <td>{{$counter++}}</td>
                                                    <td>
                                                        @if( !is_null($supllier->image) )
                                                            <img src="{{asset($supllier->image)}}" alt="" class="user-img">
                                                        @else
                                                            <img src="{{asset('backend/images/user.jpg')}}" alt="" class="user-img">
                                                        @endif
                                                    </td>
                                                    <td>{{$supllier->name}}</td>
                                                    <td>{{$supllier->email}}</td>
                                                    <td>{{$supllier->phone}}</td>
                                                    <td>
                                                        @if( !is_null($supllier->shop_name) )
                                                            {{$supllier->shop_name}} 
                                                        @else
                                                            <div class="empty">empty</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if( !is_null($supllier->bank_name) )
                                                            {{$supllier->bank_name}} 
                                                        @else
                                                            <div class="empty">empty</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if( !is_null($supllier->type) )
                                                            {{$supllier->type}} 
                                                        @else
                                                            <div class="empty">empty</div>
                                                        @endif
                                                    </td>
                                                    <td class="action">
                                                        <button>
                                                            <a href="{{route('show.supplier',$supllier->id)}}" target="_blank">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </button>
                                                        <button>
                                                            <a href="{{route('edit.supplier',$supllier->id)}}">
                                                                <i class="ri-edit-2-fill"></i>
                                                            </a>
                                                        </button>
                                                        <button class="deleteButton" data-supplier-id="{{ $supllier->id }}">
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
    {{-- delete suppliers --}}
    <script>
        $(document).ready(function() {
            $('.deleteButton').click(function() {
                var deleteButton = $(this); 
                
                var supplierId = deleteButton.data('supplier-id');

                // Trigger SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this supplier data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    // Handle the user's response
                    if (result.isConfirmed) {
                        // Send an AJAX request to delete the supplier
                        $.ajax({
                            type: 'DELETE',
                            url: '/admin/suppliers/delete/' + supplierId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {    
                                // Remove the row from the table
                                deleteButton.closest('tr').fadeOut('slow', function() {
                                    $(this).remove();
                                });

                                setTimeout(() => {
                                    Swal.fire('Deleted!', 'Supplier has been deleted.', 'success');
                                }, 1000);

                            },
                            error: function(xhr, textStatus, errorThrown) {
                                // Handle deletion error
                                Swal.fire('Error!', 'Failed to delete Supplier.', 'error');
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