<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsUser.php');
include_once('../controls/clsMember.php');
include_once('../controls/clsCommon.php');

if(isset($_SESSION['studentloggedin'])) {
    
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

              </div>
            </div>
          </div>
          <div class="page-header">
            <div class="pull-left">
              <h2>Ask Me</h2>
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
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Ask Me 
                  </div>
                </div>
                
                <div class="widget-body">
                    <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" enctype="multipart/form-data">
                        <div class="control-group span12 left-0">
                          <label class="control-label" for="password5">Query *</label>
                          <div class="controls">
                              <textarea name="message" id="message" class="span12" rows="5" style="width: 97%;"></textarea>
                          </div>
                        </div>
                        <div class="form-actions no-margin">
                            <span class="form-errors" id="onetimeerror"></span>
                            <input type="button" name="submit" class="btn btn-info pull-right" onclick="saveQuery()" value="Submit">
                          <div class="clearfix">
                          </div>
                        </div>
                    </form>
                    <br><br>
                    <?php
                    $objC = new Common();
                    $resC=$objC->getAllTicketByuserId($_SESSION['studentuserid']);
                    if($resC->rowCount()>0)
                    {
                    ?>
                    <table id="data-table" class="table table-bordered table-striped">
                        <tr>
                            <th width="10%">S.No.</th>
                            <th width="15%">Generated Date</th>
                            <th width="15%">Ticket No</th>
                            <th width="50%">Query</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php
                        $i=1;
                        while($row2=$resC->fetch(PDO::FETCH_ASSOC))
                        {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo date('d-m-Y h:i:s',strtotime($row2['generate_date'])); ?></td>
                            <td><?php echo $row2['ticketNo']; ?></td>
                            <td><?php echo $row2['query']; ?></td>
                            <td><a href="#myModal" class="btn btn-info btn-mini" data-toggle="modal" data-original-title="View Answer" onclick="getFollowupDetails('<?php echo $row2['ticketId']; ?>','<?php echo $row2['ticketNo']; ?>');"><i class="icon icon-zoom-in"></i></a></td>
                        </tr>
                        <?php $i++; } ?>
                    </table>
                    <?php } ?>
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
    function saveQuery()
    {
        var message=$("#message").val();
        if(message=='') 
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter query.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else 
        {
            $.post("../ajax/ajax-common.php",{
                q:'saveQuery',
                message:message,
                },function(data){
                window.location.reload();
            });
        }
    }
    
    function getFollowupDetails(ticketId,ticketNo)
    {
        $("#myModal .modal-body").html('<img src="../bootstrap/img/ajax-loader.gif">');
        $.post("../ajax/ajax-common.php",{
            q:'getFollowupDetails',
            ticketId:ticketId,
            ticketNo:ticketNo,
            },function(data){
            $("#myModal .modal-body").html(data);
        });
    }
    
    function saveFollowup()
    {
        var ticketId=$("#ticketId").val();
        var ticketNo=$("#ticketNo").val();
        var comment=$("#comment").val();
        
        if(comment=='') {
            $('#coursetimeerror').fadeIn();
            $("#coursetimeerror").html('Please enter query.');
            setTimeout(function() {
                $('#coursetimeerror').fadeOut();
            }, 5000 );
        }
        else 
        {
            $("#submit1").hide("fast");
            $("#processbtn1").show("fast");
            $("#myModal .modal-body").html('<img src="../bootstrap/img/ajax-loader.gif">');
            $.post("../ajax/ajax-common.php",{
                q:'saveFollowup',
                ticketId:ticketId,
                ticketNo:ticketNo,
                comment:comment,
                },function(data){
					
                $("#submit1").show("fast");
                $("#processbtn1").hide("fast");
					
                getFollowupDetails(ticketId,ticketNo);
            });
        }
        
    }
</script>
  
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 1000px; left: 460px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel" style="text-align:left;">Answer</h3>
    </div>
    <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="">
        
        <div class="modal-body" style="text-align:left;"></div>
        <div class="modal-footer">
            <span class="form-errors" id="coursetimeerror"></span>
            <input type="button" name="coursesubmit" id="submit1" class="btn btn-info btn-mini" onclick="saveFollowup()" value="Submit">
            <button type="button" id="processbtn1"  class="btn btn-success btn-lg" style="display:none;"><img src="../img/loading.gif" width="15px" height="15px"></button>
            <button class="btn btn-danger btn-mini" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </form>
</div>

  </body>
</html>