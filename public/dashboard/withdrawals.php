<?php

error_reporting(E_ERROR | E_PARSE);


session_start();

if(!$_SESSION['active']) {
  header("location:../../login.php"); 
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

//Withdraw money
if(isset($_POST['btn-withdraw'])){
  $amount = $_POST['amount'];
  $address = $_POST['address'];
  $status = 0;
  $rid = rand(10,1000);
  $tid = '#FGS'.$rid;

  if($roi < 30){
    $error = "<div class='container'>
    <div class='alert alert-danger '>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong class=''>ROI has to be at least $30 before it can be withdrawn</strong>
    </div>
  </div>";
  }
  else if($amount < 30){
    $error = "<div class='container'>
    <div class='alert alert-danger '>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong class=''>Amount must be at least $30</strong>
    </div>
  </div>";
  }
  else if($amount > $roi){
    $error = "<div class='container'>
    <div class='alert alert-danger '>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong class=''>Insufficient Funds</strong>
    </div>
  </div>";
  }
  else{
    $sql = $conn->query("INSERT INTO withdrawals(tid,amount,address,status,email)VALUES('$tid','$amount','$address','$status','$email')");
    $new_roi = $roi - $amount;
    $sql1 = $conn->query("UPDATE users SET roi = '$new_roi' WHERE email = '$email'");
    if($sql){
      if($sql1){
        $error = "<div class='container'>
        <div class='alert alert-success '>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class=''>Withdrawal Request Sucessful</strong>
        </div>
      </div>";
      }
      $to="billrhodes126@gmail.com";
      $subject="Withdraw Initiated";
      $from = 'support@ffgroups.org';
      $body='Request to withdraw '.$amount.' by '.$email;
      $headers = "From: " . strip_tags($from) . "\r\n";
      $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      mail($to,$subject,$body,$headers);
    }
    else{
      $error = "<div class='container'>
      <div class='alert alert-danger '>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong class=''>An error occurred..</strong>
      </div>
    </div>";
    }
  
  }

}

    
    

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Withdrawals</title>

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
<style>
    .table-responsive {
	min-height:.01%;
	overflow-x:auto
}
@media screen and (max-width:767px) {
    .table-responsive {
    width:100%;
    margin-bottom:15px;
    overflow-y:hidden;
    -ms-overflow-style:-ms-autohiding-scrollbar;
    border:1px solid #ddd
    }
    .table-responsive>.table {
    margin-bottom:0
    }
        .table-responsive>.table>tbody>tr>td, .table-responsive>.table>tbody>tr>th, .table-responsive>.table>tfoot>tr>td, .table-responsive>.table>tfoot>tr>th, .table-responsive>.table>thead>tr>td, .table-responsive>.table>thead>tr>th {
    white-space:nowrap
    }
    .table-responsive>.table-bordered {
    border:0
    }
    .table-responsive>.table-bordered>tbody>tr>td:first-child, .table-responsive>.table-bordered>tbody>tr>th:first-child, .table-responsive>.table-bordered>tfoot>tr>td:first-child, .table-responsive>.table-bordered>tfoot>tr>th:first-child, .table-responsive>.table-bordered>thead>tr>td:first-child, .table-responsive>.table-bordered>thead>tr>th:first-child {
    border-left:0
    }
    .table-responsive>.table-bordered>tbody>tr>td:last-child, .table-responsive>.table-bordered>tbody>tr>th:last-child, .table-responsive>.table-bordered>tfoot>tr>td:last-child, .table-responsive>.table-bordered>tfoot>tr>th:last-child, .table-responsive>.table-bordered>thead>tr>td:last-child, .table-responsive>.table-bordered>thead>tr>th:last-child {
    border-right:0
    }
    .table-responsive>.table-bordered>tbody>tr:last-child>td, .table-responsive>.table-bordered>tbody>tr:last-child>th, .table-responsive>.table-bordered>tfoot>tr:last-child>td, .table-responsive>.table-bordered>tfoot>tr:last-child>th {
    border-bottom:0
    }
}
</style>

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
          <?php
             if(isset($error)){
               echo $error;
             }
            
             ?>
				<div class="card-body">
                <div class='container'>
     
    </div>			
				<nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-inverse">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Withdrawals</li>
                    </ol>
                    </nav>
					
			   </div>					 
                  <!-- Top Statistics -->
                  <div class="row">
                  
                  <div class="col-lg-12">
									
                     <!--TABLE STARTS -->
              <div class='card-body'>
              <div class="card card-default">
				<div class="card-header card-header-border-bottom">
                        <h2>Withdraw Funds</h2>
                    </div>
                    <div class="card-body">
                        <form class="form-pill" action='' method='POST'>
                            <div class="form-group">
                                <label for="exampleFormControlInput3">Amount</label>
                                <input type="text" name='amount' class="form-control" id="exampleFormControlInput3" placeholder="Enter Amount">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlPassword3">BTC Address</label>
                                <input type="text" name='address' class="form-control" id="exampleFormControlPassword3" placeholder='Enter a valid BTC Address'>
                            </div>
                            <div class="form-footer">
                                <button type="submit" name='btn-withdraw' class="btn btn-primary btn-default">Withdraw</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class='table-responsive'>
               
              <!-- Table -->
              <?php 
                  include '../../db.php';
                  $sql = $conn->query("SELECT * FROM withdrawals WHERE email = '$email' ORDER BY id desc");
                ?>
              <table id='dataTable' class='table table-bordered table-hover' width='100%' cellspacing='0'>
                  <thead>
                  <tr>
                      <th>Transaction ID</th>
                      <th>USD Amount</th>
                      <th>BTC Address</th>
                      <th>Transaction Status</th>
                      <th>Transaction Date</th>
                  </tr>
                  </thead>
                  <?php
                      while($row = $sql->fetch_array()){
                        $status = $row['status'];
                    ?>
                    <tr>
                      <td><?php echo $row['tid']; ?></td>
                      <td><?php echo '$ '.$row['amount']; ?></td>
                      <td><?php echo $row['address']; ?></td>
                      <td>
                        <?php if($status == 0){
                          echo "<span style='color: white;background:orangered;border-radius:5px;padding:10px;' id='status'>PENDING</span>";
                        } 
                        else{
                          echo "<span style='color: white;background:green;border-radius:5px;padding:10px;' id='status'>PAID</span>";
                        }?>
                      </td>
                      <td><?php  echo $row['created_at']; ?></td>
                      
                  </tr>
                  <?php } ?>
              </table>
                    </div>
            </div>
            <!--TABLE ENDS-->
                
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
