
<nav>
  <!-- social-links-and-phone-number----------------->
  <div class="social-call">
    <!-- social-links--->
    <div class="social">
        <a rel="nofollow" href="{{ setting()->facebook }}" target="_blank"  title="facebook"><i class="fab fa-facebook-f"></i></a>
        <a rel="nofollow" href="{{ setting()->twitter }}" target="_blank"  title="twitter"><i class="fab fa-twitter"></i></a>
        <a rel="nofollow" href="{{ setting()->youtube }}" target="_blank"  title="youtube"><i class="fab fa-youtube"></i></a>
        <a rel="nofollow" href="{{ setting()->instagram }}" target="_blank"  title="instagram"><i class="fab fa-instagram"></i></a>
    </div>
    <!-- phone-number------>
    <!--<div class="phone"><span> <i class="fas fa-phone-alt">-->
    <!--     <span>{{ setting()->phone_one }}</span></i></span>
    </div>-->
  </div>
  <!-- menu-bar----------------------------------------->
  <div class="navigation">
    <!-- logo------------>
    <a class="logo" href="{{ url('/') }}">
        @if(!empty(setting()->logo))
        <img src="{{ asset("files/setting/".setting()->logo) }}" title="{{ setting()->siteName }}" alt="{{ setting()->siteName }}"/></a>
        @endif
        <!-- menu-icon------------->
    <div class="toggle"></div>
    <!-- menu----------------->
    <ul class="menu">
      <li><a href="{{ url('/') }}" title="Home">Home</a></li>
      <li class="shop"><a href="{{ url('about-patio') }}" title="About Us">About Us</a></li>
      <li><a href="{{ url('all-products') }}" title="Product">Product</a></li>
      <li><a href="{{ url('catalogue') }}"title="Catalogue">Catalogues</a></li>
      <li><a href="{{ url('contact-us') }}" title="Contact Us">Contact Us</a></li>
      <li><a href="{{ url('blog/post') }}" title="Blog">Blog</a></li>
    </ul>
    <!-- right-menu----------->
    <div class="right-menu">
        <a class="search" href="javascript:void(0);" title="Search"><i class="fas fa-search"></i></a>

        @guest
        <a class="user" href="javascript:void(0);">
            <i class="far fa-user"></i></a>
            @else
         <a class="user-style-in-media"  href="{{ route('user.account') }}">Hi {{ auth()->user()->first_name }}</a>
        @endguest


        @guest
        @else
        @php
    $wishlist = App\Models\WishList::where('user_id',Auth::id())->get();
        @endphp
        <a href="{{ route('user.account') }}" title="WishList">
        <i class="fas fa-heart"></i>
        </a>
   @endguest
        <a href="{{ route('show.cart') }}" title="Cart">
            <i class="fas fa-shopping-cart">
                <span class="num-cart-product">{{ Cart::count() }}</span>
            </i>
        </a>
    </div>
  </div>
</nav>
<!-- search-bar----------------------------------->
<div class="search-bar">
  <!-- search-input------->
  <div class="search-input">
      <form action="{{ route('search') }}" method="Post" class="w-100">
          @csrf
        <input type="text" placeholder="Search" name="search"/>
      </form>
    <!-- cancel-btn--->
    <a class="search-cancel" href="javascript:void(0);">
        <i class="fas fa-times"></i>
    </a>
  </div>
</div>
<!-- -login-and-sign-up--------------------------------->
<div class="form">
  <!-- login---------->
  <div class="login-form">
    <!-- cancel-btn---------------->
    <a class="form-cancel" href="javascript:void(0);">
        <i class="fas fa-times"></i>
    </a>
    <strong>Log In</strong>
    <!-- inputs-->
    {!! Form::open(
        [
      'action'=>'Auth\LoginController@login' ,
       'method' =>'post',
        ])
         !!}
          {!! Form::email('email',old('email') ,['class'=>'form-control' ,'placeholder'=>"Email"]) !!}
          @error('email')<span class="text-danger">{{ $message }}</span>@enderror

          {!! Form::password('password',['class'=>'form-control' , 'placeholder'=>"Password"]) !!}
          @error('password')<span class="text-danger">{{ $message }}</span>@enderror

          {!! Form::submit('Log In') !!}

         {!! Form::close() !!}
    <!-- forget-and-sign-up-btn-->
    <div class="form-btns">
        <a class="forget" href="{{ route('password.request') }}">Forget Your Password?</a>
        <a class="sign-up-btn" href="javascript:void(0);">Create Account</a>
    </div>
  </div>
  <!-- Sign-up---------->
  <div class="sign-up-form">
    <!-- cancel-btn---------------->
    <a class="form-cancel" href="javascript:void(0);">
        <i class="fas fa-times"></i>
    </a>
    <strong>Sign Up</strong>
    <!-- inputs-->

    {!! Form::open(
        [
        'action'=>'Auth\RegisterController@register' ,
        'method' =>'post',
        ])
         !!}
         {!! Form::text('first_name',old('first_name') ,['class'=>'form-control','placeholder'=>'First Name']) !!}
         @error('name')<span class="text-danger">{{ $message }}</span>@enderror
        {!! Form::text('name',old('name') ,['class'=>'form-control','placeholder'=>'Last Name']) !!}
        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
        {!! Form::email('email',old('email') ,['class'=>'form-control','placeholder'=>'E-mail']) !!}
         @error('email')<span class="text-danger">{{ $message }}</span>@enderror
         {!! Form::text('phone',old('phone') ,['class'=>'form-control','placeholder'=>'Phone']) !!}
         @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
         {!! Form::password('password' ,['class'=>'form-control','placeholder'=>'Password']) !!}
         @error('password')<span class="text-danger">{{ $message }}</span>@enderror
         {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Your Password Conformation']) !!}
         @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
         {!! Form::submit('Sign Up') !!}
      {!! Form::close() !!}
    <!-- forget-and-sign-up-btn-->
    <div class="form-btns"><a class="already-account" href="javascript:void(0);">Already Have Account?</a></div>
  </div>
</div>
