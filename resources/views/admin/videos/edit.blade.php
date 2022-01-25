@extends('admin.app')

@section('content')

 <!-- ########## START: MAIN PANEL ########## -->

      <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Videos Section</span>
      </nav>

      <div class="sl-pagebody">


 <div class="card pd-20 pd-sm-40">


            <h6 class="card-body-title">{{ $title }}</h6>
            <div class="ml-auto">
                <a href="{{ adminurl('video') }}" class="btn btn-primary btn-sm pull-right">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Videos</span>
                </a>
            </div>


           {!! Form::model($model,
            ['action' => ['BackendController\VideoController@update',$model->id],
             'method' => 'put',
              'files'=>true ,
              'enctype' =>'multipart/form-data'
                ])
             !!}

          <div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-8">
                <div class="form-group">
                {!! Form::label('video_name', 'Video Name',['class'=>"form-control-label"]) !!}
                {!! Form::text('video_name', old('video_name',$model->video_name), ['class' => 'form-control' ,'placeholder'=>" Video Name"]) !!}
                @error('video_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
              </div><!-- col-4 -->



          <div class="col-lg-8">
         <div class="form-group mg-b-10-force">
            {!! Form::label('status', 'Status' ,['class'=>"form-control-label" ]) !!}
            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status',$model->status), ['class' => 'form-control']) !!}
            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-lg-8">
                <div class="form-group">
                {!! Form::label('video_link', 'Video link',['class'=>"form-control-label"]) !!}
                {!! Form::url('video_link', old('video_link',$model->video_link), ['class' => 'form-control' ,'placeholder'=>" Video link"]) !!}
                @error('video_link')<span class="text-danger">{{ $message }}</span>@enderror

                <br>
                @php
                $url = getYoutubeId($model->video_link)

                @endphp
                @if($url)

                <iframe width="350" height="200"  src="https://www.youtube.com/embed/{{ $url }}" frameborder="0"  allowfullscreen>
                </iframe>

                @endif
            </div>
              </div><!-- col-4 -->

          </div>

            </div><!-- row -->

  <br><br>



            <div class="form-layout-footer">
           {!! Form::submit('Submit', ['class' => 'btn btn-info mg-r-5']) !!}
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </div><!-- card -->

            {!! Form::close() !!}




    <!-- ########## END: MAIN PANEL ########## -->



@endsection

