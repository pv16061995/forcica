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

              </div>
            </div>
          </div>
          <div class="page-header">
            <div class="pull-left">
              <h2>Manage Quiz</h2>
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
              <div class="widget no-margin">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Quiz List
                  </div>
                  <div class="pull-right">
                        <select name="category" id="category" class="" onchange="catByCourse();">
                           <!-- <option value="">Select Course Category</option>-->
						<?php	
						$obj=new Common();
						$query=$obj->getAllCategory();
                        while($row = $query->fetch_assoc())
                        {
						?>
                            <option value="<?php echo $row['Id']; ?>"><?php echo $row['categoryname'];?></option>
						<?php }?>
						
                        </select>
                        <select name="course" id="course" class="" onchange="searchdata();">
                            <option value="">Select Course</option>
                          </select> 
						  <!-- <a href="javascript:;" data-toggle="tooltip" class="btn btn-primary btn-mini" data-original-title="Go"  style="margin-bottom: 10px;">Go</a>
						  -->
						  <a href="addeditquiz.php" data-toggle="tooltip" class="btn btn-success btn-mini" data-original-title="Add Quiz" style="margin-bottom: 10px;"><i class="icon icon-plus"></i></a>
                    </div>
                </div>
                <div class="widget-body">
                  <div id="dt_example" class="example_alt_pagination">
                      <div id="data">
                          <?php
//                          $tabledata='<table id="data-table" class="table table-bordered table-striped">
//                                <thead>
//                                  <tr>
//                                    <th width="5%">S.No.</th>
//                                    <th width="12%">Created Date</th>
//                                    <th width="30%">Title</th>
//                                    <th width="12%">Retake Exam</th>
//                                    <th width="12%">Passing Grade</th>
//                                    <th width="12%">Duration</th>
//                                    <th width="10%">Action</th>
//                                  
//                                  </tr>
//                                </thead>
//                                <tbody>';
//                                    $obj=new Common();
//                                    $res=$obj->getallquizlist();
//                                    $i=1;
//                                    while($row=$res->fetch_assoc())
//                                    {
//                                    $tabledata .='<tr>
//                                        <td>'.$i.'</td>
//                                        <td>'.date('d M, Y',strtotime($row['datetime'])).'</td>  
//                                        <td>'.$row['title'].'</td>
//                                        <td>'.$row['retake'].'</td>
//                                        
//                                        <td>'.$row['passing_grade'].'</td>    
//                                        <td>'.$row['duration'].'</td> 
//										<td><a href="addeditquiz.php?id='.base64_encode($row['id']).'" class="btn btn-mini btn-success" data-toggle="tooltip" data-original-title="Edit"><i class="icon icon-pencil"></i></a></td>
//                                         
//                                    </tr>';    
//                                $i++; }
//                                $tabledata .='</tbody>
//                            </table>';

                          //  echo $tabledata;
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
		catByCourse1('1');
		searchdata();
    });
   </script>
   <script>
    $(document).ready(function() {
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',});
    });
	
	function catByCourse()
	{
		catByCourse1();
	}
    
    function catByCourse1(str)
    {
       var category=$('#category').val();
		$("#course").val('Please wait ...');
		$.post("../ajax/ajax-common.php",{
			q:'coursecatByCourse',
			category:category,
			str:str
		},function(data){
			$('#course').html(data);
		});
        
    }
	
    function searchdata()
    {
       var category=$('#category').val();
       var course=$('#course').val();
		
        $.post("../ajax/ajax-common.php",{
                q:'searchdataquiz',
                category:category,
                course:course,
        },function(data){
                $('#data').html(data);
                $('#data-table').dataTable({
                "sPaginationType": "full_numbers"
                });
                $('[data-toggle=toggle]').tooltip();
        });
        
    }
    
    function addVideo(lessonId)
    {
        $("#myModal .modal-body").html('<img src="../bootstrap/img/ajax-loader.gif">');
        $.post("../ajax/ajax-common.php",{
            q:'addVideo',
            lessonId:lessonId,
            },function(data){
            $("#myModal .modal-body").html(data);
        });
    }
    function editVideo(vId,lessonId)
    {
        $("#lessonId").val(lessonId);
        $("#vId").val(vId);
        $.post("../ajax/ajax-common.php",{
            q:'editVideo',
            lessonId:lessonId,
            vId:vId,
            },function(data){
            var ret=data.split('^');    
            $("#videodata").val(ret[1]);
        });
    }
    
    function saveVideo()
    {
        var lessonId=$("#lessonId").val();
        var vId=$("#vId").val();
        var videodata=$("#videodata").val();
        
        if(videodata=='') {
            $('#coursetimeerror').fadeIn();
            $("#coursetimeerror").html('Please enter video data.');
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
                q:'saveVideo',
                lessonId:lessonId,
                vId:vId,
                videodata:videodata,
                },function(data){
					
                $("#submit1").show("fast");
                $("#processbtn1").hide("fast");
					
                addVideo(lessonId);
            });
        }
        
    }
   
   
    function deleteVideo(lessonId,vId)
    {
        var r=confirm('Are you sure you want to delete this video ?');
        if(r)
        {
            $("#myModal .modal-body").html('<img src="../bootstrap/img/ajax-loader.gif">');
            $.post("../ajax/ajax-common.php",{
                q:'deleteVideo',
                lessonId:lessonId,
                vId:vId,
                },function(data){
                addVideo(lessonId);
            });
        }
    }
</script>
</script>


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 1000px; left: 460px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel" style="text-align:left;">Manage Video</h3>
    </div>
    <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="">
        
        <div class="modal-body" style="text-align:left;"></div>
        <div class="modal-footer">
            <span class="form-errors" id="coursetimeerror"></span>
            <input type="button" name="coursesubmit" id="submit1" class="btn btn-info btn-mini" onclick="saveVideo()" value="Submit">
            <button type="button" id="processbtn1"  class="btn btn-success btn-lg" style="display:none;"><img src="../img/loading.gif" width="15px" height="15px"></button>
            <button class="btn btn-danger btn-mini" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </form>
</div>

  </body>
</html>