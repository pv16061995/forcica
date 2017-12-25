<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsCommon.php');

if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
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
              <h2>Student List</h2>
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
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Student List
                  </div>
                
                </div>
                <div class="widget-body">
                  <div id="dt_example" class="example_alt_pagination">
                      <div id="data">
                          <?php
                          $tabledata='<table id="data-table" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th width="5%">S.No.</th>
                                    <th width="8%">ENR No.</th>
                                    <th width="12%">Name</th>
                                    <th width="12%">DOB</th>
                                    <th width="15%">Address</th>
                                    <th width="10%">Email</th>
                                    <th width="8%">Ref. By</th>
                                    <th width="12%">Course</th>
                                    <th width="8%">PAN</th>
                                    <th width="8%">Gender</th>
                                    <th width="10%">Date of Admission</th>
                                    <th width="10%">Date of PA</th>
                                    <th width="10%">Date of DSA</th>
                                    <th width="10%">Status</th>
                                  </tr>
                                </thead>
                                <tbody>';
                                    $obj=new Common();
                                    $res=$obj->getAllMemberList();
                                    $i=1;
                                    while($row=$res->fetch_assoc())
                                    {
                                    $tabledata .='<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$row['user_login'].'</td>
                                        <td>'.ucfirst($row['first_name']).' '.($row['last_name']).'</td>
                                        <td>'.date('d M, Y',strtotime($row['dob'])).'</td>  
                                        <td>'.$row['address1'].', '.$row['city'].', '.$row['state'].', '.$row['country'].' - '.$row['pincode'].'</td>    
                                        <td>'.$row['user_email'].'</td>
                                        <td>'.$row['student_parent_id'].'</td>   
                                        <td>'.$row['post_title'].' ('.$row['categoryname'].')</td>';
                                    $panno='';
                                    if($row['pa_pan']!='') { $panno= $row['pa_pan']; } else if($row['dsa_pan']!='') { $panno= $row['dsa_pan']; }
                                       $tabledata .=' <td>'.$panno.'</td>';

                                        $tabledata .='<td>'.$row['gender'].'</td>    
                                        <td>'.date('d M, Y', strtotime($row['user_registered'])).'</td>
                                        <td>'.(($row['pa_pan']!='')?date('d M, Y', strtotime($row['pa_created_on'])):"NA").'</td>
                                        <td>'.(($row['dsa_pan']!='')?date('d M, Y', strtotime($row['dsa_created_on'])):"NA").'</td>    
                                        <td><a href="editStudent.php?stId='.base64_encode($row['ID']).'" class="btn btn-mini btn-success" data-toggle="tooltip" data-original-title="Edit"><i class="icon icon-pencil"></i></a>';
                                        if($row['user_status']=='1') { $txt='enable';
                                        $tabledata .='<a href="javascript:void(0);" class="btn btn-mini btn-success" data-toggle="tooltip" data-original-title="Enable" onclick="changeStatus(\''.$row['ID'].'\',0,\''.$txt.'\')"><i class="icon icon-thumbs-up"></i></a>';
                                       } else { $txt='disable';
                                        $tabledata .='<a href="javascript:void(0);" class="btn btn-mini btn-danger" data-toggle="tooltip" data-original-title="Disable" onclick="changeStatus(\''.$row['ID'].'\',1,\''.$txt.'\')"><i class="icon icon-thumbs-down icon-white"></i></a>';
                                       } 
                                       $tabledata .='<br><a href="greenfieldinfo.php?enrno='.base64_encode($row['user_login']).'" target="_blank" class="btn btn-info btn-mini" data-toggle="tooltip" data-original-title="View Green Field"><i class="icon icon-zoom-in"></i></a></td>    
                                    </tr>';    
                                $i++; }
                                $tabledata .='</tbody>
                            </table>';

                            echo $tabledata;
                          ?>
                      </div>  
                        
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