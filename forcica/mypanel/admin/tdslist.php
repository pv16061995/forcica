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
              <h2>TDS List</h2>
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
                    <span class="fs1" aria-hidden="true" data-icon=""></span> TDS List
                  </div>
                <div class="pull-right">
                    <select name="stmonth" id="stmonth">
                        <option value="">Select Month</option>
                        <option value="01" <?php if(date('m')=='01') { echo 'selected'; } ?>>January</option>
                        <option value="02" <?php if(date('m')=='02') { echo 'selected'; } ?>>February</option>
                        <option value="03" <?php if(date('m')=='03') { echo 'selected'; } ?>>March</option>
                        <option value="04" <?php if(date('m')=='04') { echo 'selected'; } ?>>April</option>
                        <option value="05" <?php if(date('m')=='05') { echo 'selected'; } ?>>May</option>
                        <option value="06" <?php if(date('m')=='06') { echo 'selected'; } ?>>June</option>
                        <option value="07" <?php if(date('m')=='07') { echo 'selected'; } ?>>July</option>
                        <option value="08" <?php if(date('m')=='08') { echo 'selected'; } ?>>August</option>
                        <option value="09" <?php if(date('m')=='09') { echo 'selected'; } ?>>September</option>
                        <option value="10" <?php if(date('m')=='10') { echo 'selected'; } ?>>October</option>
                        <option value="11" <?php if(date('m')=='11') { echo 'selected'; } ?>>November</option>
                        <option value="12" <?php if(date('m')=='12') { echo 'selected'; } ?>>December</option>
                    </select>
                    <select name="styear" id="styear">
                        <option value="">Select Year</option>
                        <?php 
                        for($i=2017; $i<=(date('Y')+1);$i++) {
                        ?>
                        <option value="<?php echo $i; ?>" <?php if(date('Y')==$i) { echo 'selected'; } ?>><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <a href="javascript:void(0);" class="btn btn-info " style="margin-bottom: 10px;" data-original-title="Go" onclick="searchTDSList();">Go</a>
                    <a href="javascript:void(0);" class="btn btn-warning2 " style="margin-bottom: 10px;" data-original-title="Export" onclick="exportExcel();">Export Excel</a>
                    <a class="btn btn-success " href="#myModalmail" role="button" style="margin-bottom: 10px;" data-toggle="modal" data-original-title="Push Mail" onclick="setemail();">Push Mail</a>
                </div>  
                </div>
                <div class="widget-body">
                  <div id="dt_example" class="example_alt_pagination">
                      <div id="data"></div>  
                        
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
    <script src="<?php echo BASEPATH; ?>js/ckeditor/ckeditor.js" type="text/javascript"></script>
    
<script>
    $(document).ready(function() {
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',maxDate:0,});
        CKEDITOR.replace('bodymessage');
        //searchSTList();
    });
    
    function searchTDSList()
    {
        var stmonth=$("#stmonth").val();
        var styear=$("#styear").val();
        
        if(stmonth=='')
        {
            alert('Please select month');
        }
        else if(styear=='')
        {
            alert('Please select year');
        }
        else {
            $("#data").html('<img src="../bootstrap/img/ajax-loader.gif">');
            $.post("../ajax/ajax-common.php",{
                q:'searchTDSList', 
                stmonth:stmonth,
                styear:styear,
            },function(data){
                 $("#data").html(data);
                 $('#data-table').dataTable({
                    "sPaginationType": "full_numbers",
                    "iDisplayLength": 50,
                });
            });
        }
            
    }
    
    function exportExcel()
    {
        var stmonth=$("#stmonth").val();
        var styear=$("#styear").val();
        
        if(stmonth=='')
        {
            alert('Please select month');
        }
        else if(styear=='')
        {
            alert('Please select year');
        }
        else {
            window.open('tdsexcel.php?stmonth='+stmonth+'&styear='+styear+'','_blank');
        }
    }
    
    function setemail()
    {
        var stmonth=$("#stmonth").val();
        var styear=$("#styear").val();
        
        if(stmonth=='')
        {
            alert('Please select month');
        }
        else if(styear=='')
        {
            alert('Please select year');
        }
        else {
            $.post("../ajax/ajax-common.php",{
                q:'settdsemail',
                stmonth:stmonth,
                styear:styear,
                },function(data){
                var ret=data.split('^');
                $("#filefound").val(ret[1]);
                $("#emailfrom").val(ret[2]);
                $("#filename").val(ret[4]);
                $("#filenames").val(ret[5]);
            });
        }
    }
    
    function validateemail()
    {
        var filefound=$("#emailfrm #filefound").val();
        
        if(filefound==0 && filefound!='')
        {
            alert("Please generate tds excel first");
        }
        else 
        {
            var filename=$("#emailfrm #filename").val();
            var emailfrom=$("#emailfrm #emailfrom").val();
            var mailto=$("#emailfrm #emailto").val();
            var bodymessage=CKEDITOR.instances.bodymessage.getData();
            var subject=$("#emailfrm #subject").val();
            var filenames=$("#emailfrm #filenames").val();
            
            if(mailto=='')
            {
                $('#onetimeerror').fadeIn();
                $("#onetimeerror").html('Please enter email id.');
                setTimeout(function() {
                    $('#onetimeerror').fadeOut();
                }, 5000 );
            }
            else if(subject=='')
            {
                $('#onetimeerror').fadeIn();
                $("#onetimeerror").html('Please enter subject.');
                setTimeout(function() {
                    $('#onetimeerror').fadeOut();
                }, 5000 );
            }
            else if(bodymessage=='')
            {
                $('#onetimeerror').fadeIn();
                $("#onetimeerror").html('Please enter message.');
                setTimeout(function() {
                    $('#onetimeerror').fadeOut();
                }, 5000 );
            }
            else
            {
                mailthis(mailto,bodymessage,subject,filename,emailfrom,filenames);
                $(".modal-footer .btn-success").html('Sending Mail...');
            }
        }
    }

    function mailthis(email, bodymessage, subject,filename,emailfrom,filenames){
        var to=email;
        
        $.post("../ajax/ajax-common.php",{
            q:'mailthis',
            to:to,
            bodymessage:bodymessage,
            subject:subject,
            filename:filename,
            emailfrom:emailfrom,
            filenames:filenames,
            },function(data){
            window.location.reload();
        });
    }
</script>

<?php
echo '<div id="myModalmail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 650px;left: 45%;">';
    echo '<div class="modal-header">';
      echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>';
      echo '<h3 id="myModalLabel" style="text-align:left;">Send Mail</h3>';
    echo '</div>';
    echo '<div class="modal-body" style="text-align:left;">';
        echo '<form name="emailfrm" id="emailfrm" method="post" action="">';
        echo '<div class="row-fluid">';
            echo '<div class="span12">';
                echo '<div class="control-group">';
                    echo '<label class="control-label" for="subject">Email Id</label>';
                    echo '<div class="controls">';
                      echo '<input type="text" id="emailto" name="emailto" placeholder="emailto" class="span12" data-prompt-position="topLeft"><br><span style="color:red;font-size:10px;">Comma separated Email Ids, if more than one.</span>';  
                      echo '<input type="hidden" id="emailfrom" name="emailfrom"><input type="hidden" id="filefound" name="filefound"><input type="hidden" id="filename" name="filename"><input type="hidden" id="filenames" name="filenames">';  
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<div class="row-fluid">';
            echo '<div class="span12">';
                echo '<div class="control-group">';
                    echo '<label class="control-label" for="subject">Subject</label>';
                    echo '<div class="controls">';
                      echo '<input type="text" id="subject" name="subject" placeholder="Subject" class="span12" data-prompt-position="topLeft">';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<div class="row-fluid">';
            echo '<div class="span12">';
                echo '<div class="control-group">';
                    echo '<label class="control-label" for="bodymessage">Message</label>';
                    echo '<div class="controls">';
                      echo '<textarea id="bodymessage" name="bodymessage" class="validate[required] span12" rows="5" style="resize:none;"></textarea>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '</form>';
    echo '</div>';
    echo '<div class="modal-footer">';
      echo '<span class="form-errors" id="onetimeerror" style="margin-right:15px;"></span>';
      echo '<button class="btn btn-success btn-mini" onclick="validateemail();">Send</button>';
      echo '<button class="btn btn-danger btn-mini" data-dismiss="modal" aria-hidden="true">Close</button>';
    echo '</div>';
  echo '</div>';
?>

  </body>
</html>