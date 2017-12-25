<?php 
include_once('../controls/config.php');
include_once('../controls/clsCommon.php');
include_once('../controls/clsUser.php');
include_once('../controls/clsMember.php');

if(isset($_SESSION['studentloggedin'])) {
    
} else {
    header('location: ../index.php');
}


$flag=false;
$obj=New Common();
if(isset($_SESSION['studentuserid']))
{
 $flag=true;
 $_SESSION['tru_user_id']=$_SESSION['studentuserid'];
 $uid=$_SESSION['tru_user_id'];


 $student=$obj->getStudentDetailByUid($uid);
 $detail=$student->fetch_assoc();


 $order_id=rand(9999,99999999);
 $update_order=$obj->getUpdateOrderIdByUid($uid,$order_id);
 $_SESSION['orderId']=$order_id;
 
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
              <h2>Payment Online</h2>
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
            <?php 
            if(isset($_SESSION['ErrorMessage']))
            {
                include_once('../controls/clsAlerts.php');
                ShowAlerts(); 
            }
            ?>
          </div>
        <?php if($flagPA) { ?>
            <h4>Already one course request is pending.</h4>
        <?php } else { ?>
        <div class="row-fluid">
            <div class="span12">
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Payment Online 
                  </div>
                </div>
                
                <div class="widget-body">
                    <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" enctype="multipart/form-data">
                   
                    <div class="row-fluid">
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">First Name *</label>
                          <div class="controls">
                            <input name="first_name" id="first_name" type="text"  placeholder="Enter First Name" readonly value="<?php if($flag){ echo $detail['first_name'];}?>" class="span12" >
                             
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">Last Name *</label>
                          <div class="controls">
                            <input name="last_name" id="last_name" type="text"  placeholder="Enter Last Name" readonly value="<?php if($flag){ echo $detail['last_name'];}?>" class="span12">
                            
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">E-mail ID *</label>
                          <div class="controls">
                            <input name="email" id="email" type="text"  placeholder="Enter E-mail ID" readonly value="<?php if($flag){ echo $detail['email'];}?>" class="span12">
                              
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Mobile Number *</label>
                          <div class="controls">
                            <input name="phone" id="phone" type="text" maxlength="15" placeholder="Your Mobile Number" readonly value="<?php if($flag){ echo $detail['phone'];}?>" class="span12">                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Total Fee *</label>
                          <div class="controls">
                            <input name="total_fee" id="total_fee" type="text" placeholder="Enter Your Total Fee" readonly value="<?php if($flag){ echo $detail['fee'];}?>" class="span12">
                           
                          </div>
                        </div>
                        <div class="control-group span6 left-0 alreadyPaidArea">
                          <label class="control-label" for="password5">Payment Id *</label>
                          <div class="controls">
                            <input name="order_id" id="order_id" type="text" placeholder="Enter Payment Id *" readonly  value="<?php if($flag){ echo $order_id;}?>" class="span12">
                              
                          </div>
                        </div>
                    </div>
                   
                    <div class="form-actions no-margin">
                      <div id="trupayPaymentFrame"></div>
                        <button type="button" id="submitButton"  class="btn btn-info pull-right" onclick="getWebSessionKey('<?php echo base64_encode($order_id);?>','<?php echo base64_encode($detail['fee']);?>','<?php echo base64_encode($detail['email']);?>','<?php echo base64_encode($detail['phone']);?>')" class="pay_btn">Submit</button>
                       
                      <div class="clearfix">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div><!-- dashboard-container -->
    </div><!-- container-fluid -->

    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/moment.js"></script>

    <script src="<?php echo BASEPATH; ?>js/jquery.validate.min.js"></script>
    
    <script src="<?php echo BASEPATH; ?>bootstrap/js/validatesubmit.js"></script>
    
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
        $("#submitButton").trigger("click");
    });
    
    
</script>
    
  </body>
</html>
<script src="https://uat.trupay.in/TrupayPaymentGateway/js/trupay-web-payment.js" type="text/javascript"></script>
<script type="text/javascript" src="trupay/client.js"></script>