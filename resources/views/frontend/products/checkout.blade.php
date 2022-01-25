@extends('frontend.home')

@section('content')
<div class="head-product-page">
    <div class="overlay">
      <h1 class="title-sub-pages">Make Order</h1>
    </div><img src="{{ asset("frontend/images/back-sub.jpg") }}" alt="Make Order" title="Make Order">
  </div>
  <div class="posts">
    <!-- Cart-->
    <div class="cart_section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="cart_items">
              <ul class="cart_list">
                @if ($carts)
                @foreach ($carts as $cart )
                <li class="cart_item">
                  <div class="cart_item_image"><img src="{{ asset("files/products/".$cart->options->image) }}" alt="{{ $cart->name }}" title="{{ $cart->name }}"></div>
                  <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                    <div class="cart_item_name cart_info_col">
                      <div class="cart_item_title">Product Code</div>
                      <div class="cart_item_text">{{ $cart->name }}</div>
                    </div>
                    <div class="cart_item_quantity cart_info_col">
                        <div class="cart_item_title">Quantity</div>
                        <form method="POST" action="{{ route('update.cart') }}">
                            @csrf
                        <input type="hidden" name="product_id" value="{{ $cart->rowId }}">
                        <input type="number" name="qty" value="{{ $cart->qty }}"
                               style="width: 50px;
                               border: none;
                               box-shadow: 1px 1px 5px #ddd;" class="cart_item_text">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-check"
                                style="color: #fff !important;
                                font-size: 16px;
                                line-height: 1.5;"></i>
                        </button>
                        </form>
                      </div>
                      <div class="cart_item_price cart_info_col">
                        <div class="cart_item_title">Price</div>
                        <div class="cart_item_text">{{ $cart->price }}L.E</div>
                      </div>
                      <div class="cart_item_total cart_info_col">
                        <div class="cart_item_title">Total</div>
                        <div class="cart_item_text">{{ $cart->price*$cart->qty }}L.E</div>
                      </div>
                      <div class="cart_item_total cart_info_col">
                        <div class="cart_item_title">Action</div>
                       <a href="{{ url('remove/cart/'.$cart->rowId ) }}" class="btn btn-sm btn-danger cart_item_text" title="Remove"><i class="fas fa-times"></i></a>
                    </div>
                  </div>
                </li>
                @endforeach
                @endif
              </ul>
            </div>
                    <div style="text-align: left;
                                margin-top: 30px;
                                font-family: initial;">
                        @if (Session::has('coupon'))
                        @else
                        <h5 class="col-lg-4">Apply Coupon</h5>
                        <form method="POST" action="{{ route('apply.coupon') }}">
                            @csrf
                            <div class="col-lg-4">
                         <input type="text" name="coupon" placeholder="Enter Your Coupon" required class="form-control">
                           <br>
                         <button type="submit" class="btn btn-danger ml-2">Submit</button>
                        </div>
                        </form>
                        @endif
                    </div>

                    <ul class="list-group col-lg-4" style="float: right;text-align: left;">
                        @if (Session::has('coupon'))
                        <li class="list-group-item">Coupon : ({{ Session::get('coupon')['name'] }} )
                            <a href="{{ route('remove.coupon') }}" class="btn btn-danger btn-sm">X</a>
                             <span style="float: right">{{ Session::get('coupon')['discount'] }}%</span></li>
                             <li class="list-group-item"> Total : <span style="float: right">{{ Session::get('coupon')['price'] }} L.E</span></li>
                             @else
                        <li class="list-group-item"> Total : <span style="float: right">{{ Cart::subtotal() }} L.E</span></li>
                        @endif
                    </ul>
            </div>
        </div>

        <div class="row with-out">
            <span class="col-md-6">Without shipping cost and VAT</span>
            <span class="col-md-6">بدون تكلفة الشحن وضريبة القيمة المضافة </span>
          </div>

            <div class="cart_buttons">
                {{-- <button type="button" class="button button btn btn-danger">All Cancel</button> --}}
                <a href="{{ route('user.order') }}" class="button btn btn-success" title="CheckOut">CheckOut</a>
            </div>

    </div>
  </div>
@endsection
