@extends('frontend.home')
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="{{ setting()->siteName }}">


@php
    $lists = App\Models\WishList::with('user','product')->where('user_id',Auth::id())->orderBy('id','desc')->get();
@endphp
@section('content')
<div class="head-product-page">
    <div class="overlay">
      <h1 class="title-sub-pages">Account Details</h1>
    </div><img src="{{ asset("frontend/images/back-sub.jpg") }}" alt="Account Details" title="Account Details">
  </div>
  <div class="posts">
    <div class="container">
      <div class="row account-pade-details">
        <div class="account-box col-md-4">
            <img src="{{ asset("frontend/images/user.png") }}" alt="User iamge" title="{{ Auth::user()->first_name }} {{ Auth::user()->name }}">
          <h6>{{ Auth::user()->first_name }} {{ Auth::user()->name }}</h6>
          <hr><a href="{{ route('change.password') }}" title="Change Password">Change Password</a>
          <hr>
          <a href="{{ route('user.logout') }}" class="btn btn-danger out-style" title="Log Out">Log Out</a>
        </div>
        <div class="cart-like-box col-md-7">
          <h5 class="btn btn-danger">Wish List</h5>
          <div class="table-responsive">
            <table class="table">
              <thead></thead>

              <tr>

                <th scope="col">Image</th>
                <th scope="col">Product Code</th>
                <th scope="col">Category</th>
                <th scope="col">Cart</th>
                <th scope="col">Action</th>
              </tr>
              <tbody>
              @if ($lists)
              @foreach ($lists as $list )
              <tr>

                <td>@if(!empty($list->product->image))
                    <img src="{{ asset('/files/products/'.$list->product->image) }}" style="width:50px;height:50px;" title="{{ $list->product->product_code }}" alt="{{ $list->product->product_code }}"/>
                       @endif</td>
                <td>{{ $list->product->product_code }}</td>
                <td>{{ $list->product->category->name }}</td>
                <td><button class="btn btn-sm btn-success addcart" data-id="{{ $list->product->id }}" title="Add To Cart">Add To Cart</button> </td>
                <td><a href="{{ url('remove/wishlist/'.$list->id) }}" class="btn btn-sm btn-danger cart_item_text" title="Remove" ><i class="fas fa-times"></i></a>
                </td>
              </tr>
              @endforeach

              @endif

            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <script type="text/javascript">

    $(document).ready(function(){
      $('.addcart').on('click', function(){
         var id = $(this).data('id');
         if (id) {
             $.ajax({
                 url: " {{ url('add/cart/') }}/"+id,
                 type:"GET",
                 datType:"json",
                 success:function(data){
              const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   timerProgressBar: true,
                   onOpen: (toast) => {
                     toast.addEventListener('mouseenter', Swal.stopTimer)
                     toast.addEventListener('mouseleave', Swal.resumeTimer)
                   }
                 })
              if ($.isEmptyObject(data.error)) {
                 Toast.fire({
                   icon: 'success',
                   title: data.success
                 })
              }else{
                  Toast.fire({
                   icon: 'error',
                   title: data.error
                 })
              }

                 },
             });
         }else{
             //alert('danger');
         }
      });
    });
 </script>
@endsection
