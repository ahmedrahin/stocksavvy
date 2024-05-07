@extends('backend.layout.template')
@section('page-title')
    <title>Category - {{ $showData->cat_name }} || {{ !is_null($siteTitle = App\Models\Settings::site_title()) ? $siteTitle->company_name : '' }}</title>
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

        .product .card-body {
            background: #EFF3F6;
        }
        .card-text {
            color: #818181 !important;
        }
        .card-body h4 {
            font-size: 15px;
            font-weight: 600;
            color: #2c2c2c;
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
                                <li class="breadcrumb-item"><a href="{{url('/admin/categories/manage')}}">All Category</a></li>
                                <li class="breadcrumb-item active">{{ $showData->cat_name }}</li>
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
                                    {{ $showData->cat_name }} - {{$products->count()}} Product found
                                </h4>
                                <a href="{{route('edit.category', $showData->id)}}" class="btn btn-primary"> <i class=" ri-edit-box-line"></i> Edit Category</a>
                            </div>
                            
                            <div class="row product">
                                @foreach( $products as $product )
                                    <div class="col-md-6 col-xl-3">
                                        <a href="{{route('show.product', $product->slug)}}" >
                                            <div class="card">
                                                @if( !is_null($product->image) )
                                                    <img class="card-img-top img-fluid" src="{{asset($product->image)}}">
                                                @else
                                                    <img class="card-img-top img-fluid" src="{{asset('backend/images/default.jpg')}}">
                                                @endif
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        <h4>{{$product->title}}</h4>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
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