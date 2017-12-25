<?php 
include_once('../controls/config.php');
include_once('../controls/clsCommon.php');
include_once('../controls/clsUser.php');
include_once('../controls/clsAlerts.php');

if(isset($_SESSION['studentloggedin']) && $_SESSION['studentuserid'] != 1) {
    
} 
else 
{
    header('location: ../index.php');
}


if(isset($_GET['catId'])) {
    $catId=  base64_decode($_GET['catId']);
}

$obj=new User();
$res=$obj->getStudentUserDetailsById($_SESSION['studentuserid']);
$data=$res->fetch_assoc();


$resAC=$obj->getStudentappliedCourses($_SESSION['studentuserid'],$catId);
$appliedcourses=array();
$i=0;
$amountpaid=0;
while($rowAC=$resAC->fetch_assoc())
{
    $appliedcourses[$i]=$rowAC['post_id'];
    $amountpaid=$amountpaid+($rowAC['fee']-$rowAC['service_tax']);
    $i++;
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
              <h2>Course List</h2>
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
            <?php 
                ShowAlerts(); 
            ?>
          </div>

        <div class="row-fluid pricing-table">
            <?php
            $i=1;
            $obj=new Common();
            $query=$obj->getAllCourseByCatId($catId);
            while($row = $query->fetch_assoc())
            {
                $resES=$obj->getAllEnrolledStudentByCourseId($row['Id']);
            ?>
            <div class="span4 plan">
              <div >
                  <img src="../coursesImages/<?php echo $row['image'] ?>" style="width: 380px; height: 250px;">
              </div>
              <ul>
                    <li class="plan-feature"><h4><?php echo $row['coursename']; ?></h4></li>
                    <li class="plan-feature">
                        <b> Fee Amount :</b>  <span style="color: #54b551; font-size: 14px;"><?php echo $row['price']; ?></span>
                    </li>
                    <li class="plan-feature">
                        <?php if(in_array($row['Id'],$appliedcourses)) { ?>
                        <b> You have enrolled. </b>
                        <?php } else { ?>
                        <b> <?php if($resES->num_rows>0) { echo $resES->num_rows; } else { echo 'No'; } ?> student enrolled. </b>
                        <?php } ?>
                    </li>
                    <li class="plan-feature">
                        <?php if(in_array($row['Id'],$appliedcourses)) { ?>
                        <a href="javascript:void(0);" class="btn btn-default"  data-original-title="">Already Applied</a>
                        <?php if($catId!=1) { ?>
                        <a href="quiz.php?catId=<?php echo $_GET['catId']; ?>&courseId=<?php echo base64_encode($row['Id']); ?>"  class="btn btn-info"  data-original-title="">Study Material</a>
                        <?php } ?>
                        <?php if($catId==1){ ?>
                            <a href="../../MT_4_COURSE.html" target="_blank" class="btn btn-success"  data-original-title="">Study Material</a> 			
                        <?php } } else if($data['current_courseId'] < $row['Id']) { ?>
                            <a href="<?php echo BASEPATH.'student/apply_courses.php?courseId='.  base64_encode($row['Id']).'&&course='.  base64_encode($row['coursename']).'&&courseamt='.  base64_encode($row['price']).'&&category='.  base64_encode($row['catId']).'&&amtpaidpre='.  base64_encode($amountpaid); ?>" class="btn btn-success"  data-original-title=""> Apply</a>
                        <?php } else { ?>
                        <a href="javascript:void(0);" class="btn btn-default"  data-original-title="">Already Applied</a>
                        
                        <?php } ?>
						
                        
                        
                    </li>
              </ul>
            </div>
            
            <?php if($i==3) { echo '</div><div class="row-fluid pricing-table">'; } ?>
            
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