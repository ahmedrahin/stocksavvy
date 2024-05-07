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
    <link href="{{asset('backend/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="{{asset('backend/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <style>
        #e_date_error{
            font-size: 83%;
            color: #f32f53;
            font-weight: 600 !important;
            margin-top: 7px !important;
        }
        .modal-header h5 {
            font-size: 16px;
            font-weight: 700;
        }
        .modal-dialog {
            max-width: 50%;
        }
        table .text-danger{
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
        .page-title {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
        }
        .card-header {
            font-size: 17px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            justify-content: space-between;
        }
        .card-header a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px 12px;
            font-size: 13px;
            font-weight: 700;
        }
        .card-header a i {
            padding-right: 4px ;
        }
        .fa-plus-square {
            color: green;
            font-size: 18px;
        }
        .cart_item {
            background: white;
            /* padding: 10px; */
            border-radius: 8px;
            box-shadow: 1px 0 20px rgba(0,0,0,.05);
        }
        .cart_item table thead {
            background: #5C636A;
            color: white;
            font-size: 13px;
        }
        .cart_item .del {
            border: none;
            font-weight: 800;
            font-size: 9px;
            background: #ff0000a3;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            line-height: 19px;
        }
        .cart_item tbody tr td {
            font-size: 12px;
             font-weight: 700;
        }
        .cart_info {
            background: #5c636a;
            padding: 15px 25px;
        }
        .cart_item h6 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #ffffffed;
            font-size: 13px;
        }
        .cart_item h6 label {
            margin: 0;
        }
        .sub_total {
            margin-top: 14px;
            padding-top: 10px;
            border-top: 1px solid;
        }
        tr h5 {
            text-align: center;
            font-size: 14px !important;
            margin: 0;
        }
        .fa-check-square {
            color: #1b1b6c;
            font-size: 17px;
        }
        .input-number {
            padding: 0px 8px;
            height: 30px;
            width: 30px !important;
            text-align: center;
        }
        .quantity-left-minus{
            background: #0f9cf3;
            color: white;
            font-size: 8px;
            padding: 0 8px;
            height: 30px;
            border-radius: 5px 0px 0 5px;
        }
        .quantity-right-plus{
            background: #0f9cf3;
            color: white;
            font-size: 8px;
            padding: 0 8px;
            height: 30px;
            border-radius: 0px 5px 5px 0px;
        }
        .input-group-prepend button:hover i {
            color: white;
        }
        .input-group-prepend button:focus {
            box-shadow: none !important;
        }
        .noQty i {
            color: red;
        }
    </style>  
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
                                <li class="breadcrumb-item active">POS (Point of Sale)</li>
                            </ol>
                            <label class="text-danger">{{date('d/m/y')}}</label>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-4 cart_items">
                    @include('backend.pages.pos.cart')
                </div>

                <div class="col-md-8 product_items">
                    @include('backend.pages.pos.product')
                </div> 
            </div>
            
        </div> 
    </div>
    <!-- End Page-content -->
                
@endsection

@section('page-script')
    
    {{-- select box --}}
    
    <script src="{{asset('backend/js/pages/form-advanced.init.js')}}"></script>
    
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
    <script src="{{asset('backend/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('backend/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>

    <script>
        $(document).ready(function() {

             // place order
            function OrderPlace(){
                // $('.needs-validation').submit(function(event) {
                //     event.preventDefault(); 
                //     var form = $(this);
                //     // var form = orderPlace.closest('form'); 

                //     $.ajax({
                //         type: 'POST',
                //         url: form.attr('action'),
                //         data: form.serialize(),
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         beforeSend: function(){
                //             $("#submitOrder").prop('disabled', true).html(`
                //                 <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                //                 Loading...
                //             `);
                //         },
                //         success: function(response) {
                //             $("#submitOrder").prop('disabled', false).html(`
                //                 Place Order
                //             `);

                //             // Close modal after successful submission
                //             $('.btn-close').click();

                //             // Display success message
                //             toastr.success('Order placed successfully!');
                //         },
                //         error: function(xhr, textStatus, errorThrown)  {
                //             // Reset Bootstrap validation state
                //             form.find('.form-control').removeClass('is-invalid');
                //             form.find('.invalid-feedback').html('');
                //             $("#submitOrder").prop('disabled', false).html('Place Order');
                //             toastr.error('Failed to place order. Please try again later.');

                //             // Handle validation errors
                //             var errors = xhr.responseJSON.errors;
                //             $.each(errors, function(key, value) {
                //                 var input = form.find('[name="' + key + '"]');
                //                 input.addClass('is-invalid');
                //                 input.addClass('form-control');
                //                 input.next('.invalid-feedback').html(value); 
                //             });
                //         }
                //     });
                // });

                // // Remove validation classes and messages on input change
                // $('.needs-validation input').on('input', function() {
                //     var input = $(this);
                //     input.removeClass('is-invalid');
                //     input.next('.invalid-feedback').html('');
                // });

                $('.pstatus').on('change', function(){
                    if($(this).val() == "Due") { // Use $(this).val() instead of this.val()
                        $('#paid').val(''); // Set the value to an empty string
                    }else {
                        $('#paid').val(`{{App\Models\Cart::totalAmount()}}.00`);
                    }
                });
            }
            
            // Function to add a product to the cart
            function addCart() {
                $('.addToCart').off().click(function(event) {
                    event.preventDefault(); // Prevent form submission
                    var addToCart = $(this); 
                    var form = addToCart.closest('form');

                    // Send an AJAX request to add the product to the cart
                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'), // Get the form's action URL
                        data: form.serialize(), // Serialize form data
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {    
                            // Handle success response
                            Swal.fire('Success!', 'Product added to cart.', 'success');
                            $('.cart_items').html(response.html);
                            $('.product_items').html(response.html2);
                            // Rebind the click event for 'del' buttons
                            delCart();
                            addCart();
                            btnOrder();
                            OrderPlace();
                            updateCart();
                            $('.showtoast').click(function() {
                                toastr.info("The Product Exist in Cart");
                            });
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            // Handle error response
                            console.log(errorThrown);
                            Swal.fire('Error!', 'Failed to add product to cart.', 'error');
                        }
                    });
                });
            }

            // Function to delete a product from the cart
            function delCart() {
                $('.del').off().click(function() {
                    var deleteButton = $(this);
                    var productId = deleteButton.data('product-id');

                    // Trigger SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: '',
                        icon: 'info',
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
                                url: '/admin/pos/del-cart/' + productId,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {    
                                    // Remove the row from the table
                                    deleteButton.closest('tr').fadeOut('slow', function() {
                                        $(this).remove();
                                    });

                                    toastr.warning("The Product Deleted in Cart");

                                    $('.cart_items').html(response.html);
                                    $('.product_items').html(response.html2);
                                    // Rebind the click event for 'addToCart' buttons
                                    addCart();
                                    delCart();
                                    btnOrder();
                                    OrderPlace();
                                    updateCart();
                                    $('.showtoast').click(function() {
                                        toastr.info("The Product Exist in Cart");
                                    });
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    // Handle deletion error
                                    console.log(errorThrown)
                                    Swal.fire('Error!', 'Failed to delete Product.', 'error');
                                }
                            });
                        }
                    });
                });
            }

            // update qty
            function updateCart() {
                $(document).ready(function() {
                function upQty() {
                    // Function to increment quantity
                    $('.quantity-right-plus').on('click', function() {
                        var $input = $(this).closest('.qty-box').find('.input-number');
                        var currentVal = parseInt($input.val()) || 0;
                        var totalQuant = parseInt($input.siblings('.totalQuant').val());
                        if (currentVal < totalQuant) {
                            $input.val(currentVal + 1);
                            sendAjaxRequest($input);
                        }
                    });

                    // Function to decrement quantity
                    $('.quantity-left-minus').on('click', function() {
                        var $input = $(this).closest('.qty-box').find('.input-number');
                        var currentVal = parseInt($input.val()) || 0;
                        if (currentVal > 1) {
                            $input.val(currentVal - 1);
                            sendAjaxRequest($input);
                        }
                    });

                    // Function to handle input change and validation
                    $('.input-number').on('input', function() {
                        var $input = $(this);
                        var enteredQty = parseInt($input.val()) || 0;
                        var totalQuant = parseInt($input.siblings('.totalQuant').val());
                        var inputQynt = parseInt($input.siblings('.input-qynt').val());

                        // Validate quantity
                        if (enteredQty < 1 || isNaN(enteredQty)) {
                            $input.val(inputQynt);
                            toastr.warning('Value must be greater than or equal to 1', '', {"positionClass": "toast-top-right", "closeButton": true});
                        } else if (enteredQty > totalQuant) {
                            $input.val(totalQuant); 
                            toastr.warning('Exceeds available quantity', '', {"positionClass": "toast-top-right", "closeButton": true});
                            toastr.info(`Available Product is ${totalQuant} Pc`, '', {"positionClass": "toast-top-right", "closeButton": true});
                            sendAjaxRequest($input);
                        } else {
                            toastr.clear();
                            sendAjaxRequest($input);
                        }

                        // Enable/disable buttons based on quantity
                        $input.siblings('.quantity-right-plus').prop('disabled', enteredQty >= totalQuant);
                        $input.siblings('.quantity-left-minus').prop('disabled', enteredQty <= 1);
                    });
                }

                upQty();

                function sendAjaxRequest($input) {
                    var cartId = $input.closest('tr').data('cart-id');
                    var newQuantity = $input.val();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    console.log(newQuantity)
                    var requestData = {
                        newQuantity: newQuantity
                    };

                    // Send the AJAX request
                    $.ajax({
                        type: 'POST',
                        url: '/admin/pos/update-cart/' + cartId,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                        },
                        data: requestData,
                        success: function(response) {
                            toastr.success(response.msg, '', {"positionClass": "toast-top-right", "closeButton": true});
                            $('.cart_items').html(response.html);
                            $('.product_items').html(response.html2);
                            addCart();
                            delCart();
                            btnOrder();
                            OrderPlace();
                            updateCart();
                            // upQty();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error('Error in AJAX request:', errorThrown);
                        }
                    });
                    }
                });
            }

            function btnOrder(){
                $('.Noselected').prop('disabled', true);
                $('.orderModel').prop('disabled', true);
                $('.select2').on('change', function(){
                    $('.orderModel').prop('disabled', false);
                    $('.Noselected').prop('disabled', true);
                    let selectedText = $(this).find('option:selected').text();
                    $('.modal-title').html( "Create Order for " + selectedText);
                })

                $('.noQty').click(function(){
                    toastr.info("The Product is not available!");
                })
            }

            $('.showtoast').click(function() {
                toastr.info("The Product Exist in Cart");
            });

            // Initial binding of click events
            addCart();
            delCart();
            btnOrder();
            OrderPlace();
            updateCart()
            
        });
        
    </script>
    {{-- toastr --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     {{-- data picker --}}
     <script src="{{asset('backend/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
     <script src="{{asset('backend/libs/select2/js/select2.min.js')}}"></script>

@endsection