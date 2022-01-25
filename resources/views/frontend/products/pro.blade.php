
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
      <button id="{{ $product->id }}" class="pro-cart addcart addwishlist" data-toggle="modal" data-target="#modalLoginForm"
          onclick="productview(this.id)" title="Add To Cart">
          <i class="fas fa-shopping-cart"></i></button>

  </div>
  </div>
</div>

@endforeach


<script>
    $(document).ready(function(){
      $('.addwishlist').on('click', function(){
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
       $(".addwishlist i").click(function(){
		$(this).toggleClass("like");
	})

 </script>
