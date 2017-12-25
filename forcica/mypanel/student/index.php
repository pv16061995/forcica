<?php 
include_once('../controls/config.php');

if(isset($_SESSION['studentloggedin']) && $_SESSION['studentuserid'] != 1) {
    
} 
else 
{
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
    
    <script src="<?php echo BASEPATH; ?>bootstrap/js/html5-trunk.js"></script>
    <link href="<?php echo BASEPATH; ?>bootstrap/icomoon/style.css" rel="stylesheet" />
    
    <!-- NVD graphs css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/nvd-charts.css" rel="stylesheet" />

    <!-- Bootstrap css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/main.css" rel="stylesheet" />
    <link rel="icon" href="<?php echo BASEPATH;; ?>bootstrap/images/admin-logo.png" type="image/x-icon">
    <!-- fullcalendar css -->
    <link href='<?php echo BASEPATH; ?>bootstrap/css/fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link rel="stylesheet" href="<?php echo BASEPATH; ?>js/chosen/chosen.css" />
    
    <link href='<?php echo BASEPATH; ?>bootstrap/css/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link href='<?php echo BASEPATH; ?>bootstrap/css/jquery-ui.css' rel='stylesheet' />
    <link href='<?php echo BASEPATH; ?>bootstrap/css/validationEngine.jquery.css' rel='stylesheet' />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo BASEPATH; ?>js/jquery.validate.min.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/validatesubmit.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-ui-date.js"></script>
    <script type="text/javascript" src="<?php echo BASEPATH; ?>js/chosen/chosen.jquery.js"></script> 
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.validationEngine.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/languages/jquery.validationEngine-en.js"></script>
    
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
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
              <h2>Dashboard</h2>
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
          </div>

            <div class="row-fluid" style="display: none;">
            <div class="span12">
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe09f;"></span> Quick Access
                  </div>
                </div>
                <div class="widget-body">
                    <a href="" class="quick-action-btn span2 input-bottom-margin" data-original-title="You have 2 paid merchant">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe1c9;"></span> 
                    <p class="no-margin">Paid Merchant</p>
                    <div class="label label-info">2</div>
                  </a>  
                  <a href="" class="quick-action-btn span2 input-bottom-margin" data-original-title="You have 3 free merchant">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe1cb;"></span> 
                    <p class="no-margin">Free Merchant</p>
                    <div class="label label-important">3</div>
                  </a>
                  
                  <a href="" class="quick-action-btn span2 input-bottom-margin" data-original-title="You have 3 new member">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe15e;"></span> 
                    <p class="no-margin">New Member</p>
                    <div class="label label-success">3</div>
                  </a>
                  <a href="" class="quick-action-btn span2 input-bottom-margin" data-original-title="You have 3 issued member">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe16d;"></span> 
                    <p class="no-margin">Issued Member</p>
                    <div class="label label-warning">2</div>
                  </a>
                  <a href="" class="quick-action-btn span2 input-bottom-margin" data-original-title="You have 3 vendor">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe0d0;"></span> 
                    <p class="no-margin">Vendor</p>
                    <div class="label label-important">3</div>
                  </a>
                  
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
        <div class="row-fluid" style="display: none;">    
            <div class="span6">
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe0b3;"></span> Todo list
                  </div>
                </div>
                <div class="widget-body">
                  <div class="todo-container">
                      <ul class="todo-list" id="todo-list">
                        
                       </ul>
                    <form action="#" class="no-margin" />
                      <div class="control-group">
                        <div class="controls">
                            <textarea class="input-block-level" id="task" name="task" placeholder="Add new task"></textarea>
                        </div>
                      </div>
                        <div class="control-group">
                        <div class="controls">
                            <input type="text" name="cdate" id="cdate" readonly class="custom-dt" style="cursor:pointer;"/>
                        </div>
                      </div>
                      <span class="form-errors"></span>
                      <div class="control-group no-margin">
                        <div class="controls">
                            <input type="button" class="btn btn-info pull-right" name="create" id="create" value="Save" onclick="saveTododata();"/>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

         

        </div>
      </div><!-- dashboard-container -->
    </div><!-- container-fluid -->
<script>
$(document).ready(function() {
    $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',minDate:0,});
    $('#data-table2').dataTable({
        "sPaginationType": "full_numbers"
      });
});

function saveTododata()
{
    var task=$("#task").val();
    var cdate=$("#cdate").val();
    
    if(task=='') 
    {
        $('.form-errors').fadeIn();
        $(".form-errors").html("Please enter your task");
        setTimeout(function() {
            $('.form-errors').fadeOut();
        }, 5000 );
    }
    else if(cdate=='') 
    {
        $('.form-errors').fadeIn();
        $(".form-errors").html("Please enter task date");
        setTimeout(function() {
            $('.form-errors').fadeOut();
        }, 5000 );
    }
    else {
        $.post("ultpanel/dashboard/saveTododata",{
           task:task,
           cdate:cdate,
        },function(data){
            $("#todo-list").html(data);
            $("#task").val('');
            $("#cdate").val('');
        });
    }
}

function updateTodostatus(Id)
{
   var status=0;
   if($("#taskch"+Id).is(":checked"))
   {
       status=1;
   }
   $.post("ultpanel/dashboard/updateTodostatus",{
        Id:Id,
        status:status,
     },function(data){
        
     });
   
}

function deleteToDoData(Id)
{
    var r=confirm('Are you sure you want to delete this');
    if(r) {
        $.post("ultpanel/dashboard/deleteToDoData",{
            Id:Id,
         },function(data){
             $("#lst"+Id).hide('fast');
         });
    }
}
</script>

    <script src="<?php echo BASEPATH; ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/moment.js"></script>

    
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

    <!-- Calendar Js -->
    <script src='<?php echo BASEPATH; ?>bootstrap/js/fullcalendar/jquery-ui-1.10.2.custom.min.js'></script>
    <script src='<?php echo BASEPATH; ?>bootstrap/js/fullcalendar/fullcalendar.min.js'></script>

    <!-- Custom Js -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom-index.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom-calendar.js"></script>

    <script src="<?php echo BASEPATH; ?>bootstrap/js/theming.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom.js"></script>
    
  </body>
</html>