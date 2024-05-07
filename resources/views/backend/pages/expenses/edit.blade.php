@extends('backend.layout.template')
@section('page-title')
    <title>Edit Expense || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }}</title>
@endsection

@section('page-css')
    <style>
        .err {
            font-size: 83%;
            color: #f32f53;
            font-weight: 600 !important;
            margin-top: 7px !important;
        }
        .dateIcon {
            position: absolute;
            right: -2px;
            top: -0.5px;
            z-index: 0;
        }
        .dateBox {
            position: relative;
        }
    </style>
    <link href="{{asset('backend/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
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
                                <li class="breadcrumb-item active">Edit Expense</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Expense</h4>
                            {{-- edit data --}}
                            <div id="edit-data">
                                <form action="{{route('update.expenses', $editData->id)}}" method="POST" class="needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="amn" class="form-label">Expense Amount</label>
                                                <input type="text" class="form-control" id="amn" placeholder="Expense Amount" name="amn" value="{{$editData->amn}}" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="month" class="form-label">Month</label>
                                                <select name="month" class="form-control select2" id="month" required>
                                                    <option value="">Please select month</option>
                                                    <option value="1" {{($editData->month == 1) ? "selected" : ""}} >January</option>
                                                    <option value="2" {{($editData->month == 2) ? "selected" : ""}}>February</option>
                                                    <option value="3" {{($editData->month == 3) ? "selected" : ""}}>March</option>
                                                    <option value="4" {{($editData->month == 4) ? "selected" : ""}}>April</option>
                                                    <option value="5" {{($editData->month == 5) ? "selected" : ""}}>May</option>
                                                    <option value="6" {{($editData->month == 6) ? "selected" : ""}}>June</option>
                                                    <option value="7" {{($editData->month == 7) ? "selected" : ""}}>July</option>
                                                    <option value="8" {{($editData->month == 8) ? "selected" : ""}}>August</option>
                                                    <option value="9" {{($editData->month == 9) ? "selected" : ""}}>September</option>
                                                    <option value="10" {{($editData->month == 10) ? "selected" : ""}}>October</option>
                                                    <option value="11" {{($editData->month == 11) ? "selected" : ""}}>November</option>
                                                    <option value="12" {{($editData->month == 12) ? "selected" : ""}}>December</option>
                                                </select>
                                                <div id="month_error" class="err"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="year" class="form-label">Year</label>
                                                <input type="text" class="form-control" id="year" placeholder="Expense Year" name="year" value="{{$editData->year}}" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="date" class="form-label" value="{{$editData->date}}">Expense Date</label>
                                                <div class="input-group" id="datepicker1">
                                                    <input type="text" class="form-control" placeholder="dd M, yyyy"
                                                        data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker" name="date" required value="{{$editData->date}}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                                <div id="e_date_error" class="err"></div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="vo" class="form-label">Write Details</label>
                                                <textarea id="elm1" placeholder="Write Details.." name="details">{{$editData->details}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div>
                                        <button class="btn btn-primary" type="submit" id="addCustomer"> Save Changes </button>
                                    </div>
                                </form>
                            </div>
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

     {{-- data picker --}}
     <script src="{{asset('backend/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
     {{-- select box --}}
     <script src="{{asset('backend/libs/select2/js/select2.min.js')}}"></script>
     <script src="{{asset('backend/js/pages/form-advanced.init.js')}}"></script>
    {{-- form editor --}}
    <script src="{{asset('backend/js/pages/form-editor.init.js')}}"></script>
    <script src="{{asset('backend/libs/tinymce/tinymce.min.js')}}"></script>

    {{-- send employess data --}}
    <script>
        $(document).ready(function() {
            $('.needs-validation').submit(function(event) {
                event.preventDefault(); 
                var form = $(this);
                var formData = new FormData(form[0]); 

                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: formData,
                    contentType: false, // Don't set content type
                    processData: false, // Don't process the data
                    beforeSend: function(){
                        $("#addCustomer").prop('disabled', true).html(`
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        `);
                    },
                    success: function(response) {
                        $("#addCustomer").prop('disabled', false).html(`
                            Save Changes
                        `);
                        $('.needs-validation').find('.form-control').removeClass('form-control');
                        $('#datepicker1').addClass('boxIcon');
                         $('#datepicker1 .input-group-text').addClass('dateIcon');
                         $('#month_error').html('');
                         $('#e_date_error').html('');

                        // Display SweetAlert popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Information Updated!',
                        });
                        imgUpload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Reset Bootstrap validation state
                        form.find('.form-control').removeClass('is-invalid');
                        form.find('.invalid-feedback').html('');
                        $("#addCustomer").prop('disabled', false).html(' Add Expense');
                        
                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        console.log(errors);
                        $.each(errors, function(key, value) {
                            var input = form.find('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.addClass('form-control');
                            if (key === 'month') {
                                $('#month_error').html(value);
                            }else if (key === 'date') {
                                $('#e_date_error').html(value);
                            } else {
                                input.next('.invalid-feedback').html(value);
                            }
                        });
                    }
                });
            });

            // Remove validation classes and messages on input change
            $('.needs-validation input').on('input', function() {
                var input = $(this);
                input.removeClass('is-invalid');
                input.next('.invalid-feedback').html('');
            });
        });
    </script>

@endsection