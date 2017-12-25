<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsUser.php');

if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}

//print_r($_SESSION);
$obj=new User();
$flagusercheck=FALSE;
if(isset($_POST['submit']))
{
    $uid=$_POST['userId'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $image=$_FILES['image']['name'];
    $preimage=$_POST['preimage'];
    $userpermission=$_POST['userpermission'];
    $userpermission=  implode(',', $userpermission);
    $flagusercheck=FALSE;
    
    if($uid=='')
    {
        $resc=$obj->checkusernameExist(trim($username));
        if($resc->num_rows > 0)
        {
            $flagusercheck=TRUE;
            $_SESSION['ErrorMessage']='Username already exist';
        }
        else 
        {
            $flagusercheck=FALSE;
        }
    }
    else 
    {
        $flagusercheck=FALSE;
    }
    if(!$flagusercheck)
    {
        if($image!='')
        {
            $allowedExts = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG");
            $temp = explode(".", $_FILES["image"]["name"]);
            $extension = end($temp);
            if ((($_FILES["image"]["type"] == "image/gif")|| ($_FILES["image"]["type"] == "image/jpeg")|| ($_FILES["image"]["type"] == "image/jpg")|| ($_FILES["image"]["type"] == "image/pjpeg")|| ($_FILES["image"]["type"] == "image/x-png")|| ($_FILES["image"]["type"] == "image/png")) && in_array($extension, $allowedExts))
            {
                @unlink('user_images/'.$preimage);
                $image=time().'_'.$_FILES["image"]["name"];
                move_uploaded_file($_FILES["image"]["tmp_name"],"user_images/" . $image);
            }
            else 
            {
                $image='';
            }
        }
        else 
        {
            $image=$_POST['preimage'];
        }
        $resP=$obj->saveUserProfile($uid,$username,$password,$name,$email,$image,$userpermission);
        if($resP)
        {
            $_SESSION['SuccessMessage']='User Details has been saved successfully';
            
        }
        else 
        {
            $_SESSION['ErrorMessage']='Error occured while saving user details';
        }
    }
}

$flag=FALSE;
if(isset($_GET['id'])) {
    $id=  base64_decode($_GET['id']);
    $res=$obj->getUserDetailsById($id);
    $data=$res->fetch_assoc();
    $flag=TRUE;
    $userpermission=explode(',',$data['userpermission']);
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
              <h2>Add/Edit User</h2>
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
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Add/Edit User 
                  </div>
                </div>
                
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" enctype="multipart/form-data">
                    <div class="row-fluid">
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">Username</label>
                      <div class="controls">
                          <input type="text" name="username" id="username" class="span12" placeholder="Enter your Username" <?php if($flag) { ?> readonly <?php } ?> value="<?php if($flagusercheck) { echo $_POST['username']; } else if($flag) { echo $data['user_login']; } ?>" />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Password</label>
                      <div class="controls">
                        <input type="password" name="password" id="password" class="span12" placeholder="********" value="<?php if($flagusercheck) { echo $_POST['password']; } ?>" />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">Name *</label>
                      <div class="controls">
                        <input type="text" name="name" id="name" class="span12" placeholder="Enter your Name" value="<?php if($flagusercheck) { echo $_POST['name']; } else if($flag) { echo $data['user_nicename']; } ?>" />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Email *</label>
                      <div class="controls">
                        <input type="text" name="email" id="email" class="span12" placeholder="Enter email address"  value="<?php if($flagusercheck) { echo $_POST['email']; } else if($flag) { echo $data['user_email']; } ?>"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">
                        Image
                      </label>
                      <div class="controls">
                          <input type="file" name="image" id="image" onchange="checkfileSize();">
                          <input type="hidden" name="preimage" id="preimage" value="<?php if($flag) { echo $data['user_image']; } ?>" >
                          <input type="hidden" name="userId" id="userId" value="<?php if($flag) { echo $data['ID']; } ?>" >
                      </div>
                    </div>
                </div>
                <div class="row-fluid">
                        <div class="span2">
                            <label class="control-label" for="dfirstclass" style="text-align: left; font-weight: bold;">Others</label>
                            <div class="controls span12">
                                <input type="checkbox" name="userpermission[]" id="userpermission11" value="11" onClick="getchecked();" <?php if($flag) { if(in_array('11', $userpermission)) { echo 'checked'; } } ?>> Student List<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission17" value="17" onClick="getchecked();" <?php if($flag) { if(in_array('17', $userpermission)) { echo 'checked'; } } ?>> Get Admission<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission12" value="12" onClick="getchecked();" <?php if($flag) { if(in_array('12', $userpermission)) { echo 'checked'; } } ?>> Manage Course<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission8" value="8" onClick="getchecked();" <?php if($flag) { if(in_array('8', $userpermission)) { echo 'checked'; } } ?>> Call Center<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission13" value="13" onClick="getchecked();" <?php if($flag) { if(in_array('13', $userpermission)) { echo 'checked'; } } ?>> Payout<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission18" value="18" onClick="getchecked();" <?php if($flag) { if(in_array('18', $userpermission)) { echo 'checked'; } } ?>> Manage Quiz<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission16" value="16" onClick="getchecked();" <?php if($flag) { if(in_array('16', $userpermission)) { echo 'checked'; } } ?>> Result<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission19" value="19" onClick="getchecked();" <?php if($flag) { if(in_array('19', $userpermission)) { echo 'checked'; } } ?>> Prediction / Report<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission20" value="20" onClick="getchecked();" <?php if($flag) { if(in_array('20', $userpermission)) { echo 'checked'; } } ?>> Asked Query<br>
                            </div>

                        </div>
                        <!--<div class="span2">
                            <label class="control-label" for="dfirstclass" style="text-align: left; font-weight: bold;">PA Income</label>
                            <div class="controls span12">
                                <input type="checkbox" name="userpermission[]" id="userpermission9" value="9" onClick="getchecked();" <?php if($flag) { if(in_array('9', $userpermission)) { echo 'checked'; } } ?>> PASC<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission10" value="10" onClick="getchecked();" <?php if($flag) { if(in_array('10', $userpermission)) { echo 'checked'; } } ?>> PAC<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission13" value="13" onClick="getchecked();" <?php if($flag) { if(in_array('13', $userpermission)) { echo 'checked'; } } ?>> FI<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission14" value="14" onClick="getchecked();" <?php if($flag) { if(in_array('14', $userpermission)) { echo 'checked'; } } ?>> LB<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission15" value="15" onClick="getchecked();" <?php if($flag) { if(in_array('15', $userpermission)) { echo 'checked'; } } ?>> SB<br>
                            </div>

                        </div>-->
                        <div class="span2">
                            <label class="control-label" for="dfirstclass" style="text-align: left; font-weight: bold;">Trading Support Service</label>
                            <div class="controls span12">
                                <input type="checkbox" name="userpermission[]" id="userpermission1" value="1" onClick="getchecked();" <?php if($flag) { if(in_array('1', $userpermission)) { echo 'checked'; } } ?>> One Time Input<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission2" value="2" onClick="getchecked();" <?php if($flag) { if(in_array('2', $userpermission)) { echo 'checked'; } } ?>> Monthly Input<br>
                            </div>

                        </div>
                        <div class="span2">
                            <label class="control-label" for="dfirstclass" style="text-align: left; font-weight: bold;">Report</label>
                            <div class="controls span12">
                                <input type="checkbox" name="userpermission[]" id="userpermission3" value="3" onClick="getchecked();" <?php if($flag) { if(in_array('3', $userpermission)) { echo 'checked'; } } ?>> Student List<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission4" value="4" onClick="getchecked();" <?php if($flag) { if(in_array('4', $userpermission)) { echo 'checked'; } } ?>> NEFT List<br>
<!--                                <input type="checkbox" name="userpermission[]" id="userpermission5" value="5" onClick="getchecked();" <?php //if($flag) { if(in_array('5', $userpermission)) { echo 'checked'; } } ?>> Service Tax List<br>-->
                                <input type="checkbox" name="userpermission[]" id="userpermission6" value="6" onClick="getchecked();" <?php if($flag) { if(in_array('6', $userpermission)) { echo 'checked'; } } ?>> TDS List<br>
                                <input type="checkbox" name="userpermission[]" id="userpermission7" value="7" onClick="getchecked();" <?php if($flag) { if(in_array('7', $userpermission)) { echo 'checked'; } } ?>> Payout Report<br>
                            </div>

                        </div>
                        
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
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',maxDate:0,});
    });
    
    function saveProfile()
    {
        var name=$("#name").val();
        var email=$("#email").val();
        if(name=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter name.');
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
        else {
            return true;
        }
    }
</script>
    
  </body>
</html>