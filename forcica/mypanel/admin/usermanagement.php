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


$query=$obj->getAllUsers();

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
              <h2>User Management</h2>
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
              <div class="widget no-margin">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon=""></span> User Management
                  </div>
                  <div class="pull-right">
                        <a href="addedituser.php" class="btn btn-mini btn-info" data-toggle="tooltip" data-original-title="Add New User">Add New User</a>
                    </div>
                </div>
                <div class="widget-body">
                  <div id="dt_example" class="example_alt_pagination">
                        <table id="data-table" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th width="5%">Sr.No.</th>
                                <th width="10%">Name</th>
                                <th width="15%">Username</th>
                                <th width="15%">Email</th>
                                <th width="10%">Image</th>
                                <th width="15%">Action</th>
                              </tr>
                            </thead>
                            <tbody >
                                <?php
                                $i=1;
                                while($row = $query->fetch_assoc())
                                {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['user_nicename']; ?></td>
                                    <td><?php echo $row['user_login']; ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td>
                                        <?php if($row['user_image']!='') { ?>
                                        <img src="user_images/<?php echo $row['user_image']; ?>" width="120">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="addedituser.php?id=<?php echo base64_encode($row['ID']); ?>" class="btn btn-mini btn-success" data-toggle="tooltip" data-original-title="Edit"><i class="icon icon-pencil"></i></a>
                                       <?php if($row['user_status']=='1') { $txt='enable'; ?> 
                                        <a href="javascript:void(0);" class="btn btn-mini btn-success" data-toggle="tooltip" data-original-title="Enable" onclick="changeStatus('<?php echo $row['ID'];  ?>','0','<?php echo $txt;  ?>')"><i class="icon icon-thumbs-up"></i></a>
                                       <?php } else { $txt='disable'; ?>  
                                        <a href="javascript:void(0);" class="btn btn-mini btn-danger" data-toggle="tooltip" data-original-title="Disable" onclick="changeStatus('<?php echo $row['ID'];  ?>','1','<?php echo $txt;  ?>')"><i class="icon icon-thumbs-down icon-white"></i></a>
                                       <?php } ?> 
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    <div class="clearfix"></div>
                  </div>
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
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',maxDate:0,});
        $('#data-table').dataTable({
            "sPaginationType": "full_numbers",
            "iDisplayLength": 50,
        });
    });
    
    function changeStatus(userId,status,txt)
    {
        var r=confirm('Are you sure you want to '+txt+' this user');
        if(r)
        {
            $.post("../ajax/ajax-common.php",{
                q:'changeStatus',
                userId:userId,
                status:status,
                },function(data){
                window.location.reload();
            });
        }
    }
</script>
    
  </body>
</html>