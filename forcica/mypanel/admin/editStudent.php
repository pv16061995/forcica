<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsUser.php');
include_once('../controls/clsMember.php');
include_once('../controls/clsCommon.php');

if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}

//print_r($_SESSION);
$obj=new User();

if(isset($_POST['submit']))
{
    $uid=$_POST['user_id'];
    $password=$_POST['password'];
    
    $first_name=$_POST['first_name'];
    $las_name=$_POST['last_name'];
    
    $email=$_POST['email'];
    $preemail=$_POST['preemail'];
    $phone1=$_POST['phone1'];
    
    $dob=$_POST['dob'];
    $address1=$_POST['address1'];
    $address2=$_POST['address2'];
    $city=$_POST['city'];
    $country=explode('^',$_POST['country']);
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];
    $gender=$_POST['gender'];
    
    $profile_image=$_FILES['profile_image']['name'];
    $preprofile_image=$_POST['preprofile_image'];
    
    $address_proof=$_FILES['address_proof']['name'];
    $preaddress_proof=$_POST['preaddress_proof'];
    
    $education_certificate=$_FILES['education_certificate']['name'];
    $preeducation_certificate=$_POST['preeducation_certificate'];
    
    $path='../userdocs/'.$uid.'/';
    @chmod($path, 0777);
    
    if($profile_image!='')
    {
        $allowedExts = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG");
        $temp = explode(".", $_FILES["profile_image"]["name"]);
        $extension = end($temp);
        if ((($_FILES["profile_image"]["type"] == "image/gif")|| ($_FILES["profile_image"]["type"] == "image/jpeg")|| ($_FILES["profile_image"]["type"] == "image/jpg")|| ($_FILES["profile_image"]["type"] == "image/pjpeg")|| ($_FILES["profile_image"]["type"] == "image/x-png")|| ($_FILES["profile_image"]["type"] == "image/png")) && in_array($extension, $allowedExts))
        {
            @unlink($path.$preprofile_image);
            $profile_image=time().'_'.$_FILES["profile_image"]["name"];
            move_uploaded_file($_FILES["profile_image"]["tmp_name"], $path.$profile_image);
            
            $_SESSION['profile_image']=$profile_image;
        }
        else 
        {
            $profile_image='';
        }
    }
    else 
    {
        $profile_image=$_POST['preprofile_image'];
        $_SESSION['profile_image']=$profile_image;
    }
    
    
    if($address_proof!='')
    {
        $allowedExts = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "DOCX", "DOC", "docx", "doc");
        $temp = explode(".", $_FILES["address_proof"]["name"]);
        $extension = end($temp);
        if ((($_FILES["address_proof"]["type"] == "image/gif")|| ($_FILES["address_proof"]["type"] == "image/jpeg")|| ($_FILES["address_proof"]["type"] == "image/jpg")|| ($_FILES["address_proof"]["type"] == "image/pjpeg")|| ($_FILES["address_proof"]["type"] == "image/x-png") || ($_FILES["address_proof"]["type"] == "image/png") || ($_FILES["address_proof"]["type"] == "application/doc" ) || ($_FILES["address_proof"]["type"] == "application/docx" )) && in_array($extension, $allowedExts))
        {
            @unlink($path.$preaddress_proof);
            $address_proof=time().'_'.$_FILES["address_proof"]["name"];
            move_uploaded_file($_FILES["address_proof"]["tmp_name"], $path.$address_proof);
        }
        else 
        {
            $address_proof='';
        }
    }
    else 
    {
        $address_proof=$_POST['preaddress_proof'];
    }
    
    if($education_certificate!='')
    {
        $allowedExts = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "DOCX", "DOC", "docx", "doc");
        $temp = explode(".", $_FILES["education_certificate"]["name"]);
        $extension = end($temp);
        if ((($_FILES["education_certificate"]["type"] == "image/gif")|| ($_FILES["education_certificate"]["type"] == "image/jpeg")|| ($_FILES["education_certificate"]["type"] == "image/jpg")|| ($_FILES["education_certificate"]["type"] == "image/pjpeg")|| ($_FILES["education_certificate"]["type"] == "image/x-png") || ($_FILES["education_certificate"]["type"] == "image/png") || ($_FILES["education_certificate"]["type"] == "application/doc" ) || ($_FILES["education_certificate"]["type"] == "application/docx" )) && in_array($extension, $allowedExts))
        {
            @unlink($path.$preeducation_certificate);
            $education_certificate=time().'_'.$_FILES["education_certificate"]["name"];
            move_uploaded_file($_FILES["education_certificate"]["tmp_name"], $path.$education_certificate);
        }
        else 
        {
            $education_certificate='';
        }
    }
    else 
    {
        $preeducation_certificate=$_POST['preeducation_certificate'];
    }
    
    $_SESSION['name']=$first_name.' '.$las_name;
    
    if($email!=$preemail)
    {
        $emailcheck=$obj->checkUserEmail($email);
        if($emailcheck->num_rows>0)
        {
            $_SESSION['ErrorMessage']='Email address already exist';
            $email=$preemail;
        } 
        else 
        {
            $email=$email;
        }
    }
    else 
    {
        $email=$preemail;
    }
    
    $paymentData  = $_POST['course'];

    $paymentData = explode('^', $paymentData);

    $level_name = $paymentData[2];
    $courseid = $paymentData[1]; 
    $totFee  = $_POST['totalfee'];
    $service_tax= $_POST['service_tax'];
    $payment_response = $_POST['paymentStatus'];
    
    
    $resP=$obj->updateStudentUserProfile($uid,$password,$email);
    
    $resP2=$obj->updateStudentDetailsProfileAdmin($uid,$first_name,$las_name,$phone1,$dob,$state,$city,$country[1],$address1,$address2,$profile_image,$address_proof,$education_certificate,$gender,$courseid,$totFee,$service_tax);
    
    
    $resPA=$obj->updateStudentBankDetails($uid,$_POST['bank_name'],$_POST['bank_ac'],$_POST['ifsc'],$_POST['cityofbranch'],$_POST['panno']);
    
    
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
                    $cashrecipt=$_POST['precashrecipt'];
                }
            }
            else 
            {
                $cashrecipt=$_POST['precashrecipt'];
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

    $resS=$obj->updateStudentCourseRequest($_POST['paymentId'],$courseid,$level_name,'',$service_tax,$totFee,$paymentMode,$payment_type,$cheque,$utrno,$date1,$bank,$amount,$cashrecipt);
    
    
    if($resP)
    {
        $_SESSION['SuccessMessage']='Profile has been updated successfully';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while updating profile';
    }
    
}

if(isset($_GET['stId']))
{
    $stId=base64_decode($_GET['stId']);
    $res=$obj->getStudentUserDetailsById($stId);
    $data=$res->fetch_assoc();
    
    $objC=new Common();
    $resBD=$objC->getStudentPADetails($stId); 
    $rowBD=$resBD->fetch_assoc();
    
    $resCD=$objC->getStudentCurrentCourse($stId); 
    $rowCD=$resCD->fetch_assoc();
}


$objM=new Member();
$resC=$objM->getCountry();
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
              <h2>Edit Details</h2>
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
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Edit Details 
                  </div>
                </div>
                
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $data['ID']; ?>">
                    <h3>Login Information</h3>
                    <hr />     
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">Username</label>
                      <div class="controls">
                          <input type="text" name="username" id="username" class="span12" placeholder="Enter your Username" readonly value="<?php echo $data['user_login']; ?>" />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Password</label>
                      <div class="controls">
                        <input type="password" name="password" id="password" class="span12" placeholder="********" />
                      </div>
                    </div>
                    <h3>Contact Information</h3>
                    <hr />  
                    <div class="row-fluid">
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">First Name *</label>
                      <div class="controls">
                        <input type="text" name="first_name" id="first_name" class="span12" placeholder="Enter first Name" value="<?php echo $data['first_name']; ?>" />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">Last Name </label>
                      <div class="controls">
                        <input type="text" name="last_name" id="last_name" class="span12" placeholder="Enter last Name" value="<?php echo $data['last_name']; ?>" />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Email *</label>
                      <div class="controls">
                        <input type="text" name="email" id="email" class="span12" placeholder="Enter email address"  value="<?php echo $data['user_email']; ?>"/>
                        <input type="hidden" name="preemail" id="preemail" class="span12" placeholder="Enter email address"  value="<?php echo $data['user_email']; ?>"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Mobile *</label>
                      <div class="controls">
                        <input type="text" name="phone1" id="phone1" class="span12" placeholder="Enter mobile"  value="<?php echo $data['phone1']; ?>"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">DOB *</label>
                      <div class="controls">
                          <input type="text" name="dob" id="dob" class="span12 custom-dt" placeholder="Enter DOB"  value="<?php echo $data['dob']; ?>" readonly style="cursor: pointer;"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Address 1*</label>
                      <div class="controls">
                        <input type="text" name="address1" id="address1" class="span12" placeholder="Enter address1"  value="<?php echo $data['address1']; ?>"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Address 2</label>
                      <div class="controls">
                        <input type="text" name="address2" id="address2" class="span12" placeholder="Enter address2"  value="<?php echo $data['address2']; ?>"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">City *</label>
                      <div class="controls">
                        <input type="text" name="city" id="city" class="span12" placeholder="Enter City"  value="<?php echo $data['city']; ?>"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Country *</label>
                      <div class="controls">
                          <select name="country" id="country" class="span12" onchange="getStatListById('')">
                                <option value="">Select Country</option>
                                <?php
                                while($rowC=$resC->fetch_assoc())
                                {
                                ?> 
                                <option value="<?php echo $rowC['country_id'].'^'.$rowC['name']; ?>" <?php if($rowC['name']==$data['country']) { echo 'selected'; } ?>><?php echo $rowC['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">State *</label>
                      <div class="controls">
                        <select name="state" id="state" class="span12">
                            <option value="">Select State</option>
                        </select>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Pincode *</label>
                      <div class="controls">
                        <input type="text" name="pincode" id="pincode" class="span12" placeholder="Enter Pincode"  value="<?php echo $data['pincode']; ?>"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Gender *</label>
                      <div class="controls">
                          <select name="gender" id="gender" class="span12">
                                <option value="">Select Gender</option>
                                <option value="Male" <?php if($data['gender']=='Male') { echo 'selected'; } ?>>Male</option>
                                <option value="Female" <?php if($data['gender']=='Female') { echo 'selected'; } ?>>Female</option>
                          </select>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">
                        Profile Image
                      </label>
                      <div class="controls">
                          <input type="file" name="profile_image" id="profile_image" onchange="checkfileSize();">
                          <input type="hidden" name="preprofile_image" id="preprofile_image" value="<?php echo $data['profile_image']; ?>" >
                          <?php if($data['profile_image']!='') { ?>
                          <br>
                          <a href="../userdocs/<?php echo $data['ID']; ?>/<?php echo $data['profile_image']; ?>" target="_blank"><?php echo $data['profile_image']; ?></a>
                          <?php } ?>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">
                        Address Proof
                      </label>
                      <div class="controls">
                          <input type="file" name="address_proof" id="address_proof" onchange="checkfileSize2();">
                          <input type="hidden" name="preaddress_proof" id="preaddress_proof" value="<?php echo $data['address_proof']; ?>" >
                          <?php if($data['address_proof']!='') { ?>
                          <br>
                          <a href="../userdocs/<?php echo $data['ID']; ?>/<?php echo $data['address_proof']; ?>" target="_blank"><?php echo $data['address_proof']; ?></a>
                          <?php } ?>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">
                        Education Certificate
                      </label>
                      <div class="controls">
                          <input type="file" name="education_certificate" id="education_certificate" onchange="checkfileSize3();">
                          <input type="hidden" name="preeducation_certificate" id="preeducation_certificate" value="<?php echo $data['education_certificate']; ?>" >
                          <?php if($data['education_certificate']!='') { ?>
                          <br>
                          <a href="../userdocs/<?php echo $data['ID']; ?>/<?php echo $data['education_certificate']; ?>" target="_blank"><?php echo $data['education_certificate']; ?></a>
                          <?php } ?>
                      </div>
                    </div>
                    </div>
                    <h3>Bank Details</h3>
                    <hr />
                    <div class="row-fluid">
                        <div class="control-group span6 left-0">
                            <label class="control-label" for="password5">Bank Name</label>
                            <div class="controls">
                                <input type="text" name="bank_name" id="bank_name" class="span12" placeholder="Bank Name" value="<?php echo $rowBD['bank_name']; ?>">

                            </div>
                        </div>
                        <div class="control-group span6 left-0">
                            <label class="control-label" for="password5">Account No</label>
                            <div class="controls">
                                <input type="text" name="bank_ac" id="bank_ac" class="span12" placeholder="Bank Account No." value="<?php echo $rowBD['account_no']; ?>">

                            </div>
                        </div>
                        <div class="control-group span6 left-0">
                            <label class="control-label" for="password5">IFSC Code</label>
                            <div class="controls">
                                <input type="text" name="ifsc" id="ifsc" class="span12" placeholder="IFSC" value="<?php echo $rowBD['ifsc_code']; ?>">

                            </div>
                        </div>
                        <div class="control-group span6 left-0">
                            <label class="control-label" for="password5">Branch Area</label>
                            <div class="controls">
                                <input type="text" name="cityofbranch" id="cityofbranch" class="span12" placeholder="City of branch" value="<?php echo $rowBD['bank_code']; ?>">

                            </div>
                        </div>
                        <div class="control-group span6 left-0">
                            <label class="control-label" for="password5">Pan No</label>
                            <div class="controls">
                                <input type="text" name="panno" id="panno" class="span12" placeholder="Pan No." value="<?php echo $rowBD['pan']; ?>">

                            </div>
                        </div>
                    </div>
                    <h3>Fee Details</h3>
                    <hr />
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
                                            if($data['catId']==$rescat['Id']){
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
                        
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">Course *</label>
                          <div class="controls">
                              <select name="course" id="course" class="span12" onchange="calculateFee(this.value);">
                                    <option value="">Select the Level</option>
                                    <?php
                                        $obj=new Common();
                                        $coursecatRes=$obj->getAllCourseByCatId($data['catId']);
                                        while($rescat=$coursecatRes->fetch_assoc()) 
                                        {
                                            $selected1 = '';
                                            if($data['current_courseId']==$rescat['Id']){
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
                        <div class="control-group span6 left-0">
                         <label class="control-label" for="password5">Fee *</label>
                         <div class="controls">
                             <input type="text" name="fee" id="fee" class="span12" value="<?php echo ($data['current_fee']-$data['current_servicetax']); ?>" placeholder="Fee" readonly>
                         </div>
                       </div>
                       <div class="control-group span6 left-0">
                         <label class="control-label" for="password5">Service Tax *</label>
                         <div class="controls">
                             <input type="text" name="service_tax" id="service_tax" class="span12" placeholder="Service Tax" readonly value="<?php echo ($data['current_servicetax']); ?>">
                         </div>
                       </div>
                       <div class="control-group span6 left-0">
                         <label class="control-label" for="password5">Total Fee *</label>
                         <div class="controls">
                             <input type="text" name="totalfee" id="totalfee"  class="span12" placeholder="Total fee" readonly value="<?php echo ($data['current_fee']); ?>">
                         </div>
                       </div>
                       <div class="control-group span6 left-0">
                         <label class="control-label" for="password5">Payment Mode *</label>
                         <div class="controls">
                             <select name="paymentMode" id="paymentMode" class="span12" onchange="CheckPaymentMode(this.value);">
                                    <option value="">Select Payment Mode</option>
                                    <option value="1" <?php if($rowCD['payment_mode']=='1'){ echo "selected"; } ?>>Payment Gateway</option>
                                    <option value="2" <?php if($rowCD['payment_mode']=='2'){ echo "selected"; } ?>>Paid already</option>
                                    <option value="3" <?php if($rowCD['payment_mode']=='3'){ echo "selected"; } ?>>SWS</option>
                            </select>
                         </div>
                       </div>
                       <div class="control-group span6 left-0 alreadyPaidArea" style="<?php if($rowCD['payment_mode']=='2') { ?>display:block;<?php } else { ?>display:none;<?php } ?>">
                            <label class="control-label" for="password5">Payment Mode *</label>
                            <div class="controls">
                                <select name="payment_type" id="payment_type" class="span12" onchange="checkPaymentType(this.value);">
                                      <option value="">Select Payment Type</option>
                                        <option value="cash" <?php if($rowCD['offline_paymet']=='cash') { echo "selected"; } ?> >Cash Deposit</option>
                                        <option value="cheque" <?php if($rowCD['offline_paymet']=='cheque') { echo "selected"; } ?> >Cheque</option>
                                        <option value="neft" <?php if($rowCD['offline_paymet']=='neft') { echo "selected"; } ?>>NEFT</option>
                              </select>
                            </div>
                          </div>
                       <div class="row-fluid cheque" <?php if($rowCD['offline_paymet']=='neft') { echo 'style="display:none;"'; } else { echo 'style="display:none;"'; }  ?>>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Cheque *</label>
                          <div class="controls">
                            <input type="text" name="cheque" id="cheque" class="span12 " placeholder="Cheque No."  value="<?php echo $rowCD['cheque_no']; ?>" />
                          </div>
                        </div>
                        </div>
                        <div class="row-fluid neft" <?php if($rowCD['offline_paymet']=='neft') { echo 'style="display:block;"'; } else { echo 'style="display:none;"'; } ?>>
                            <div class="control-group span6 left-0">
                              <label class="control-label" for="password5">NEFT / RTGS *</label>
                              <div class="controls">
                                <input type="text" name="utrno" id="utrno" class="span12" placeholder="UTR No."  value="<?php echo $rowCD['transaction_reference_no']; ?>"/>
                              </div>
                            </div>
                            <div class="control-group span6 left-0">
                              <label class="control-label" for="password5">NEFT / RTGS Date *</label>
                              <div class="controls">
                                <input type="text" name="date1" id="date1" class="span12 custom-dt" placeholder="NEFT / RTGS Date"  value="<?php echo (($rowCD['transaction_date']!='0000-00-00 00:00:00')?date('Y-m-d',strtotime($rowCD['transaction_date'])):""); ?>" readonly style="cursor: pointer;"/>
                              </div>
                            </div>
                        </div>
                        <div class="row-fluid bank" <?php if($rowCD['offline_paymet']=='cheque' || $rowCD['offline_paymet']=='neft'){ echo 'style="display:block;"'; } else { echo 'style="display:none;"'; } ?>>
                            <div class="control-group span6 left-0">
                              <label class="control-label" for="password5">Bank Name *</label>
                              <div class="controls">
                                <input type="text" name="bank" id="bank" class="span12" placeholder="Bank Name"  value="<?php echo $rowCD['bank_name']; ?>"/>
                              </div>
                            </div>
                            <div class="control-group span6 left-0">
                              <label class="control-label" for="password5">Paid Amount *</label>
                              <div class="controls">
                                <input type="text" name="amount" id="amount" class="span12" placeholder="Paid Amount"  value="<?php if(isset($_POST['amount'])) echo $_POST['amount']; ?>" readonly/>
                              </div>
                            </div>
                        </div>
                        <div class="row-fluid sws" <?php if($rowCD['offline_paymet']=='cash') { echo 'style="display:block;"'; } else { echo 'style="display:none;"'; }  ?>>
                            <div class="control-group span6 left-0">
                              <label class="control-label" for="password5">Paid Date *</label>
                              <div class="controls">
                                <input type="text" name="paiddate" id="paiddate" class="span12 custom-dt" placeholder="Payment Date"  value="<?php echo (($rowCD['transaction_date']!='0000-00-00 00:00:00')?date('Y-m-d',strtotime($rowCD['transaction_date'])):""); ?>" readonly style="cursor: pointer;"/>
                              </div>
                            </div>
                            <div class="control-group span6 left-0">
                              <label class="control-label" for="password5">Paid Amount *</label>
                              <div class="controls">
                                <input type="text" name="swsamount" id="swsamount" class="span12" placeholder="Paid Amount"  value="<?php echo $rowCD['cheque_amount']; ?>" readonly/>
                              </div>
                            </div>
                            <div class="control-group span6 left-0">
                              <label class="control-label" for="password5">Cash Deposit Slip *</label>
                              <div class="controls">
                                  <input type="file" class="span12" name="cashrecipt" id="cashrecipt" onchange="checkfileSize4();"/>
                                  <input type="hidden" class="span12" name="precashrecipt" id="precashrecipt" value="<?php echo $rowCD['cash_deposit_slip']; ?>"/>
                              </div>
                            </div>
                        </div>
                   </div>
                    
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <input type="hidden" name="paymentStatus" id="paymentStatus" value="">
                        <input type="hidden" name="paymentId" id="paymentId" value="<?php echo $rowCD['id']; ?>">
                        <input type="submit" name="submit" class="btn btn-info pull-right" onclick="return saveProfile()" value="Submit" id="submit">
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
        $("#dob").datepicker({dateFormat:'yy-mm-dd',maxDate:"<?php $cdate = date('Y-m-d'); echo date('Y-m-d', strtotime($cdate.'-18 years'));?>",changeYear: true,changeMonth: true,yearRange: '1900:2017',});
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',changeYear: true,changeMonth: true,yearRange: '1900:2017',});
        getStatListById('<?php echo $data['state']; ?>');
    });
    
    function getStatListById(statname)
    {
        var countryId=$("#country").val();

        var country=countryId.split('^');

        $.post("../ajax/ajax-member.php",{
            q:'getStatListById',
            countryId:country[0],
            statname:statname,
            },function(data){
            $("#state").html(data);    
        });
    }
    
    function calculateFee(data)
    {
            var data1 = data.split('^');

            var amount = parseFloat(data1[0]);

            $('#fee').val(amount.toFixed(2));

            var tax = (amount*15)/100; 

            var totalfee=amount+tax;

            $('#service_tax').val(tax.toFixed(2));

            $('#totalfee').val(totalfee.toFixed(2));

            $('#amount').val(totalfee.toFixed(2));
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
    
    function saveProfile()
    {
        var first_name=$("#first_name").val();
        var last_name=$("#last_name").val();
        var email=$("#email").val();
        var phone1=$("#phone1").val();
        var password=$("#password").val();
        var dob=$("#dob").val();
        var address1=$("#address1").val();
        var city=$("#city").val();
        var country=$("#country").val();
        var state=$("#state").val();
        var pincode=$("#pincode").val();
        var gender=$("#gender").val();
        
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
        
        if(first_name=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter first name.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
//        else if(last_name=='') {
//            $('#onetimeerror').fadeIn();
//            $("#onetimeerror").html('Please enter last name.');
//            setTimeout(function() {
//                $('#onetimeerror').fadeOut();
//            }, 5000 );
//            return false;
//        }
        else if(email=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter email.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(!validateEmail(email)) {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter correct email address.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if($("#phone1").val()=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter mobile number.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(isNaN(parseInt(phone1))) {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter correct mobile no.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(phone1.length!=10) {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter 10 digit mobile no.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(password!='' && password.length<8)
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Password must be 8 characters long.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(password!='' && password.length>=8 && !IsPassword(password))
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Password must be at least 1 uppercase alphabet, 1 lowercase alphabet, 1 number and 1 special character.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(dob=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select DOB.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(address1=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter address1.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(city=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter city name.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(country=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select country.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(state=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select state');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(pincode=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter pincode');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(gender=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select gender');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(!coursecatgory)
        {
            $("#onetimeerror").html('Please select course category.');
            $("#onetimeerror").show();
            $("#coursecatgory").focus();
            return false;
        } 
        else if(!course)
        {
            $("#onetimeerror").html('Please select level.');
            $("#onetimeerror").show();
            $("#course").focus();
            return false;
        }
        else if(!paymentMode)
        {
            $("#onetimeerror").html('Please select payment mode.');
            $("#onetimeerror").show();
            $("#paymentMode").focus();
            return false;
        }
        else if(paymentMode=='2')
        {
            if(!payment_type)
            {
                $("#onetimeerror").html('Please select payment type.');
                $("#onetimeerror").show();
                $("#payment_type").focus();
                return false;
            }
            else if(payment_type=='cheque')
            {
                if(!cheque_no)
                {
                    $("#onetimeerror").html('Please enter cheque no.');
                    $("#onetimeerror").show();
                    $("#cheque").focus();
                    return false;
                }
                else if(!bank)
                {
                    $("#onetimeerror").html('Please enter bank name.');
                    $("#onetimeerror").show();
                    $("#bank").focus();
                    return false;
                }
                else if(!amount)
                {
                    $("#onetimeerror").html('Please enter amount.');
                    $("#onetimeerror").show();
                    $("#amount").focus();
                    return false;
                }
                else
                {
					$("#submit").hide("fast");
					$("#processbtn").show("fast");
                    return true;
                }
            }
            else if(payment_type=='neft')
            {
                if(!utrno)
                {
                    $("#onetimeerror").html('Please enter URT No.');
                    $("#onetimeerror").show();
                    $("#utrno").focus();
                    return false;
                }
                else if(!date1)
                {
                    $("#onetimeerror").html('Please select date.');
                    $("#onetimeerror").show();
                    $("#date1").focus();
                    return false;
                }
                else if(!bank)
                {
                    $("#onetimeerror").html('Please enter bank name.');
                    $("#onetimeerror").show();
                    $("#bank").focus();
                    return false;
                }
                else if(!amount)
                {
                    $("#onetimeerror").html('Please enter amount.');
                    $("#onetimeerror").show();
                    $("#amount").focus();
                    return false;
                }
                else
                {
					$("#submit").hide("fast");
					$("#processbtn").show("fast");
                    return true;
                }
            }
            else if(payment_type=='cash')
            {
                if(paiddate=='')
                {
                    $("#onetimeerror").html('Please select paid date.');
                    $("#onetimeerror").show();
                    $("#paiddate").focus();
                    return false;
                }
                else if(cashrecipt=='' && $("#precashrecipt").val()=='')
                {
                    $("#onetimeerror").html('Please upload cash receipt.');
                    $("#onetimeerror").show();
                    $("#cashrecipt").focus();
                    return false;
                }
                else
                {
					$("#submit").hide("fast");
					$("#processbtn").show("fast");
                    return true;
                }
            }
        }
        else if(paymentMode=='1' && paymentStatus=='')
        {
            checkStatus();
            return false;
        }
        else 
        {
			$("#submit").hide("fast");
			$("#processbtn").show("fast");
            return true;
        }
    }
 function checkStatus()
    {
            $('#myModal').modal('show');
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
function getPaymentStatus(status)
{
	$('#paymentStatus').val(status);
	$('#myModal').modal('hide');
}
function IsPassword(pass) {
	
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/;
    return regex.test(pass);
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
        <div class="row-fluid">
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