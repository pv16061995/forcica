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

if(isset($_POST['submit']))
{
    $uid=$_POST['userId'];
    $password=$_POST['password'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $image=$_FILES['image']['name'];
    $preimage=$_POST['preimage'];
    
    if($image!='')
    {
        $allowedExts = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG");
        $temp = explode(".", $_FILES["image"]["name"]);
        $extension = end($temp);
        if ((($_FILES["image"]["type"] == "image/gif")|| ($_FILES["image"]["type"] == "image/jpeg")|| ($_FILES["image"]["type"] == "image/jpg")|| ($_FILES["image"]["type"] == "image/pjpeg")|| ($_FILES["image"]["type"] == "image/x-png")|| ($_FILES["image"]["type"] == "image/png")) && in_array($extension, $allowedExts))
        {
            @unlink('user_images/'.$preimage);
            $image=time().'_'.$_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], "user_images/" . $image);
            
            $_SESSION['profile_image']=$image;
        }
        else 
        {
            $image='';
        }
    }
    else 
    {
        $image=$_POST['preimage'];
        $_SESSION['profile_image']=$image;
    }
    $_SESSION['name']=$name;
    $resP=$obj->updateUserProfile($uid,$password,$name,$email,$image);
    if($resP)
    {
        $_SESSION['SuccessMessage']='Profile has been updated successfully';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while updating profile';
    }
    
}

$res=$obj->getUserDetailsById($_SESSION['adminuserid']);
$data=$res->fetch_assoc();
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
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">Name *</label>
                      <div class="controls">
                        <input type="text" name="name" id="name" class="span12" placeholder="Enter your Name" value="<?php echo $data['user_nicename']; ?>" />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Email *</label>
                      <div class="controls">
                        <input type="text" name="email" id="email" class="span12" placeholder="Enter email address"  value="<?php echo $data['user_email']; ?>"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">
                        Image
                      </label>
                      <div class="controls">
                          <input type="file" name="image" id="image" onchange="checkfileSize();">
                          <input type="hidden" name="preimage" id="preimage" value="<?php echo $data['user_image']; ?>" >
                          <input type="hidden" name="userId" id="userId" value="<?php echo $data['ID']; ?>" >
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