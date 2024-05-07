  {{-- customer --}}
  <div class="card mb-4">
    <div class="card-header">
        Customer
        <a href="{{route('add.customer')}}" class="btn btn-primary"> <i class="ri-heart-add-line"></i> Add New</a>
    </div>
    <div class="card-body">
        <blockquote class="card-blockquote mb-0">
            <form action="{{route('place.order')}}" method="post" class="needs-validation" novalidate>
                @csrf
                <select name="customer" id="" class="form-control select2">
                    <option value="" disabled selected>Select a Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            
                <button class="btn btn-primary orderModel {{(App\Models\Cart::totalItems()->count() == 0)?'Noselected':''}}" style="margin-top: 15px;" type="button" data-bs-toggle="modal" data-bs-target="#firstmodal">
                    Create Order
                </button>
        </blockquote>
    </div>
</div>

        <!-- First modal dialog -->
        <div class="modal fade" id="firstmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Total Amount</label>
                                    <input type="text" class="form-control" value="{{App\Models\Cart::totalAmount()}}.00" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pstatus">Payment</label>
                                    <select name="pstatus" class="form-control pstatus">
                                        <option value="Hand Cash">Hand Cash</option>
                                        <option value="Processing">Cheque</option>
                                        <option value="Due">Due</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="paid">Paid Amount</label>
                                    <input type="text" id="paid" name="paid" class="form-control" value="{{App\Models\Cart::totalAmount()}}.00"  placeholder="00.00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="discount">Discount Amount</label>
                                    <input type="text" id="discount" name="discount" class="form-control" placeholder="00.00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="vat">Vat(%)</label>
                                    <input type="number" id="vat" name="vat" class="form-control" placeholder="00.00">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Pending">Pending</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancel">Cancel</option>
                                        <option value="Partially Refunded">Partially Refunded</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="order_date">Order Date</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="dd M, yyyy"
                                            data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker" name="order_date">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    <div id="" class="err"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="order_date">Issue Date</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="dd M, yyyy"
                                            data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-provide="datepicker" name="issue_date">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    <div id="e_date_error" class="err"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- Toogle to second dialog -->
                        <button class="btn btn-primary" type="submit" id="submitOrder">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

{{-- cart item --}}
<div class="cart_item">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Title</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th>Del.</th>
            </tr>
        </thead>
        <tbody>
            @if( App\Models\Cart::totalItems()->count() != 0 )
                @foreach( App\Models\Cart::totalItems() as $cart )
                    <tr data-cart-id="{{ $cart->id }}">
                        <td>{{ $cart->product->title }}</td>
                        <td style="width: 115px;">
                            <div class="qty-box">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <button type="button" class="btn quantity-left-minus" data-type="minus">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button> 
                                    </span>
                                    
                                    <input type="text" name="quantity" class="form-control input-number" value="{{ $cart->product_quantity }}" min="1">
                                    <input type="hidden" class="input-qynt" value="{{ $cart->product_quantity }}">
                                    <input type="hidden" class="totalQuant" value="{{$cart->product->qty}}"> 
                                    <span class="input-group-prepend">
                                        <button type="button" class="btn quantity-right-plus" data-type="plus">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $cart->product->selling_price }}</td>
                        <td>{{ $cart->product->selling_price * $cart->product_quantity }}</td>
                        <td>
                            <button class="del" data-product-id="{{ $cart->id }}">
                                &#x2715;
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5"><h5 class="text-danger">No product added!</h5></td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="cart_info">
        <h6>
           Total Quantity: 
            <label>{{App\Models\Cart::totalQunt()}}</label>
        </h6>
        <h6 class="sub_total">
            Sub Total:
            <label>
                @if( App\Models\Cart::totalAmount() > 1 )
                    {{App\Models\Cart::totalAmount()}}.00tk
                @else
                    00.00tk
                @endif
            </label>
        </h6>
    </div>
</div>