<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsCommon.php');

if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}
$flag=false;

$obj=new Common();

if(isset($_POST['coursesubmit']))
{
	$flag=true;
	$coursename=$_POST['coursename'];
	$price=$_POST['price'];
	$pacamount=$_POST['pacamount'];
	$coursecatId=$_POST['coursecatId'];
	$courseId=$_POST['courseId'];
	
	
	if(file_exists($_FILES['studydoc']['tmp_name']) || is_uploaded_file($_FILES['studydoc']['tmp_name']))
		{	
$randString = mt_rand(99,99999);
  $fileName = $_FILES["studydoc"]["name"];
  $splitName = explode(".", $fileName);
  $fileExt = end($splitName);
  
  if($fileExt)
  $newFileName  = strtolower($randString.'.'.$fileExt);
   move_uploaded_file( $_FILES['studydoc']['tmp_name'],"documents/".$newFileName);
    $studydoc = "documents/".$newFileName;
		}else{
			$studydoc=$_POST['pre_studydoc'];
		}
		
		$obj=new Common();
    $res=$obj->saveCourse($coursecatId,$courseId,$coursename,$price,$pacamount,$studydoc);
  
    if($res) 
    {
        $_SESSION['SuccessMessage']='Course details has been saved successfully';
		header("location:manageCourse.php?cid=".base64_encode($coursecatId));
		
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while saving course details'; 
		header("location:manageCourse.php?cid=".base64_encode($coursecatId));
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
              <h2>Manage Course</h2>
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
                <div  style="display:none;">
                     <div class="widget no-margin">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Add/Edit Course Category
                  </div>
                </div>
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" >
                    <input type="hidden" name="catId" id="catId" value="">
                    <div class="control-group span12 left-0">
                      <label class="control-label" for="email1">Course Category</label>
                      <div class="controls">
                          <input type="text" name="categoryname" id="categoryname" class="span12" placeholder="Enter Course Category"  value=""  />
                      </div>
                    </div>
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <input type="button" name="submit" class="btn btn-info pull-right" onclick="saveCategory()" value="Submit" id="submit" >
						<button type="button" id="processbtn"  class="btn btn-success btn-lg pull-right" style="display:none;"><img src="../img/loading.gif" width="15px" height="15px"></button>
                      <div class="clearfix">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
                </div>
                <div class="span10">
                     <div class="widget no-margin">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Manage Course
                  </div>
                </div>
                <div class="widget-body">
                  <div id="dt_example" class="example_alt_pagination">
                        <table id="data-table" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th width="5%">Sr.No.</th>
                                <th width="40%">Course Category</th>
                                <th width="15%">Action</th>
                              </tr>
                            </thead>
                            <tbody >
                                <?php
                                $i=1;
                                $query=$obj->getAllCategory();
                                while($row = $query->fetch_assoc())
                                {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['categoryname']; ?></td>
                                    <td>
<!--                                        <a href="javascript:void(0);" onclick="editCategory('<?php //echo $row['Id']; ?>','<?php //echo $row['categoryname']; ?>');" class="btn btn-success btn-mini" data-original-title="Edit"><i class="icon icon-pencil"></i></a> -->
                                        <a href="#myModal" onclick="addCourse('<?php echo $row['Id']; ?>');" data-toggle="modal" class="btn btn-info btn-mini" data-original-title="Manage Course Amount"><i class="icon icon-plus"></i></a> 
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
    
    


<?php if(isset($_GET['cid'])) { $cid=base64_decode($_GET['cid']); ?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
		addCourse(<?php echo $cid;?>);
    });
</script>
<?php }?>
<script>
    $(document).ready(function() {
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',maxDate:0,});
        $('#data-table').dataTable({
            "sPaginationType": "full_numbers",
            "iDisplayLength": 50,
        });
    });
    function editCategory(catId,categoryname)
    {
        $("#catId").val(catId);
        $("#categoryname").val(categoryname);
    }
    function editCourse(courseId,coursecatId,coursename,price,pacamount,studydoc)
    {
        $("#cfrm").show('fast');
        $("#submit1").show('fast');
        $("#courseId").val(courseId);
        $("#coursecatId").val(coursecatId);
        $("#coursename").val(coursename);
        $("#price").val(price);
        $("#pacamount").val(pacamount);
        $("#pre_studydoc").val(studydoc);
    }
    
    function addCourse(catId)
    {
        $("#submit1").hide('fast');
        $("#myModal .modal-body").html('<img src="../bootstrap/img/ajax-loader.gif">');
        $.post("../ajax/ajax-common.php",{
            q:'addCourse',
            catId:catId,
            },function(data){
            $("#myModal .modal-body").html(data);
        });
    }
    
    function saveCategory()
    {
        var categoryname=$("#categoryname").val();
        var catId=$("#catId").val();
        if(categoryname=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter course category name.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else 
        {
			$("#submit").hide("fast");
			$("#processbtn").show("fast");
            $.post("../ajax/ajax-common.php",{
                q:'saveCategory',
                categoryname:categoryname,
                catId:catId,
                },function(data){
                window.location.href='manageCourse.php';
            });
        }
        
    }
    function saveCourse()
    {
        var coursecatId=$("#coursecatId").val();
        var courseId=$("#courseId").val();
        var coursename=$("#coursename").val();
        var price=parseFloat($("#price").val());
        var pacamount=parseFloat($("#pacamount").val());
        var studydoc=$("#studydoc").val();
        
        if(coursename=='') {
            $('#coursetimeerror').fadeIn();
            $("#coursetimeerror").html('Please enter course name.');
            setTimeout(function() {
                $('#coursetimeerror').fadeOut();
            }, 5000 );
        }
        else if($("#price").val()=='') {
            $('#coursetimeerror').fadeIn();
            $("#coursetimeerror").html('Please enter price.');
            setTimeout(function() {
                $('#coursetimeerror').fadeOut();
            }, 5000 );
        }
        else if(isNaN(price)) {
            $('#coursetimeerror').fadeIn();
            $("#coursetimeerror").html('Please enter price as number.');
            setTimeout(function() {
                $('#coursetimeerror').fadeOut();
            }, 5000 );
        }
        else if($("#pacamount").val()=='') {
            $('#coursetimeerror').fadeIn();
            $("#coursetimeerror").html('Please enter pac amount.');
            setTimeout(function() {
                $('#coursetimeerror').fadeOut();
            }, 5000 );
        }
        else if(isNaN(pacamount)) {
            $('#coursetimeerror').fadeIn();
            $("#coursetimeerror").html('Please enter amount as number.');
            setTimeout(function() {
                $('#coursetimeerror').fadeOut();
            }, 5000 );
        }
         else if($("#studydoc").val()=='' && courseId=='') {
            $('#coursetimeerror').fadeIn();
            $("#coursetimeerror").html('Please upload study material document.');
            setTimeout(function() {
                $('#coursetimeerror').fadeOut();
            }, 5000 );
        }else if($("#studydoc").val()!='' && $("#studydoc").val()!='') {
			ext=$("#studydoc").val().split('.');
			if(ext[1]!='pdf')
			{
			$('#coursetimeerror').fadeIn();
            $("#coursetimeerror").html('Please upload file only pdf.');
            setTimeout(function() {
                $('#coursetimeerror').fadeOut();
            }, 5000 );
			return false;
			}
            
        }else{
			$("#submit1").hide("fast");
			$("#processbtn1").show("fast");
			return true;
		}
		
        /* else 
        {
			$("#submit1").hide("fast");
			$("#processbtn1").show("fast");
			
            $.post("../ajax/ajax-common.php",{
                q:'saveCourse',
                coursecatId:coursecatId,
                courseId:courseId,
                coursename:coursename,
                price:price,
                pacamount:pacamount,
                },function(data){
					
					$("#submit1").show("fast");
					$("#processbtn1").hide("fast");
					
                    addCourse(coursecatId);
            });
        } */
        
    }
</script>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 1000px; left: 460px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel" style="text-align:left;">Manage Course Amount</h3>
    </div>
    <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" enctype="multipart/form-data">
        
        <div class="modal-body" style="text-align:left;"></div>
        <div class="modal-footer">
            <span class="form-errors" id="coursetimeerror"></span>
            <input type="submit" name="coursesubmit" id="submit1" class="btn btn-info btn-mini" onclick="return saveCourse()" value="Submit">
            <button type="button" id="processbtn1"  class="btn btn-success btn-lg" style="display:none;"><img src="../img/loading.gif" width="15px" height="15px"></button>
            <button class="btn btn-danger btn-mini" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </form>
</div>
  </body>
</html>