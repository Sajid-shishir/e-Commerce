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
    <meta name='csrf-token' content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')

    </title>

    <!-- vendor css -->
    <link href="{{ asset('dashboard_assets/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_assets/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_assets/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/starlight.css') }}">
  </head>

  <body>
    <!-- ########## START: LEFT PANEL ########## -->
    @if (Auth::user()->role == 1)
    <div class="sl-logo"><a href=""><i class="fa fa-graduation-cap"></i> Admin Panel</a></div>
    @else
    <div class="sl-logo"><a href=""><i class="fa fa-user"></i> Customer Home</a></div>
    @endif
    <div class="sl-sideleft">
      {{-- <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group --> --}}

      <h1><label href="" class="sidebar-label text-dark">Admin Dashboard</label></h1>


      <div class="sl-sideleft-menu">
          @if (Auth::user()->role == 1)
        <a href="{{ url('/home') }}" class="sl-menu-link @yield('home') @yield('edit_profile')">
            <div class="sl-menu-item">
              <i class="fa fa-tachometer tx-22"></i>
              <span class="menu-item-label">Home Page</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
               <ul class="sl-menu-sub nav flex-column">
                  <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Dashboard</a></li>
                  <li class="nav-item"><a href="{{route('edit_profile')}}" class="nav-link">Edit Profile</a></li>
              </ul>

              <h1><label href="" class="sidebar-label text-dark"> Categories</label></h1>
              <a href="{{ route('category.index') }}" class="sl-menu-link @yield('add_category')">
                <div class="sl-menu-item">
                  <i class="fa fa-list-alt tx-22"></i>
                  <span class="menu-item-label">Category</span>
                  <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
              </a><!-- sl-menu-link -->
                   <ul class="sl-menu-sub nav flex-column">
                      <li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link">Add Category</a></li>
                  </ul>

                  <h1><label href="" class="sidebar-label text-dark">Products and coupons</label></h1>

                  <a href="{{ route('product.index') }}" class="sl-menu-link @yield('add_product') @yield('add_coupon')">
                    <div class="sl-menu-item">
                      <i class="fa fa-product-hunt tx-22"></i>
                      <span class="menu-item-label">Product</span>
                      <i class="menu-item-arrow fa fa-angle-down"></i>
                    </div><!-- menu-item -->
                  </a><!-- sl-menu-link -->
                       <ul class="sl-menu-sub nav flex-column">
                          <li class="nav-item"><a href="{{ route('product.index') }}" class="nav-link">Add Product</a></li>
                          <li class="nav-item"><a href="{{ route('coupon.index') }}" class="nav-link">Add Coupon</a></li>
                      </ul>

        {{-- <a href="{{ url('/home') }}" class="sl-menu-link @yield('home')" >
          <div class="sl-menu-item">
            <i class="fa fa-tachometer"></i>
            <span class="menu-item-label">Admin Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link --> --}}
        {{-- <a href="{{route('edit_profile')}}" class="sl-menu-link @yield('edit_profile')" >
          <div class="sl-menu-item">
            <i class="fa fa-pencil-square-o"></i>
            <span class="menu-item-label">Edit Profile</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link --> --}}

        {{-- <a href={{ route('category.index') }} class="sl-menu-link @yield('add_category')">
          <div class="sl-menu-item">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
            <span class="menu-item-label">Category</span>
          </div><!-- menu-item -->
        </a> --}}

        {{-- <a href="{{ route('product.index') }}" class="sl-menu-link @yield('add_product')">
          <div class="sl-menu-item">
            <i class="fa fa-product-hunt"></i>
            <span class="menu-item-label">Product</span>
          </div><!-- menu-item -->
        </a> --}}
        {{-- <a href="{{ route('coupon.index') }}" class="sl-menu-link @yield('add_coupon')">
          <div class="sl-menu-item">
            <i class="fa fa-gift"></i>
            <span class="menu-item-label">Coupon</span>
          </div><!-- menu-item -->
        </a> --}}
        {{-- <a href="{{ route('faq_post') }}" class="sl-menu-link @yield('faq')">
            <div class="sl-menu-item">
              <i class="fa fa-quora"></i>
              <span class="menu-item-label">FAQ</span>
            </div><!-- menu-item -->
          </a> --}}
          <h1><label href="" class="sidebar-label text-dark">Question n answers</label></h1>

          <a href="{{ route('faq_post') }}" class="sl-menu-link @yield('faq')">
            <div class="sl-menu-item">
              <i class="fa fa-quora tx-22"></i>
              <span class="menu-item-label">FAQ</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
               <ul class="sl-menu-sub nav flex-column">
                  <li class="nav-item"><a href="{{ route('faq_post') }}" class="nav-link">FAQ</a></li>
              </ul>

              <h1><label href="" class="sidebar-label text-dark">Blog posting</label></h1>

          <a href="{{ route('blog_post') }}" class="sl-menu-link @yield('blog')">
            <div class="sl-menu-item">
              <i class="fa fa-text-width"></i>
              <span class="menu-item-label">Blog</span>
            </div><!-- menu-item -->
          </a>

          <h1><label href="" class="sidebar-label text-dark">Roles and permissions</label></h1>

        <a href="{{ route('manage.role') }}" class="sl-menu-link @yield('manage_role')">
            <div class="sl-menu-item">
              <i class="fa fa-lock"></i>
              <span class="menu-item-label">Manage Role</span>
            </div><!-- menu-item -->
          </a>

          {{-- <a href="{{ route('report') }}" class="sl-menu-link @yield('report')">
            <div class="sl-menu-item">
              <i class="fa fa-server"></i>
              <span class="menu-item-label">Report</span>
            </div><!-- menu-item -->
          </a> --}}
          <h1><label href="" class="sidebar-label text-dark">Generate report</label></h1>

          <a href="{{ route('report') }}" class="sl-menu-link @yield('report')">
            <div class="sl-menu-item">
              <i class="fa fa-server tx-22"></i>
              <span class="menu-item-label"> Report</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
               <ul class="sl-menu-sub nav flex-column">
                  <li class="nav-item"><a href="{{ route('report') }}" class="nav-link">Report</a></li>
              </ul>

             <h1><label href="" class="sidebar-label text-dark">Messenger</label></h1>

          <a href="{{ route('chat') }}" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="fa fa-comments-o"></i>
              <span class="menu-item-label">Live Chat</span>
            </div><!-- menu-item -->
          </a>

        @else
        <a href="{{ url('/') }}" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="fa fa-shopping-cart"></i>
            <span class="menu-item-label">Shop</span>
          </div><!-- menu-item -->
        </a>
        <a href="{{ url('home/customer') }}" class="sl-menu-link @yield('home')" >
          <div class="sl-menu-item">
            <i class="fa fa-tachometer"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="{{ route('chat') }}" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="fa fa-comments-o"></i>
              <span class="menu-item-label">Live Chat</span>
            </div><!-- menu-item -->
          </a>

        @endif
        {{-- <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
            <span class="menu-item-label">Reserved</span>
          </div><!-- menu-item -->
        </a> --}}


        {{-- <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Reserved dropdown</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
             <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link">Blank Page</a></li>
            </ul> --}}

      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile fa fa-user" data-toggle="dropdown">
              <span class=" "><span class="logged-name badge badge-light ">{{ Auth::user()->name }}</span></span>
              {{-- <img src="{{asset('dashboard_assets/img/img3.jpg')}}" class="wd-32 rounded-circle" alt=""> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href="{{route('edit_profile')}}"><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="icon ion-power"></i> Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
          {{-- <a id="btnRightMenu" href="" class="pos-relative">
            <i class="icon ion-ios-bell-outline"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger"></span>
            <!-- end: if statement -->
          </a> --}}
        </div><!-- navicon-right -->
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications</a>
        </li>
      </ul><!-- sidebar-tabs -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

        @yield('breadcrumb')
      <div class="sl-pagebody">
        <div class="sl-page-title">
          @yield('content')
        </div><!-- sl-page-title -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{ asset('dashboard_assets/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard_assets/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('dashboard_assets/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard_assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>

    <script src="{{ asset('dashboard_assets/js/starlight.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" integrity="sha512-HCG6Vbdg4S+6MkKlMJAm5EHJDeTZskUdUMTb8zNcUKoYNDteUQ0Zig30fvD9IXnRv7Y0X4/grKCnNoQ21nF2Qw==" crossorigin="anonymous"></script>

  </body>
</html>


