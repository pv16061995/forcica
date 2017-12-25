<?php 
include_once('../controls/config.php');
include_once('../controls/clsCommon.php');

if(isset($_SESSION['studentloggedin']) && $_SESSION['studentuserid'] != 1) {
    
} 
else 
{
    header('location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Forcica School Of Trading</title>
    <meta name="author" content="" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="description" content="" />
    
    <script src="<?php echo BASEPATH; ?>bootstrap/js/html5-trunk.js"></script>
    <link href="<?php echo BASEPATH; ?>bootstrap/icomoon/style.css" rel="stylesheet" />
    
    <!-- NVD graphs css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/nvd-charts.css" rel="stylesheet" />

    <!-- Bootstrap css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/main.css" rel="stylesheet" />
    <link rel="icon" href="<?php echo BASEPATH;; ?>bootstrap/images/admin-logo.png" type="image/x-icon">
    <!-- fullcalendar css -->
    <link href='<?php echo BASEPATH; ?>bootstrap/css/fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link rel="stylesheet" href="<?php echo BASEPATH; ?>js/chosen/chosen.css" />
    
    <link href='<?php echo BASEPATH; ?>bootstrap/css/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link href='<?php echo BASEPATH; ?>bootstrap/css/jquery-ui.css' rel='stylesheet' />
    <link href='<?php echo BASEPATH; ?>bootstrap/css/validationEngine.jquery.css' rel='stylesheet' />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo BASEPATH; ?>js/jquery.validate.min.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/validatesubmit.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-ui-date.js"></script>
    <script type="text/javascript" src="<?php echo BASEPATH; ?>js/chosen/chosen.jquery.js"></script> 
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.validationEngine.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/languages/jquery.validationEngine-en.js"></script>
    
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
  <body>
    <?php include_once('include/header.php'); ?>
    <div class="container-fluid">
      <?php // include_once('include/left-navigation.php'); ?>
    <div class="dashboard-wrapper no-margin">
        <?php include_once('include/menu.php'); ?>
        <div class="main-container">
          <div class="navbar hidden-desktop">
            <div class="navbar-inner">
              <div class="container">
                <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
<!--                <div class="nav-collapse collapse navbar-responsive-collapse">
                  <ul class="nav">
                    <li>
                      <a href="index.html">Dashboard</a>
                    </li>
                    
                    <li>
                      <a href="form.html">form</a>
                    </li>
                    <li>
                      <a href="list.html">list</a>
                    </li>
                    
                  </ul>
                </div>-->
              </div>
            </div>
          </div>
          <div class="page-header">
            <div class="pull-left">
              <h2>Course Category</h2>
            </div>
            <div class="pull-right">
              <ul class="stats">
<!--                <li class="color-first hidden-phone">
                  <span class="fs1" aria-hidden="true" data-icon="&#xe037;"></span>
                  <div class="details">
                    <span class="big">$879,89</span>
                    <span>Balance</span>
                  </div>
                </li>-->
                <li class="color-second">
                  <span class="fs1" aria-hidden="true" data-icon="&#xe052;"></span>
                  <div class="details" id="date-time">
                    <span>Date </span>
                    <span>Day, Time</span>
                  </div>
                </li>
              </ul>
            </div>
            <div class="clearfix"></div>
          </div>

        <div class="row-fluid pricing-table">
            <?php
            $i=1;
            $obj=new Common();
            $query=$obj->getAllCategory();
            while($row = $query->fetch_assoc())
            {
                if($i==1) { $btncolor='btn-warning2'; } else if($i==2) { $btncolor='btn-info'; } else if($i==3) { $btncolor='btn-success'; }
            ?>
            <div class="span4 plan">
              <div >
                  <img src="../coursesImages/<?php echo $row['image'] ?>" style="width: 380px; height: 250px;">
              </div>
              <ul>
                  <li class="plan-feature"><h3><?php echo $row['categoryname']; ?></h3></li>
                <li class="plan-feature">
                    <a href="<?php echo BASEPATH.'student/courses.php?catId='.  base64_encode($row['Id']); ?>" class="btn <?php echo $btncolor; ?>" data-original-title=""> View Course</a>
                </li>
              </ul>
            </div>
            <?php $i++; } ?>
          </div>
        </div>
      </div><!-- dashboard-container -->
    </div><!-- container-fluid -->
<script>
$(document).ready(function() {
    $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',minDate:0,});
    $('#data-table2').dataTable({
        "sPaginationType": "full_numbers"
      });
});


</script>

    <script src="<?php echo BASEPATH; ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/moment.js"></script>

    
    <!-- Google Visualization JS -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- Easy Pie Chart JS -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/pie-charts/jquery.easy-pie-chart.js"></script>

    <!-- Tiny scrollbar js -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/tiny-scrollbar.js"></script>
    
    <!-- Sparkline charts -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/sparkline.js"></script>

    <!-- Datatables JS -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.dataTables.js"></script>

    <!-- Calendar Js -->
    <script src='<?php echo BASEPATH; ?>bootstrap/js/fullcalendar/jquery-ui-1.10.2.custom.min.js'></script>
    <script src='<?php echo BASEPATH; ?>bootstrap/js/fullcalendar/fullcalendar.min.js'></script>

    <!-- Custom Js -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom-index.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom-calendar.js"></script>

    <script src="<?php echo BASEPATH; ?>bootstrap/js/theming.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom.js"></script>
    
  </body>
</html>