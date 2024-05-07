<div class="card">
    <div class="card-body">

        <h4 class="card-title">Manage Products</h4>
        <div class="data">
            @if( $products->count() == 0 )
                <div class="alert alert-danger" role="alert">
                    No Data Found!
                </div>
            @else
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Title</th>
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Sku Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    @if( !is_null($product->image) )
                                    <img src="{{asset($product->image)}}" alt="" class="user-img">
                                    @else
                                    <img src="{{asset('backend/images/default.jpg')}}" alt="" class="user-img">
                                    @endif
                                </td>
                                <td>{{$product->title}}</td>
                                <td>
                                    @if( isset($product->category) )
                                    @if($product->category->status !=0)
                                    {{$product->category->cat_name}}
                                    @else
                                    <span class="text-danger">Uncategorize</span>
                                    @endif
                                    @else
                                    <span class="text-danger">Uncategorize</span>
                                    @endif
                                </td>
                        
                                <td>{{$product->qty}}</td>
                                <td>
                                    @if( isset($product->code) )
                                    {{$product->code}}
                                    @else
                                    <div style="text-align: center">-</div>
                                    @endif
                                </td>
                        
                                <td class="action">
                                    @php
                                        $isProduct = App\Models\Cart::where('product_id', $product->id)->where('order_id', null)->get();
                                    @endphp
                                    @if( $isProduct->count() == 0 )
                                        @if( $product->qty != 0 )
                                            <form action="{{ route('add.cart') }}" method="post" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <input type="hidden" name="qty" value="1">
                                                <button class="addToCart" type="button">
                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="noQty">
                                                <i class="fa fa-check-square" aria-hidden="true"></i>
                                            </button>
                                        @endif
                                    @else
                                        <button class="showtoast">
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    @endif
                                    <button>
                                        <a href="{{route('show.product',$product->slug)}}" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>