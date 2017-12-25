<?php 
$flag=false;
$category_url=0;
$course_url=0;
if(isset($_GET['cat']))
{
  $flag=true;
  $category_url=base64_decode($_GET['cat']);
  $course_url=base64_decode($_GET['cou']);
}

?>

<!DOCTYPE html>
<html>
<head>
<title>School Of Forex Trading, Commodity Trading, Binary Options Trading</title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<link href="css/bootsnav.css" type="text/css" rel="stylesheet" media="all">
<link href="css/font-awesome.css" type="text/css" rel="stylesheet" media="all">
<link href="css/owl.theme.default.css" type="text/css" rel="stylesheet" media="all">
<link href="css/owl.carousel.css" type="text/css" rel="stylesheet" media="all">
<link href="css/animations.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootsnav.js"></script>
<script src="js/owl.carousel.js"></script>

<!-- //js -->
</head>
<body>
<!--header-->
<?php include 'include/header.php'; ?>
<!--//header-->
<?php 
$obj=new Common();

$get_tax=$obj->getservicetax();

if(isset($_POST['submit3']))
{
    $uplodepath = 'mypanel/userdocs/';
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

                $path='mypanel/userdocs'.'/'.$user_id.'/';

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

        $resS=$objM->saveStudentCourseRequest($user_id,$courseid,$level_name,'',$service_tax,$totFee,$paymentMode,$payment_type,$cheque,$utrno,$date1,$bank,$amount,$cashrecipt,'0');
		
    if($paymentMode=='1')
    {
        $_SESSION['tru_user_id']=$user_id;
        $_SESSION['tru_pid']=$password;
        
        $to = 'support@forcica.com';
        $subject = 'New Admission - Forcica';
        
        $message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
        $message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
        $message .='<b>Dear Admin,</b><br><br>';
        $message .="New admission request has been generated. Student admission details are as follows : - <br><br>";

        $message .="Name : ".$first_name." ".$last_name." <br>";
        $message .="Email : ".$user_email." <br>";
        $message .="Phone : ".$phone1." <br>";
        $message .="Ref. No : ".$refno." <br>";
        $message .="Address 1 : ".$address1." <br>";
        if($address2!='') {
            $message .="Address 2 : ".$address2." <br>";
        }
        $message .="City, State, Country - Pincode : ".$city.", ".$state.", ".$country." - ".$pincode." <br>";

        $message .="Want to become PA  : ".$_POST['radio']." <br><br>";

        $message .="<b>Course details are as follows : - </b><br><br>";
        $message .="Course : ".$level_name." <br>";
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
        
        
        ?>
        <script>
        window.location.href="trupay_payment.php";
        </script>
    <?php
    }
    else
    {
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
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: Forcica  <support@forcica.com> \r\n";
            @mail($to, $subject, $message, $headers);
            
            
            
            $to = 'support@forcica.com';
            $subject = 'New Admission - Forcica';
            $message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
            $message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
            $message .='<b>Dear Admin,</b><br><br>';
            $message .="New admission request has been generated. Student admission details are as follows : - <br><br>";
            
            $message .="Name : ".$first_name." ".$last_name." <br>";
            $message .="Email : ".$user_email." <br>";
            $message .="Phone : ".$phone1." <br>";
            $message .="Ref. No : ".$refno." <br>";
            $message .="Address 1 : ".$address1." <br>";
            if($address2!='') {
                $message .="Address 2 : ".$address2." <br>";
            }
            $message .="City, State, Country - Pincode : ".$city.", ".$state.", ".$country." - ".$pincode." <br>";
            
            $message .="Want to become PA  : ".$_POST['radio']." <br><br>";
            
            $message .="<b>Course details are as follows : - </b><br><br>";
            $message .="Course : ".$level_name." <br>";
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
            $message .="Payment Mode : ".$paymentMethod." <br> <br>Kindly check and update student details from forcica admin panel";
            
            $message .='With Best Regards<br>Forcica';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: Forcica  <support@forcica.com> \r\n";
            @mail($to, $subject, $message, $headers);
        }
    }
}    
    unset($_SESSION['ErrorMessage']);
    ?>
    <script>
    alert('Your Details has been saved successfully.');
    window.location.href="index.php";
    </script>
    <?php
 
}

?>





<!--banner-->
<div class="inner-banner" style="background:url(images/admission-bg.jpg);"> 
<div class="container">
<h1>Admission</h1>
<div class="breadcrumb"><a href="index.php"> HOME </a> / Admission</div>
</div>   
</div>
<!--//banner-->

<!--Admission-->
<div class="admission-wrap">
<div class="container text-left">
<div class="form-box">
<form id="msform" class="clearfix" id="paymentform" action="" enctype="multipart/form-data" method="POST">
<ul id="progressbar">
<li id="stp1" class="active">Step 1</li>
<li id="stp2">Step 2</li>
<li id="stp3">Step 3</li>
</ul>
<!-- <div id="form1"> -->
<fieldset id='tst_fieldset1'>
<div class="row text-left">
<div class="col-xs-12 col-sm-6 col-md-6">
<label>E-mail ID *</label>
<input name="email" id="email" type="text"  placeholder="Enter E-mail ID"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Mobile Number *</label>
<input name="phone" id="phone" type="text" maxlength="15" placeholder="Your Mobile Number"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Password *</label>
<input name="password" id="password" type="password" placeholder="Enter Your Password *"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>First Name *</label>
<input name="first_name" id="first_name" type="text" placeholder="Enter First Name *"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Last Name *</label>
<input name="last_name" id="last_name" type="text" placeholder="Enter Last Name *"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Country of Residence *</label>
<select name="country" id="country">
<option value="">Select Country</option>
<?php 
$obj=New Common();
$coun_query=$obj->getAllCountryList();

while($coun_list=$coun_query->fetch_assoc())
{
	if($coun_list['country_id']==99)
    {
        $selected = 'selected';  
    }else
    {
    	$selected='';
    }
	echo '<option value="'.$coun_list['country_id'].'^'.$coun_list['name'].'" '.$selected.'>'.$coun_list['name'].'</option>';
}
?>
</select>
</div>
</div>
<input type="hidden" name="chk1" id="chk1" value="1">
<div class="form-errors" id="firstStepError"></div>
<input type="button" name="firstform" id="fstform" onclick="frstform();" class="action-button" value="Next" />
</fieldset>
<!-- </div> -->

<fieldset id='tst_fieldset2'>
<div class="row text-left">
<div class="col-xs-12 col-sm-6 col-md-6"><label>Course Category *</label>
<!-- <select name="">
<option value="">Forex Trading</option> 
</select> -->
<select name="coursecatgory" id="coursecatgory" onchange="getCousebycatId();">
<option value="">Select Course Category</option>
<?php
    $obj=new Common();
    $coursecatRes=$obj->getAllCategory();
    while($rescat=$coursecatRes->fetch_assoc()) 
    {
      if($flag){if($rescat['Id']==$category_url){ $cat_selected="selected";}else{ $cat_selected="";}}
       ?>
<option value="<?php echo $rescat['Id']; ?>" <?php echo $cat_selected;?>><?php echo $rescat['categoryname']; ?></option>
<?php
    }
?>
</select>
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Level *</label>
<!-- <select name="">
<option value="">Sr. Secondary</option> 
</select> -->
<select name="course" id="course" onchange="calculateFee(this.value);">
<option value="">Select the Level</option>
<?php
    $obj=new Common();
    $coursecatRes=$obj->getAllCourseByCatId($_POST['coursecatgory']);
    while($rescat1=$coursecatRes->fetch_assoc()) 
    {
      if($flag){if($rescat1['Id']==$course_url){ $selected1="selected";}else{ $selected1="";}}
      
?>
<option value="<?php echo $rescat1['price'].'^'.$rescat1['Id'].'^'.$rescat1['coursename']; ?>" <?php echo $selected1; ?>><?php echo $rescat1['coursename'].$rescat1['Id'].$course_url; ?></option>
<?php
    }
?>  
</select>

</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Fee*</label>
<input type="text" name="fee" id="fee" placeholder="Fee" readonly>
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Service Tax  *</label>
<input type="text" name="service_tax" id="service_tax" placeholder="Service Tax" readonly>
<!-- <input name="name" type="text" placeholder="15000.00"> -->
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Total Fee *</label>
<input type="text" name="totalfee" id="totalfee" placeholder="Total fee" readonly>
<!-- <input name="name" type="text" placeholder="115000.00"> -->
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Payment Mode *</label>
<select name="paymentMode" id="paymentMode" onchange="CheckPaymentMode(this.value);">
<option value="">Select Payment Mode</option>
 <option value="1">Online Payment</option> 
<option value="2">Paid already</option>
<option value="3">SWS</option>
</select>
<!-- <select name="">
<option value="">Paid Already</option> 
</select> -->
</div>
<div class="col-xs-12 col-sm-6 col-md-6 alreadyPaidArea" style="display:none;">
<label>Payment Mode *</label>
<select name="payment_type" id="payment_type" onchange="checkPaymentType(this.value);">
      <option value="">Select Payment Type</option>
      <option value="cash">Cash Deposit</option>
      <option value="cheque">Cheque</option>
      <option value="neft">NEFT</option>
</select>
</div>

<div class="col-xs-12 col-sm-6 col-md-6 cheque">
<label>Cheque *</label>
<input type="text" name="cheque" id="cheque" placeholder="Cheque No."/>
</div>

 <div class="neft">
<div class="col-xs-12 col-sm-6 col-md-6">
 <label>NEFT / RTGS *</label>
 <input type="text" name="utrno" id="utrno" placeholder="UTR No."/>
 </div>
<div class="col-xs-12 col-sm-6 col-md-6">
  <label>NEFT / RTGS Date *</label>
  <input type="text" name="date1" id="date1" class="custom-dt" placeholder="NEFT / RTGS Date" readonly style="cursor: pointer;"/>
</div>
</div>
<div class="bank">
<div class="col-xs-12 col-sm-6 col-md-6">
  <label>Bank Name *</label>
  <input type="text" name="bank" id="bank" placeholder="Bank Name"/>
  
</div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Paid Amount *</label>
<input type="text" name="amount" id="amount" placeholder="Paid Amount" readonly/>
  
</div>

 <div class="sws">
    <div class="col-xs-12 col-sm-6 col-md-6">
      <label>Paid Date *</label>
      <input type="text" name="paiddate" id="paiddate" class="custom-dt" placeholder="Payment Date"   readonly style="cursor: pointer;"/>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
      <label>Paid Amount *</label>
      <input type="text" name="swsamount" id="swsamount" class="span12" placeholder="Paid Amount" readonly/>
      </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
      <label>Cash Deposit Slip *</label>
      <input type="file" class="span12" name="cashrecipt" id="cashrecipt" onchange="checkfileSize4();"/>
      </div>
</div>


</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-errors" id="secondStepError"></div>
<input type="button" name="next"  onclick="secondform();" class="action-button" value="Next" />
</div>
</fieldset>

<fieldset id="tst_fieldset3">
<div class="row text-left">
<div class="col-xs-12 col-sm-6 col-md-6"><label>Referral ENR No. *</label>
<input type="text" name="refno" id="refno" placeholder="Referral ENR No. / Self" onblur="checkRefMobileNo();">
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Gender *</label>

<select name="gender" id="gender">
	<option value="">Select Gender</option>
	<option value="Male">Male</option>
	<option value="Female">Female</option>							
</select>
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Date Of Birth *</label>
<input type="text" name="dob" id="dob"  placeholder="Date of birth" readonly style="cursor: pointer;">
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Address 1 *</label>
<input type="text" name="address1" id="address1" placeholder="Address 1st line">
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Address 2 *</label>
<input type="text" name="address2" id="address2" placeholder="Address 2nd line">
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Select State *</label>
 <select name="state" id="state">
    <option value="">Select State</option>
    <?php
    $objM=new Member();
    $result=$objM->getStateByCountryId(99);
    while($data=$result->fetch_assoc())
    { 
    ?> 
    <option value="<?php echo $data['name']; ?>"><?php echo $data['name']; ?></option>
    <?php
    }
    ?>
</select>
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>City *</label>
<input name="city" id="city" type="text" placeholder="City">
</div>

<div class="col-xs-12 col-sm-6 col-md-6"><label>Pincode *</label>
<input type="text" name="pincode" id="pincode" placeholder="Pin code">
</div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Upload Photo *</label>
<span class="form_subject">
<input id="user_pics" placeholder="Upload your photo" disabled="disabled">
<div class="fileUpload up-btn">
<span>Upload</span>
<input type="file" name="user_pic" id="user_pic" class="upload"></div>
</span>
</div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Upload Address Proof *</label>
<span class="form_subject">
<input id="addressproofs" placeholder="Upload your address proof" disabled="disabled">
<div class="fileUpload up-btn">
<span>Upload</span>
<input type="file" name="addressproof" id="addressproof" class="upload"></div>
</span>
</div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Upload Edu. Cert. *</label>
<span class="form_subject">
<input id="edus" placeholder="Upload your educational certificates" disabled="disabled">
<div class="fileUpload up-btn">
<span>Upload</span>
<input id="edu" type="file" name="edu" class="upload"></div>
</span>
</div>
<div class="col-xs-12 col-sm-6 col-md-6"><label>Do you want to be PA *</label>
<input type="radio" name="radio" id="radio1" value="yes" onclick="checkPa(this.value);"> <span class="rd-text">YES</span>
<input type="radio" name="radio" id="radio2"  value="no" onclick="checkPa(this.value);" checked> <span class="rd-text">NO</span>
<!-- <input type="radio" name="" value="" checked> <span class="rd-text">Yes</span>
<input type="radio" name="" value=""> <span class="rd-text">No</span> -->
</div>

<div class="paArea" style="display:none;">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <label>Bank Name</label>
        <input type="text" name="bank_name" id="bank_name" placeholder="Bank Name">
	</div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <label>Account No</label>
        <input type="text" name="bank_ac" id="bank_ac" placeholder="Bank Account No." >
	</div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <label>IFSC Code</label>
        <input type="text" name="ifsc" id="ifsc" placeholder="IFSC">
	</div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <label>Branch Area</label>
        <input type="text" name="cityofbranch" id="cityofbranch" placeholder="City of branch">
	</div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <label>Pan No</label>
        <input type="text" name="panno" id="panno" placeholder="Pan No.">
	</div>
</div>


</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-errors" id="secondThirdError"></div>
<input type="submit" name="submit3" id="submit3"  onclick="return thirdform()" class="action-button" value="Submit" />
<button type="button" id="processbtn"  class="btn btn-success btn-lg pull-right" style="display:none;"><img src="mypanel/img/loading.gif" width="15px" height="15px"></button>

</div>
</fieldset>
</form>
</div>
</div>
</div>
<!--  Trupay
<div id="trupayPaymentFrame"></div>
<button type="button" onclick="getWebSessionKey('ORDERNUMBER1', '10.00','prateek@intouchgroup.in')" class="pay_btn">Pay with Trupay</button>  -->
<!--//Admission-->

<!--Footer-->
<?php include 'include/footer.php'; ?>
<!--//footer-->
<script>
$(document).ready(function() {

  CheckPaymentMode('');

  <?php if(isset($_GET['cat']) && isset($_GET['cou'])) { ?>  
    getCousebycatIdonload();
    setInterval(function(){ calculateFee($('#course').val()); }, 2000);
  <?php } ?>
  $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',});
  $("#dob").datepicker({dateFormat:'yy-mm-dd',maxDate:"<?php $cdate=date('Y-m-d'); echo date('Y-m-d', strtotime($cdate.'-18 years'));?>",changeYear: true,changeMonth: true,yearRange: '1900:2017',});
    $('#phone').bind('keypress', function(e) { 
        return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
    })
    });


   
function getCousebycatIdonload()
{
    var coursecatgory=<?php echo $category_url;?>;
    var course=<?php echo $course_url;?>;
    
    $.post("mypanel/ajax/ajax-member.php",{
        q:'getCousebycatIdonload',
        coursecatgory:coursecatgory,
        course:course
        },function(data){
        $("#course").html(data);    
    });
}
   
function getCousebycatId()
{
    var coursecatgory=$("#coursecatgory").val();
    
    $.post("mypanel/ajax/ajax-member.php",{
        q:'getCousebycatId',
        coursecatgory:coursecatgory,
        },function(data){
        $("#course").html(data);    
    });
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




function frstform()
{
	var i=1;
	var step= $('#chk'+i).val();
	
	if(step==1)
  	 {

  	 		var email = $('#email').val();
            var phone = $('#phone').val();
            var password  = $('#password').val();
            var first_name  = $('#first_name').val();
            var last_name  = $('#last_name').val();
            var country=$('#country').val();

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
           else if(!country)
           {
               $("#firstStepError").html('Please select country name.');
               $("#firstStepError").show();
               $("#country").focus();
               return false;
           }
            else
            {
                $.post("mypanel/ajax/ajax-member.php",{
                    q:'checkUserEmail',
                    email:email,
                    phone:phone,
                    },function(data){
                        
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
						displaynext('1','2');

                    }
                });
            }
     }
    


}


function secondform()
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
                displaynext('2','3');
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
                displaynext('2','3');
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
                displaynext('2','3');
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
        displaynext('2','3');
    }		
        
}
function thirdform()
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
			$("#secondThirdError").html('');
			return true;
		}
		else
		{
			$("#submit3").hide("fast");
			$("#processbtn").show("fast");
			$("#secondThirdError").html('');
			$( "#paymentform").submit(); 

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
		$.post("mypanel/ajax/ajax-member.php",{
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



<script>
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 10) {
        $(".header").addClass("header-bg");
    } else {
        $(".header").removeClass("header-bg");
   }
});
function displaynext(pre,id)
{

	$('#tst_fieldset'+pre).hide('fast');
	$('#tst_fieldset'+id).show('fast');
	$("#stp"+id).addClass("active");
}
function getStatListById()
{
    var countryId=$("#country").val();
    var country=countryId.split('^');
    $.post("mypanel/ajax/ajax-member.php",{
        q:'getStatListById',
        countryId:country[0],
        },function(data){
        $("#state").html(data);    
    });
}

</script>

<script>
		(function( $ ) {

    function doAnimations( elems ) {
        var animEndEv = 'webkitAnimationEnd animationend';
        
        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }
    var $myCarousel = $('#carousel-example-generic'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
        
    $myCarousel.carousel();
    doAnimations($firstAnimatingElems);
    $myCarousel.carousel('pause');
    $myCarousel.on('slide.bs.carousel', function (e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });  
    
	})(jQuery);
		</script>
		<script>
		$('#carousel-example-generic').carousel({
  			interval: 5000,
  			cycle: true
		}); 
		</script>	
		<script>
            $(document).ready(function() {
              $('#testi').owlCarousel({
                loop: true,
                margin:0,
				autoplay: true,
                autoplayTimeout: 5000,
				dots:false,
				nav: true,
				navText: ["<img src='images/left.png'>","<img src='images/right.png'>"],
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true,
                  },
				  480: {
                    items: 1,
                    nav: true,
                  },
				  640: {
                    items: 1,
                    nav: true,
                  },
                  768: {
                    items: 1,
                    nav: true,
                  },
                  1000: {
                    items:1,
                    nav: true,
                  }
                }
              })
            })
</script>

<script>
            $(document).ready(function() {
              $('#proof').owlCarousel({
                loop: true,
                margin:15,
				autoplay: true,
                autoplayTimeout: 5000,
				dots:false,
				nav: true,
				navText: ["<img src='images/left.png'>","<img src='images/right.png'>"],
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false,
                  },
				  480: {
                    items: 1,
                    nav: false,
                  },
				  640: {
                    items:2,
                    nav: false,
                  },
                  768: {
                    items: 2,
                    nav: false,
                  },
                  1000: {
                    items:2,
                    nav: false,
                  }
                }
              })
            })
</script>

<script src="js/css3-animate-it.js"></script>	

<script type="text/javascript">
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>

<!-- jQuery easing plugin -->
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script>
/*var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches*/


/////////////////////  Next Button Code /////////////////////

/*$(".next").click(function(){

	if(firstformvalid())
	{

	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 0, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	}
	
});

/////////////////////  Next Button Code /////////////////////

/////////////////////  Previous Button Code /////////////////////

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 0, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

/////////////////////  Previous Button Code /////////////////////




$(".submit").click(function(){
	return false;
})*/
</script>
<script type="text/javascript">  
/*document.getElementById("uploadBtn").onchange=function () {  
document.getElementById("uploadFile").value = $("#uploadBtn")[0].files[0].name;
}; */
document.getElementById("user_pic").onchange=function () {  
document.getElementById("user_pics").value = $("#user_pic")[0].files[0].name;
};
document.getElementById("addressproof").onchange=function () {  
document.getElementById("addressproofs").value = $("#addressproof")[0].files[0].name;
};
document.getElementById("edu").onchange=function () {  
document.getElementById("edus").value = $("#edu")[0].files[0].name;
};
</script>
<script>
function IsEmail(email) {
	
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function IsPassword(pass) {
	
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/;
    return regex.test(pass);
}
</script>
</body>
</html>	
<style type="text/css">
.form-errors{
	text-align: left;
    color: #ea1313;
    font-size: 15px;
    font-weight: 500;
}

/*#tst_fieldset2,#tst_fieldset1,#tst_fieldset3
{
  display: block !important;
} */
	
</style>
<link href='<?php echo BASEPATH; ?>bootstrap/css/jquery-ui.css' rel='stylesheet' />
<script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-ui-date.js"></script>
