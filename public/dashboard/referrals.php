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
  $value_points = $data->value_points;
  
}

  //Withdraw referal money

  if(isset($_POST['btn-withdraw'])){

    $status = 0;
    $rid = rand(10,1000);
    $tid = '#FGS'.$rid;

    //Get latest address
    $sql3 = $conn->query("SELECT * from withdrawals WHERE email = '$email' ORDER BY id DESC limit 1");

    while($row = $sql3->fetch_array()){
      $address = $row['address'];
    }
  
    //check if bonus less than 30
  if($ref_bonus < 30){
      $error = "<div class='container'>
    <div class='alert alert-danger '>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong class=''>Bonus has to be at least $30 before it can be withdrawn</strong>
    </div>
  </div>";
  }
  else if($address == ''){
    $error = "<div class='container'>
        <div class='alert alert-danger'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class=''>No wallet address found</strong>
        </div>
      </div>";
  }
  else{
     
      $sql = $conn->query("INSERT INTO withdrawals(tid,amount,address,status,email) VALUES('$tid','$ref_bonus','$address','$status','$email')");

      $to='billrhodes126@gmail.com';
      $subject="Referral Bonus Withdrawal Request";
      $from = 'support@ffgroups.org';
      $body = 'Request to withdraw my referral bonus $'.$ref_bonus  .'  '.' from '. $email;
      
       $headers = "From: " . strip_tags($from) . "\r\n";
       $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
       mail($to,$subject,$body,$headers);

      if(!$sql){
        $error = "<div class='container'>
        <div class='alert alert-danger '>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class=''>An error has occured</strong>
        </div>
      </div>";

        
      }
      else{
           $sql1 = $conn->query("UPDATE users SET ref_bonus = '0' WHERE username = '$username'");
        $error = "<div class='container'>
        <div class='alert alert-success '>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class=''>Withdrawal request submitted successfully</strong>
        </div>
      </div>";
      }
}

} 

//Withdraw value points 
if(isset($_POST['btn-value'])){
  if($value_points >= 300 && $value_points < 500){
    
    $address = 'VALUE-POINTS '.$value_points.' vp';
    $status = 1;
    $rid = rand(10,1000);
    $tid = '#FGS'.$rid;

    $new_roi = 150 + $roi;
    $sql = $conn->query("UPDATE users SET roi ='$new_roi', value_points = '0' WHERE email = '$email' ");
    $sql1 = $conn->query("INSERT INTO deposits(tid,email,amount,address,status) VALUES ('$tid','$email','150','$address','$status') ");

    if($sql){
      if($sql1){
        $error = "<div class='container'>
        <div class='alert alert-success '>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class=''>You have been credited $150..View your updated ROI and check the deposits tab</strong>
        </div>
      </div>";
      }
    }
    else{
      $error = "<div class='container'>
      <div class='alert alert-danger '>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong class=''>An error occurred</strong>
      </div>
    </div>";
    }
   
  }
  else if($value_points > 500){
    $address = 'VALUE-POINTS '.$value_points.' vp';
    $status = 1;
    $rid = rand(10,1000);
    $tid = '#FGS'.$rid;

    $new_roi = 250 + $roi;
    $sql = $conn->query("UPDATE users SET roi ='$new_roi', value_points = '0' WHERE email = '$email' ");
    $sql1 = $conn->query("INSERT INTO deposits(tid,email,amount,address,status) VALUES ('$tid','$email','250','$address','$status') ");

    if($sql){
      if($sql1){
        $error = "<div class='container'>
        <div class='alert alert-success '>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class=''>You have been credited $250..View your updated ROI and check the deposits tab</strong>
        </div>
      </div>";
      }
    }
    else{
      $error = "<div class='container'>
        <div class='alert alert-danger'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class=''>An error occurred</strong>
        </div>
      </div>";
    }
  }
  else{
    $error = "<div class='container'>
    <div class='alert alert-danger '>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong class=''>Currenlty ineligible to withdraw value points...See valuepoints page for more info.</strong>
    </div>
  </div>";
  }
}

//Get the number of refs
$sql7 = $conn->query("SELECT * FROM users WHERE ref = '$username' ORDER BY id desc");
$ref_number = $sql7->num_rows;

//Get the number of refs(first gen)
$sql8 = $conn->query("SELECT * FROM users WHERE parent_ref = '$username' ORDER BY id desc");
$ref_number_first = $sql8->num_rows;

//Get the number of refs(second gen)
$sql9 = $conn->query("SELECT * FROM users WHERE master_ref = '$username' ORDER BY id desc");
$ref_number_second = $sql9->num_rows;

    

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Referrals</title>

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
             if(isset($ad)){
               echo $ad;
             }
             ?>
									<div class="card-body">
                  <div class='container'>
      <div class='alert alert-primary '>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong class=''>Referal Payouts are made to the last address used for withdrawals..If you havent made any withdrawals, you are not eligible for payout yet.</strong>
      </div>
    </div>
										
										<nav aria-label="breadcrumb">
											<ol class="breadcrumb breadcrumb-inverse">
												<li class="breadcrumb-item">
													<a href="#">Home</a>
												</li>
												<li class="breadcrumb-item active" aria-current="page">Referals</li>
											</ol>
                    </nav>
					
									</div>
								 
                  <!-- Top Statistics -->
                  <div class="row">
                  <div class="col-xl-6 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-3"><?php echo $value_points; ?></h2>
                          <p class='mb-3'>VALUE POINTS</p>
                          <div class="d-flex">
                            <a href='valuepoints.php' class='btn btn-primary mr-4'>More Info...</a>
                            <form action="" method="POST">
                              <button name="btn-value" class='btn btn-primary'>Withdraw</button>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-sm-6">
                      <div class="card card-mini  mb-4">
                        <div class="card-body">
                          <h2 class="mb-3"><?php echo number_format($ref_bonus,2); ?></h2>
                          <p class='mb-3'>REF BONUS</p>
                          <form action="" method='POST'>
                           <button class='btn btn-primary' name='btn-withdraw'>Withdraw</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-3"><?php echo $ref_number; ?></h2>
                          <p>TOTAL DIRECT REFERALS</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-3"><?php echo $ref_number_first; ?></h2>
                          <p>TOTAL 1ST GEN REFERALS</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-3"><?php echo $ref_number_second; ?></h2>
                          <p>TOTAL 2ND GEN REFERALS</p>
                        </div>
                      </div>
                    </div>
            

                    <div class="col-xl-12 col-md-12 mb-1">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1">REFERRAL LINK</div>
                                <hr class="light-100">
                                <div class="mb-0 text-black-800">
                                    <a href="http://ffgroups.org/index?ref=<?php echo $username; ?>">https://ffgroups.org/index?ref=<?php echo $username; ?></a>
                                </div>
                                </div>
                                <div class="col-auto">
                                <i class=" fa-2x text-gray-300"></i>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>

                   
                  </div>
                  
          <div class='card shadow mb-4 mt-4'>
                <div class='card-header py-3'>
                    <span class="m-5 h6 font-weight-bold">DIRECT REFERRALS</span>
                </div>
                 <!--TABLE STARTS -->
              <div class='card-body'>
                <div class='table-responsive'>
                <?php 
                  include '../../db.php';
                  $sql = $conn->query("SELECT * FROM users WHERE ref = '$username' ORDER BY id desc");
                ?>
              <!-- Table -->
              <table id='dataTable' class='table table-bordered table-hover' width='100%' cellspacing='0'>
                  <thead>
                  <tr>
                      <th>Username</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Date Registered</th>
                  </tr>
                  </thead>
                  <?php
                      while($row = $sql->fetch_array()){
                    ?>
                    <tr>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['fullname']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php  echo $row['created_at']; ?></td>
                      
                  </tr>
                  <?php } ?>
                  
              </table>
                    </div>
            </div>
            <!--TABLE ENDS-->
              
            </div>
          <div class='card shadow mb-4 mt-4'>
                <div class='card-header py-3'>
                    <span class="m-5 h6 font-weight-bold">INDIRECT REFERRALS(FIRST GENERATION)</span>
                </div>
                 <!--TABLE STARTS -->
              <div class='card-body'>
                <div class='table-responsive'>
                <?php 
                  include '../../db.php';
                  $sql = $conn->query("SELECT * FROM users WHERE parent_ref = '$username' ORDER BY id desc");
                ?>
              <!-- Table -->
              <table id='dataTable' class='table table-bordered table-hover' width='100%' cellspacing='0'>
                  <thead>
                  <tr>
                      <th>Username</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Date Registered</th>
                  </tr>
                  </thead>
                  <?php
                      while($row = $sql->fetch_array()){
                    ?>
                    <tr>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['fullname']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php  echo $row['created_at']; ?></td>
                      
                  </tr>
                  <?php } ?>
                  
              </table>
                    </div>
            </div>
            <!--TABLE ENDS-->
              
            </div>
          <div class='card shadow mb-4 mt-4'>
                <div class='card-header py-3'>
                    <span class="m-5 h6 font-weight-bold">INDIRECT REFERRALS(SECOND GENERATION)</span>
                </div>
                 <!--TABLE STARTS -->
              <div class='card-body'>
                <div class='table-responsive'>
                <?php 
                  include '../../db.php';
                  $sql = $conn->query("SELECT * FROM users WHERE master_ref = '$username' ORDER BY id desc");
                ?>
              <!-- Table -->
              <table id='dataTable' class='table table-bordered table-hover' width='100%' cellspacing='0'>
                  <thead>
                  <tr>
                      <th>Username</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Date Registered</th>
                  </tr>
                  </thead>
                  <?php
                      while($row = $sql->fetch_array()){
                    ?>
                    <tr>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['fullname']; ?></td>
                      <td><?php echo $row['email']; ?></td>
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
