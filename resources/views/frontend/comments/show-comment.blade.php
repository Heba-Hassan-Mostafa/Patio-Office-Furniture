@extends('frontend.home')

<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="{{ setting()->siteName }}">

@section('content')
<div class="head-product-page">
    <div class="overlay">
      <h1 class="title-sub-pages">{{ $title }}</h1>
    </div><img src="{{ asset('frontend/images/back-sub.jpg') }}" alt="{{ $title }}" title="{{ $title }}">
  </div>
  <!-- start all comments page-->
  <div class="Clints" style="padding-top:30px">
    <div class="container">
      <button class="btn btn-success add-comment-link">
          <a class="btn-rounded mb-4" href="" data-toggle="modal" data-target="#modalContactForm" title="Add Comment">Add Comment</a></button>
      <div class="row">
          @if ($comments)
          @foreach ($comments as $comment )
        <div class="comment-box col-md-5">
          <h6>From :<span> {{ $comment->name }}</span></h6>
          <hr>
          <p>
             {{$comment->comment}}
          </p>
        </div>
        @endforeach

        @endif

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
@endsection
