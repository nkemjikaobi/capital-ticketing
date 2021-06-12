<?php


error_reporting(E_ERROR | E_PARSE);


session_start();

if(!$_SESSION['active']) {
  header("location:login.php");
  die();
}

include '../../db.php';


$username = $_SESSION['username'];
$email = $_SESSION['dbemail'];



//fetch details of user
$sql =$conn->query("SELECT * FROM users WHERE email = '$email'");

while ($data = $sql->fetch_object()){
  $full_name = $data->fullname;
  $email =$data->email;
  $username = $data->username;
  $plan = $data->plan;
  $roi = $data->roi;
  $balance = $data->balance;
  $ref_bonus = $data->ref_bonus;
  $ref = $data->ref;

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Investments</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
  <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="assets/plugins/toaster/toastr.min.css" rel="stylesheet" />
  <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
  <link href="assets/plugins/flag-icons/css/flag-icon.min.css" rel="stylesheet"/>
  <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
  <link href="assets/plugins/ladda/ladda.min.css" rel="stylesheet" />
  <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />

  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />



  <!-- FAVICON -->
  <link href="assets/img/favicon.png" rel="shortcut icon" />

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>


  <body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
      <style>
          .con{
              font-weight: bold;
          }
          .connn{
              color:#337ab7;
          }
      </style>
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
              <a href="../../index.php">
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
                <span class="brand-name">FFG</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">

              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">



                  <li  class="has-sub active expand" >
                    <a class="sidenav-item-link" href="index.php"
                      aria-expanded="false" aria-controls="dashboard">
                      <i class="mdi mdi-view-dashboard-outline"></i>
                      <span class="nav-text">Dashboard</span>
                    </a>
                  </li>

                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="investments.php"
                      aria-expanded="false" aria-controls="ui-elements">
                      <i class="mdi mdi-credit-card"></i>
                      <span class="nav-text">Create Investments</span>
                    </a>
                  </li>

                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="deposits.php"
                      aria-expanded="false" aria-controls="charts">
                      <i class="mdi mdi-currency-btc"></i>
                      <span class="nav-text">Deposits</span>
                    </a>
                  </li>

                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="withdrawals.php"
                      aria-expanded="false" aria-controls="pages">
                      <i class="mdi mdi-currency-usd"></i>
                      <span class="nav-text">Withdrawals</span>
                    </a>
                  </li>

                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="profile.php"
                      aria-expanded="false" aria-controls="documentation">
                      <i class="mdi mdi-account"></i>
                      <span class="nav-text">Profile</span>
                    </a>
                  </li>
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="referrals.php"
                      aria-expanded="false" aria-controls="documentation">
                      <i class="mdi mdi-account-group"></i>
                      <span class="nav-text">Referrals</span>
                    </a>
                  </li>
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="valuepoints.php"
                      aria-expanded="false" aria-controls="documentation">
                      <i class="mdi mdi-chart-line"></i>
                      <span class="nav-text">Value Points</span>
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

                      <span class="d-none d-lg-inline-block"><?php echo $full_name; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li class="dropdown-header">

                        <div class="d-inline-block">
                        <?php echo $full_name; ?> <small class="pt-1"><?php echo $email; ?></small>
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

										<nav aria-label="breadcrumb">
											<ol class="breadcrumb breadcrumb-inverse">
												<li class="breadcrumb-item">
													<a href="#">Home</a>
												</li>
												<li class="breadcrumb-item active" aria-current="page">Investments</li>
											</ol>
                    </nav>

									</div>

                  <!-- Top Statistics -->

                  <div class='row'>
                <div class='col-lg-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h3 class='card-title'>BASIC PLAN</h3>
                            <hr>
                            <div class='row padding'>
                                <div class='col-md-6'>
                                    <p class='mb-3'><span class='con '>Min:</span><span class='connn'>  $100</span></p>
                                    <p class='mb-3'><span class='con'>Max:</span><span class='connn'>  $9,999</span></p>
                                    <p class='mb-3'><span class='con'>Daily Profit (ROI):</span><span class='connn'>1.2%</span></p>
                                    <p class='mb-3'><span class='con'>Support:</span><span class='connn'>24 Hours</span></p>
                                    <p class='mb-3'><span class='con'>Ref Bonus</span><span class='connn'>5%</span></p>

                                </div>

                            </div>


                            <a href='basicplan.php' class='btn btn-primary fun'><span class='select_plan'>INVEST NOW</span></a>

                        </div>
                    </div>
                </div>

                <div class='col-lg-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h3 class='card-title'>BRONZE PLAN</h3>
                            <hr>
                            <div class='row padding'>
                                <div class='col-md-6'>
                                <p class='mb-3'><span class='con'>Min:</span><span class='connn'>  $10,000</span></p>
                                    <p class='mb-3'><span class='con'>Max:</span><span class='connn'>  $99,999</span></p>
                                    <p class='mb-3'><span class='con'>Daily Profit:</span><span class='connn'>1.4%</span></p>
                                    <p class='mb-3'><span class='con'>Support:</span><span class='connn'>24 Hours</span></p>
                                    <p class='mb-3'><span class='con'>Ref Bonus</span><span class='connn'>5%</span></p>

                                </div>

                            </div>

                            <a href='bronzeplan.php' class='btn btn-primary fun'><span class='select_plan'>INVEST NOW</span></a>
                        </div>
                    </div>
                </div>

                <div class='col-lg-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h3 class='card-title'>SILVER PLAN</h3>
                            <hr>
                            <div class='row padding'>
                                <div class='col-md-6'>
                                    <p class='mb-3'><span class='con'>Min:</span><span class='connn'>  $100,000</span></p>
                                    <p class='mb-3'><span class='con'>Max:</span><span class='connn'>  $499,999</span></p>
                                    <p class='mb-3'><span class='con'>Daily Profit (ROI):</span><span class='connn'>1.6%</span></p>
                                    <p class='mb-3'><span class='con'>Support:</span><span class='connn'>24 Hours</span></p>
                                    <p class='mb-3'><span class='con'>Ref Bonus</span><span class='connn'>5%</span></p>

                                </div>

                            </div>

                            <a href='silverplan.php' class='btn btn-primary fun'><span class='select_plan'>INVEST NOW</span></a>
                        </div>
                    </div>
                </div>

                <div class='col-lg-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h3 class='card-title'>GOLD PLAN</h3>
                            <hr>
                            <div class='row padding'>
                                <div class='col-md-6'>
                                    <p class='mb-3'><span class='con'>Min:</span><span class='connn'>  $500,000.00</span></p>
                                    <p class='mb-3'><span class='con'>Max:</span><span class='connn'>  UNLIMITED</span></p>
                                    <p class='mb-3'><span class='con'>Daily Profit (ROI):</span><span class='connn'>1.8%</span></p>
                                    <p class='mb-3'><span class='con'>Support:</span><span class='connn'>24 Hours</span></p>
                                    <p class='mb-3'><span class='con'>Ref Bonus</span><span class='connn'>5%</span></p>

                                </div>

                            </div>

                            <a href='goldplan.php' class='btn btn-primary fun'><span class='select_plan'>INVEST NOW</span></a>
                        </div>
                    </div>
                </div>


            </div>
                    </div>
</div>

          <footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>
                &copy; <span id="copy-year"></span> Copyright FFG
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
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/toaster/toastr.min.js"></script>
<script src="assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/charts/Chart.min.js"></script>
<script src="assets/plugins/ladda/spin.min.js"></script>
<script src="assets/plugins/ladda/ladda.min.js"></script>
<script src="assets/plugins/jquery-mask-input/jquery.mask.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/jekyll-search.min.js"></script>
<script src="assets/js/sleek.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/date-range.js"></script>
<script src="assets/js/map.js"></script>
<script src="assets/js/custom.js"></script>

  </body>
</html>
