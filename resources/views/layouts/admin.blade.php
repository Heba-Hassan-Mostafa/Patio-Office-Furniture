<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
 <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}- Login</title>

    <!-- vendor css -->
    <link href="{{ asset("admin/lib/font-awesome/css/font-awesome.css") }}" rel="stylesheet">
    <link href="{{ asset("admin/lib/Ionicons/css/ionicons.css") }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset("admin/css/starlight.css") }}">
  </head>


<body>

    <div  id="app">

        @yield('content')
    </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset("admin/lib/jquery/jquery.js") }}"></script>
        <script src="{{ asset("admin/lib/popper.js/popper.js") }}"></script>
        <script src="{{ asset("admin/lib/bootstrap/bootstrap.js")}}"></script>
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type)
    {
        case 'info':
        toastr.info("{{ Session::get('message') }}")
        break;

        case 'success':
        toastr.success("{{ Session::get('message') }}")
        break;

        case 'warning':
        toastr.warning("{{ Session::get('message') }}")
        break;

        case 'error':
        toastr.error("{{ Session::get('message') }}")
        break;

    }
    @endif
    </script>

</body>

</html>
