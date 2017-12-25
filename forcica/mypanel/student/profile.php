<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsUser.php');
include_once('../controls/clsMember.php');

if(isset($_SESSION['studentloggedin'])) {
    
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
    
    @mkdir('../userdocs/'.$uid.'/');
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
            $email=$preemail;
        }
    }
    else 
    {
        $email=$email;
    }
    
    $resP=$obj->updateStudentUserProfile($uid,$password,$email);
    
    $resP2=$obj->updateStudentDetailsProfile($uid,$first_name,$las_name,$phone1,$dob,$state,$city,(($_POST['country2']=='')?$country[1]:$_POST['country2']),$address1,$address2,$profile_image,$address_proof,$education_certificate,$gender);
    
    if($resP)
    {
        $_SESSION['SuccessMessage']='Profile has been updated successfully';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while updating profile';
    }
    
}

$res=$obj->getStudentUserDetailsById($_SESSION['studentuserid']);
$data=$res->fetch_assoc();

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
              <h2>Manage Profile</h2>
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
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Profile 
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
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">First Name *</label>
                      <div class="controls">
                        <input type="text" name="first_name" id="first_name" class="span12" placeholder="Enter first Name" value="<?php echo $data['first_name']; ?>" <?php if($data['first_name']!='') { echo 'readonly'; } ?> />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">Last Name *</label>
                      <div class="controls">
                        <input type="text" name="last_name" id="last_name" class="span12" placeholder="Enter last Name" value="<?php echo $data['last_name']; ?>" <?php if($data['last_name']!='') { echo 'readonly'; } ?> />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Email *</label>
                      <div class="controls">
                        <input type="text" name="email" id="email" class="span12" placeholder="Enter email address"  value="<?php echo $data['user_email']; ?>" <?php if($data['user_email']!='') { echo 'readonly'; } ?>/>
                        <input type="hidden" name="preemail" id="preemail" class="span12" placeholder="Enter email address"  value="<?php echo $data['user_email']; ?>"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Mobile *</label>
                      <div class="controls">
                        <input type="text" name="phone1" id="phone1" class="span12" placeholder="Enter mobile"  value="<?php echo $data['phone1']; ?>" <?php if($data['phone1']!='') { echo 'readonly'; } ?>/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">DOB *</label>
                      <div class="controls">
                          <input type="text" name="dob" id="dob" class="span12 <?php if($data['phone1']=='') { echo 'custom-dt'; } ?>" placeholder="Enter DOB"  value="<?php echo $data['dob']; ?>" readonly style="cursor: pointer;"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Address 1*</label>
                      <div class="controls">
                        <input type="text" name="address1" id="address1" class="span12" placeholder="Enter address1"  value="<?php echo $data['address1']; ?>" <?php if($data['address1']!='') { echo 'readonly'; } ?>/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Address 2</label>
                      <div class="controls">
                        <input type="text" name="address2" id="address2" class="span12" placeholder="Enter address2"  value="<?php echo $data['address2']; ?>" <?php if($data['address2']!='') { echo 'readonly'; } ?>/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">City *</label>
                      <div class="controls">
                        <input type="text" name="city" id="city" class="span12" placeholder="Enter City"  value="<?php echo $data['city']; ?>" <?php if($data['city']!='') { echo 'readonly'; } ?>/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Country *</label>
                      <div class="controls">
                          <?php if($data['country']=='') { ?>
                          <select name="country" id="country" class="span12" onchange="getStatListById('')" <?php if($data['country']!='') { echo 'readonly'; } ?>>
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
                          <input type="hidden" name="country2" id="country2" class="span12" placeholder="Enter country"  value=""/>
                          <?php } else { ?>
                            <input type="text" name="country2" id="country2" class="span12" placeholder="Enter country"  value="<?php echo $data['country']; ?>" <?php if($data['country']!='') { echo 'readonly'; } ?>/>
                          <?php } ?>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">State *</label>
                      <div class="controls">
                          <?php if($data['state']=='') { ?>
                        <select name="state" id="state" class="span12" <?php if($data['state']!='') { echo 'readonly'; } ?>>
                            <option value="">Select State</option>
                        </select>
                          <?php } else { ?>
                            <input type="text" name="state" id="state" class="span12" placeholder="Enter state"  value="<?php echo $data['state']; ?>" <?php if($data['state']!='') { echo 'readonly'; } ?>/>
                          <?php } ?>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Pincode *</label>
                      <div class="controls">
                        <input type="text" name="pincode" id="pincode" class="span12" placeholder="Enter Pincode"  value="<?php echo $data['pincode']; ?>" <?php if($data['pincode']!='') { echo 'readonly'; } ?>/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Gender *</label>
                      <div class="controls">
                          <?php if($data['state']=='') { ?>
                          <select name="gender" id="gender" class="span12" <?php if($data['gender']!='') { echo 'readonly'; } ?>>
                                <option value="">Select Gender</option>
                                <option value="Male" <?php if($data['gender']=='Male') { echo 'selected'; } ?>>Male</option>
                                <option value="Female" <?php if($data['gender']=='Female') { echo 'selected'; } ?>>Female</option>
                          </select>
                          <?php } else { ?>
                            <input type="text" name="gender" id="gender" class="span12" placeholder="Enter gender"  value="<?php echo $data['gender']; ?>" <?php if($data['gender']!='') { echo 'readonly'; } ?>/>
                          <?php } ?>
                      </div>
                    </div>
                    <?php //if($data['profile_image']=='') { ?>
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
                    <?php //} else { ?>
                    <input type="hidden" name="preprofile_image" id="preprofile_image" value="<?php echo $data['profile_image']; ?>" >
                    <?php //} ?>
                    <?php if($data['address_proof']=='') { ?>
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
                    <?php } else { ?>
                    <input type="hidden" name="preaddress_proof" id="preaddress_proof" value="<?php echo $data['address_proof']; ?>" >
                    <?php } ?>
                    <?php if($data['education_certificate']=='') { ?>
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
                    <?php } else { ?>
                    <input type="hidden" name="preeducation_certificate" id="preeducation_certificate" value="<?php echo $data['education_certificate']; ?>" >
                    <?php } ?>
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <input type="submit" name="submit" class="btn btn-info pull-right" onclick="return saveProfile()" value="Submit">
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
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',maxDate:"<?php $cdate = date('Y-m-d'); echo date('Y-m-d', strtotime($cdate.'-18 years'));?>",});
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
        
        if(first_name=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter first name.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(last_name=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter last name.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
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
        else 
        {
            return true;
        }
    }
    
    
function IsPassword(pass) {
	
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/;
    return regex.test(pass);
}
</script>
    
  </body>
</html>