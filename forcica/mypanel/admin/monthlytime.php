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
    
    $res=$obj->saveMonthlyinputdata('tss',$rowSD['tds']);
    if($res) {
        echo '<script type="text/javascript">alert("Details has been saved successfully"); window.location.href="monthlytime.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("Error occured while saving details"); window.location.href="monthlytime.php";</script>';
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
              <h2>Trading Support Service</h2>
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
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Monthly Input 
                  </div>
                </div>
                
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="">
                       
                       
                    <div class="control-group span12 left-0">
                        <div class="control-group span3 left-0">
                          <label class="control-label" for="email1">Month *</label>
                            <div class="controls">
                                <select name="profitmonth" id="profitmonth" class="span12">
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
                            </div>
                        </div>
                        <div class="control-group span3 left-0">
                          <label class="control-label" for="email1">Year *</label>
                            <div class="controls">
                                <select name="profityear" id="profityear" class="span12">
                                    <option value="">Select Year</option>
                                    <?php 
                                    for($i=2017; $i<=(date('Y')+1);$i++) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">Profit (%) *</label>
                            <div class="controls">
                                <input type="text" name="profit" id="profit" class="span9" placeholder="Enter Profit (%)" value="" />
                                <input type="button" name="checkprofit" id="checkprofit" class="span3 btn btn-mini btn-info" data-original-title="GO" data-toggle="tooltip" value="GO" onclick="applyProfit();" />
                            </div>
                        </div>
                    </div> 
                       
                    <div class="control-group span11" id="studentdetails">

                    </div>
                       
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <button type="submit" id="finalsubmit" name="finalsubmit" class="btn btn-info pull-right" onclick="return saveMonthlyInput()" style="display:none;">Save</button>
                      
						
						<button type="button" name="finalsubmit2" id="finalsubmit2"  class="btn btn-success btn-lg" style="display:none;"><img src="../img/loading.gif" width="15px" height="15px"></button>
						
                      <div class="clearfix">
                      </div>
                    </div>
                  </form>
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
    
    
<script>
    $(document).ready(function() {
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',});
    });

    function applyProfit()
    {
        var profit=parseFloat($("#profit").val());
        var profitmonth=$("#profitmonth").val();
        var profityear=$("#profityear").val();
        
        if(profitmonth=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select month.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else if(profityear=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select year.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else if($("#profit").val()=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter profit.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        } else if(isNaN(profit)) {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter profit in numbers.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else {
            $("#studentdetails").html('<img src="../bootstrap/img/ajax-loader.gif">');
            
            $.post("../ajax/ajax-common.php",{
                q:'applyProfit',
                profit:profit,
                profitmonth:profitmonth,
                profityear:profityear,
            },function(data){
                var ret=data.split('^');
                if(ret[1]=='exist') {
                    $("#studentdetails").html('');
                    $('#onetimeerror').fadeIn();
                    $("#onetimeerror").html('Selected month and year data was already saved.');
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
    
    function saveMonthlyInput()
    {
        var totaluser=$("#totaluser").val();
        if(totaluser=='')
        {
            alert('No data found for save');
            return false;
        }
        else 
        {
            var profit=parseFloat($("#profit").val());
            var r=confirm('Are you sure you want to save monthly input data with '+profit+' % of profit');
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
    
    function getUserTSSDetails(enr_no)
    {
        $.post("../ajax/ajax-common.php",{
            q:'getUserTSSDetails', 
            enr_no:enr_no,
        },function(data){
            $("#myModal .modal-body").html(data);
        });
    }
</script>
  
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 1000px; left: 460px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel" style="text-align:left;">TSS Details</h3>
    </div>
    <div class="modal-body" style="text-align:left;"></div>
    <div class="modal-footer">
        <button class="btn btn-danger btn-mini" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

  </body>
</html>