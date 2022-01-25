<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="twitter:card" content="summary">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="max-age=0">  

    @yield('header')
    @yield('blog')
    @include('feed::links')
    <link rel="canonical" href="https://www.patio-egypt.com">
    <link rel="stylesheet" href="{{ asset("frontend/lib/bootstrap-4.3.1/dist/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/css/nav-login.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/css/brand-style.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/css/offer-style.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/css/product-modal.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/css/scroll.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/lib/lightbox.min.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <link rel="icon" href="{{ asset('/files/setting/'.setting()->icon) }}" />
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MPTP15ME3E"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-MPTP15ME3E');
    </script>


    <title>Patio Office Furniture</title>
  </head>
