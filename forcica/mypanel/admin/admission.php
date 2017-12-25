<?php 
include_once('../controls/config.php');
include_once('../controls/clsCommon.php');
include_once('../controls/clsMember.php');

if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}
$obj=new Common();

$get_tax=$obj->getservicetax();



if(isset($_POST['submit3']))
{
    $uplodepath = '../userdocs/';
    $profilePath = '';
    $profiledocname = '';
    $uploadflag=TRUE;
    if(isset($_FILES['user_pic']) && $_FILES['user_pic']['name']!=''){
      $errors= array();
      $file_name = $_FILES['user_pic']['name'];
      $file_size =$_FILES['user_pic']['size'];
      $file_tmp =$_FILES['user_pic']['tmp_name'];
      $file_type=$_FILES['user_pic']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['user_pic']['name'])));

      $expensions = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG");
      
      if(in_array($file_ext,$expensions)=== false){

             $_SESSION['ErrorMessage']="extension not allowed, please choose a JPEG or PNG file.";
      }

      if($file_size > 2097152){

             $_SESSION['ErrorMessage'] ='File size must be excately 2 MB';
      }

      if(empty($errors)==true){


             //echo "Success";
      }else{
             print_r($errors);
             $uploadflag=FALSE;
      }

      $profilePath = $uplodepath.$file_name;
      $profiledocname=$file_name;
} 

    $addressproof = '';
    $addressproofdocname=='';
    if(isset($_FILES['addressproof']) && $_FILES['addressproof']['name']!=''){
      $errors= array();
      $file_name = $_FILES['addressproof']['name'];
      $file_size =$_FILES['addressproof']['size'];
      $file_tmp2 =$_FILES['addressproof']['tmp_name'];
      $file_type=$_FILES['addressproof']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['addressproof']['name'])));

      $expensions = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "doc", "docx", "pdf", "PDF");
      

      if(in_array($file_ext,$expensions)=== false){

             $_SESSION['ErrorMessage']="extension not allowed, please choose a JPEG, PNG, DOC, DOCX, PDF file.";
      }

      if($file_size > 2097152){

             $_SESSION['ErrorMessage']='File size must be excately 2 MB';
      }

      if(empty($errors)==true){



      }else{
          $uploadflag=FALSE;
             //print_r($errors);
      }

      $addressproof = $uplodepath.$file_name;
      $addressproofdocname=$file_name;
} 

    $eduCertificate = '';
    $eduCertificatedocname='';
    if(isset($_FILES['edu']) && $_FILES['edu']['name']!=''){
      $errors= array();
      $file_name = $_FILES['edu']['name'];
      $file_size =$_FILES['edu']['size'];
      $file_tmp3 =$_FILES['edu']['tmp_name'];
      $file_type=$_FILES['edu']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['edu']['name'])));

      $expensions = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "doc", "docx", "pdf", "PDF");

      if(in_array($file_ext,$expensions)=== false){

             $_SESSION['ErrorMessage'] ="extension not allowed, please choose a JPEG, PNG, DOC, DOCX, PDF file.";
      }

      if($file_size > 2097152){

            $_SESSION['ErrorMessage'] = 'File size must be excately 2 MB';
      }

      if(empty($errors)==true){


             //echo "Success";
      }else{
          $uploadflag=FALSE;
             //print_r($errors);
      }

      $eduCertificate = $uplodepath.$file_name;
      $eduCertificatedocname=$file_name;
} 

    if($uploadflag)
    {


        $country=explode('^',$_POST['country']);

        $user_email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone1 = $_POST['phone'];
        $username = $_POST['phone'];
        $country = $country[1];
        $refno = $_POST['refno'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];

        $password = $_POST['password'];

        $user_nicename   = $username;
        $display_name    = $username;
        $nickname        = $username;

        $isPA = $_POST['radio'];
        $panno = $_POST['panno'];
        $account_no = $_POST['bank_ac'];
        $ifsc = $_POST['ifsc'];
        $cityofbranch = $_POST['cityofbranch'];
        $bank_name = $_POST['bank_name'];

        $objM=new Member();
        $user_id=$objM->saveStudent($username,$password,$user_nicename,$user_email,$display_name,$pincode,0);

        @mkdir($uplodepath.'/'.$user_id, 777);
        $uplodepath=$uplodepath.'/'.$user_id.'/';

        @chmod($uplodepath, 0755);
        
        if($profiledocname!='')
        {
            move_uploaded_file($file_tmp,$uplodepath.$profiledocname);
        }
        if($eduCertificatedocname!='')
        {
            move_uploaded_file($file_tmp2,$uplodepath.$eduCertificatedocname);
        }
        if($addressproofdocname!='')
        {
            move_uploaded_file($file_tmp3,$uplodepath.$addressproofdocname);
        }

        $paymentData  = $_POST['course'];

        $paymentData = explode('^', $paymentData);

        $level_name = $paymentData[2];
        $courseid = $paymentData[1]; 
        $totFee  = $_POST['totalfee'];
        $service_tax= $_POST['service_tax'];
        $payment_response = $_POST['paymentStatus'];

        $resSD=$objM->saveStudentDetails($user_id,$first_name,$last_name,$phone1,$dob,$state,$city,$country,$gender,$address1,$address2,$refno,$profiledocname,$eduCertificatedocname,$addressproofdocname,$courseid,$totFee,$service_tax);


        if($_POST['radio']=='yes') 
        {

            $name= $first_name.' '.$last_name;
            $panno=$_POST['panno'];
            $bank_ac=$_POST['bank_ac'];
            $ifsc=$_POST['ifsc'];
            $bank_name=$_POST['bank_name'];
            $cityofbranch=$_POST['cityofbranch'];

            $resPA=$objM->savePADetails($user_id,$name,$user_email,$panno,$bank_ac,$ifsc,$bank_name,$cityofbranch);
        }

        $currentdate = date('Y-m-d');

        $datetime = date('Y-m-d H:i:s');



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

        $resS=$objM->saveStudentCourseRequest($user_id,$courseid,$level_name,'',$service_tax,$totFee,$paymentMode,$payment_type,$cheque,$utrno,$date1,$bank,$amount,$cashrecipt,'1');
        
        if($resS)
        {
              $to = $user_email;
            
			  $subject = 'New Admission - Forcica';
				
			  $message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
			  $message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
			  $message .='<b>Dear '.$name.',</b><br><br>';
			  $message .="we are highly pleased to inform you that your request for admission in the course '".$level_name."' has been accepted and your submitted information have been duly verfied. Kindly complete the rest formalities and start learning.<br><br>";
			  $message .='Your Login details given below: <br><br>';
			  $message .='<b>Username :</b>'.trim($username).'<br><b>Password :</b>'.$password.'  <br><br>';
			  $message .='Kindly use the same for future references.<br><br>';
			  $message .='With Best Regards<br>Administration<br>www.forcica.com<br>
			  info@forcica.com<br>+91-7042782924';
            
            /* $message='<div style="width:500px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;">
            <div style="margin-bottom:35px; text-align:center;"><img src="'.BASEPATH.'bootstrap/img/logo.png" style="height:70px;" /></div>
            <div style="margin-bottom:20px;">Dear '.$name.',</div>
            <div style="margin-bottom:20px;">Thank you for your admission with forcica.com, <br><br>Below are the login details: <br> <b>Username :</b> '.trim($username).'<br><b>Password:</b>'.$password;
			

			$message.='</div><div style="margin-bottom:20px;">
			Thanks & Regards,<br>
			<b>Forcica Team</b><Br>';

			$message.='</div><div style="background:#00b3e8; padding:10px; width:100%; color:#fff; margin-left: -10px; text-align:center;"><div style="font-size:18px; font-weight:bold; margin-bottom:5px;">Forcica</div><div style="margin-bottom:10px;">www.forcica.com</div></div></div>'; */
                
                
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: Forcica  <support@forcica.com> \r\n";
            @mail($to, $subject, $message, $headers);
        }
        
        
        
    }    
    unset($_SESSION['ErrorMessage']);
    $_SESSION['SuccessMessage'] = 'Admission Details has been saved successfully.';
    header('location: manageStudent.php');
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
    <style>
        [data-tip] {
	position:relative;

}
[data-tip]:before {
	content:'';
	/* hides the tooltip when not hovered */
	display:none;
	content:'';
	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
	border-bottom: 5px solid #1a1a1a;	
	position:absolute;
	top:30px;
	left:35px;
	z-index:8;
	font-size:0;
	line-height:0;
	width:0;
	height:0;
}
[data-tip]:after {
	display:none;
	content:attr(data-tip);
	position:absolute;
	top:35px;
	left:0px;
	padding:5px 8px;
	background:#1a1a1a;
	color:#fff;
	z-index:9;
	font-size: 0.75em;
	height:18px;
	line-height:18px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	white-space:nowrap;
	word-wrap:normal;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
	display:block;
}
        
    </style>
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
              <h2>New Admission</h2>
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
            <div class="row-fluid">
            <div class="span12">
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> New Admission
                  </div>
                </div>
                
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="paymentform" id="paymentform" action="" enctype="multipart/form-data">
                <div class="" id="firstStep">
                    <div class="row-fluid">
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">Email-Id *</label>
                          <div class="controls">
                              <input type="text" name="email" id="email" class="span12" placeholder="Enter Email Id" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" />
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">Mobile *</label>
                          <div class="controls">
                            <input type="text" name="phone" id="phone" class="span12" placeholder="Enter 10-Digit Mobile No." value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>" />
                          </div>
                        </div>
                        <div class="control-group span6 left-0" >
                          <label class="control-label" for="password5">Password *</label>
                          <div class="controls" data-tip="Password must be at least 1 uppercase alphabet, 1 lowercase alphabet, 1 number and 1 special character.">
                              <input type="password" name="password" id="password" class="span12" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" placeholder="Enter Password" />
                              
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">First Name *</label>
                          <div class="controls">
                              <input type="text" name="first_name" id="first_name" class="span12" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" placeholder="Enter First Name" />
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Last Name </label>
                          <div class="controls">
                              <input type="text" name="last_name" id="last_name" class="span12" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>" placeholder="Enter Last Name" />
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                            <label class="control-label" for="password5">Country Of Residence *</label>
                            <div class="controls">
                                <select name="country" id="country" class="span12" id="country" >
                                    <?php
                                        $objM=new Member();
                                        $resC=$objM->getCountry();
                                        while($data=$resC->fetch_assoc())
                                        {
                                            $selected = '';
                                            if(isset($_POST['country']) && $_POST['country']==$data['name'])
                                            {
                                                $selected = 'selected'; 
                                            }
                                            else if($data['country_id']==99)
                                            {
                                                $selected = 'selected';  
                                            }
                                            ?> 
                                            <option value="<?php echo $data['country_id'].'^'.$data['name']; ?>" <?php echo $selected; ?>><?php echo $data['name']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="firstStepError"></span>
                        <input type="button" value="Next Step" class="btn btn-info pull-right" onclick="showSecondStep('1');" name="submit1" id="submit1">
                      <div class="clearfix"></div>
                    </div>
                </div> 
                       <div class="" id="secondStep" style="display:none;">
                           <div class="row-fluid">
                                <div class="control-group span6 left-0">
                                  <label class="control-label" for="email1">Course Category *</label>
                                  <div class="controls">
                                      <select name="coursecatgory" id="coursecatgory" class="span12" onchange="getCousebycatId();">
                                            <option value="">Select Course Category</option>
					                                 <?php
                                                $obj=new Common();
                                                $coursecatRes=$obj->getAllCategory();
                                                while($rescat=$coursecatRes->fetch_assoc()) 
                                                {
                                                    $selected1 = '';
                                                    if(isset($_POST['coursecatgory']) && $_POST['coursecatgory']==$rescat['Id']){
                                                        $selected1 = 'selected'; 
                                                    } 
                                            ?>
                                            <option value="<?php echo $rescat['Id']; ?>" <?php echo $selected1; ?>><?php echo $rescat['categoryname']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                  </div>
                                </div>
                                <?php if(isset($_POST['course'])) { ?>
                               <div class="control-group span6 left-0">
                                  <label class="control-label" for="email1">Level *</label>
                                  <div class="controls">
                                      <select name="course" id="course" class="span12" onchange="calculateFee(this.value);">
                                            <option value="">Select the Level</option>
                                            <?php
                                                $obj=new Common();
                                                $coursecatRes=$obj->getAllCourseByCatId($_POST['coursecatgory']);
                                                while($rescat=$coursecatRes->fetch_assoc()) 
                                                {
                                                    $selected1 = '';
                                                    if(isset($_POST['coursecatgory']) && $_POST['coursecatgory']==$rescat['Id']){
                                                        $selected1 = 'selected'; 
                                                    } 
                                            ?>
                                            <option value="<?php echo $rescat['price'].'^'.$rescat['Id'].'^'.$rescat['coursename']; ?>" <?php echo $selected1; ?>><?php echo $rescat['coursename']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                  </div>
                                </div>
                                <?php } else { ?>
                                <div class="control-group span6 left-0">
                                   <label class="control-label" for="email1">Level *</label>
                                   <div class="controls">
                                       <select name="course" id="course" class="span12" onchange="calculateFee(this.value);">
                                             <option value="">Select the Level</option>
                                         </select>
                                   </div>
                                 </div>
                                <?php } ?>
                                <div class="control-group span6 left-0">
                                 <label class="control-label" for="password5">Fee *</label>
                                 <div class="controls">
                                     <input type="text" name="fee" id="fee" class="span12" value="<?php if(isset($_POST['fee'])) echo $_POST['fee']; ?>" placeholder="Fee" readonly>
                                 </div>
                               </div>
                               <div class="control-group span6 left-0">
                                 <label class="control-label" for="password5">Service Tax *</label>
                                 <div class="controls">
                                     <input type="text" name="service_tax" id="service_tax" class="span12" placeholder="Service Tax" readonly value="<?php if(isset($_POST['service_tax'])) echo $_POST['service_tax']; ?>">
                                 </div>
                               </div>
                               <div class="control-group span6 left-0">
                                 <label class="control-label" for="password5">Total Fee *</label>
                                 <div class="controls">
                                     <input type="text" name="totalfee" id="totalfee"  class="span12" placeholder="Total fee" readonly value="<?php if(isset($_POST['totalfee'])) echo $_POST['totalfee']; ?>">
                                 </div>
                               </div>
                               <div class="control-group span6 left-0">
                                 <label class="control-label" for="password5">Payment Mode *</label>
                                 <div class="controls">
                                     <select name="paymentMode" id="paymentMode" class="span12" onchange="CheckPaymentMode(this.value);">
                                            <option value="">Select Payment Mode</option>
                                            <option value="1" <?php if(isset($_POST['paymentMode']) && $_POST['paymentMode']=='1'){ echo "selected"; } ?>>Payment Gateway</option>
                                            <option value="2" <?php if(isset($_POST['paymentMode']) && $_POST['paymentMode']=='2'){ echo "selected"; } ?>>Paid already</option>
                                            <option value="3" <?php if(isset($_POST['paymentMode']) && $_POST['paymentMode']=='3'){ echo "selected"; } ?>>SWS</option>
                                    </select>
                                 </div>
                               </div>
                               <div class="control-group span6 left-0 alreadyPaidArea" style="display:none;">
                                    <label class="control-label" for="password5">Payment Mode *</label>
                                    <div class="controls">
                                        <select name="payment_type" id="payment_type" class="span12" onchange="checkPaymentType(this.value);">
                                              <option value="">Select Payment Type</option>
                                                <option value="cash" <?php if(isset($_POST['payment_type']) && $_POST['payment_type']=='cash') { echo "selected"; } ?> >Cash Deposit</option>
                                                <option value="cheque" <?php if(isset($_POST['payment_type']) && $_POST['payment_type']=='cheque') { echo "selected"; } ?> >Cheque</option>
                                                <option value="neft" <?php if(isset($_POST['payment_type']) && $_POST['payment_type']=='neft') { echo "selected"; } ?>>NEFT</option>
                                      </select>
                                    </div>
                                  </div>
                               <div class="row-fluid cheque" <?php if(isset($_POST['payment_type'])) { if($_POST['payment_type']=='neft') { echo 'style="display:none;"'; } } else { echo 'style="display:none;"'; }  ?>>
                                <div class="control-group span6 left-0">
                                  <label class="control-label" for="password5">Cheque *</label>
                                  <div class="controls">
                                    <input type="text" name="cheque" id="cheque" class="span12 " placeholder="Cheque No."  value="<?php if(isset($_POST['cheque_no'])) echo $_POST['cheque']; ?>" />
                                  </div>
                                </div>
                                </div>
                                <div class="row-fluid neft" <?php if(isset($_POST['payment_type'])){ if($_POST['payment_type']=='cheque'){ echo 'style="display:none;"'; } }else{ echo 'style="display:none;"'; }  ?>>
                                    <div class="control-group span6 left-0">
                                      <label class="control-label" for="password5">NEFT / RTGS *</label>
                                      <div class="controls">
                                        <input type="text" name="utrno" id="utrno" class="span12" placeholder="UTR No."  value="<?php if(isset($_POST['utrno'])) echo $_POST['utrno']; ?>"/>
                                      </div>
                                    </div>
                                    <div class="control-group span6 left-0">
                                      <label class="control-label" for="password5">NEFT / RTGS Date *</label>
                                      <div class="controls">
                                        <input type="text" name="date1" id="date1" class="span12 custom-dt" placeholder="NEFT / RTGS Date"  value="<?php if(isset($_POST['date1'])) echo $_POST['date1']; ?>" readonly style="cursor: pointer;"/>
                                      </div>
                                    </div>
                                </div>
                                <div class="row-fluid bank" <?php if(isset($_POST['payment_type'])){ if($_POST['payment_type']=='cheque' || $_POST['payment_type']=='neft'){ echo 'style="display:block;"'; } else { echo 'style="display:none;"'; } }else{ echo 'style="display:none;"'; }  ?>>
                                    <div class="control-group span6 left-0">
                                      <label class="control-label" for="password5">Bank Name *</label>
                                      <div class="controls">
                                        <input type="text" name="bank" id="bank" class="span12" placeholder="Bank Name"  value="<?php if(isset($_POST['bank'])) echo $_POST['bank']; ?>"/>
                                      </div>
                                    </div>
                                    <div class="control-group span6 left-0">
                                      <label class="control-label" for="password5">Paid Amount *</label>
                                      <div class="controls">
                                        <input type="text" name="amount" id="amount" class="span12" placeholder="Paid Amount"  value="<?php if(isset($_POST['amount'])) echo $_POST['amount']; ?>" readonly/>
                                      </div>
                                    </div>
                                </div>
                                <div class="row-fluid sws" <?php if(isset($_POST['payment_type'])){ if($_POST['payment_type']=='cash'){ echo 'style="display:block;"'; } else { echo 'style="display:none;"'; } } else{ echo 'style="display:none;"'; }  ?>>
                                    <div class="control-group span6 left-0">
                                      <label class="control-label" for="password5">Paid Date *</label>
                                      <div class="controls">
                                        <input type="text" name="paiddate" id="paiddate" class="span12 custom-dt" placeholder="Payment Date"  value="<?php if(isset($_POST['paiddate'])) echo $_POST['paiddate']; ?>" readonly style="cursor: pointer;"/>
                                      </div>
                                    </div>
                                    <div class="control-group span6 left-0">
                                      <label class="control-label" for="password5">Paid Amount *</label>
                                      <div class="controls">
                                        <input type="text" name="swsamount" id="swsamount" class="span12" placeholder="Paid Amount"  value="<?php if(isset($_POST['amount'])) echo $_POST['amount']; ?>" readonly/>
                                      </div>
                                    </div>
                                    <div class="control-group span6 left-0">
                                      <label class="control-label" for="password5">Cash Deposit Slip *</label>
                                      <div class="controls">
                                          <input type="file" class="span12" name="cashrecipt" id="cashrecipt" onchange="checkfileSize4();"/>
                                      </div>
                                    </div>
                                </div>
                           </div>
                            <div class="form-actions no-margin">
                                <span class="form-errors" id="secondStepError"></span>
                                <input type="button" value="Next Step" class="btn btn-info pull-right" onclick="showSecondStep('2');" name="submit2" id="submit2">
                              <div class="clearfix"></div>
                            </div>
                           
                       </div>    
                       <div class="" id="thirdStep1" style="display:none;">
                           
                            <div class="row-fluid">
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Referral ENR No *</label>
                                    <div class="controls">
                                        <input type="text" name="refno" id="refno" placeholder="Referral ENR No. / Self" class="span12" value="<?php if(isset($_POST['refno'])) echo $_POST['refno']; ?>" onblur="checkRefMobileNo();">
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Gender *</label>
                                    <div class="controls">
                                        <select name="gender" id="gender" class="span12">
                                                <option value="">Select Gender</option>
                                                <option value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=='Male') { echo "selected"; } ?> >Male</option>
                                                <option value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=='Female') { echo "selected"; } ?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">DOB *</label>
                                    <div class="controls">
                                        <input type="text" name="dob" id="dob"  class="span12" placeholder="Date of birth" value="<?php if(isset($_POST['dob'])) echo $_POST['dob']; ?>" readonly style="cursor: pointer;">
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Address1 *</label>
                                    <div class="controls">
                                        <input type="text" name="address1" id="address1" class="span12" placeholder="Address 1st line" value="<?php if(isset($_POST['address1'])) echo $_POST['address1']; ?>">
                                    </div>
                                </div>  
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Address2</label>
                                    <div class="controls">
                                        <input type="text" name="address2" id="address2" class="span12" placeholder="Address 2nd line" value="<?php if(isset($_POST['address2'])) echo $_POST['address2']; ?>">
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Select State *</label>
                                    <div class="controls">
                                        <select name="state" id="state" class="span12">
                                            <option value="">Select State</option>
                                            <?php
                                            $objM=new Member();
                                            
                                            if(isset($_POST['state']) && $_POST['state']==$data['name'])
                                            {
                                                $result=$objM->getStateByCountryId($_POST['country']);
                                            } 
                                            else 
                                            {
                                                $result=$objM->getStateByCountryId(99);
                                            }
                                            while($data=$result->fetch_assoc())
                                            {
                                                    $selected3 = '';
                                                     if(isset($_POST['state']) && $_POST['state']==$data['name']){

                                                            $selected3 = 'selected'; 

                                                     } 
                                                    ?> 
                                                    <option value="<?php echo $data['name']; ?>" <?php echo $selected3; ?>><?php echo $data['name']; ?></option>
                                                    <?php
                                            }
                                            ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">City *</label>
                                    <div class="controls">
                                       <input name="city" id="city" class="span12" type="text" placeholder="City" value="<?php if(isset($_POST['city'])) echo $_POST['city']; ?>">
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Pincode *</label>
                                    <div class="controls">
                                        <input type="text" name="pincode" id="pincode" class="span12" placeholder="Pin code" value="<?php if(isset($_POST['pincode'])) echo $_POST['pincode']; ?>">
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Upload Photo </label>
                                    <div class="controls">
                                        <input type="file" name="user_pic" id="user_pic" class="span12" value="<?php if(isset($_POST['user_pic'])) echo $_POST['user_pic']; ?>">	
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Upload Address Proof </label>
                                    <div class="controls">
                                        <input type="file" name="addressproof" id="addressproof" class="span12" placeholder="" value="<?php if(isset($_POST['addressproof'])) echo $_POST['addressproof']; ?>" >	
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Upload Edu. Cert. </label>
                                    <div class="controls">
                                        <input type="file" name="edu" id="edu" class="span12" placeholder="" value="<?php if(isset($_POST['edu'])) echo $_POST['edu']; ?>">
										
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="control-group span12 left-0">
                                        <label class="control-label" for="password5"><b>Do You Want To Be PA </b> </label>
                                        <div class="controls">
                                            <input type="radio" name="radio" id="radio1" class="radio"  value="yes" onclick="checkPa(this.value);" <?php if(isset($_POST['radio']) && $_POST['radio']=='yes'){ echo "checked"; }  ?>> YES
                                            <input type="radio" name="radio" id="radio2"  value="no" onclick="checkPa(this.value);" <?php if(isset($_POST['radio']) && $_POST['radio']=='no'){ echo "checked"; }  ?> > NO

                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div class="row-fluid paArea" <?php if(isset($_POST['radio'])){ if($_POST['radio']=='no'){ echo 'style="display:none;"'; } }else{ echo 'style="display:none;"'; }  ?>>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Bank Name</label>
                                    <div class="controls">
                                        <input type="text" name="bank_name" id="bank_name" class="span12" placeholder="Bank Name" value="<?php if(isset($_POST['bank_name'])) echo $_POST['bank_name']; ?>">
										
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Account No</label>
                                    <div class="controls">
                                        <input type="text" name="bank_ac" id="bank_ac" class="span12" placeholder="Bank Account No." value="<?php if(isset($_POST['bank_ac'])) echo $_POST['bank_ac']; ?>">
										
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">IFSC Code</label>
                                    <div class="controls">
                                        <input type="text" name="ifsc" id="ifsc" class="span12" placeholder="IFSC" value="<?php if(isset($_POST['ifsc'])) echo $_POST['ifsc']; ?>">
										
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Branch Area</label>
                                    <div class="controls">
                                        <input type="text" name="cityofbranch" id="cityofbranch" class="span12" placeholder="City of branch" value="<?php if(isset($_POST['cityofbranch'])) echo $_POST['cityofbranch']; ?>">
										
                                    </div>
                                </div>
                                <div class="control-group span6 left-0">
                                    <label class="control-label" for="password5">Pan No</label>
                                    <div class="controls">
                                        <input type="text" name="panno" id="panno" class="span12" placeholder="Pan No." value="<?php if(isset($_POST['panno'])) echo $_POST['panno']; ?>">
										
                                    </div>
                                </div>
                           </div>
                           <div class="form-actions no-margin">
                               <input type="hidden" name="paymentStatus" id="paymentStatus" value="<?php if(isset($_POST['paymentStatus'])) echo $_POST['paymentStatus']; ?>">
                                <span class="form-errors" id="secondThirdError"></span>
                                <input type="submit" value="Submit" class="btn btn-info pull-right" onclick="return showSecondStep('3');" name="submit3" id="submit3">
								<button type="button" id="processbtn"  class="btn btn-success btn-lg pull-right" style="display:none;"><img src="../img/loading.gif" width="15px" height="15px"></button>
                              <div class="clearfix"></div>
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
    
    <script src="<?php echo BASEPATH; ?>js/validatesubmit.js"></script>
    
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
        $("#dob").datepicker({dateFormat:'yy-mm-dd',maxDate:"<?php $cdate=date('Y-m-d'); echo date('Y-m-d', strtotime($cdate.'-18 years'));?>",changeYear: true,changeMonth: true,yearRange: '1900:2017',});
    });
    
    function showSecondStep(step)
    {
        if(step==1)
        {
            var email = $('#email').val();
            var phone = $('#phone').val();
            var password  = $('#password').val();
            var first_name  = $('#first_name').val();
            var last_name  = $('#last_name').val();

            if(!email)
            {
                $("#firstStepError").html('Please enter email Id.');
                $("#firstStepError").show();
                $("#email").focus();
                return false;
            }
            else if (!IsEmail(email)) 
            {
                $("#firstStepError").html('Please enter valid email.');
                $("#firstStepError").show();
                $("#email").focus();
                return false;
            }
            else if(!phone)
            {
                $("#firstStepError").html('Please enter mobile no.');
                $("#firstStepError").show();
                $("#phone").focus();
                return false;
            }
            else if(phone.length!=10)
            {
                $("#firstStepError").html('Please enter 10 digit mobile no.');
                $("#firstStepError").show();
                $("#phone").focus();
                return false;
            }
            else if(!password)
            {   
                $("#firstStepError").html('Please enter password.');
                $("#firstStepError").show();
                $("#phone").focus();
                return false;
            }
            else if(password.length<8)
            {
                $("#firstStepError").html('password must be 8 characters long.');
                $("#firstStepError").show();
                $("#password").focus();
                return false;
            }
            else if(password.length>=8 && !IsPassword(password))
            {
                $("#firstStepError").html('password must be at least 1 uppercase alphabet, 1 lowercase alphabet, 1 number and 1 special character.');
                $("#firstStepError").show();
                $("#password").focus();
                return false;
            }
            else if(!first_name)
            {
                $("#firstStepError").html('Please enter first name.');
                $("#firstStepError").show();
                $("#first_name").focus();
                return false;
            }
//            else if(!last_name)
//            {
//                $("#firstStepError").html('Please enter last name.');
//                $("#firstStepError").show();
//                $("#last_name").focus();
//                return false;
//            }
            else
            {
                $.post("../ajax/ajax-member.php",{
                    q:'checkUserEmail',
                    email:email,
                    phone:phone,
                    },function(data){
                        //alert(data);
                    var rt = data.split('^');
                    if(rt[1]>0 && rt[2]>0)
                    {
                        $("#firstStepError").html('Email-Id & Mobile no. already exists.');
                        $("#firstStepError").show();
                        $("#email").focus();
                        return false;
                    }
                    else if(rt[1]>0 && rt[2]==0)
                    {
                        $("#firstStepError").html('Email-Id already exists.');
                        $("#firstStepError").show();
                        $("#email").focus();
                        return false;
                    }
                    else if(rt[1]==0 && rt[2]>0)
                    {
                        $("#firstStepError").html('Mobile no already exists.');
                        $("#firstStepError").show();
                        $("#mobile").focus();
                        return false;
                    }
                    else
                    {
                        $("#firstStepError").html('');
                        $('#firstStep').hide('slow');
                        $('#secondStep').show('slow');
                    }
                });
            }
        }
        else if(step==2)
        {
            var coursecatgory = $('#coursecatgory').val();
            var course = $('#course').val();
            var paymentMode = $('#paymentMode').val();
            var payment_type  = $('#payment_type').val();
            var cheque_no  = $('#cheque').val();
            var bank  = $('#bank').val();
            var amount  = $('#amount').val();
            var utrno  = $('#utrno').val();
            var date1  = $('#date1').val();
            var paymentStatus  = $('#paymentStatus').val();
            var swsamount=$("#swsamount").val();
            var paiddate=$("#paiddate").val();
            var filename = $("#cashrecipt").val().replace(/.*(\/|\\)/, '');
            var cashrecipt = filename;
            
            if(!coursecatgory)
            {
                $("#secondStepError").html('Please select course category.');
                $("#secondStepError").show();
                $("#coursecatgory").focus();
                return false;
            } 
            else if(!course)
            {
                $("#secondStepError").html('Please select level.');
                $("#secondStepError").show();
                $("#course").focus();
                return false;
            }
            else if(!paymentMode)
            {
                $("#secondStepError").html('Please select payment mode.');
                $("#secondStepError").show();
                $("#paymentMode").focus();
                return false;
            }
            else if(paymentMode=='2')
            {
                if(!payment_type)
                {
                    $("#secondStepError").html('Please select payment type.');
                    $("#secondStepError").show();
                    $("#payment_type").focus();
                    return false;
                }
                else if(payment_type=='cheque')
                {
                    if(!cheque_no)
                    {
                        $("#secondStepError").html('Please enter cheque no.');
                        $("#secondStepError").show();
                        $("#cheque").focus();
                        return false;
                    }
                    else if(!bank)
                    {
                        $("#secondStepError").html('Please enter bank name.');
                        $("#secondStepError").show();
                        $("#bank").focus();
                        return false;
                    }
                    else if(!amount)
                    {
                        $("#secondStepError").html('Please enter amount.');
                      	$("#secondStepError").show();
      			            $("#amount").focus();
                        return false;
                    }
                    else
                    {
                        $("#secondStepError").html('');
                        $('#firstStep').hide('slow');
                        $('#secondStep').hide('slow');
                        $('#thirdStep1').show();
                        setTimeout(function(){ getStatListById(); }, 3000);
                    }
                }
                else if(payment_type=='neft')
                {
                    if(!utrno)
                    {
                        $("#secondStepError").html('Please enter URT No.');
                        $("#secondStepError").show();
                        $("#utrno").focus();
                        return false;
                    }
                    else if(!date1)
                    {
                        $("#secondStepError").html('Please select date.');
                        $("#secondStepError").show();
            		$("#date1").focus();
                        return false;
                    }
                    else if(!bank)
                    {
                        $("#secondStepError").html('Please enter bank name.');
                        $("#secondStepError").show();
                        $("#bank").focus();
                        return false;
                    }
                    else if(!amount)
                    {
                        $("#secondStepError").html('Please enter amount.');
            	          $("#secondStepError").show();
			                  $("#amount").focus();
                        return false;
                    }
                    else
                    {
                        $("#secondStepError").html('');
                        $('#firstStep').hide('slow');
                        $('#secondStep').hide('slow');
                        $('#thirdStep1').show(); 
                        setTimeout(function(){ getStatListById(); }, 3000);
                    }
            	}
                else if(payment_type=='cash')
                {
                    if(paiddate=='')
                    {
                        $("#secondStepError").html('Please select paid date.');
                        $("#secondStepError").show();
                        $("#paiddate").focus();
                        return false;
                    }
                    else if(cashrecipt=='')
                    {
                        $("#secondStepError").html('Please upload cash receipt.');
                        $("#secondStepError").show();
                        $("#cashrecipt").focus();
                        return false;
                    }
                    else
                    {
                        $("#secondStepError").html('');
                        $('#firstStep').hide('slow');
                        $('#secondStep').hide('slow');
                        $('#thirdStep1').show(); 
                        setTimeout(function(){ getStatListById(); }, 3000);
                    }
                }
            }
            else if(paymentMode=='1' && paymentStatus=='')
            {
                checkStatus();
            }
            else
            {
                $("#secondStepError").html('');	
                $('#firstStep').hide('slow');
                $('#secondStep').hide('slow');
                $('#thirdStep1').show();
                setTimeout(function(){ getStatListById(); }, 3000);
            }		
        }
        else if(step==3)
	{
            var refno = $('#refno').val();
            var  pa = $('input[name="radio"]:checked').val();
            var gender = $('#gender').val();
            var dob = $('#dob').val();
            var age=0;
            if(dob!='') 
            {
                dob = new Date(dob);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            }
            
            var address1 = $('#address1').val();
            var state = $('#state').val();
            var city = $('#city').val();
            var pincode = $('#pincode').val();
            var panno = $('#panno').val();
            var bank_ac = $('#bank_ac').val();
            var ifsc = $('#ifsc').val();
            var cityofbranch = $('#cityofbranch').val();
            var bank_name = $('#bank_name').val();
            
            if(!refno)
            {			
                $("#secondThirdError").html('Please enter Referral ENR No.');
                $("#secondThirdError").show();
                $("#refno").focus();
                return false;
            }
            else if(!refno.length==10 && refno.toLowerCase()!='self')
            {			
                $("#secondThirdError").html('Please enter 10 digit Referral ENR No.');
                $("#secondThirdError").show();
                $("#refno").focus();
                return false;
            }
            else if(!gender)
            {			
                $("#secondThirdError").html('Please enter gender.');
        	$("#secondThirdError").show();
		$("#gender").focus();
                return false;
            }
            else if(!dob)
            {			
                $("#secondThirdError").html('Please enter date of birth.');
                $("#secondThirdError").show();
                $("#dob").focus();
                return false;
            }
            else if(age<18)
            {
                $("#secondThirdError").html('You are under 18 year, please verify your date of birth.');
                $("#secondThirdError").show();
                $("#dob").focus();
                return false;
            }
            else if(!address1)
            {			
                $("#secondThirdError").html('Please enter address1.');
                $("#secondThirdError").show();
                $("#address1").focus();
                return false;
            }
            else if(!state)
            {			
                $("#secondThirdError").html('Please select state.');
                $("#secondThirdError").show();
                $("#state").focus();
                return false;
            }
            else if(!city)
            {			
                $("#secondThirdError").html('Please select city.');
                $("#secondThirdError").show();
                $("#city").focus();
                return false;
            }
            else if(!pincode)
            {			
                $("#secondThirdError").html('Please enter pincode.');
                $("#secondThirdError").show();
                $("#pincode").focus();
                return false;
            }
            else if(pincode.length!=6)
            {			
                $("#secondThirdError").html('Please enter valid picode.');
                $("#secondThirdError").show();
                $("#pincode").focus();
                return false;
            }
            else if(!pa)
            {			
                $("#secondThirdError").html('Please select PA.');
                $("#secondThirdError").show();
                $("#radio1").focus();
                return false;
            }
            else if(pa=='yes')
            {
                /*
                if(!panno)
                {
                    $("#secondThirdError").html('Please enter pan no.');
                    $("#secondThirdError").show();
                    $("#radio1").focus();
                    return false;
                }
                else if(!bank_ac)
                {
                    $("#secondThirdError").html('Please enter bank account no.');
                    $("#secondThirdError").show();
                    $("#bank_ac").focus();
                    return false;
                }
                else if((!bank_ac>10) && (!bank_ac<18))
                {
                    $("#secondThirdError").html('Please bank account no must be contain 10 to 18 digit.');
                    $("#secondThirdError").show();
                    $("#bank_ac").focus();
                    return false;
                }
                else if(!ifsc)
                {
                    $("#secondThirdError").html('Please enter IFSC.');
                    $("#secondThirdError").show();
                    $("#ifsc").focus();
                    return false;
                }
                else if(!cityofbranch)
                {
                    $("#secondThirdError").html('Please enter city of branch.');
                    $("#secondThirdError").show();
                    $("#cityofbranch").focus();
                    return false;
                }
                else if(!bank_name)
                {
                    $("#secondThirdError").html('Please enter bank name.');
                    $("#secondThirdError").show();
                    $("#bank_name").focus();
                    return false;
                }
                else
                {
                    /* $.post("<?php //echo get_site_url(); ?>/admission/",{
                            q:'checkAgeAndPanNo',
                            dob:dob,
                            panno:panno,
                            },function(data){
                        alert(data);
                    ); 

                    $("#secondThirdError").html('');
                    return true;
                }
                */
                $("#secondThirdError").html('');
                return true;
            }
            else
            {
				$("#submit3").hide("fast");
				$("#processbtn").show("fast");
                $("#secondThirdError").html('');
                $( "#paymentform").submit();
                return true;
            }
	}
    }
    
function getCousebycatId()
{
    var coursecatgory=$("#coursecatgory").val();
    
    $.post("../ajax/ajax-member.php",{
        q:'getCousebycatId',
        coursecatgory:coursecatgory,
        },function(data){
        $("#course").html(data);    
    });
}
function checkStatus()
{
	$('#myModal').modal('show');
}
function getStatListById()
{
    var countryId=$("#country").val();
    var country=countryId.split('^');
    
    $.post("../ajax/ajax-member.php",{
        q:'getStatListById',
        countryId:country[0],
        },function(data){
        $("#state").html(data);    
    });
}
function IsEmail(email) {
	
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function IsPassword(pass) {
	
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/;
    return regex.test(pass);
}
function getPaymentStatus(status)
{
	$('#paymentStatus').val(status);
	$('#myModal').modal('hide');
}
function calculateFee(data)
{
	var data1 = data.split('^');
	
	var amount = parseFloat(data1[0]);
	
	$('#fee').val(amount.toFixed(2));
	
	var tax = (amount*<?php echo $get_tax;?>)/100; 
        
  var totalfee=amount+tax;
	
	$('#service_tax').val(tax.toFixed(2));
	
	$('#totalfee').val(totalfee.toFixed(2));
	
  $('#amount').val(totalfee.toFixed(2));
}

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
function checkPa(type)
{
    if(type=='yes')
    {
        $('.paArea').show('slow');
    }
    else
    {
        $('.paArea').hide('slow');
    }
}


function checkRefMobileNo()
{
	var refno = $('#refno').val();

	if((refno!="") && (refno.toLowerCase()!='self'))
	{
		$.post("../ajax/ajax-member.php",{
			q:'checkRefMobileNo',
			refno:refno,
			},function(data){
				var rt = data.split('^');
				
				if(rt[1]!="1")
				{
					$("#secondThirdError").html('Referral ENR No. does not exists.');
					$("#secondThirdError").show();
					
					alert("Referral ENR No. does not exists.");
					//$("#refno").focus();
					
					$("#refno").val('');
					
					//return false;
				}
			})
	}
	
}
</script>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Payment Status</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <input type="radio" name="payradio" id="payradio1" value="1" onclick="getPaymentStatus(this.value);" > Paid
            <input type="radio" name="payradio" id="payradio2" value="0" onclick="getPaymentStatus(this.value);" > Unpaid
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  </body>
</html>
<style type="text/css">
 /* #secondStep,#thirdStep1
  {
    display: block !important;
  }*/
</style>