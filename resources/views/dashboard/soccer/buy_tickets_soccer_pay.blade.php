
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Buy Tickets Soccer</title>

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
——— LEFT SIDEBAR WITH FOOTER
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
                                class="logo-fill-blue"
                                fill="#7DBCFF"
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



                    <li  class="has-sub active expand" >
                        <a class="sidenav-item-link" href="{{ route('home') }}"
                           aria-expanded="false" aria-controls="dashboard">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="{{ route('fund_wallet') }}"
                           aria-expanded="false" aria-controls="ui-elements">
                            <i class="mdi mdi-wallet"></i>
                            <span class="nav-text">Fund Wallet</span>
                        </a>
                    </li>
                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="{{ route('buy_tickets') }}"
                           aria-expanded="false" aria-controls="ui-elements">
                            <i class="mdi mdi-credit-card"></i>
                            <span class="nav-text">Buy Tickets</span>
                        </a>
                    </li>
                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="{{ route('sell_tickets') }}"
                           aria-expanded="false" aria-controls="ui-elements">
                            <i class="mdi mdi-credit-card"></i>
                            <span class="nav-text">Sell Tickets</span>
                        </a>
                    </li>

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="{{ route('deposits') }}"
                           aria-expanded="false" aria-controls="charts">
                            <i class="mdi mdi-currency-btc"></i>
                            <span class="nav-text">Deposits</span>
                        </a>
                    </li>

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="{{ route('withdrawals') }}"
                           aria-expanded="false" aria-controls="pages">
                            <i class="mdi mdi-currency-usd"></i>
                            <span class="nav-text">Withdrawals</span>
                        </a>
                    </li>

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="{{ route('view_tickets') }}"
                           aria-expanded="false" aria-controls="pages">
                            <i class="mdi mdi-currency-usd"></i>
                            <span class="nav-text">View Tickets</span>
                        </a>
                    </li>

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="{{ route('profile') }}"
                           aria-expanded="false" aria-controls="documentation">
                            <i class="mdi mdi-account"></i>
                            <span class="nav-text">Profile</span>
                        </a>
                    </li>

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="../../logout.php"
                           aria-expanded="false" aria-controls="documentation">
                            <i class="mdi mdi-logout"></i>
                            <span class="nav-text">Log Out</span>
                        </a>
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
                                <span class="d-none d-lg-inline-block">{{ucwords(auth()->user()->username)}}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <!-- User image -->
                                <li class="dropdown-header">

                                    <div class="d-inline-block">
                                        <small class="pt-1"></small>
                                    </div>
                                </li>

                                <li>
                                    <a href="profile.php">
                                        <i class="mdi mdi-account"></i> My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="referrals.php">
                                        <i class="mdi mdi-account-group"></i> Referrals
                                    </a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="../../logout.php"> <i class="mdi mdi-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


        </header>


        <div class="content-wrapper">
            <div class="content">

                <div class="card-body">
                    @include('.inc.messages')
                    @if (!empty($success))
                        {{ $success }}
                    @endif

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-inverse">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><a href="/buy_tickets" style="text-decoration: none !important;color:#4c84ff;">Buy Tickets</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="/buy_tickets/soccer" style="text-decoration: none !important;color:#4c84ff;">Soccer</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="/buy_tickets/soccer/pay" style="text-decoration: none !important;color:#4c84ff;">Pay</a></li>
                        </ol>
                    </nav>

                </div>
                <!-- Top Statistics -->
                <div class="card card-default">
                    @foreach($pay as $p)

                        <div class="card-header card-header-border-bottom">
                            <h2>Proceed to pay ${{  $p->purchase_number * $p->ticket_price }}</h2>
                        </div>
                        <div class="card-body">
                            <form class="form-pill" method='POST' action='/buy_tickets/soccer/pay/process'>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput3">Number of tickets you wish to purchase</label>
                                    <input type="number"   name='purchase_number' class="form-control" id="exampleFormControlInput3" value={{$p->purchase_number}} disabled>
                                    <input type="hidden"   name='purchase_number' class="form-control" id="exampleFormControlInput3" value={{$p->purchase_number}} >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlPassword3">Price per ticket ($)</label>
                                    <input type="text" name='ticket_price' class="form-control" id="exampleFormControlPassword3" value={{$p->ticket_price}} disabled>
                                    <input type="hidden" name='ticket_price' class="form-control" id="exampleFormControlPassword3" value={{$p->ticket_price}}>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlPassword3">Amount to Pay ($)</label>
                                    <input type="text" name='final_pay' class="form-control" id="exampleFormControlPassword3" value="{{$p->purchase_number * $p->ticket_price}}" disabled>
                                    <input type="hidden" name='final_pay' class="form-control" id="exampleFormControlPassword3" value="{{$p->purchase_number * $p->ticket_price}}">
                                    <input type="hidden" name='tickets_available' class="form-control" id="exampleFormControlPassword3" value="{{$p->tickets_available}}">
                                    <input type="hidden" name='ticket_id' class="form-control" id="exampleFormControlPassword3" value="{{$ticket_id}}">
                                </div>

                                <div class="form-footer">
                                    <button type="submit"  class="btn btn-primary btn-default">PAY</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <footer class="footer mt-auto">
            <div class="copyright bg-white">
                <p>
                    &copy; <span id="copy-year"></span> Copyright CapitalTicketing
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>