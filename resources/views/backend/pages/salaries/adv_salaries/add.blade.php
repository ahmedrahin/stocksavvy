@extends('backend.layout.template')
@section('page-title')
    <title>Advance Salary Provide || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }}</title>
@endsection

@section('page-css')
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
                                <li class="breadcrumb-item active">Advance Salary Provide</li>
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
                            <h4 class="card-title">Advance Salary Provide</h4>

                            <form action="{{route('store.advsalary')}}" method="POST" class="needs-validation"  novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationName" class="form-label">Employee Name</label>
                                            <select name="emp" class="form-control select2" id="validationName" required>
                                                <option value="">Please select employee's name</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
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
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="year" class="form-label">Year</label>
                                            <input type="text" id="year" class="form-control" placeholder="Year" name="year" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="datepicker1" class="form-label">Provided Date</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" placeholder="dd M, yyyy"
                                                    data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker" name="salary_date" required>
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
                                            <input type="text" id="adv" class="form-control" placeholder="Salary Ammount" name="adv_salary" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <button class="btn btn-primary" type="submit" id="provide"> Provide </button>
                                </div>
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

    {{-- data picker --}}
    <script src="{{asset('backend/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    {{-- select box --}}
    <script src="{{asset('backend/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/form-advanced.init.js')}}"></script>

    {{-- send salary data --}}
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
                            Provide
                        `);
                        $('.needs-validation')[0].reset();
                        $('.needs-validation').find('.form-control').removeClass('form-control');
                        $('#datepicker1').addClass('boxIcon');
                        $('#datepicker1 .input-group-text').addClass('dateIcon');

                        // Display SweetAlert popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Provided successfully!',
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Reset Bootstrap validation state
                        form.find('.form-control').removeClass('is-invalid');
                        form.find('.invalid-feedback').html('');
                        $("#provide").prop('disabled', false).html('Provide');
                        
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