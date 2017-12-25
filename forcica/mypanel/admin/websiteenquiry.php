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

              </div>
            </div>
          </div>
          <div class="page-header">
            <div class="pull-left">
              <h2>Enquiry List</h2>
            </div>
            <div class="pull-right">
              <ul class="stats">
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
          <div class="row-fluid">
            <div class="span12">
              <div class="widget no-margin">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Enquiry List
                  </div>
                <div class="pull-right">
                    <select name="enquiry_type" id="enquiry_type" onchange="getWebsiteEnquiry();">
                        <option value='1'>Contact Enquiry</option>
                        <option value='2'>Admission Enquiry</option>
                    </select>
                    <input type="text" name="fromdate" id="fromdate" value="<?php echo date('Y-m-01'); ?>" class="custom-dt" readonly style="cursor: pointer;" placeholder="From Date" onchange="getWebsiteEnquiry();">
                    <input type="text" name="todate" id="todate" value="<?php echo date('Y-m-d'); ?>" class="custom-dt" readonly style="cursor: pointer;" placeholder="To Date" onchange="getWebsiteEnquiry();">
                    <!-- <a href="javascript:void(0);" class="btn btn-info" style="margin-bottom: 10px;" data-original-title="Search" onclick="searchMember();">Search</a>
                    <a href="javascript:void(0);" class="btn btn-warning2" style="margin-bottom: 10px;" data-original-title="Export" onclick="exportExcel();">Export Excel</a> -->
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
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/pie-charts/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/tiny-scrollbar.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/sparkline.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.dataTables.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/theming.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom.js"></script>
    <link href='<?php echo BASEPATH; ?>bootstrap/css/jquery-ui.css' rel='stylesheet' />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-ui-date.js"></script>
    
    
    <script>
    $(document).ready(function() {
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',maxDate:0,});
        
        getWebsiteEnquiry();
    });
    
    function getWebsiteEnquiry()
    {
        var fromdate=$("#fromdate").val();
        var todate=$("#todate").val();
        var enquiry_type=$("#enquiry_type").val();
        
            $("#data").html('<img src="../bootstrap/img/ajax-loader.gif">');
            $.post("../ajax/ajax-common.php",{
                q:'getWebsiteEnquiry', 
                fromdate:fromdate,
                todate:todate,
                enquiry_type:enquiry_type
            },function(data){
                 $("#data").html(data);
                 $('#data-table').dataTable({
                    "sPaginationType": "full_numbers",
                    "iDisplayLength": 50,
                });
                $('[data-toggle=tooltip]').tooltip();
            });
      }
            
    
    
  
</script>

  </body>
</html>