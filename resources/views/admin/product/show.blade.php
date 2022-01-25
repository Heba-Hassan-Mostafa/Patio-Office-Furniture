@extends('admin.app')

@section('content')

 <!-- ########## START: MAIN PANEL ########## -->

      <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Product Section</span>
      </nav>

      <div class="sl-pagebody">


 <div class="card pd-20 pd-sm-40">


            <h6 class="card-body-title">{{ $title }}</h6>
            <div class="ml-auto">
                <a href="{{ adminurl('product') }}" class="btn btn-primary btn-sm pull-right">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Products</span>
                </a>
            </div>



          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Product Name: </label>
                 <strong>{{ $product->product_name }}</strong>
                </div>
              </div><!-- col-4 -->


           <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Product Code:</label>
                 <strong>{{ $product->product_code }}</strong>
                </div>
              </div><!-- col-4 -->

             <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Price: </label>
                 <strong>
                    @if (!empty($product->price))
                    {{ $product->price }}
                    @else
                    <span>Null</span>

                    @endif
                   </strong>
                </div>
              </div><!-- col-4 -->


                <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Discount: </label>
                 <strong>
                    @if (!empty($product->discount))
                    {{ $product->discount }}
                    @else
                    <span>Null</span>

                    @endif
                </strong>
                </div>
              </div><!-- col-4 -->



             <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Category: </label>
                 <strong>{{ $product->category->name }}</strong>
                </div>
              </div><!-- col-4 -->





            <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">sub-Category: </label>
                 <strong>{{optional($product->sub_category)->name }}</strong>
                </div>
              </div><!-- col-4 -->





                <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Product Details:</label>
                    <br>
                 <p>   {!! $product->detail !!} </p>

                </div>
              </div><!-- col-4 -->


              <div class="col-lg-4">
                <label class="form-control-label">Status: </label>
                   @if($product->status == 1)
                   <span class="badge badge-success" style="padding: 10px;font-size: 14px;">Active</span>

                   @else
                 <span class="badge badge-danger" style="padding: 10px;font-size: 14px;">Inactive</span>
                   @endif
                  </label>

                  </div> <!-- col-4 -->

            <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image : </label><br>
                   @if(!empty($product->image))
        <img src="{{ asset('/files/products/'.$product->image) }}" style="width:100px;height:100px;" />
       @endif
                </div>
              </div><!-- col-4 -->



          </div>

            </div><!-- row -->

  <hr>
  <br><br>

          <div class="row">

       <div class="col-lg-4">
        <label class="">
         @if($product->features == 1)
         <span class="badge badge-success">Active</span>

         @else
       <span class="badge badge-danger">Inactive</span>
         @endif

          <span> Features</span>
        </label>

        </div> <!-- col-4 -->
  <div class="col-lg-4">
        <label class="">
         @if($product->best_sellers == 1)
         <span class="badge badge-success">Active</span>

         @else
       <span class="badge badge-danger">Inactive</span>
         @endif

          <span>Best Sellers</span>
        </label>

        </div> <!-- col-4 -->



         <div class="col-lg-4">
       <label class="">
         @if($product->on_sale == 1)
         <span class="badge badge-success">Active</span>

         @else
       <span class="badge badge-danger">Inactive</span>
         @endif

          <span>On Sale</span>
        </label>

        </div> <!-- col-4 -->


         <div class="col-lg-4">
       <label class="">
         @if($product->offers == 1)
         <span class="badge badge-success">Active</span>

         @else
       <span class="badge badge-danger">Inactive</span>
         @endif

          <span> Offers </span>
        </label>

        </div> <!-- col-4 -->


          </div><!-- end row -->
        </div><!-- form-layout -->
        </div><!-- card -->
@endsection
