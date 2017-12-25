<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsCommon.php');

if(isset($_SESSION['adminloggedin'])) {
    
} else {
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/html5-trunk.js"></script>
    <link href="<?php echo BASEPATH; ?>bootstrap/icomoon/style.css" rel="stylesheet" />
    
    <!-- NVD graphs css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/nvd-charts.css" rel="stylesheet" />

    <!-- Bootstrap css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/main.css" rel="stylesheet" />
    <link rel="icon" href="<?php echo BASEPATH;; ?>bootstrap/images/admin-logo.png" type="image/x-icon">
    <!-- fullcalendar css -->
    
    </head>
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
              <h2>Pay-out Report</h2>
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
            <?php ShowAlerts(); ?>
          </div>
          <div class="row-fluid">
            <div class="span12">
              <div class="widget no-margin">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Pay-out Report
                  </div>
                <div class="pull-right">
                    <input type="text" name="enrno" id="enrno" placeholder="Enter ENR No.">
                    <select name="month" id="month">
                        <option value="">Select Month</option>
                        <option value="01" <?php if(date('m')=='01') { echo 'selected'; } ?>>January</option>
                        <option value="02" <?php if(date('m')=='02') { echo 'selected'; } ?>>February</option>
                        <option value="03" <?php if(date('m')=='03') { echo 'selected'; } ?>>March</option>
                        <option value="04" <?php if(date('m')=='04') { echo 'selected'; } ?>>April</option>
                        <option value="05" <?php if(date('m')=='05') { echo 'selected'; } ?>>May</option>
                        <option value="06" <?php if(date('m')=='06') { echo 'selected'; } ?>>June</option>
                        <option value="07" <?php if(date('m')=='07') { echo 'selected'; } ?>>July</option>
                        <option value="08" <?php if(date('m')=='08') { echo 'selected'; } ?>>August</option>
                        <option value="09" <?php if(date('m')=='09') { echo 'selected'; } ?>>September</option>
                        <option value="10" <?php if(date('m')=='10') { echo 'selected'; } ?>>October</option>
                        <option value="11" <?php if(date('m')=='11') { echo 'selected'; } ?>>November</option>
                        <option value="12" <?php if(date('m')=='12') { echo 'selected'; } ?>>December</option>
                    </select>
                    <select name="year" id="year" >
                        <option value="">Select Year</option>
                        <?php 
                        for($i=2017; $i<=(date('Y')+1);$i++) {
                        ?>
                        <option value="<?php echo $i; ?>" <?php if(date('Y')==$i) { echo 'selected'; } ?>><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <a href="javascript:void(0);" class="btn btn-info " style="margin-bottom: 10px;" data-original-title="Go" onclick="getPayoutDetails();">Go</a>
                </div>  
                </div>
                <div class="widget-body">
                  <div id="dt_example" class="example_alt_pagination">
                      <div id="data"></div>  
                        
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- dashboard-container -->
    </div><!-- container-fluid -->


    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/moment.js"></script>

    <script src="<?php echo BASEPATH; ?>js/jquery.validate.min.js"></script>
    
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

    <script src="<?php echo BASEPATH; ?>bootstrap/js/theming.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom.js"></script>
    
    <link href='<?php echo BASEPATH; ?>bootstrap/css/jquery-ui.css' rel='stylesheet' />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-ui-date.js"></script>
    <script src="<?php echo BASEPATH; ?>js/ckeditor/ckeditor.js" type="text/javascript"></script>
    
<script>
    $(document).ready(function() {
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',maxDate:0,});
        CKEDITOR.replace('bodymessage');
        //searchSTList();
    });
    
    function getPayoutDetails()
    {
        var enrno=$("#enrno").val();
        var month=$("#month").val();
        var year=$("#year").val();
        
        if(enrno=='')
        {
            alert('Please enter ENR No');
            $("#enrno").focus();
        }
        else if(month=='')
        {
            alert('Please select month');
            $("#month").focus();
        }
        else if(year=='')
        {
            alert('Please select year');
            $("#year").focus();
        }
        else {
            $("#data").html('<img src="../bootstrap/img/ajax-loader.gif">');
            $.post("../ajax/ajax-common.php",{
                q:'getPayoutDetails',
                enrno:enrno,
                month:month,
                year:year,
            },function(data){
                var ret=data.split('^');
                if(ret[1]=='notexist') {
                    alert('This ENR No not exist.');
                    $("#data").html('');
                }
                else {
                    $("#data").html(ret[2]);
                }
            });
        }
            
    }
</script>
  </body>
</html>