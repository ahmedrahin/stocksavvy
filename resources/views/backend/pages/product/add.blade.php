@extends('backend.layout.template')
@section('page-title')
    <title>Add Product || </title>
@endsection

@section('page-css')
    <style>
        #ex_date {
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
        .AppBody {
            border: 3px dotted #d1d6d6;
            height: 300px;
            width: 100%;
            background-color: #fff;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
        }
        .AppBody.active {
            border: 3px solid #0f9cf3;
        }
        .icon {
            font-size: 50px;
            color: #0f9cf3;
        }
        .AppBody h3 {
            font-size: 23px;
            font-weight: 600;
            color: #333;
        }
        .AppBody span {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin: 6px 0 2px 0;
        }
        .AppBody button {
            padding: 10px 25px;
            font-size: 20px;
            font-weight: 500;
            border: none;
            outline: none;
            background: #fff;
            color: #0f9cf3;
            border-radius: 5px;
            cursor: pointer;    
        }
        .AppBody img{
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 5px;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 11;
        }
        .cancell {
            font-weight: 800;
            font-size: 8px;
            position: absolute;
            top: 10px;
            right: 10px;
            background: red;
            color: white;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
           cursor: pointer;
           z-index: 12;
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
                                <li class="breadcrumb-item active">Add Product</li>
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
                            <h4 class="card-title">Add New Product</h4>

                            <form action="{{route('store.product')}}" method="POST" class="needs-validation"  novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationName" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="validationName" placeholder="Title" name="title" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select name="category" class="form-control select2-multiple select2" multiple="multiple" id="category" data-placeholder="Select a category" required>
                                                <option value="">Select a category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->cat_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" id="category-error"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="sup" class="form-label">Supplier Name</label>
                                            <select name="sup" class="form-control select2" id="sup">
                                                <option value="">Select supplier name</option>
                                                @foreach ($suplliers as $supllier)
                                                    <option value="{{$supllier->id}}">{{$supllier->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="code" class="form-label">Sku Code</label>
                                            <input type="text" id="code" placeholder="Sku Code" name="code">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="place" class="form-label">Stock Place</label>
                                            <input type="text" id="place" placeholder="Stock Place" name="place">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Quantity</label>
                                            <input type="number" id="qty" placeholder="00" name="qty" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="route" class="form-label">Route</label>
                                            <input type="text" id="route" placeholder="Route" name="route">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="but_date" class="form-label">Buy Date</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" placeholder="dd M, yyyy"
                                                    data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker" name="buy_date">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="ex_date" class="form-label">Expire Date</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control ex_date_error" placeholder="dd M, yyyy"
                                                    data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker" name="ex_date">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                            <div id="ex_date"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="buying_price" class="form-label">Buying price</label>
                                            <input type="text" id="buying_price" placeholder="Buying price" name="buying_price">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="selling_price" class="form-label">Selling Price</label>
                                            <input type="text" id="selling_price" placeholder="Selling Price" name="selling_price">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="acstatus" class="form-label">Active Status</label>
                                            <select name="status" id="acstatus" >
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                       <div class="mb-3">
                                            <label for="salary" class="form-label">Product Thumbnail</label>
                                            <div class="AppBody">
                                                <div class="icon">
                                                    <i class="fas fa-images"></i>
                                                </div>
                                        
                                                <h3 class="drag">Drag & Drop</h3>
                                                <span>OR</span>
                                                <button type="button" id="browseFile">Browse File</button>
                                                <input type="file" name="image" class="picture" hidden>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <button class="btn btn-primary" type="submit" id="addProduct"> Add Product </button>
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

    {{-- send supplier data --}}
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
                        $("#addProduct").prop('disabled', true).html(`
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        `);
                    },
                    success: function(response) {
                        $("#addProduct").prop('disabled', false).html(`
                            Add Product
                        `);
                        $('.needs-validation')[0].reset();
                        $('.needs-validation').find('.form-control').removeClass('form-control');
                        $('#datepicker1').addClass('boxIcon');
                        $('#datepicker1 .input-group-text').addClass('dateIcon');
                        $('#category-error').html('');
                        $('#ex_date').html('');
                        $('.ex_date_error').css('border-color', '#ced4da');

                        // Display SweetAlert popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Product added successfully!',
                        });

                        $('.AppBody').html(`
                            <div class="icon">
                                <i class="fas fa-images"></i>
                            </div>
                    
                            <h3 class="drag">Drag & Drop</h3>
                            <span>OR</span>
                            <button type="button" id="browseFile">Browse File</button>
                            <input type="file" name="image" class="picture" hidden>
                        `);
                        imgUpload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Reset Bootstrap validation state
                        form.find('.form-control').removeClass('is-invalid');
                        form.find('.invalid-feedback').html('');
                        $("#addProduct").prop('disabled', false).html('Add Product');
                        
                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        console.log(errors);
                        $.each(errors, function(key, value) {
                            var input = form.find('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.addClass('form-control');
                            if (key === 'category') {
                                $('#category-error').html(value);
                            }else if (key === 'ex_date') {
                                $('#ex_date').html('.The expire date field must be a date after or equal to buy date.');
                                $('.ex_date_error').css('border-color', '#f32f53');
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

    {{-- drag & drop --}}
    <script>
        function imgUpload() {
            let dragArea = document.querySelector('.AppBody');
            let dragText = document.querySelector('.drag');
            let btn = document.querySelector('#browseFile');
            let input = document.querySelector('.picture');
            let file;

            btn.onclick = () => {
                input.click();
            }

            input.addEventListener('change', function () {
                file = this.files[0];
                show();
            })

            dragArea.addEventListener('dragover', (event) => {
                event.preventDefault();
                dragText.innerText = "Release to Upload File";
                dragArea.classList.add('active');
            })

            dragArea.addEventListener('dragleave', (event) => {
                dragText.innerText = "Drag & Drop";
                dragArea.classList.remove('active');
            })

            dragArea.addEventListener('drop', (event) => {
                event.preventDefault();
                file = event.dataTransfer.files[0];
                input.files = event.dataTransfer.files; // Set files to input
                show();
            })

            function show() {
                let fileType = file.type;
                let validType = ['image/jpeg', 'image/jpg', 'image/png'];

                if (validType.includes(fileType)) {
                    let fileRead = new FileReader();
                    fileRead.onload = () => {
                        let imgUrl = fileRead.result;
                        let img = `<img src="${imgUrl}">`;
                        let cancelButton = `<div class="cancell">
                                                ❌
                                            </div>`;
                        // Create a new div for the uploaded image and cancel button
                        let imageContainer = document.createElement('div');
                        imageContainer.classList.add('image-container');
                        imageContainer.innerHTML = img + cancelButton;

                        // Check if an image is already uploaded
                        let existingImageContainer = dragArea.querySelector('.image-container');
                        if (existingImageContainer) {
                            // Remove the existing image container
                            dragArea.removeChild(existingImageContainer);
                        }
                        dragArea.appendChild(imageContainer);

                        // Add event listener to the cancel button
                        let cancelButtonElement = imageContainer.querySelector('.cancell');
                        cancelButtonElement.addEventListener('click', function () {
                            // Clear the input file and remove the image container
                            input.value = null;
                            dragArea.classList.remove('active');
                            dragText.innerText = "Drag & Drop";
                            dragArea.removeChild(imageContainer);
                        });
                    }
                    fileRead.readAsDataURL(file);
                } else {
                    alert('This file is not valid');
                    dragArea.classList.remove('active');
                    dragText.innerText = "Drag & Drop";
                }
            }
        }

        imgUpload();
    </script>
@endsection