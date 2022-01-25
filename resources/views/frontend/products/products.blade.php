@extends('frontend.home')
        @section('header')
        <meta name="keywords" content="{{ setting()->keywords }}">
        <meta name="description" content="{{ setting()->description }}">
        <meta name="author" content="{{ setting()->siteName }}">
        @endsection
@section('content')
    <div class="head-product-page">
      <div class="overlay">
        <h1 class="title-sub-pages">Products</h1>
      </div><img src="{{ asset("frontend/images/back-sub.jpg") }}" alt="products" title="products">
    </div>
    <!-- start all product category content-->
    <div class="products-category-content">
      <div class="categories-select">
        <h2>Product Categories</h2>

        {{-- <select id="pro_id" onchange="getProduct();" name="Category">
            @foreach ($categories as $cat)
            <option value="{{ $cat->id }}">
                {{ ucwords($cat->name) }}
            </option>
            @endforeach
        </select> --}}

        <ul>
            <li><a href="{{ url('all-products') }}" title="All Product">All Product</a> </li>
            @foreach ($categories as $cat)
          <li > <a href="{{ url('/product/category/'.$cat->id) }}" title="{{ $cat->name }}">{{ ucwords($cat->name) }}</a></li>
          @endforeach

        </ul>
      </div>

      <div class="row product-page-item">
          @foreach ($products as $product)
          
            @php
          $user_id = Auth::id();
          $check = App\Models\WishList::where('user_id',$user_id)->where('product_id',$product->id)->first();
        @endphp
        <div class="col-lg-3 col-sm-5 cart-box">
            <button class="addwishlist" data-id="{{ $product->id }}">
               @if ($check)
                <i class="fas fa-heart like"></i>
                @else
                <i class="fas fa-heart"></i>

                @endif
            </button>
          <div class="img-with-overlay">
              @if (!empty($product->image))
              
             <a  href="{{ asset("files/products/".$product->image) }}" data-lightbox="mygallery-{{ $product->id }}" data-title="{{ $product->detail }}">
                <img class="img-fluid" src="{{ asset("files/products/".$product->image) }}" title="{{ $product->product_code }}" alt="{{ $product->product_code }}">
            </a>
              
              

              @endif
          </div>
          <div class="row details-all-item">
            <div class="col-6 category-details"><span>Code:</span><span>{{ $product->product_code }}</span></div>
            <div class="col-6 style-pro-cart">
                <button id="{{ $product->id }}" class="pro-cart addcart"  data-toggle="modal" data-target="#modalLoginForm"
                    onclick="productview(this.id)" title="Add To Cart"><i class="fas fa-shopping-cart"></i></button>
                </div>
          </div>
        </div>
        @endforeach
          </div>

    </div>
    <div class="pagi-style">{{ $products->links() }}</div>

    <!--modal for all carts-->
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 850px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title w-100 font-weight-bold">Product Details</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body mx-3">
              <div class="row">
                <div class="col-md-4">
                    <img id="pimg" class="img-fluid" src="" alt=""></div>
                <div class="col-md-8 product-more-details">
                  <h4 >Category: <span id="pcat"></span></h4>
                  <h4>Code:  <span id="pcode"></span></h4>
                  <h4>Description: <span id="pdetail"></span></h4>
                  <div class="row">
                    <div class="product_quantity clearfix col-6"><span>Quantity: </span>
                        <form method="POST" action="{{ route('insert.cart.modal') }}">
                            @csrf
                        <input type="hidden" name="product_id" id="product_id" >
                        <input id="quantity_input" type="text" name="qty" value="1" pattern="[0-9]">
                        <div class="quantity_buttons">
                            <div class="quantity_inc quantity_control" id="quantity_inc_button"><i class="fas fa-chevron-up"></i></div>
                            <div class="quantity_dec quantity_control" id="quantity_dec_button"><i class="fas fa-chevron-down"></i></div>
                          </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer modal-footer-cart d-flex justify-content-center">
              <button class='m-auto' type="submit" title="Add To Cart">Add To Cart</button>
            </div>
        </form>
          </div>
        </div>
      </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        function productview(id)
        {
            $.ajax({
                url:"{{ url('/cart/product/view/') }}/"+id,
                type:"GET",
                datType:"json",
                success:function(data){
                    $('#pimg').attr('src',"{{ asset('files/products/') }}/"+data.product.image);
                    $('#pcode').text(data.product.product_code);
                    $('#pcat').text(data.product_cat);
                    $('#product_id').val(data.product.id);
                    $('#pdetail').html(data.product.detail);
                }
            })
        }
    </script>
   <script type="text/javascript">

    $(document).ready(function(){
      $('.addwishlist').on('click', function(){
    $(this).find(">:first-child").toggleClass("like");

         var id = $(this).data('id');



         if (id) {

             $.ajax({
                 url: " {{ url('add/wishlist/') }}/"+id,
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

                 window.location.href = 'login'
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
