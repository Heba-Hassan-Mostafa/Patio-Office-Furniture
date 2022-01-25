@extends('admin.app')

@section('content')

@php
$subcategory = DB::table('sub_categories')->get();
@endphp

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


           {!! Form::model($model,
            ['action' => ['BackendController\ProductController@update',$model->id],
             'method' => 'put',
              'files'=>true ,
              'enctype' =>'multipart/form-data'
                ])
             !!}

          <div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-6">
                <div class="form-group">
                {!! Form::label('product_name', 'Product Name',['class'=>"form-control-label"]) !!}
                {!! Form::text('product_name', old('product_name',$model->product_name), ['class' => 'form-control' ]) !!}
                @error('product_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->


              <div class="col-lg-6">
                <div class="form-group">
                {!! Form::label('product_code', 'Product Code',['class'=>"form-control-label"]) !!}
                {!! Form::text('product_code', old('product_code',$model->product_code), ['class' => 'form-control' ]) !!}
                @error('product_code')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->


              <div class="col-lg-4">
                <div class="form-group">
                {!! Form::label('price', 'Price',['class'=>"form-control-label"]) !!}
                {!! Form::text('price', old('price',$model->price), ['class' => 'form-control' ]) !!}
                @error('price')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->



               <div class="col-lg-6">
                <div class="form-group">
                {!! Form::label('discount', 'Discount',['class'=>"form-control-label"]) !!}
                {!! Form::text('discount', old('discount',$model->discount), ['class' => 'form-control' ]) !!}
                @error('discount')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
            {!! Form::label('category_id', 'Category',['class'=>"form-control-label"]) !!}
            {!! Form::select('category_id',['placeholder'=>"Choose Category"] + $categories , old('category_id', $model->category_id), ['class' => 'form-control select2','id'=>"category"]) !!}
            @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
             </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
                {!! Form::label('sub_category_id', 'Sub Category',['class'=>"form-control-label"]) !!}
               <select class="form-control select2"  name="sub_category_id">
                 @foreach($subcategory as $row)
                <option value="{{ $row->id }}" <?php if ($row->id === $model->sub_category_id) {
                 echo "selected"; } ?> > {{ optional($model->sub_category)->name }}</option>
                @endforeach

              </select>
            </div>
          </div><!-- col-4 -->




         <div class="col-lg-12">
                <div class="form-group">
                {!! Form::label('detail', 'Product Details',['class'=>"form-control-label"]) !!}
                {!! Form::textarea('detail', old('detail', $model->detail), ['class' => 'form-control' , 'id'=>'ckeditor', ]) !!}
                @error('detail')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->





          <div class="col-lg-4">
         <div class="form-group mg-b-10-force">
            {!! Form::label('status', 'Status' ,['class'=>"form-control-label" ]) !!}
            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status',$model->status), ['class' => 'form-control']) !!}
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
    <input type="checkbox" name="features" value="1" <?php if ($model->features == 1) { echo "checked"; } ?> >
          <span>Features</span>
        </label>

        </div> <!-- col-4 -->

         <div class="col-lg-4">
        <label class="ckbox">
           <input type="checkbox" name="best_sellers" value="1" <?php if ($model->best_sellers == 1) { echo "checked"; } ?> >

          <span>Best Sellers</span>
        </label>

        </div> <!-- col-4 -->



         <div class="col-lg-4">
        <label class="ckbox">
           <input type="checkbox" name="on_sale" value="1" <?php if ($model->on_sale == 1) { echo "checked"; } ?> >

          <span>On Sale</span>
        </label>

        </div> <!-- col-4 -->


         <div class="col-lg-4">
        <label class="ckbox">
           <input type="checkbox" name="offers" value="1" <?php if ($model->offers == 1) { echo "checked"; } ?> >

          <span>Offers</span>
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

            <div class="sl-pagebody">

                <div class="card pd-20 pd-sm-40">
                         <h6 class="card-body-title">Update Images  </h6>

                         {!! Form::model($model,
                           ['action' => ['BackendController\ProductController@updateImage',$model->id],
                            'method' => 'put',
                             'files'=>true ,
                             'enctype' =>'multipart/form-data'
                               ])
                            !!}

                           <div class="row">

                       <div class="col-lg-6 col-sm-6">
                   <label class="form-control-label">Image ( Main Image)</label><br>
                     <label class="custom-file">
                       {!! Form::file('image', ['class' => 'custom-file-input' ,'id'=>"file" ,'onchange'=>"readURL(this);"]) !!}
                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        <span class="custom-file-control"></span>
                        <input type="hidden" name="old_image" value="{{ $model->image }}">
                         <img src="" id="one">
                        </label>

                       </div>

                       <div class="col-lg-6 col-sm-6">
                          @if(!empty($model->image))
                 <img src="{{ asset('/files/products/'.$model->image) }}" style="width: 80px; height: 80px;">

                      @endif
                                </div>

                         </div><!-- col-4 -->


                          {!! Form::submit('Update Image', ['class' => 'btn btn-warning mg-r-5']) !!}

                         {!! Form::close() !!}
                         </div>
                         </div>



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
