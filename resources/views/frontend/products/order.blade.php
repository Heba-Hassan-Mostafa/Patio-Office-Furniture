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
        <div class="last-step">
          <p>After You Accept The Last Step The Sales Department Will Contact You To Complete The Products Ordering Process</p>
          <h5 class=""> Final Step</h5>
        </div>
        <div class="row">
          <div class="col-lg-12 accept-last-step">
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
                        <div class="cart_item_text">{{ $cart->qty }}</div>
                      </div>
                      <div class="cart_item_price cart_info_col">
                        <div class="cart_item_title">Price</div>
                        <div class="cart_item_text">{{ $cart->price }}L.E</div>
                      </div>
                      <div class="cart_item_total cart_info_col">
                        <div class="cart_item_title">Total</div>
                        <div class="cart_item_text">{{ $cart->price*$cart->qty }}L.E</div>
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
                         <button type="submit" class="btn btn-danger ml-2" title="Submit">Submit</button>
                        </div>

                        </form>
                        @endif


                    </div>

                    <ul class="list-group col-lg-4" style="float: right;text-align: left;margin-bottom:20px">
                        @if (Session::has('coupon'))
                        <li class="list-group-item">Coupon : ({{ Session::get('coupon')['name'] }} )
                            <a href="{{ route('remove.coupon') }}" class="btn btn-danger btn-sm">X</a>
                             <span style="float: right">{{ Session::get('coupon')['discount'] }}</span></li>
                             <li class="list-group-item"> Total : <span style="float: right">${{ Session::get('coupon')['price'] }} L.E</span></li>
                             @else
                        <li class="list-group-item"> Total : <span style="float: right">{{ Cart::subtotal() }} L.E</span></li>
                        @endif
                    </ul>

                    <div class="row with-out" style="clear: both">
                        <span class="col-md-6">Without shipping cost and VAT</span>
                        <span class="col-md-6">بدون تكلفة الشحن وضريبة القيمة المضافة </span>
                    </div>

                    <div class="attention-text">
                        <p>
                        After You Accept The Last Step The Sales Department Will Contact You To Complete The Products Ordering Process ,
                        </p>
                        <p>Please indicate the sizes and any details of the required products in the notes box
                        </p>
                        <p>
                            بعد قبول الخطوة الأخيرة ، سيتصل بك قسم المبيعات لإكمال عملية طلب المنتجات
                            الرجاء توضيح المقاسات واي تفاصيل للمنتجات المطلوبة في خانة الملاحظات
                        </p>
                    </div>
            </div>

        </div>



        <div class="leave-last-order col-md-12">
            <h6>Please,Enter Your Information</h6>
                {!! Form::open(
                    [
                    'action'=> 'FrontendController\CartController@makeOrder' ,
                    'method' =>'post',
                    'id'=>"contact_form"
                    ])
                     !!}
                      <input type="hidden" name="total" value="{{ Cart::Subtotal() }}">
                      <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::text('first_name',old('first_name') ,['class'=>'form-control','placeholder'=>'  First Name']) !!}
                        @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-md-6">
                    {!! Form::text('last_name',old('last_name') ,['class'=>'form-control','placeholder'=>'  Last Name']) !!}
                    @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::email('email',old('email') ,['class'=>'form-control','placeholder'=>' E-mail']) !!}
                         @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group col-md-6">
                        {!! Form::text('phone',old('phone') ,['class'=>'form-control','placeholder'=>' Phone Number']) !!}
                        @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::text('address',old('address') ,['class'=>'form-control','placeholder'=>' Address']) !!}
                         @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::textarea('note',old('note') ,['class'=>'form-control','placeholder'=>' Notes']) !!}
                             @error('note')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                  <div class="cart_buttons">
                    <button class="btn btn-success" type="submit" title="Order Now">Order Now</button>
                </div>
                {!! Form::close() !!}
            </div>
          </div>



    </div>
  </div>
@endsection
