<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsCommon.php');

if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}

if(isset($_POST['finalsubmit']))
{
    
    $obj=new Common();
    $resSD=$obj->getSettings();
    $rowSD=$resSD->fetch_assoc();
    
    $res=$obj->saveLBdata('lb',$rowSD['tds']);
    
    if($res) {
        echo '<script type="text/javascript">alert("Details has been saved successfully"); window.location.href="lblist.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("Error occured while saving details"); window.location.href="lblist.php";</script>';
    }
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
              <h2>LB</h2>
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
        <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="">
        <div class="row-fluid">
            <div class="span12">
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Leadership Bonus
                  </div>
                    <div class="pull-right">
                        <select name="month" id="month" class="">
                            <option value="">Select Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="year" id="year" class="">
                            <option value="">Select Year</option>
                            <?php 
                            for($i=2017; $i<=(date('Y')+1);$i++) {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                        <input type="button" name="checkprofit" id="checkprofit" class=" btn  btn-info" data-original-title="GO" data-toggle="tooltip" value="GO" onclick="getLBLIST();" />
                    </div>
                </div>
                
                <div class="widget-body">
                    <div class="control-group span11" id="studentdetails">

                    </div>
                       
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <button type="submit" id="finalsubmit" name="finalsubmit" class="btn btn-info pull-right" onclick="return saveFI()" style="display:none;">Save</button>
                        <button type="button" id="finalsubmit2" name="finalsubmit2" class="btn btn-info pull-right" style="display:none;">Saving...</button>
                      <div class="clearfix">
                      </div>
                    </div>
                  
                </div>
              </div>
            </div>
          </div>
        </form>
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
    
    
<script>
    $(document).ready(function() {
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',});
    });
    
    function getLBLIST()
    {
        var month=$("#month").val();
        var year=$("#year").val();
        
        if(month=='')
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select month.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else if(year=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select year.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else
        {
            $("#studentdetails").html('<img src="../bootstrap/img/ajax-loader.gif">');
            $.post("../ajax/ajax-pac.php",{
                q:'getLBLIST',
                month:month,
                year:year,
            },function(data){
                var ret=data.split('^');
                if(ret[1]=='exist') {
                    $("#studentdetails").html('');
                    $('#onetimeerror').fadeIn();
                    $("#onetimeerror").html('LB of this month and year was already saved.');
                    setTimeout(function() {
                        $('#onetimeerror').fadeOut();
                    }, 5000 );
                } else {
                    $("#studentdetails").html(ret[2]);
                    $("#finalsubmit").show('fast');
                    $('[data-toggle=modal]').tooltip();
                }
            });
        }
    }
    function saveFI()
    {
        var totaluser=$("#totaluser").val();
        if(totaluser=='')
        {
            alert('No data found for save');
            return false;
        }
        else 
        {
            var r=confirm('Are you sure you want to save LB detail on selected month and year');
            if(r) 
            {
                $("#finalsubmit").hide('fast');
                $("#finalsubmit2").show('fast');
                return true;
            } 
            else 
            {
                return false;
            }
        }
    }
</script>
  </body>
</html>