@extends('frontend.home')
@section('header')
<meta name="keywords" content="{{ setting()->keywords }}">
<meta name="description" content="{{ setting()->description }}">
<meta name="author" content="{{ setting()->siteName }}">
@endsection
@section('content')
<div class="head-product-page">
    <div class="overlay">
      <h1 class="title-sub-pages">{{ $title }}</h1>
    </div><img src="{{ asset("frontend/images/back-sub.jpg") }}" alt="{{ $title }}" title="{{ $title }}">
  </div>
  <!-- start contact us content-->
  <div class="contact-us">
    <div class="container">
      <div class="row">
        <div class="contacts col-md-6">
          <h2 class="text-left m-0 p-0">Contacts</h2>
          <div class="contact-details"><i class="fas fa-map-marker-alt"></i><span>{{ setting()->address }}</span></div>
          <div class="contact-details"><i class="fas fa-phone-alt"></i><span>{{ setting()->phone_one }}</span></div>
          <div class="contact-details"><i class="fas fa-phone-alt"></i><span>{{ setting()->phone_two }}</span></div>
          <div class="contact-details"><i class="fas fa-envelope"></i><span>{{ setting()->gmail }}</span></div>
        </div>
        <div class="contact-keep-intouch col-md-6">
          <h6>Keep In Touch</h6>
          {!! Form::open(
            [
            'action'=>'FrontendController\IndexController@contact' ,
            'method' =>'post',
            ])
             !!}
            {!! Form::text('name',old('name') ,['class'=>'form-control','placeholder'=>'Name']) !!}
            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            {!! Form::email('email',old('email') ,['class'=>'form-control','placeholder'=>'E-mail']) !!}
             @error('email')<span class="text-danger">{{ $message }}</span>@enderror
             {!! Form::textarea('message',old('message') ,['class'=>'form-control','placeholder'=>'Message']) !!}
             @error('message')<span class="text-danger">{{ $message }}</span>@enderror
             {!! Form::submit('Send',['class'=>"btn btn-success"]) !!}
          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
  <div class="patio-location">
    <iframe rel='nofollow' src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3452.9746895231947!2d31.34900561511562!3d30.066259981874484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583ffdf498e59b%3A0xe054a78a57778c!2sPatio%20Office%20Furniture!5e0!3m2!1sen!2ssa!4v1619989899603!5m2!1sen!2ssa" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>

@endsection
