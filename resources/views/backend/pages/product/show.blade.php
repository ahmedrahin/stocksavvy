@extends('backend.layout.template')
@section('page-title')
    <title>{{ $showData->name }} Information || </title>
@endsection

@section('page-css')
    <style>
        .edit-item{
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #00000040;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .edit-item h4 {
            border-bottom: none !important;
            padding-bottom: 0px !important;
            margin-bottom: 0px !important;
        }
        .edit-item a {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
        .edit-item a i {
            padding-right: 7px;
        }
        .productThum {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            display: block;
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
                                <li class="breadcrumb-item active">{{ $showData->name }} Information</li>
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
                            <div class="edit-item">
                                <h4 class="card-title">
                                    {{ $showData->title }} Information
                                </h4>
                                <a href="{{route('edit.product', $showData->id)}}" class="btn btn-primary"> <i class=" ri-edit-box-line"></i> Edit Product</a>
                            </div>

                            @if( !is_null($showData->image) )
                            <div class="row mb-3">
                                <label for="example-search-input" class="col-sm-2 col-form-label">Product Thumbnail</label>
                                <div class="col-sm-10">
                                    <img src="{{asset($showData->image)}}" alt="" class="productThum">
                                </div>
                            </div>
                            @endif
                            
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Product Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->title }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-search-input" class="col-sm-2 col-form-label">Product Category</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="@if( isset($showData->category) )@if($showData->category->status !=0){{$showData->category->cat_name}}@else Uncategorize @endif @else Uncategorize @endif" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-email-input" class="col-sm-2 col-form-label">Supplier Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="@if( isset($product->supplier) ){{$product->supplier->name}} @endif" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Sku Code</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->code }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-tel-input" class="col-sm-2 col-form-label">Place</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->place }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-password-input" class="col-sm-2 col-form-label">Product Route</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->route }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-number-input" class="col-sm-2 col-form-label">Buy Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->buy_date }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Expire Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->expire_date }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Buying Price</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->buying_price }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Selling Price</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->selling_price }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->qty }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-date-input" class="col-sm-2 col-form-label">Add Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($showData->created_at)->format('d-M-Y') }}" readonly>

                                </div>
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


@endsection