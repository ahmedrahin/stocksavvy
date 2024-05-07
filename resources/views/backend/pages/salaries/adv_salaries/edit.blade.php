@extends('backend.layout.template')
@section('page-title')
    <title>Edit Adv Salary || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }}</title>
@endsection

@section('page-css')
    <link href="{{asset('backend/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/libs/select2/css/select2.min.css')}}" rel="stylesheet">
    <style>
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
                                <li class="breadcrumb-item active">Edit Adv Salary</li>
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
                            <h4 class="card-title">Edit {{$editData->emp->name}}'s Adv Salary</h4>
                            {{-- edit data --}}
                            <div id="edit-data">
                                <form action="{{route('update.advsalary', $editData->id)}}" method="POST" class="needs-validation"  novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationName" class="form-label">Employee Name</label>
                                                <select name="emp" class="form-control select2" id="validationName" required>
                                                    <option value="">Please select employee's name</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{$employee->id}}" {{($employee->id == $editData->emp_id ) ? "selected" : ""}} >{{$employee->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="month" class="form-label">Month Name</label>
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
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="year" class="form-label">Year</label>
                                                <input type="text" id="year" class="form-control" placeholder="Year" name="year" value="{{$editData->year}}" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="datepicker1" class="form-label">Provided Date</label>
                                                <div class="input-group" id="datepicker1">
                                                    <input type="text" class="form-control" id="date" placeholder="dd M, yyyy"
                                                        data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker" value="{{$editData->salary_date}}" name="salary_date" required>
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="adv" class="form-label">Salary Ammount</label>
                                                <input type="text" id="adv" class="form-control" placeholder="Salary Ammount" name="adv_salary" value="{{$editData->adv_salary}}" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <button class="btn btn-primary" type="submit" id="provide"> Save Changes </button>
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

    {{-- send adv salary data --}}
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
                        $("#provide").prop('disabled', true).html(`
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        `);
                    },
                    success: function(response) {
                        $("#provide").prop('disabled', false).html(`
                            Save Changes
                        `);
                        // $('.needs-validation')[0].reset();
                        $('.needs-validation').find('.form-control').removeClass('form-control');

                        $('#datepicker1').addClass('boxIcon');
                        $('#datepicker1 .input-group-text').addClass('dateIcon');


                        // Display SweetAlert popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Information Updated!',
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Reset Bootstrap validation state
                        form.find('.form-control').removeClass('is-invalid');
                        form.find('.invalid-feedback').html('');
                        $("#provide").prop('disabled', false).html('Save Changes');
                        
                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        console.log(errors);
                        $.each(errors, function(key, value) {
                            var input = form.find('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.addClass('form-control');
                            input.next('.invalid-feedback').html(value); 
                        });
                        // Display error message using SweetAlert if no specific field error is present
                        if(errors && errors.adv_salary && errors.adv_salary.includes("Advance salary for this employee")) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: errors.adv_salary,
                            });
                        }
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