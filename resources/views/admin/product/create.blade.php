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


           {!! Form::open(
            ['action' => 'BackendController\ProductController@store',
             'method' => 'post',
              'files'=>true ,
              'enctype' =>'multipart/form-data'
                ])
             !!}

          <div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-6">
                <div class="form-group">
                {!! Form::label('product_name', 'Product Name',['class'=>"form-control-label"]) !!}
                {!! Form::text('product_name', old('product_name'), ['class' => 'form-control' ,'placeholder'=>"Enter Product Name"]) !!}
                @error('product_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->


              <div class="col-lg-6">
                <div class="form-group">
                {!! Form::label('product_code', 'Product Code',['class'=>"form-control-label"]) !!}
                {!! Form::text('product_code', old('product_code'), ['class' => 'form-control' ,'placeholder'=>"Enter Product Code"]) !!}
                @error('product_code')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->


              <div class="col-lg-6">
                <div class="form-group">
                {!! Form::label('price', 'Price',['class'=>"form-control-label"]) !!}
                {!! Form::text('price', old('price'), ['class' => 'form-control' ,'placeholder'=>"product price"]) !!}
                @error('price')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->

          <div class="col-lg-6">
                <div class="form-group">
                {!! Form::label('discount', 'Discount',['class'=>"form-control-label"]) !!}
                {!! Form::text('discount', old('discount'), ['class' => 'form-control' ]) !!}
                @error('discount')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
            {!! Form::label('category_id', 'Category',['class'=>"form-control-label"]) !!}
            {!! Form::select('category_id',['placeholder'=>"Choose Category"] + $categories , old('category_id'), ['class' => 'form-control select2','id'=>"category"]) !!}
            @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
             </div>
          </div>



            <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                 {!! Form::label('sub_category_id', 'Sub Category',['class'=>"form-control-label"]) !!}
                {!! Form::select('sub_category_id',['placeholder'=>"Choose Sub Category"]  , old('sub_category_id'), ['class' => 'form-control select2']) !!}

                  </select>
                </div>
              </div><!-- col-4 -->





         <div class="col-lg-12">
                <div class="form-group">
                {!! Form::label('detail', 'Product Details',['class'=>"form-control-label"]) !!}
                {!! Form::textarea('detail', old('detail'), ['class' => 'form-control' ,'placeholder'=>"product detail" , 'id'=>'ckeditor', ]) !!}
                @error('detail')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->



          <div class="col-lg-4">
        <div class="form-group">
    <label class="form-control-label">Image (Main Image)</label>
      <label class="custom-file">
        {!! Form::file('image', ['class' => 'custom-file-input' ,'id'=>"file" ,'onchange'=>"readURL(this);"]) !!}
         @error('image')<span class="text-danger">{{ $message }}</span>@enderror
         <span class="custom-file-control"></span>
          <img src="" id="one">
         </label>
        </div>
          </div>




          <div class="col-lg-4">
         <div class="form-group mg-b-10-force">
            {!! Form::label('status', 'Status' ,['class'=>"form-control-label" ]) !!}
            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control']) !!}
            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

          </div>

            </div><!-- row -->

  <hr>
  <br><br>

          <div class="row">

        <div class="col-lg-4">
        <label class="ckbox">
    {!! Form::checkbox('features', 1 ) !!}
          <span>Features</span>
        </label>

        </div> <!-- col-4 -->

         <div class="col-lg-4">
        <label class="ckbox">
    {!! Form::checkbox('best_sellers', 1 ) !!}
          <span>Best Sellers</span>
        </label>

        </div> <!-- col-4 -->



         <div class="col-lg-4">
        <label class="ckbox">
    {!! Form::checkbox('on_sale', 1 ) !!}
          <span>On Sale</span>
        </label>

        </div> <!-- col-4 -->


         <div class="col-lg-4">
        <label class="ckbox">
    {!! Form::checkbox('offers', 1 ) !!}
          <span> Offers </span>
        </label>

        </div> <!-- col-4 -->




          </div><!-- end row -->
<br><br>


            <div class="form-layout-footer">
           {!! Form::submit('Submit', ['class' => 'btn btn-info mg-r-5']) !!}
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </div><!-- card -->

            {!! Form::close() !!}




    <!-- ########## END: MAIN PANEL ########## -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>


 <script type="text/javascript">
      $(document).ready(function(){
     $('select[name="category_id"]').on('change',function(){
          var category_id = $(this).val();
          if (category_id) {

            $.ajax({
              url:'/admin/product/subcategory/'+category_id,
              type:'GET',
              dataType:"json",
              success:function(data) {
                  console.log(data);
              var d =$('select[name="sub_category_id"]').empty();
              $.each(data, function(key, value){

              $('select[name="sub_category_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
              });
              },
            });
          }else{
            alert('danger');
          }
            });
      });
 </script>

{{-- load image --}}

<script type="text/javascript">

  function readURL(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#one')
        .attr('src', e.target.result)
        .width(80)
        .height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>


@push('ckeditor')

<script src="{{ asset('admin/lib/texteditor/ckeditor/ckeditor.js') }}"></script>
<script>

CKEDITOR.replace('ckeditor',{filebrowserImageBrowseUrl: '/file-manager/ckeditor' });
</script>
@endpush
@endsection
