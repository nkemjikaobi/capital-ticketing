<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>@yield('title')</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
  <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{ asset('dashboard/assets/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('dashboard/assets/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
  <link href="{{ asset('dashboard/assets/plugins/flag-icons/css/flag-icon.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('dashboard/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
  <link href="{{ asset('dashboard/assets/plugins/ladda/ladda.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('dashboard/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('dashboard/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />

  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="{{ asset('dashboard/assets/css/sleek.css') }}" />

  <!--FONT AWESOME-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- FAVICON -->
  <link href="{{ asset('dashboard/assets/img/favicon.png') }}" rel="shortcut icon" />

  <script src="{{ asset('dashboard/assets/plugins/nprogress/nprogress.js') }}"></script>
</head>


  <body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">

              <!--
          ====================================
          ????????? LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="/">
                <svg
                  class="brand-icon"
                  xmlns="http://www.w3.org/2000/svg"
                  preserveAspectRatio="xMidYMid"
                  width="30"
                  height="33"
                  viewBox="0 0 30 33"
                >
                  <g fill="none" fill-rule="evenodd">
                    <path
                      class="logo-fill-blu"
                      {{-- fill="#7DBCFF" --}}
                      fill="#855438"
                      d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                    />
                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                  </g>
                </svg>
                <span class="brand-name">Capital Ticketing</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">

              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">

                  <li  class="has-sub expand {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" >
                    <a class="sidenav-item-link" href="{{ route('home') }}"
                      aria-expanded="false" aria-controls="dashboard">
                      <i class="mdi mdi-view-dashboard-outline"></i>
                      <span class="nav-text {{ Route::currentRouteName() == 'home' ? 'active-span' : '' }}">Dashboard</span>
                    </a>
                  </li>

                  <li  class="has-sub {{ Route::currentRouteName() == 'fund_wallet' ? 'active' : '' }}" >
                    <a class="sidenav-item-link" href="{{ route('fund_wallet') }}"
                      aria-expanded="false" aria-controls="ui-elements">
                      <i class="mdi mdi-wallet"></i>
                      <span class="nav-text {{ Route::currentRouteName() == 'fund_wallet' ? 'active-span' : '' }}">Fund Wallet</span>
                    </a>
                  </li>
                  <li  class="has-sub {{ Route::currentRouteName() == 'buy_tickets' ? 'active' : '' }}" >
                    <a class="sidenav-item-link" href="{{ route('buy_tickets') }}"
                      aria-expanded="false" aria-controls="ui-elements">
                      {{-- <i class="mdi mdi-credit-card"></i> --}}
                      <i class="fas fa-futbol"></i>
                      <span class="nav-text {{ Route::currentRouteName() == 'buy_tickets' ? 'active-span' : '' }}">Buy Tickets</span>
                    </a>
                  </li>
                 
                  <li  class="has-sub {{ Route::currentRouteName() == 'deposits' ? 'active' : '' }}" >
                    <a class="sidenav-item-link" href="{{ route('deposits') }}"
                      aria-expanded="false" aria-controls="charts">
                      <i class="fab fa-bitcoin"></i>
                      <span class="nav-text {{ Route::currentRouteName() == 'deposits' ? 'active-span' : '' }}">Deposits</span>
                    </a>
                  </li>

                  <li  class="has-sub {{ Route::currentRouteName() == 'withdraw' ? 'active' : '' }}" >
                    <a class="sidenav-item-link" href="{{ route('withdraw') }}"
                      aria-expanded="false" aria-controls="pages">
                      <i class="far fa-credit-card"></i>
                      <span class="nav-text {{ Route::currentRouteName() == 'withdraw' ? 'active-span' : '' }}">Withdraw Funds</span>
                    </a>
                  </li>

                  <li  class="has-sub {{ Route::currentRouteName() == 'withdrawals' ? 'active' : '' }}" >
                    <a class="sidenav-item-link" href="{{ route('withdrawals') }}"
                      aria-expanded="false" aria-controls="pages">
                      <i class="far fa-credit-card"></i>
                      <span class="nav-text {{ Route::currentRouteName() == 'withdrawals' ? 'active-span' : '' }}">Withdrawals</span>
                    </a>
                  </li>

                  <li  class="has-sub {{ Route::currentRouteName() == 'view_tickets' ? 'active' : '' }}" >
                    <a class="sidenav-item-link" href="{{ route('view_tickets') }}"
                      aria-expanded="false" aria-controls="pages">
                      <i class="fas fa-ticket-alt"></i>
                      <span class="nav-text {{ Route::currentRouteName() == 'view_tickets' ? 'active-span' : '' }}">View Tickets</span>
                    </a>
                  </li>

                  <li  class="has-sub {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" >
                    <a class="sidenav-item-link" href="{{ route('profile') }}"
                      aria-expanded="false" aria-controls="documentation">
                      <i class="mdi mdi-account"></i>
                      <span class="nav-text {{ Route::currentRouteName() == 'profile' ? 'active-span' : '' }}">Profile</span>
                    </a>
                  </li>

                  <!---Show if admin-->
                  @if (auth()->user()->account_type == 2)
                     <li  class="has-sub {{ Route::currentRouteName() == 'transfer_funds' ? 'active' : '' }}" >
                    <a class="sidenav-item-link" href="{{ route('transfer_funds') }}"
                      aria-expanded="false" aria-controls="documentation">
                      <i class="mdi mdi-account"></i>
                      <span class="nav-text {{ Route::currentRouteName() == 'transfer_funds' ? 'active-span' : '' }}">Transfer Funds</span>
                    </a>
                  </li>
                  @endif

                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="{{ route('logout') }}"
                      aria-expanded="false" aria-controls="documentation"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="mdi mdi-logout"></i>
                      <span class="nav-text">Log Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </li>

              </ul>

            </div>

            <hr class="separator" />
          </div>
        </aside>



      <div class="page-wrapper">
                  <!-- Header -->
          <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <!-- search form -->
              <div class="search-form d-none d-lg-inline-block">

                <div id="search-results-container">
                  <ul id="search-results"></ul>
                </div>

              </div>

              <div class="navbar-right ">
                <ul class="nav navbar-nav">

                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                      <span class="d-none d-lg-inline-block">{{auth()->user()->firstname}}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li>
                        <a href="{{ route('profile') }}">
                          <i class="mdi mdi-account"></i> My Profile
                        </a>
                      </li>
                       <li  class="has-sub" >
                          <a class="sidenav-item-link" href="{{ route('logout') }}"
                            aria-expanded="false" aria-controls="documentation"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout"></i>
                            <span class="nav-text">Log Out</span>
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                          </form>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>


          </header>


        <div class="content-wrapper">
          <div class="content">
            @include('inc.messages')
            @yield('content')

          </div>
        </div>

          <footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>
                &copy; <span id="copy-year"></span> Copyright Capital Ticketing
              </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
          </footer>

      </div>
    </div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script>
<script src="{{ asset('dashboard/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/toaster/toastr.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/charts/Chart.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/ladda/ladda.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/jquery-mask-input/jquery.mask.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/jekyll-search.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/sleek.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/chart.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/date-range.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/map.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/custom.js') }}"></script>

  </body>
</html>
