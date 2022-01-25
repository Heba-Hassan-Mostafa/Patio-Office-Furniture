<footer>
    <div class="footer-content container">
      <div class="row">
        <div class="col-md-4 footer-logo">
            @if (!empty(setting()->logo))
            <img class="img-fluid" src="{{ asset("files/setting/".setting()->logo) }}" alt="{{ setting()->siteName }}" title="{{ setting()->siteName }}">

            @endif
          <h3>Level Up Your WorkSpace</h3>
        </div>
        <div class="col-md-4 services">
          <h6>Services</h6>
          <div class="row">
            <div class="col-md-5"><a href="{{ url('/') }}" title="Home">Home</a>
                <a href="{{ url('about-patio') }}" title="Patio">Patio</a>
                <a href="{{ url('catalogue') }}" title="Catalogues">Catalogues</a></div>
            <div class="col-md-5"><a href="{{ url('all-products') }}" title="Products">Products</a>
                <a href="{{ url('comments') }}" title="Comments">Comments</a>
                <a href="{{ url('blog/post') }}" title="Blog">Blog</a></div>
          </div>
        </div>
        <div class="col-md-4 contacts">
          <h6>Contacts</h6>
          <div class="contact-details"><i class="fas fa-map-marker-alt"></i><span>{{ setting()->address }}</span></div>
          <div class="contact-details"><i class="fas fa-phone-alt"></i><span>{{ setting()->phone_one }}</span></div>
          <div class="contact-details"><i class="fas fa-phone-alt"></i><span>{{ setting()->phone_two }}</span></div>
          <div class="contact-details"><i class="fas fa-envelope"></i><span>{{ setting()->gmail }}</span></div>
        </div>
      </div>
    </div>
    <hr class="linefooter">
    <div class="copyright container">
      <div class="row">
        <div class="col-md-6 copy-right-style">Copyright © 2021 <span>Patio</span> Office Furniture</div>
        <div class="col-md-6 powered-by">Powered By 
        <span><a href="https://www.linkedin.com/in/mohammed-a-ghanem">Mohammed Ghanem</a></span>
        & 
        <span> <a href="https://www.linkedin.com/in/heba-hassan-mostafa">Heba Hassan</a></span>
        </div>
      </div>
    </div>
  </footer>
  <div class="scrollup"><i class="fas fa-chevron-up"></i></div>
  <div itemscope="" itemtype="http://schema.org/Movie"></div>
  <!--script files-->
  <script src="{{ asset("frontend/lib/jquery-3.4.1.min.js") }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="{{ asset("frontend/lib/bootstrap-4.3.1/dist/js/bootstrap.min.js") }}"></script>
  <script src="{{ asset("frontend/lib/kitfontawsome.js") }}"></script>
  <script src="{{ asset("frontend/lib/lightbox-plus-jquery.min.js") }}"></script>
  <script src="{{ asset("frontend/js/nav-login.js") }}"></script>
  <script src="{{ asset("frontend/js/offer.js") }}"></script>
  <script src="{{ asset("frontend/js/quantity.js") }}"></script>
  <script src="{{ asset("frontend/js/brand-control.js") }}"></script>
  <script src="{{ asset("frontend/js/brand-slide.js") }}"></script>
  <script src="{{ asset("frontend/js/scroll.js") }}"></script>

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
    
    <script>
      (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0],
          a.async = 1,
          a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

      ga('create', 'G-MPTP15ME3E', 'auto');
      ga('send', 'pageview');
    </script>
    
    
    
    <!--<script data-cfasync="false" src="/javascript.js"></script>-->
    