@include('admin.layouts.header')

  <body>
    <div id="app">
    <!-- ########## START: LEFT PANEL ########## -->
    @include('admin.layouts.sidebar')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
   @include('admin.layouts.menu')
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->

    @include('admin.layouts.messages')
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        @yield('content')

        <footer class="sl-footer">
            <div class="footer-left">
              <div class="mg-b-2"></div>

            </div>

          </footer>
        </div><!-- sl-mainpanel -->
    </div>
     @include('admin.layouts.footer')

  </body>
</html>
