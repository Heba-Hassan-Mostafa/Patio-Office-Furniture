 <!-- ########## START: LEFT PANEL ########## -->
 <div class="sl-logo"><a href="">
     <i class="icon ion-android-star-outline" style="color: #ff9829"></i> <span style="color: #ff9829">P</span>atio</a></div>
 <div class="sl-sideleft">
   <div class="input-group input-group-search">
     {{-- <input type="search" name="search" class="form-control" placeholder="Search"> --}}
     {{-- <span class="input-group-btn">
       <button class="btn"><i class="fa fa-search"></i></button>
     </span><!-- input-group-btn --> --}}
   </div><!-- input-group -->

   <label class="sidebar-label">Navigation</label>
   <div class="sl-sideleft-menu">
     <a href="{{ route('admin.patio') }}" class="sl-menu-link active">
       <div class="sl-menu-item">
         <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
         <span class="menu-item-label">Home</span>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link -->
     {{-- <a href="widgets.html" class="sl-menu-link">
       <div class="sl-menu-item">
         <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
         <span class="menu-item-label">Cards &amp; Widgets</span>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link --> --}}
     <a href="#" class="sl-menu-link">
       <div class="sl-menu-item">
         {{-- <i class="menu-item-icon ion-ios-pie-outline tx-20"></i> --}}
         <img src="{{ asset('frontend/images/chair.png') }}" style="width: 20px;height:20px;">

         <span class="menu-item-label">Products</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link -->
     <ul class="sl-menu-sub nav flex-column">
       <li class="nav-item"><a href="{{ adminurl('product') }}" class="nav-link">Products</a></li>
       <li class="nav-item"><a href="{{ adminurl('category') }}" class="nav-link">Categories</a></li>
       <li class="nav-item"><a href="{{ adminurl('subcategory') }}" class="nav-link">SubCategories</a></li>

    </ul>
    <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-navigate-outline tx-24"></i>
          <span class="menu-item-label">Catalogues</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ adminurl('imgcategory') }}" class="nav-link">Catalogues Category</a></li>
        <li class="nav-item"><a href="{{ adminurl('image') }}" class="nav-link">Catalogues Images</a></li>
        <li class="nav-item"><a href="{{ adminurl('pdf') }}" class="nav-link">Catalogues Pdf File</a></li>

    </ul>

    <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          {{-- <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i> --}}
          <img src="{{ asset('frontend/images/order.png') }}" style="width: 20px;height:20px;">
          <span class="menu-item-label">Orders</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ adminurl('new-order') }}" class="nav-link">New Order</a></li>
        <li class="nav-item"><a href="{{ adminurl('accept/order') }}" class="nav-link"> Accept Payment </a></li>
        <li class="nav-item"><a href="{{ adminurl('cancel/order') }}" class="nav-link"> Cancel Order </a></li>
        <li class="nav-item"><a href="{{ adminurl('delivery/order') }}" class="nav-link"> Delivery Success </a></li>

      </ul>
      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          {{-- <i class="menu-item-icon ion-ios-pie-outline tx-20"></i> --}}
          <img src="{{ asset('frontend/images/brand.png') }}" style="width: 20px;height:20px;">
          <span class="menu-item-label">Client Brands</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ adminurl('brand') }}" class="nav-link">Brands</a></li>
      </ul>
   <a href="#" class="sl-menu-link">
       <div class="sl-menu-item">
         {{-- <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i> --}}
         <img src="{{ asset('frontend/images/blog.png') }}" style="width: 20px;height:20px;">
         <span class="menu-item-label">Blog</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link -->
     <ul class="sl-menu-sub nav flex-column">
       <li class="nav-item"><a href="{{ adminurl('post-category') }}" class="nav-link">Blog Category</a></li>
       <li class="nav-item"><a href="{{ adminurl('post') }}" class="nav-link"> Posts </a></li>
              <li class="nav-item"><a href="{{ adminurl('video') }}" class="nav-link"> Videos </a></li>

     </ul>
       <a href="#" class="sl-menu-link">
       <div class="sl-menu-item">
         {{-- <i class="menu-item-icon ion-ios-pie-outline tx-20"></i> --}}
         <img src="{{ asset('frontend/images/coupon.png') }}" style="width: 20px;height:20px;">
         <span class="menu-item-label">Coupons</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link -->
     <ul class="sl-menu-sub nav flex-column">
       <li class="nav-item"><a href="{{ adminurl('coupon') }}" class="nav-link">Coupons</a></li>
     </ul>
     <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          {{-- <i class="menu-item-icon ion-ios-pie-outline tx-20"></i> --}}
          <img src="{{ asset('frontend/images/group2.png') }}" style="width: 20px;height:20px;">
          <span class="menu-item-label">Clients</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ adminurl('client') }}" class="nav-link">Clients</a></li>
      </ul>
     <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="fa fa-cogs"></i>
          <span class="menu-item-label"> Site Settings</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ adminurl('setting') }}" class="nav-link">Setting</a></li>

     </ul>

      <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
          {{-- <i class="fa fa-cogs"></i> --}}
          <img src="{{ asset('frontend/images/like.png') }}" style="width: 20px;height:20px;">
          <span class="menu-item-label">Site Comments</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
       <li class="nav-item"><a href="{{ adminurl('comments') }}" class="nav-link">Comments</a></li>

     </ul>

     <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
            <img src="{{ asset('frontend/images/contact.png') }}" style="width: 20px;height:20px;">
            <span class="menu-item-label">Contacts Messages</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
       <li class="nav-item"><a href="{{ adminurl('contacts') }}" class="nav-link">Contact Messages</a></li>

     </ul>

     <a href="#" class="sl-menu-link">
        <div class="sl-menu-item">
            <img src="{{ asset('frontend/images/report.png') }}" style="width: 20px;height:20px;">
          <span class="menu-item-label">Reportes</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ adminurl('today/order') }}" class="nav-link"> Today Orders</a></li>
        <li class="nav-item"><a href="{{ adminurl('today/deliver') }}" class="nav-link">Today Delivery</a></li>
        <li class="nav-item"><a href="{{ adminurl('month/order') }}" class="nav-link">This Month</a></li>
        <li class="nav-item"><a href="{{ adminurl('search/report') }}" class="nav-link">Search Report</a></li>

     </ul>

     <a href="#" class="sl-menu-link">
       <div class="sl-menu-item">
        <img src="{{ asset('frontend/images/email.png') }}" style="width: 20px;height:20px;">
        <span class="menu-item-label">NewsLetters</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link -->
     <ul class="sl-menu-sub nav flex-column">
       <li class="nav-item"><a href="{{ adminurl('news') }}" class="nav-link">NewsLetters</a></li>

    </ul>


   </div><!-- sl-sideleft-menu -->

   <br>
 </div><!-- sl-sideleft -->
 <!-- ########## END: LEFT PANEL ########## -->





























































































{{-- <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('admin/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li> --}}

    {{-- <li class="nav-item active">
        <a class="nav-link" href="{{ adminurl('category') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Categories</span></a>
    </li> --}}

    <!-- Divider -->
    {{-- <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Projects</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
<a class="collapse-item" href="{{ adminurl('category') }}"><i class="fas fa-fw fa-tachometer-alt"></i>Categories</a>
<a class="collapse-item" href="{{ adminurl('project') }}"><i class="fas fa-fw fa-tachometer-alt"></i>Projects</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('admin/img/undraw_rocket.svg') }}" alt="">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>

</ul> --}}
