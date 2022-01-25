@extends('admin.app')

@section('content')

 <!-- ########## START: MAIN PANEL ########## -->

      <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Post Section</span>
      </nav>

      <div class="sl-pagebody">


 <div class="card pd-20 pd-sm-40">


            <h6 class="card-body-title">{{ $title }}</h6>
            <div class="ml-auto">
                <a href="{{ adminurl('post') }}" class="btn btn-primary btn-sm pull-right">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Posts</span>
                </a>
            </div>


           {!! Form::open(
            ['action' => 'BackendController\PostController@store',
             'method' => 'post',
              'files'=>true ,
              'enctype' =>'multipart/form-data'
                ])
             !!}

          <div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-6">
                <div class="form-group">
                {!! Form::label('title', 'Post Title ',['class'=>"form-control-label"]) !!}
                {!! Form::text('title', old('title'), ['class' => 'form-control' ,'placeholder'=>"Enter Post Title "]) !!}
                @error('title')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->



              <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
            {!! Form::label('post_category_id', 'Category',['class'=>"form-control-label"]) !!}
            {!! Form::select('post_category_id',['placeholder'=>"Choose Post Category"] + $categories , old('Post_category_id'), ['class' => 'form-control select2']) !!}
            @error('post_category_id')<span class="text-danger">{{ $message }}</span>@enderror
             </div>
          </div>


                 <div class="col-lg-12">
                <div class="form-group">
                {!! Form::label('content', 'Post Content ',['class'=>"form-control-label"]) !!}
                {!! Form::textarea('content', old('content'), ['class' => 'form-control' ,'placeholder'=>"Post Content" ,'id'=>'ckeditor' ]) !!}
                @error('content')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->



          <div class="col-lg-4">
        <div class="form-group">
    <label class="form-control-label">Post Image</label><br>
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

            <div class="col-lg-12">
                <div class="form-group">
                {!! Form::label('keywords', 'Post keywords ',['class'=>"form-control-label"]) !!}
                {!! Form::text('keywords', old('keywords'), ['class' => 'form-control' ,'placeholder'=>"Enter Post Keywords "]) !!}
                @error('keywords')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->


              <div class="col-lg-12">
                <div class="form-group">
                {!! Form::label('description', 'Post description ',['class'=>"form-control-label"]) !!}
                {!! Form::textarea('description', old('description'), ['class' => 'form-control'  ]) !!}
                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->

          </div>

            </div><!-- row -->

         
            <div class="form-layout-footer">
           {!! Form::submit('Submit', ['class' => 'btn btn-info mg-r-5']) !!}
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </div><!-- card -->

            {!! Form::close() !!}




    <!-- ########## END: MAIN PANEL ########## -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>



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
