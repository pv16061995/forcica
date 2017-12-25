<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');

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
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> One Time Input 
                  </div>
                </div>
                
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="">
                       <input type="hidden" name="userid" id="userid" value="">
                       <input type="hidden" name="pre_margin_money_deposited" id="pre_margin_money_deposited" value="">
                       <input type="hidden" name="pre_trading_account_id" id="pre_trading_account_id" value="">
                       
                    <div class="control-group span6 left-0">
                        <div class="control-group span12 left-0">
                          <label class="control-label" for="email1">ENR No *</label>
                          <div class="controls">
                              <input type="text" name="enr_no" id="enr_no" class="span9" placeholder="Enter ENR No" value="" />
                              <input type="button" name="checkuser" id="checkuser" class="span3 btn btn-mini btn-info" data-original-title="GO" data-toggle="tooltip" value="GO" onclick="checkUserExist();" />
                              <br> 
                              <span id="errnonotexist" class="form-errors"></span>
                          </div>
                        </div>
                       <div class="control-group span12 left-0">
                          <label class="control-label" for="email1">Trading Account ID *</label>
                          <div class="controls">
                              <input type="text" name="trading_account_id" id="trading_account_id" class="span12" placeholder="Trading Account ID" value="" />
                          </div>
                        </div>
                       <div class="control-group span12 left-0">
                          <label class="control-label" for="email1">Margin Money Deposited </label>
                          <div class="controls">
                              <input type="text" name="margin_money_deposited" id="margin_money_deposited" class="span12" placeholder="Margin Money Deposited" value="" />
                          </div>
                        </div>
                        <div class="control-group span12 left-0">
                          <label class="control-label" for="email1">Margin Money Withdrawn </label>
                          <div class="controls">
                              <input type="text" name="margin_money_withdrawn" id="margin_money_withdrawn" class="span12" placeholder="Margin Money Withdrawn" value="" />
                          </div>
                        </div>
                        <div class="control-group span12 left-0">
                          <label class="control-label" for="email1">Date of Trading Activation </label>
                          <div class="controls">
                              <input type="text" name="trading_activation_date" id="trading_activation_date" class="span12 custom-dt" placeholder="Date of Trading Activation" value="" readonly style="cursor: pointer;" />
                          </div>
                        </div>
                    </div> 
                       <div class="control-group span6" id="studentdetails">
                           
                       </div>
                       
                        <div class="form-actions no-margin">
                            <span class="form-errors" id="onetimeerror"></span>
                            <button type="button" class="btn btn-info pull-right" onclick="saveOnetimeInput()" id="submit">Submit</button>
							<button type="button" id="processbtn"  class="btn btn-success btn-lg pull-right" style="display:none;"><img src="../img/loading.gif" width="15px" height="15px"></button>
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
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',maxDate:0,});
    });

    function saveOnetimeInput()
    {
        var enr_no=$("#enr_no").val();
        var userid=$("#userid").val();
        var trading_account_id=$("#trading_account_id").val();
        var margin_money_deposited=parseFloat($("#margin_money_deposited").val());
        var margin_money_withdrawn=parseFloat($("#margin_money_withdrawn").val());
        var trading_activation_date=$("#trading_activation_date").val();
        var pre_margin_money_deposited=parseFloat($("#pre_margin_money_deposited").val());
        var pre_trading_account_id=$("#pre_trading_account_id").val();
        
        if(isNaN(margin_money_deposited)) { margin_money_deposited=''; }
        if(isNaN(margin_money_withdrawn)) { margin_money_withdrawn=''; }
        if(isNaN(pre_margin_money_deposited)) { pre_margin_money_deposited=''; }
        
        if(enr_no=='') 
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html("Please enter ENR No.");
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else if(trading_account_id=='') 
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html("Please enter trading account id");
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else if(pre_margin_money_deposited < margin_money_withdrawn) 
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html("Margin money withdrawn is greater than margin money deposited by this user");
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else if(userid=='') 
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html("Please enter correct ENR No.");
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else if(margin_money_deposited=='' && margin_money_withdrawn=='') 
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html("Please enter either margin money deposited / money withdrawn.");
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else if(trading_activation_date=='') 
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html("Please select date.");
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else {
			$("#submit").hide("fast");
			$("#processbtn").show("fast");
            
            $.post("../ajax/ajax-common.php",{
               q:'saveOnetimeInput', 
               enr_no:enr_no,
               trading_account_id:trading_account_id,
               margin_money_deposited:margin_money_deposited,
               margin_money_withdrawn:margin_money_withdrawn,
               trading_activation_date:trading_activation_date,
               userid:userid,
               pre_trading_account_id:pre_trading_account_id,
               pre_margin_money_deposited:pre_margin_money_deposited,
            },function(data){
                var ret=data.split('^');
                if(ret[1]=='saved') {
                    window.location.reload();
                } else if(ret[1]=='notsaved') {
                    $('#onetimeerror').fadeIn();
                    $("#onetimeerror").html("Error occured while saving details");
                    setTimeout(function() {
                        $('#onetimeerror').fadeOut();
                    }, 5000 );
                }
                else if(ret[1]=='tradeidexist') {
					
					$("#submit").show("fast");
					$("#processbtn").hide("fast");
			
                    $('#onetimeerror').fadeIn();
                    $("#onetimeerror").html("This trading account id already assigned.");
                    setTimeout(function() {
                        $('#onetimeerror').fadeOut();
                    }, 5000 );
                }
            });
        }
    }

    function checkUserExist()
    {
        var enr_no=$("#enr_no").val();
        $("#pre_margin_money_deposited").val('');
        $("#pre_trading_account_id").val('');
        $("#trading_account_id").val('');
        $("#userid").val('');
        if(enr_no=='') {
            $('#errnonotexist').fadeIn();
            $("#errnonotexist").html('Please enter ENR No.');
            setTimeout(function() {
                $('#errnonotexist').fadeOut();
            }, 5000 );
        } else {
            $.post("../ajax/ajax-common.php",{
                q:'checkUserExist',
                enr_no:enr_no,
            },function(data){
                var ret=data.split('^');
                if(ret[1]=='exist') {
                    $("#studentdetails").html(ret[2]);
                    $("#userid").val(ret[3]);
                    $("#pre_margin_money_deposited").val(ret[4]);
                    $("#pre_trading_account_id").val(ret[5]);
                    if(ret[5]!='') {
                        $("#trading_account_id").val(ret[5]);
                        $("#trading_account_id").attr('readonly',true);
                    }
                    else {
                        $("#trading_account_id").attr('readonly',false);
                    }
                } else {
                    $("#errnonotexist").html('This enr no not registered with us');
                    $("#userid").val('');
                    $("#trading_account_id").attr('readonly',false);
                    $('#errnonotexist').fadeIn();
                    setTimeout(function() {
                        $('#errnonotexist').fadeOut();
                    }, 5000 );
                }
            });
        }
    }
</script>
    
  </body>
</html>