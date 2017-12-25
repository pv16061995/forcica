<?php
ini_set("display_errors", 1); 
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
	
	$month = $_POST['month'];
	$year = $_POST['year'];
	$monthdate = $_POST['monthdate'];
	
	if($monthdate==10)
	{
		$startDate = date($year.'-'.$month.'-01');
		$endDate = date($year.'-'.$month.'-10');
	}
	else if($monthdate==20){
		
		$startDate = date($year.'-'.$month.'-11');
		$endDate = date($year.'-'.$month.'-20');
	}
	else if($monthdate==30){
		
		$startDate = date($year.'-'.$month.'-21');
		
		$endDate= date("Y-m-t", strtotime($startDate));
	}
	
	$users = explode(',', $_POST['users']);
	
	$payoutAmounts = explode(',', $_POST['payoutAmount']);
	
	
	
  $res = $obj->updatePayoutSegment($startDate, $endDate);
    if($res) {
		$i=0;
		foreach($users as $key => $userid)
		{
			
			 $result = $obj->getStudentDetailsById($userid);
			
			 $row = $result->fetch_assoc();
			
			 $name = $row['first_name'].' '.$row['last_name'];
			
			 $mobileNo = $row['user_login'];
			
			 $to = $row['user_email'];
			
			 $SMS = "Dear ".$name.",Your payout amount ".$payoutAmounts[$key]." has been released on '.date('d-m-Y').'";
		   	 $obj->sendsms($mobileNo, $SMS);
			
            
              $subject = 'Payout Release - Forcica';
			
			  $message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
			  $message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
			  $message .='<b>Dear '.$name.',</b><br><br>';
			  $message .='Your payout amount '.$payoutAmounts[$key].' has been released on '.date('d-m-Y').'.<br><br>';
			  /* $message .='Your Login details given below: <br><br>';
			  $message .='<b>Username :</b>'.trim($username).'<br><b>Password :</b>'.$password.'  <br><br>'; */
			  $message .='Kindly use the same for future references.<br><br>';
			  $message .='With Best Regards<br>Administration<br>www.forcica.com<br>
			  info@forcica.com<br>+91-7042782924';
            
			/* $message='<div style="width:500px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;">
            <div style="margin-bottom:35px; text-align:center;"><img src="'.BASEPATH.'bootstrap/img/logo.png" style="height:70px;" /></div>
            <div style="margin-bottom:20px;">Dear '.$name.',</div>
            <div style="margin-bottom:20px;">Your payout amount '.$payoutAmounts[$key].' has been released on '.date('d-m-Y').'. <br>';
			

			$message.='</div><div style="margin-bottom:20px;">
			Thanks & Regards,<br>
			<b>Forcica Team</b><Br>';

			$message.='</div><div style="background:#00b3e8; padding:10px; width:100%; color:#fff; margin-left: -10px; text-align:center;"><div style="font-size:18px; font-weight:bold; margin-bottom:5px;">Forcica</div><div style="margin-bottom:10px;">www.forcica.com</div></div></div>'; */
                
         
			  
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: Forcica  <support@forcica.com> \r\n";
            @mail($to, $subject, $message, $headers);
			
			$_SESSION['SuccessMessage']='Selected Payout Details has been approved successfully';
			
			$i++;
			
		}
		 
		
    } else {
		
		 $_SESSION['ErrorMessage']='Error occured while approving payout details';
       
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
              <h2>Payout</h2>
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
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Payout
                  </div>
                </div>
                
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="">
                       
                       
                    <div class="control-group span12 left-0">
                        <div class="control-group span3 left-0">
                          <label class="control-label" for="email1">Month *</label>
                            <div class="controls">
                                <select name="month" id="month" class="span12">
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
                                <select name="year" id="year" class="span12">
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
                          <label class="control-label" for="email1">Select Date *</label>
                            <div class="controls">
                                <select name="monthdate" id="monthdate">
                                    <option value="">Select</option>
                                    <option value="10">On 10th</option>
                                    <option value="20">On 20th</option>
                                    <option value="30">On 30th</option>
                                </select>
                                <input type="button" name="checkprofit" id="checkprofit" class="span3 btn btn-mini btn-info" data-original-title="GO" data-toggle="tooltip" value="GO" onclick="applyPASC();" />
                            </div>
                        </div>
                    </div> 
                       
                    <div class="control-group span11" id="studentdetails">

                    </div>
                       
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <button type="submit" id="finalsubmit" name="finalsubmit" class="btn btn-info pull-right" onclick="return ApprovePayout()" style="display:none;">Approve</button>
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

    function applyPASC()
    {
        var monthdate=parseFloat($("#monthdate").val());
        var month=$("#month").val();
        var year=$("#year").val();
        
        if(month=='') {
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
        else if($("#monthdate").val()=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select date.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        } 
        else {
            $("#studentdetails").html('<img src="../bootstrap/img/ajax-loader.gif">');
            
            $.post("../ajax/ajax-common.php",{
                q:'getStudentPayoutdataBySegment',
                monthdate:monthdate,
                month:month,
                year:year,
            },function(data){
                var ret=data.split('^');
                if(ret[1]=='exist') {
                    $("#studentdetails").html('');
                    $('#onetimeerror').fadeIn();
                    $("#onetimeerror").html('Payout of selected date of this month and year was already approved.');
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
    
    function ApprovePayout()
    {
        var users=$("#users").val();
        if(users=='')
        {
            alert('No data found for approve');
            return false;
        }
        else 
        {
            var r=confirm('Are you sure you want to approve detail on selected date');
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