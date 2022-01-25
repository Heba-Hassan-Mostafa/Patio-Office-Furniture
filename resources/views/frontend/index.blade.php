@extends('frontend.home')

@section('header')
<meta name="keywords" content="{{ setting()->keywords }}">
<meta name="description" content="{{ setting()->description }}">
<meta name="author" content="{{ setting()->siteName }}">
@endsection

@section('content')
<div class="head-background"><img src="{{ asset("frontend/images/head-back.jpg") }}" title="{{ setting()->siteName }}" alt="{{ setting()->siteName }}"></div>


        @php
        $offers = App\Models\Product::with('category')->whereStatus(1)->where('offers',1)->orderBy('order', 'asc')->paginate(3);
        @endphp
    <!--start deals-->
    <div class="deals-offer">
      <div class="row effect">
        <div class="col-lg-4">
          <div class="offer-box">
            <h1>PATIO OFFERS</h1>

            @if($offers->count() > 0)
            <div class="carousel slide" id="carouselExampleInterval" data-ride="carousel" >
              <div class="carousel-inner">


                @if ($offers)
                @foreach ($offers as $row)

                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                    @if (!empty($row->image))
                    <img class="d-block" src="{{ asset("files/products/".$row->image) }}" alt="{{ $row->product_code }}" title="{{ $row->product_code }}">
                    @endif

                  <div class="product-details row">
                    <div class="col-6 item-category">
                      <h4>{{ $row->category->name }}</h4>
                      <h4>Code: <span> {{ $row->product_code }}</span></h4>
                    </div>
                    <div class="col-6 price-offer">
                        @if($row->discount == null)
                      @else
                      <h4 class="orignal-price">{{ $row->price }} <span>L.E</span></h4>
                      <h4 class="after-offer">{{ $row->discount }} <span>L.E</span></h4>
                      @endif
                    </div>
                  </div>
                  {{-- <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                    <div class="deals_timer_title_container">
                      <div class="deals_timer_title">Hurry Up</div>
                      <div class="deals_timer_subtitle">Offer ends in:</div>
                    </div>
                    <div class="deals_timer_content ml-auto">
                      <div class="deals_timer_box clearfix" data-target-time="may 29, 2021">
                        <div class="deals_timer_unit">
                          <div class="deals_timer_hr" id="deals_timer3_hr"></div><span>hours</span>
                        </div>
                        <div class="deals_timer_unit">
                          <div class="deals_timer_min" id="deals_timer3_min"></div><span>mins</span>
                        </div>
                        <div class="deals_timer_unit">
                          <div class="deals_timer_sec" id="deals_timer3_sec"></div><span>secs</span>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                   <form id="formABC" >
                     <input type="submit" value="Get IT" id="btnSubmit" class="accept-offer btn btn-info addcart" data-id="{{ $row->id }}" title="Get It">
                 </form>
                </div>
                @endforeach

                @endif
            </div>
            @if($offers->count() > 1)
            <a class="carousel-control-prev move-select" href="#carouselExampleInterval" role="button" data-slide="prev">
                <span aria-hidden="true">
                    <i class="fas fa-angle-left postion-select"></i>
                </span><span class="sr-only">Previous</span>
            </a><a class="carousel-control-next move-select" href="#carouselExampleInterval" role="button" data-slide="next">
                <span aria-hidden="true"><i class="fas fa-angle-right postion-select"></i>
                </span><span class="sr-only">Next</span></a>
                @endif

        </div>
        @else
        <img class="d-block w-100 slider-img defo-img" src="{{ asset('frontend/images/offercomming.png') }}" alt="Offer" title="Offer">

            @endif
          </div>
        </div>


        @php
        $features = App\Models\Product::with('category')->whereStatus(1)->where('features',1)->orderBy('order', 'asc')->paginate(6);
        $best_sellers = App\Models\Product::with('category')->whereStatus(1)->where('best_sellers',1)->orderBy('order', 'asc')->paginate(6);
        $sales = App\Models\Product::with('category')->whereStatus(1)->where('on_sale',1)->orderBy('order', 'asc')->paginate(6);

        @endphp
        <div class="col-lg-8">
          <ul class="all-items-news">
            <li class="features active" data-content=".features-content">Features</li>
            <li class="best-sellers" data-content=".best-sellers-content">Best Sellers</li>
            <li class="on-sale" data-content=".on-sale-content">On Sale</li>
          </ul>
          <hr>
          <div class="all-offers-select">
            <div class="content-all-data features-content">
              <div class="container">
                <div class="row center-items justify-content-center">

             @if ($features)
            @foreach ($features as $row )

                  <div class="col-lg-3 col-md-5 cart-box">

                    @php
                          $user_id = Auth::id();
                          $check = App\Models\WishList::where('user_id',$user_id)->where('product_id',$row->id)->first();
                    @endphp
                    <button class="addwishlist" data-id="{{ $row->id }}">
                        @if ($check)
                        <i class="fas fa-heart like"></i>
                        @else
                        <i class="fas fa-heart"></i>

                        @endif
                    </button>

                    <div class="img-with-overlay">

                        @if (!empty($row->image))
                        <a  href="{{ asset("files/products/".$row->image) }}" data-lightbox="funt-{{ $row->id }}" data-title="{{ $row->detail }}">
                            <img class="img-fluid" src="{{ asset("files/products/".$row->image) }}" title="{{ $row->product_code }}" alt="{{ $row->product_code }}">
                        </a>
                        @endif
                    </div>
                    <div class="row details-all-item">
                      <div class="col-md-6 category-item">{{ $row->category->name }}</div>
                      <div class="col-md-6 category-details"><span>Code:</span><span>{{ $row->product_code }}</span></div>
                    </div>
                    <div class="style-button">
                      <button id="{{ $row->id }}"  class="add-to-cart addcart"  data-toggle="modal" data-target="#modalLoginForm"
                        onclick="productview(this.id)" title="Add To Cart">Add To Cart</button>

                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
            <div class="content-all-data best-sellers-content">
              <div class="container">
                <div class="row center-items justify-content-center">

                    @if($best_sellers)
                    @foreach ($best_sellers as $row )
                  <div class="col-lg-3 col-md-5 cart-box">
                         @php
                          $user_id = Auth::id();
                          $check = App\Models\WishList::where('user_id',$user_id)->where('product_id',$row->id)->first();
                    @endphp
                    <button class="addwishlist" data-id="{{ $row->id }}">
                        @if ($check)
                        <i class="fas fa-heart like"></i>
                        @else
                        <i class="fas fa-heart"></i>

                        @endif
                    </button>
                        <div class="img-with-overlay">
                        @if (!empty($row->image))
                         <a  href="{{ asset("files/products/".$row->image) }}" data-lightbox="seller-{{ $row->id }}" data-title="{{ $row->detail }}">
                            <img class="img-fluid" src="{{ asset("files/products/".$row->image) }}" title="{{ $row->product_code }}" alt="{{ $row->product_code }}">
                        </a>
                        @endif
                    </div>
                    <div class="row details-all-item">
                      <div class="col-md-6 category-item">{{ $row->category->name }}</div>
                      <div class="col-md-6 category-details"><span>Code:</span><span>{{ $row->product_code }}</span></div>
                    </div>
                    <div class="style-button">
                        <button id="{{ $row->id }}" class="add-to-cart addcart"  data-toggle="modal" data-target="#modalLoginForm"
                            onclick="productview(this.id)" title="Add To Cart">Add To Cart</button>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
            <div class="content-all-data on-sale-content">
              <div class="container">
                <div class="row center-items justify-content-center">
                    @if($sales)
                    @foreach ($sales as $row )
                  <div class="col-lg-3 col-md-5 cart-box">
                       @php
                          $user_id = Auth::id();
                          $check = App\Models\WishList::where('user_id',$user_id)->where('product_id',$row->id)->first();
                    @endphp
                    <button class="addwishlist" data-id="{{ $row->id }}">
                        @if ($check)
                        <i class="fas fa-heart like"></i>
                        @else
                        <i class="fas fa-heart"></i>
                        @endif
                    </button>

                <div class="img-with-overlay">
                        @if (!empty($row->image))
                        <a  href="{{ asset("files/products/".$row->image) }}" data-lightbox="onsall-{{ $row->id }}" data-title="{{ $row->detail }}">
                            <img class="img-fluid" src="{{ asset("files/products/".$row->image) }}" title="{{ $row->product_code }}" alt="{{ $row->product_code }}">
                        </a>
                        @endif
                    </div>
                    <div class="row details-all-item">
                      <div class="col-md-6 category-item">{{ $row->category->name }}</div>
                      <div class="col-md-6 category-details"><span>Code:</span><span>{{ $row->product_code }}</span></div>
                    </div>
                    <div class="style-button">
                        <button id="{{ $row->id }}" class="add-to-cart addcart"  data-toggle="modal" data-target="#modalLoginForm"
                            onclick="productview(this.id)" title="Add To Cart">Add To Cart</button>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end offers-->
    
    
    @php
        $categories = App\Models\Category::whereHas('products')->whereStatus(1)->orderBy('order','asc')->paginate(6);
        $data= App\Models\Product::with('category')
        ->whereStatus(1)
        ->orderBy('order', 'asc')
        ->paginate(6);

    @endphp
       <!-- start some of product in home page -->
    <div class="home-product">
        <div class="container">
          <h5>Products</h5>
          <ul class="ul-cat">
            @foreach ($categories as $cat)
          <li >
        <span class="pro_id" data-id="{{ $cat->id }}" value="{{ $cat->id }}" title="{{ $cat->name }}">{{ ucwords($cat->name) }}</span></li>
          @endforeach

        </ul>
          <div class="all-product-category">
            <div class="all-product-item chair-items-product">
              <div class="container">
                <div class="row center-items" id="div1">
                    @foreach ($data as $product)
                  <div class=" col-md-3 cart-box">
                       @php
                  $user_id = Auth::id();
                  $check = App\Models\WishList::where('user_id',$user_id)->where('product_id',$product->id)->first();
                    @endphp
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
                        <button id="{{ $product->id }}" class="pro-cart addcart" data-toggle="modal" data-target="#modalLoginForm"
                            onclick="productview(this.id)" title="Add To Cart">
                            <i class="fas fa-shopping-cart"></i></button>

                    </div>
                    </div>
                  </div>

                  @endforeach
                </div>
              </div>
            </div>
              <div style="margin-top: 20px;">
                <a href="{{ url('all-products') }}" class=" more-pro" title="More Products">More Products</a>
            </div>

          </div>
        </div>
      </div>



    <!--start our customers-->
    @php
        $brands = App\Models\ClientBrand::whereStatus(1)->orderBy('id','desc')->get();
    @endphp
    <div class="our-brands container">
        <h2 class="h2-clint">Our Clients</h2>
        <section class="customer-logos slider">
            @if ($brands)
            @foreach ($brands as $row)
            <div class="slide">
                @if (!empty($row->image))
                <img src="{{ asset("files/brands/".$row->image) }}" alt="{{ $row->name }}" title="{{ $row->name }}">
                @endif
            </div>
            @endforeach
            @endif

        </section>
      </div>

    
       <!--start subscribe -->
       @php
           $coupon = App\Models\Coupon::orderBy('id','desc')->first();
       @endphp
    <div class="subscriber">
        <div class="overlay"></div>
        <div class="container">
          <div class="row">
            <div class="col-md-6 form-text-details">
              <h2>Sign UP For Newsletter</h2>
                @if ($coupon)
                <p>
                    <span></span>and receive <span class="discount"> {{ $coupon->discount }} %</span>Coupon for first Shopping
                </p>

                @else
                @endif

            </div>
            <div class="col-md-6 form-details">
              {!! Form::open(
                ['action'=>'FrontendController\IndexController@subscriber' ,
                'method' =>'post',
                ])
                 !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control' ,'placeholder'=>"Enter your Email address"]) !!}
                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                 {!! Form::submit('Subscribe', ['class' => 'btn btn-warning click-sub']) !!}
            {!! Form::close() !!}

            </div>
          </div>
        </div>
      </div>

      @php
          $comments = App\Models\Comment::whereStatus(1)->orderBy('order','asc')->paginate(4);
      @endphp
       <!-- Clints comments-->
    <div class="Clints">
        <div class="container">
          <h3>Clients Opinion</h3>
          <button class="btn btn-danger add-comment-link"><a class="btn-rounded mb-4" href="" data-toggle="modal" data-target="#modalContactForm" title="Add Comment">Add Comment</a></button>
          <div class="row">
              @if ($comments)
              @foreach ($comments as $comment)
              <div class="comment-box col-md-5">
                <h6>From :<span> {{ $comment->name }}</span></h6>
                <hr>
                <p>
                  {{ $comment->comment }}
                </p>
              </div>
              @endforeach

              @endif

          </div>
          <button class="more-comment btn btn-info"><a href="{{ url('comments') }}" title="More Comments">More Comments</a></button>
        </div>
      </div>



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
                <img id="pimg" class="img-fluid" src="" alt="image"></div>
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
          <button type="submit" style="margin: auto;" title="Add To Cart">Add To Cart</button>
        </div>
    </form>
      </div>
    </div>
  </div>


  <!-- modal for add comment-->
  <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100 font-weight-bold">Add Your Comment</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        {!! Form::open(
            ['action'=>'FrontendController\IndexController@comment' ,
            'method' =>'post',
            ])
             !!}
            <div class="modal-body content-modal-comment mx-3">

        <div class="md-form mb-5"><i class="fas fa-user prefix grey-text"></i>
            {!! Form::text('name', old('name'), ['class' => 'form-control  validate' ,'id'=>'form34','placeholder'=>"Your Name"]) !!}
             @error('name')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="md-form mb-5"><i class="fas fa-envelope prefix grey-text"></i>
            {!! Form::email('client_email', old('client_email'), ['class' => 'form-control validate' ,'id'=>'form29','placeholder'=>"Email Address"]) !!}
             @error('client_email')<span class="text-danger">{{ $message }}</span>@enderror

        </div>

          <div class="d-flex">
              <i class="fas fa-edit"
                style="font-size: 30px;
                color: #bdbdbd;
                margin: 3px 10px;"></i>
            {!! Form::textarea('comment', old('comment'),
             ['class' => 'md-textarea  count-limit' ,'id'=>'form8','rows'=>"4",'placeholder'=>"Write Your Comment",'maxlength'=>"260"]) !!}
             @error('comment')<span class="text-danger">{{ $message }}</span>@enderror
          </div>
          <div class="alram-lim-text">
            <p class="error-msg">Character Limit Exceed</p>
            <p class="num-lim"><span class="counting">0</span>/260</p>
            <br clear="both">
        </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
            {!! Form::submit('Send', ['class' => 'btn btn-success']) !!}<i class="fas fa-paper-plane-o ml-1"></i>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
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
          
            
         var id = $(this).data('id');
         
          
            
         if (id) {
             
        //  $(this).find(">:first-child").toggleClass("like");
           
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
             
            //  $(this).find(">:first-child").toggleClass("like");
             
          
         }
         
        
      });
    });
 </script>

<script>

$(document).ready(function(){
        
        
      $('.addwishlist').click(function(){
           $(this).find(">:first-child").toggleClass("like");
          
      });
      
});


</script>

<script>
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

<script>
    $('.pro_id').on('click',function(getProduct){
     var id = $(this).data('id');
         $.ajax({
             type:"GET",
             dataType:"html",
             url:"{{ URL::to('get-product') }}",
             data:{
                 'id' : id
             },
             success:function(data){
                 $("#div1").html(data);
             }

         });
    })

  </script>
  
  <!--this script for make offer to get only one shot-->
    <script>
      $(document).ready(function () {

          $("#formABC").submit(function (e) {

              //stop submitting the form to see the disabled button effect
              e.preventDefault();

              //disable the submit button
              $("#btnSubmit").attr("disabled", true);

              //disable a normal button
              $("#btnTest").attr("disabled", true);

              return true;

          });
      });
  </script>
    @endsection
