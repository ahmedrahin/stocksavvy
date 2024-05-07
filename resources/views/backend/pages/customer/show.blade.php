@extends('backend.layout.template')
@section('page-title')
    <title>{{ $showData->name }} Information || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }}</title>
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
                                    {{ $showData->name }} Information
                                </h4>
                                <a href="{{route('edit.customer', $showData->id)}}" class="btn btn-primary"> <i class=" ri-edit-box-line"></i> Edit Customer</a>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->name }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-search-input" class="col-sm-2 col-form-label">Customer Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->email }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-email-input" class="col-sm-2 col-form-label">Phone No.</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->phone }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-url-input" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->address }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-tel-input" class="col-sm-2 col-form-label">Bank Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->bank_name }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-password-input" class="col-sm-2 col-form-label">Bank Account</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->bank_account }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-number-input" class="col-sm-2 col-form-label">City / State</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->city }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Vacation</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="{{ $showData->vacation }}" readonly>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-date-input" class="col-sm-2 col-form-label">Join Date</label>
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