<?php 
include_once('../controls/config.php');
include_once('../controls/clsCommon.php');
include_once('../controls/clsUser.php');
include_once('../controls/clsMember.php');

if(isset($_SESSION['studentloggedin'])) {
    
} else {
    header('location: ../index.php');
}

$obj=New Common();
$get_tax=$obj->getservicetax();


$obj=new User();

if(isset($_POST['submit']))
{
    
    $user_id=$_POST['user_id'];
	
    $course_id=$_POST['course_id'];
    
    $objM=new member();
    $resP=$objM->checkAlreadyApplied($user_id,$course_id);
    if($resP->num_rows>0) 
    {
        $_SESSION['ErrorMessage=']='You had already applied for this course';
    }
    else 
    {
        $coursename=$_POST['coursename'];
        $fee=$_POST['fee'];
        $service_tax=$_POST['service_tax'];
        $totalfee=$_POST['totalfee'];
        $paymentMode=$_POST['paymentMode'];

        $payment_type='';
        $cheque='';
        $utrno='';
        $date1='';
        $bank='';
        $amount='';
        $cashrecipt='';

        $paymentMode = $_POST['paymentMode'];

        if($paymentMode==1)
        {
                $paymentMethod = 'Payment Gateway';

        }else if($paymentMode==2)
        {
                $paymentMethod = 'Paid already';

        }else if($paymentMode==3)
        {
                $paymentMethod = 'SWS';
        }

        if($paymentMode==2) 
        {
            $payment_type=$_POST['payment_type'];
            if($payment_type=='cash')
            {
                $amount=$_POST['swsamount'];
                $date1=$_POST['paiddate'];
                $cashrecipt=$_FILES['cashrecipt']['name'];

                $path='../userdocs'.'/'.$user_id.'/';

                @chmod($path, 0755);


                if($cashrecipt!='')
                {
                    $allowedExts = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "doc", "docx", "pdf", "PDF");
                    $temp = explode(".", $_FILES["cashrecipt"]["name"]);
                    $extension = end($temp);
                    if ((($_FILES["cashrecipt"]["type"] == "image/gif")|| ($_FILES["cashrecipt"]["type"] == "image/jpeg")|| ($_FILES["cashrecipt"]["type"] == "image/jpg")|| ($_FILES["cashrecipt"]["type"] == "image/pjpeg")|| ($_FILES["cashrecipt"]["type"] == "image/x-png") || ($_FILES["cashrecipt"]["type"] == "image/png") || ($_FILES["cashrecipt"]["type"] == "application/pdf") || ($_FILES["cashrecipt"]["type"] == "application/doc") || ($_FILES["cashrecipt"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")) && in_array($extension, $allowedExts))
                    {
                        $cashrecipt=time().'_'.$_FILES["cashrecipt"]["name"];
                        move_uploaded_file($_FILES["cashrecipt"]["tmp_name"], $path.$cashrecipt);
                    }
                    else 
                    {
                        $cashrecipt='';
                    }
                }
            }
            else 
            {
                $cheque=$_POST['cheque'];
                $utrno=$_POST['utrno'];
                $date1=$_POST['date1'];
                $bank=$_POST['bank'];
                $amount=$_POST['amount'];
            }
        }
        else if($paymentMode==3) 
        {
            $amount=$_POST['totalfee'];
        }
        
        $resS=$objM->saveStudentCourseRequest($user_id,$course_id,$coursename,$fee,$service_tax,$totalfee,$paymentMode,$payment_type,$cheque,$utrno,$date1,$bank,$amount,$cashrecipt,'0');

        if($paymentMode=='1')
        {
            $obj=new User();
            $res=$obj->getStudentUserDetailsById($_SESSION['studentuserid']);
            $data=$res->fetch_assoc();
            
            $_SESSION['tru_user_id']=$user_id;
            $_SESSION['tru_pid']=$password;
          
            $to = 'support@forcica.com';
            $subject = 'Course Upgrade Request - Forcica';

            $message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
            $message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
            $message .='<b>Dear Admin,</b><br><br>';
            $message .="New course upgrade request has been generated. Student details are as follows : - <br><br>";

            $message .="Name : ".$data['first_name']." ".$data['last_name']." <br>";
            $message .="Email : ".$data['user_email']." <br>";
            $message .="Phone : ".$data['phone1']." <br>";
            
            $message .="<b>Course details are as follows : - </b><br><br>";
            $message .="Course : ".$coursename." <br>";
            $message .="Fee Amount : ".($totFee-$service_tax)." <br>";
            $message .="Service Tax : ".$service_tax." <br>";
            $message .="Total amount : ".$totFee." <br>";

            if($paymentMode==1)
            {
                $paymentMethod = 'Payment Gateway';

            }else if($paymentMode==2)
            {
                $paymentMethod = 'Paid already';

            }else if($paymentMode==3)
            {
                $paymentMethod = 'SWS';
            }
            $message .="Payment Mode : ".$paymentMethod." <br>";

            $message .='With Best Regards<br>Forcica';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: Forcica  <support@forcica.com> \r\n";
            @mail($to, $subject, $message, $headers);
            
            header("location:trupay_payment.php");
        }
        else
        {

          
        if($resS) 
        {
            $_SESSION['SuccessMessage']='Course request has been saved successfully';
        } 
        else 
        {
            $_SESSION['ErrorMessage']='Error occured while saving course request';
        }
        
        header('location: courses.php?catId='.$_GET['category']);

        }
    }
    
}

if(isset($_GET['courseId']))
{
    $courseId   =  base64_decode($_GET['courseId']);
    $courseName =  base64_decode($_GET['course']);
    $price      =  base64_decode($_GET['courseamt']);
    $amtpaidpre =  base64_decode($_GET['amtpaidpre']);
    
    $price=$price-$amtpaidpre;
    $fee=$price;
    $serviceTax=($fee*$get_tax)/100;
    $price=$fee+$serviceTax;
}

$res=$obj->getStudentUserDetailsById($_SESSION['studentuserid']);
$data=$res->fetch_assoc();

$flagPA=FALSE;

$objM=new Member();
$resC=$objM->checkPACR($_SESSION['studentuserid']);

if($resC->num_rows>0) { $flagPA=TRUE; }
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
              <h2>Apply For - <?php echo $courseName; ?></h2>
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
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Apply For - <?php echo $courseName; ?> 
                  </div>
                </div>
                
                <div class="widget-body">
                    <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $data['ID']; ?>">
                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $courseId; ?>">
                    
                    <div class="row-fluid">
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">Course Name *</label>
                          <div class="controls">
                              <input type="text" name="coursename" id="coursename" class="span12" placeholder="Course Name" value="<?php echo $courseName; ?>" readonly/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">Fee *</label>
                          <div class="controls">
                            <input type="text" name="fee" id="fee" class="span12" placeholder="Fee" value="<?php echo $fee; ?>" readonly/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Service Tax *</label>
                          <div class="controls">
                              <input type="text" name="service_tax" id="service_tax" class="span12" value="<?php echo $serviceTax; ?>" readonly placeholder="Service Tax"  value="" />
                              
                              
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Total Fee *</label>
                          <div class="controls">
                            <input type="text" name="totalfee" id="totalfee" class="span12" placeholder="Total Amount"  value="<?php echo $price; ?>" readonly/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Payment Mode *</label>
                          <div class="controls">
                            <select name="paymentMode" id="paymentMode" class="span12" onchange="CheckPaymentMode(this.value);">
                                    <option value="">Select Payment Mode</option>
<!--                                    <option value="1">Online Payment</option>-->
                                    <option value="2">Paid already</option>
                                    <option value="3">SWS</option>
                            </select>
                          </div>
                        </div>
                        <div class="control-group span6 left-0 alreadyPaidArea" style="display:none;">
                          <label class="control-label" for="password5">Payment Type *</label>
                          <div class="controls">
                              <select name="payment_type" id="payment_type" class="span12" onchange="checkPaymentType(this.value);">
                                    <option value="">Select Payment Type</option>
                                    <option value="cash">Cash Deposit</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="neft">NEFT</option>
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="row-fluid cheque" style="display:none;">
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Cheque *</label>
                          <div class="controls">
                            <input type="text" name="cheque" id="cheque" class="span12 " placeholder="Cheque No."  value="" />
                          </div>
                        </div>
                    </div>
                    <div class="row-fluid neft" style="display:none;">
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">NEFT / RTGS *</label>
                          <div class="controls">
                            <input type="text" name="utrno" id="utrno" class="span12" placeholder="UTR No."  value=""/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">NEFT / RTGS Date *</label>
                          <div class="controls">
                            <input type="text" name="date1" id="date1" class="span12 custom-dt" placeholder="NEFT / RTGS Date"  value="" readonly/>
                          </div>
                        </div>
                    </div>
                    <div class="row-fluid bank" style="display:none;">
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Bank Name *</label>
                          <div class="controls">
                            <input type="text" name="bank" id="bank" class="span12" placeholder="Bank Name"  value=""/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Paid Amount *</label>
                          <div class="controls">
                            <input type="text" name="amount" id="amount" class="span12" placeholder="Paid Amount"  value="<?php echo $price; ?>" readonly/>
                          </div>
                        </div>
                    </div>
                    <div class="row-fluid sws" style="display:none;">
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Paid Date *</label>
                          <div class="controls">
                            <input type="text" name="paiddate" id="paiddate" class="span12 custom-dt" placeholder="Payment Date"  value=""/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Paid Amount *</label>
                          <div class="controls">
                            <input type="text" name="swsamount" id="swsamount" class="span12" placeholder="Paid Amount"  value="<?php echo $price; ?>" readonly/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Cash Deposit Slip *</label>
                          <div class="controls">
                              <input type="file" class="span12" name="cashrecipt" id="cashrecipt" onchange="checkfileSize4();"/>
                          </div>
                        </div>
                    </div>
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <input type="submit" name="submit" id="submit" class="btn btn-info pull-right" onclick="return saveCourseRequest()" value="Submit">
                        <input type="button" name="submit2" id="submit2" style="display:none;" class="btn btn-info pull-right" value="Processing...">
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
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',});
    });
    
    function CheckPaymentMode(type)
    {
        if(type==2)
        {
            $('.alreadyPaidArea').show('slow');
            $(".sws").hide('slow');
            $("#swsamount").val('');
        }
        else if(type==3)
        {
            $('.alreadyPaidArea').hide('slow');
            $('.cheque').hide('slow');
            $('.neft').hide('slow');
            $('.bank').hide('slow');
            $(".sws").hide('slow');
        }
        else 
        {
            $(".sws").hide('slow');
            $('.alreadyPaidArea').hide('slow');
            $('.cheque').hide('slow');
            $('.neft').hide('slow');
            $('.bank').hide('slow');
            $("#swsamount").val('');
        }
    }

    function checkPaymentType(type)
    {
        if(type=="cheque")
        {
            $('.neft').hide('slow');
            $('.sws').hide('slow');
            $('.cheque').show('slow');
            $('.bank').show('slow');
        }
        else if(type=="neft")
        {
            $('.cheque').hide('slow');
            $('.sws').hide('slow');
            $('.neft').show('slow');
            $('.bank').show('slow');
        }
        else if(type=="cash")
        {
            $('.cheque').hide('slow');
            $('.neft').hide('slow');
            $('.bank').hide('slow');
            $('.sws').show('slow');
            var totalfee=$("#totalfee").val();
            $("#swsamount").val(totalfee);
        }
        else
        {
            $('.cheque').hide('slow');
            $('.neft').hide('slow');
            $('.sws').hide('slow');
            $('.bank').hide('slow');
        }
    }
    
    function saveCourseRequest()
    {
        var user_id=$("#user_id").val();
        var course_id=$("#course_id").val();
        var coursename=$("#coursename").val();
        var fee=$("#fee").val();
        var service_tax=$("#service_tax").val();
        var totalfee=$("#totalfee").val();
        var paymentMode=$("#paymentMode").val();
        var payment_type='';
        var cheque='';
        var utrno='';
        var date1='';
        var bank='';
        var amount='';
        var swsamount='';
        var paiddate='';
        var cashrecipt='';
        
        if(paymentMode==2)
        {
            if($("#payment_type").val()!='')
            {
                payment_type=$("#payment_type").val();
            }
            if($("#cheque").val()!='')
            {
                cheque=$("#cheque").val();
            }
            if($("#utrno").val()!='')
            {
                utrno=$("#utrno").val();
            }
            if($("#date1").val()!='')
            {
                utrno=$("#date1").val();
            }
            if($("#bank").val()!='')
            {
                bank=$("#bank").val();
            }
            if($("#amount").val()!='')
            {
                amount=$("#amount").val();
            }
        }
        
        if(payment_type=='cash') 
        {
            swsamount=$("#swsamount").val();
            paiddate=$("#paiddate").val();
            var filename = $("#cashrecipt").val().replace(/.*(\/|\\)/, '');
            cashrecipt = filename;
            
        }
        
        if(paymentMode=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select payment mode');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        /*else if(paymentMode==1) {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select other payment mode option');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }*/
        else if(paymentMode==2 && payment_type=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select payment type');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(paymentMode==2 && payment_type=='cheque' && cheque=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter cheque no');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(paymentMode==2 && payment_type=='cheque' && isNaN(cheque)) {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter correct cheque no');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(paymentMode==2 && payment_type=='neft' && utrno=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter NEFT / RTGS No.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(paymentMode==2 && payment_type=='neft' && date1=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select NEFT / RTGS Date');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(paymentMode==2 && payment_type!='cash' && bank=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter bank name');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(paymentMode==2 && paiddate=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select paid date');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(paymentMode==2 && cashrecipt=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please upload cash deposit slip ');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else
        {
            $("#submit").hide('fast');
            $("#submit2").show('fast');
           
        }
    }
</script>
    
  </body>
</html>