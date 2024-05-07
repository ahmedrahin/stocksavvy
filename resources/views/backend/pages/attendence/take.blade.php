@extends('backend.layout.template')
@section('page-title')
    <title>Take Attendence || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }}</title>
@endsection

@section('page-css')
    <link href="{{asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />     
    <style>
        input[type="radio"]{
            padding: 0 !important;
        }
        .card-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        table label i {
            padding-left: 6px;
        }
        
        table label {
            display: flex;
            align-items: center;
        }
        .ri-checkbox-circle-line {
            color: #03c003;
            padding-left: 12px;
        }
        .ri-close-circle-line {
            color: #ff0000ba;
        }
        
        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page-title span {
            font-weight: 800;
            font-size: 16px;
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
                    <div class="page-title-box">

                        <div class="page-title">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Stock Savvy</a></li>
                                <li class="breadcrumb-item active">Take Attendence</li>
                            </ol>
                            <span class="text-danger" pull-right>{{date('d/m/Y')}}</span>
                        </div>


                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('store.attendance')}}" method="POST" class="needs-validation">
                            @csrf
                                <h4 class="card-title">Take Attendence
                                    <button class="btn btn-primary" type="button" id="submitAttendance">Submit Attendence</button>
                                </h4>
                                @if( $employees->count() == 0 )
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
                                                <th>Attendence</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $counter = 1; // Initialize counter variable
                                            @endphp
                                            @foreach ($employees as $employee)
                                                <tr>
                                                    <td>{{$counter++}}</td>
                                                    <td>
                                                        @if( !is_null($employee->image) )
                                                            <img src="{{asset($employee->image)}}" alt="" class="user-img">
                                                        @else
                                                            <img src="{{asset('backend/images/user.jpg')}}" alt="" class="user-img">
                                                        @endif
                                                    </td>
                                                    <td>{{$employee->name}}</td>
                                                    
                                                    <td>
                                                        <input type="hidden" name="emp[]" value="{{$employee->id}}">
                                                        <input type="hidden" name="date" value="{{date('d M, Y')}}">
                                                        <input type="hidden" name="year" value="{{date('Y')}}">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="radio" name="att[{{$employee->id}}]" id="present{{$employee->id}}" value="present">
                                                            <label class="form-check-label" for="present{{$employee->id}}">
                                                                Present <i class="ri-checkbox-circle-line"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="att[{{$employee->id}}]" id="absence{{$employee->id}}" value="absence">
                                                            <label class="form-check-label" for="absence{{$employee->id}}">
                                                                Absence <i class="ri-close-circle-line"></i>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div> 
            </div>
            <!-- end row -->

        </div> 
    </div>
    <!-- End Page-content -->
                
@endsection

@section('page-script')
    <script src="{{asset('backend/js/pages/form-validation.init.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

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

    {{-- send attendance data --}}
    <script>
        $(document).ready(function() {
            $('#submitAttendance').click(function() {
                // Serialize the form data
                var formData = $('form.needs-validation').serialize();

                // Send an AJAX request
                $.ajax({
                    type: 'POST',
                    url: $('form.needs-validation').attr('action'),
                    data: formData,
                    beforeSend: function(){
                        $("#submitAttendance").prop('disabled', true).html(`
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        `);
                        $("#submitAttendance").css('width', '166px')
                    },
                    success: function(response) {
                        $("#submitAttendance").prop('disabled', false).html(`
                            Submited Attendance
                        `);
                        $("#submitAttendance").css('width', '166px')
                        // Display SweetAlert popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Submited Attendance successfully!',
                        });

                        setTimeout(() => {
                            window.location = ('/admin/attendence/manage');
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        // Enable the submit button and change its text
                        $("#submitAttendance").prop('disabled', false).html('Submit Attendance');

                        console.error(error);

                        // Check if the error is a validation error
                        if (xhr.status === 422) {
                            // If it's a validation error, show the error message returned by the server
                            var errorMessage = xhr.responseJSON.error;
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errorMessage,
                            });
                        } else {
                            // If it's not a validation error, show a generic error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred while submitting attendance.',
                            });
                        }
                    }

                });
            });
        });
    </script>

@endsection