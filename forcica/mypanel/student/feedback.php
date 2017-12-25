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
    $name=$_POST['name'];
    $email=$_POST['email'];
    $sid=$_SESSION['studentuserid'];
    $message=addslashes($_POST['message']);
    $category=$_POST['category'];
    
    $resP=$obj->savefeedback($sid,$message,$category);
    
    if($resP)
    {
        $_SESSION['SuccessMessage']='Feedback has been send successfully';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while sending feedback';
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

              </div>
            </div>
          </div>
          <div class="page-header">
            <div class="pull-left">
              <h2>Feedback</h2>
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
            <?php ShowAlerts(); ?>
          </div>

        <div class="row-fluid">
            <div class="span12">
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Feedback 
                  </div>
                </div>
                
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" enctype="multipart/form-data">
                   
                    <!-- <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">Name *</label>
                      <div class="controls">
                        <input type="text" name="name" id="name" class="span12" placeholder="Enter Name"  />
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Email *</label>
                      <div class="controls">
                        <input type="text" name="email" id="email" class="span12" placeholder="Enter email address"/>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Mobile *</label>
                      <div class="controls">
                        <input type="text" name="phone1" id="phone1" class="span12" placeholder="Enter mobile"/>
                      </div>
                    </div> -->
                   
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Category *</label>
                      <div class="controls">
                         
                        <select name="category" id="category" class="span12" >
                            <option value="">Select Category</option>
                            <option value="Compliment">Compliment</option>
                            <option value="Complaint">Complaint</option>
                            <option value="Suggestion">Suggestion</option>
                            <option value="Comments">Comments</option>
                        </select>
                          
                      </div>
                    </div>
                   
                    
                    <div class="control-group span12 left-0">
                      <label class="control-label" for="password5">Message *</label>
                      <div class="controls">
                          <textarea name="message" id="message" class="span12" rows="5" style="width: 97%;"></textarea>
                      </div>
                    </div>
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <input type="submit" name="submit" class="btn btn-info pull-right" onclick="return savefeedback()" value="Submit">
                      <div class="clearfix">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/moment.js"></script>
    <script src="<?php echo BASEPATH; ?>js/jquery.validate.min.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/validatesubmit.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/pie-charts/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/tiny-scrollbar.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/sparkline.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.dataTables.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/theming.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom.js"></script>
    <link href='<?php echo BASEPATH; ?>bootstrap/css/jquery-ui.css' rel='stylesheet' />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-ui-date.js"></script>
    
    
<script>
    function savefeedback()
    {
       
        var category=$("#category").val();
        var message=$("#message").val();
         if(category=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter category.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }else if(message=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter message.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
    }
    
   
</script>
    
  </body>
</html>