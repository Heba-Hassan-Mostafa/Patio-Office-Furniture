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
    </div><img src="{{ asset("frontend/images/room.jpg") }}" style="height:400px" alt="patio iamge">
  </div>
  <!-- start about us content-->
  <div class="about-us">
    <div class="container">
      <p>
       {!! setting()->about_patio !!}
      </p>
    </div>
  </div>
@endsection
