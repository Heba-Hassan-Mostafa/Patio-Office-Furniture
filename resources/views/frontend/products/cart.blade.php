@extends('frontend.home')

@section('content')
   <div class="head-product-page">
      <div class="overlay">
        <h1 class="title-sub-pages">Shopping Cart</h1>
      </div><img src="{{ asset("frontend/images/back-sub.jpg") }}" alt="Shopping Cart" title="Shopping Cart">
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
                    <div class="cart_item_image">
                        <img src="{{ asset("files/products/".$cart->options->image) }}" alt="{{ $cart->name }}" title="{{ $cart->name }}"></div>
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
                        @if ($cart->price == null)

                        <div class="cart_item_text"> No Price </div>
                        @else
                        <div class="cart_item_text">{{ $cart->price }}L.E</div>
                        @endif
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

              <!-- Order Total-->
              <div class="order_total">
                <div class="order_total_content text-md-right">
                  <div class="order_total_title">Order Total:</div>
                  <div class="order_total_amount">{{ Cart::subtotal() }}L.E</div>

                  <div class="row with-out">
                    <span class="col-md-6">Without shipping cost and VAT</span>
                    <span class="col-md-6">بدون تكلفة الشحن وضريبة القيمة المضافة </span>
                  </div>

                </div>
              </div>
              <div class="cart_buttons">
                {{-- <button class="button btn btn-danger">Cancel All </button> --}}
                <a href="{{ route('user.checkout') }}" class="button btn btn-success" title="CheckOut">CheckOut</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
