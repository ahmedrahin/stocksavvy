@extends('backend.layout.template')
@section('page-title')
    <title>Product Import & Export || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }}</title>
@endsection

@section('page-css')
   <style>
        .card-header {
            font-size: 17px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            justify-content: space-between;
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
                                <li class="breadcrumb-item active">Product Import & Export</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                Import & Export
                                <button id="downloadBtn" class="btn btn-danger">Download Xlsx</button>
                            </div>
                            <div class="card-body">
                                <blockquote class="card-blockquote mb-0">
                                    <form action="{{route('import.xlsx')}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="">Xlsx File Import</label>
                                            <input type="file" name="import_file" class="form-control" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <button type="submit" id="addCategory" class="btn btn-primary">Upload</button>
                                    </form>
                                </blockquote>
                            </div>
                        </div>
                    </div>
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

    {{-- send category data --}}
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
                        $("#addCategory").prop('disabled', true).html(`
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        `);
                    },
                    success: function(response) {
                        $("#addCategory").prop('disabled', false).html(`
                            Add Category
                        `);
                        $('.needs-validation')[0].reset();
                        $('.needs-validation').find('.form-control').removeClass('form-control');

                        // Display SweetAlert popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Import successfully!',
                        });

                        setTimeout(() => {
                            window.location = ('/admin/product/manage');
                        }, 1000);

                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Reset Bootstrap validation state
                        form.find('.form-control').removeClass('is-invalid');
                        form.find('.invalid-feedback').html('');
                        $("#addCategory").prop('disabled', false).html('Add Supplier');
                        
                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        console.log(errors);
                        $.each(errors, function(key, value) {
                            var input = form.find('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.addClass('form-control');
                            input.next('.invalid-feedback').html(value); 
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

    {{-- export xls --}}
    <script>
        document.getElementById('downloadBtn').addEventListener('click', function() {
            // Make an AJAX request to the export route
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '{{ route("export.product") }}', true);
            xhr.responseType = 'blob';

            xhr.onload = function() {
                if (this.status === 200) {
                    var url = window.URL.createObjectURL(this.response);
                    
                    // Create a temporary <a> element to initiate the download
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'products.xlsx';
                    
                    // Append the <a> element to the document body and click it programmatically
                    document.body.appendChild(a);
                    a.click();
                    
                    // Clean up
                    window.URL.revokeObjectURL(url);
                }
            };

            xhr.send();
        });

    </script>

@endsection