@extends('admin.app')
@section('content')


<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>PDF Page</h5>
    </div><!-- sl-page-title -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>

        </div>
        <div class="card-body">

            {!! Form::model($model,
            ['action' => ['BackendController\PdfFileController@update',$model->id],
             'method' => 'put',
             'files'=>true ,
            'enctype' =>'multipart/form-data'])
             !!}
            <div class="row">

                <div class="col-10">
                    <div class="form-group">
                        {!! Form::label('pdf', 'Catalogue Pdf File') !!}
                        {!! Form::file('pdf', ['class' => 'form-control']) !!}
                        @error('pdf')<span class="text-danger">{{ $message }}</span>@enderror
                     <br>
                        @if(!empty($model->pdf))
                        <i class="fas fa-file-pdf"></i>
                        <a href="{{ asset('/files/pdf/'.$model->pdf) }}" >{{ $model->pdf }}</a>

                        {!! Form::open(['route'=>['pdf.destroy',$model->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $model->pdf }}" type="submit"><i class="fa fa-trash"></i></button>
                           {!! Form::close() !!}
                        @endif

                    </div>
                </div>

            </div>

            <div class="form-group pt-4">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
