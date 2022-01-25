@extends('admin.app')

@section('content')

 <!-- ########## START: MAIN PANEL ########## -->

      <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Images Section</span>
      </nav>

      <div class="sl-pagebody">


 <div class="card pd-20 pd-sm-40">


            <h6 class="card-body-title">{{ $title }}</h6>
            <div class="ml-auto">
                <a href="{{ adminurl('image') }}" class="btn btn-primary btn-sm pull-right">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Images </span>
                </a>
            </div>


           {!! Form::open(
            ['action' => 'BackendController\CatalogueController@store',
             'method' => 'post',
              'files'=>true ,
              'enctype' =>'multipart/form-data'
                ])
             !!}

          <div class="form-layout">
            <div class="row mg-b-25">



                <div class="col-lg-4">
                    <div class="form-group">
                    {!! Form::label('title', 'Catalogue Title ',['class'=>"form-control-label"]) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control' ,'placeholder'=>"Enter Catalogue Title "]) !!}
                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                  </div><!-- col-4 -->

              <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
            {!! Form::label('image_category_id', 'Category',['class'=>"form-control-label"]) !!}
            {!! Form::select('image_category_id',['placeholder'=>"Choose Image Category"] + $categories , old('image_category_id'), ['class' => 'form-control select2']) !!}
            @error('image_category_id')<span class="text-danger">{{ $message }}</span>@enderror
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
    <label class="form-control-label">Image</label><br>
        {!! Form::file('images[]', ['class' => 'custom-file-input' ,'id'=>"img" , 'multiple'=>'multiple']) !!}
         @error('images')<span class="text-danger">{{ $message }}</span>@enderror


        </div>
          </div>



          </div>

            </div><!-- row -->


            <div class="form-layout-footer">
           {!! Form::submit('Submit', ['class' => 'btn btn-info mg-r-5']) !!}
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </div><!-- card -->

            {!! Form::close() !!}




    <!-- ########## END: MAIN PANEL ########## -->






@push('fileinput')

<script>
     $(function () {

        $('#img').fileinput({
                theme: "fa",
                maxFileCount: 20,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });
</script>
@endpush

@endsection
