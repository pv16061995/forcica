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
              <h2>Course Upgrade Request</h2>
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
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Course Upgrade Request
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
                                    <th width="10%">Course Name</th>
                                    <th width="10%">Payment Mode</th>
                                    <th width="35%">Payment Details</th>
                                    <th width="10%">Requested Date</th>
                                    <th width="10%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>';
                                    $obj=new Common();
                                    $res=$obj->getAllMemberCourseRequest();
                                    $i=1;
                                    while($row=$res->fetch_assoc())
                                    {
                                        if($row['payment_mode']==1) { $payment_mode='Payment Gateway'; }
                                        else if($row['payment_mode']==2) { $payment_mode='Paid already'; }
                                        else if($row['payment_mode']==3) { $payment_mode='SWS'; }
                                        
                                    $tabledata .='<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$row['user_login'].'</td>
                                        <td>'.ucfirst($row['first_name']).' '.($row['last_name']).'</td>
                                        <td>'.$row['coursename'].'</td> 
                                        <td>'.$payment_mode.'</td>';
                                    
                                        if($row['payment_mode']==3) {
                                            $tabledata .='<td>';
                                                $tabledata .='<b>Paid Amount : </b>'.$row['cheque_amount'].'<br>';
                                                $tabledata .='<b>Paid Date : </b>'.date('d M, Y',strtotime($row['transaction_date'])).'<br>';
                                                $tabledata .='<b>Cash Receipt : </b><a href="../userdocs/'.$row['user_id'].'/'.$row['cash_deposit_slip'].'" target="_blank" style="text-decoration:underline;">'.$row['cash_deposit_slip'].'</a>';
                                            $tabledata .='</td>';
                                        }
                                        else if($row['payment_mode']==2) {
                                            $tabledata .='<td>';
                                                $tabledata .='<b>Paid Amount : </b>'.$row['cheque_amount'].'<br>';
                                                if($row['offline_paymet']=='cheque') 
                                                {
                                                    $tabledata .='<b>Cheque No. : </b>'.$row['cheque_no'].'<br>';
                                                }
                                                else if($row['offline_paymet']=='neft') 
                                                {
                                                    $tabledata .='<b>NEFT / RTGS No. : </b>'.$row['transaction_reference_no'].'<br>';
                                                    $tabledata .='<b>NEFT / RTGS Date : </b>'.date('d M, Y',strtotime($row['transaction_date'])).'<br>';
                                                }
                                                $tabledata .='<b>Bank Name : </b>'.$row['bank_name'].'';
                                            $tabledata .='</td>';
                                        }
                                        else if($row['payment_mode']==1) {
                                            $tabledata .='<td>';
                                                $tabledata .='<b>Paid Amount : </b>'.($row['fee']).'<br>';
                                                    $tabledata .='<b>Payment Id : </b>'.$row['order_id'].'<br>';
                                                    $tabledata .='<b>Transaction Id : </b>'.$row['txn_id'].'<br>';
                                                $tabledata .='</td>';
                                        }
                                    
                                    $tabledata .='<td>'.date('d M, Y',strtotime($row['created_on'])).'</td>';
                                    $tabledata .='<td><a href="javascript:void(0);" class="btn btn-success btn-mini" data-toggle="tooltip" data-original-title="Approve" onclick="approveRequest(\''.$row['id'].'\',\''.$row['user_id'].'\',\''.$row['post_id'].'\',\''.$row['fee'].'\',\''.$row['service_tax'].'\')"><i class="icon icon-ok icon-white"></i></a></td>    
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
    function approveRequest(Id,user_id,courseId,fee,service_tax)
    {
        var r=confirm('Are you sure you want to approve this course request');
        if(r)
        {
            $.post("../ajax/ajax-common.php",{
                q:'approveRequest',
                Id:Id,
                user_id:user_id,
                courseId:courseId,
                fee:fee,
                service_tax:service_tax,
                },function(data){
                window.location.reload();
            });
        }
    }
</script>

  </body>
</html>