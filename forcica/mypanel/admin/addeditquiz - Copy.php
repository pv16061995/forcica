<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsCommon.php');

if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}

$obj=new Common();
$flag=false;

if(isset($_POST['submit']))
{
	
	$course_cat=$_POST['course_cat'];
	$course=$_POST['course'];
	$title=ucfirst(strtolower(addslashes(trim($_POST['title']))));
	$retake=$_POST['retake'];
	$passing_grade=$_POST['passing_grade'];
	$duration=$_POST['duration'];
	
	if($_POST['eqid']!='')
	{
		
		$lid=$_POST['eqid'];
		$lid1=$obj->updatelessonquiz($course_cat,$course,$title,$retake,$passing_grade,$duration,$lid);
		
	}else{
		$lid=$obj->savelessonquiz($course_cat,$course,$title,$retake,$passing_grade,$duration);
	}
	
	
	
	$count_ques=$_POST['count_ques'];
	for($i=1;$i<=$count_ques;$i++)
	{
		if($_POST['eid'.$i]!=''){
		
		$resP=$obj->updatequestionanswer($lid,
		ucfirst(strtolower(addslashes(trim($_POST['question_'.$i])))),
		ucfirst(strtolower(addslashes(trim($_POST['quizansoption_one'.$i])))),
		ucfirst(strtolower(addslashes(trim($_POST['quizansoption_two'.$i])))),
		ucfirst(strtolower(addslashes(trim($_POST['quizansoption_three'.$i])))),
		ucfirst(strtolower(addslashes(trim($_POST['quizansoption_four'.$i])))),
		$_POST['quizcorrectans_'.$i],
		$_POST['eid'.$i]
		);
		if($resP)
		{
			$query='1';
		}else{
			$query='';
		}
		}else{
		
		$resP=$obj->savequestionanswer($lid,
		ucfirst(strtolower(addslashes(trim($_POST['question_'.$i])))),
		ucfirst(strtolower(addslashes(trim($_POST['quizansoption_one'.$i])))),
		ucfirst(strtolower(addslashes(trim($_POST['quizansoption_two'.$i])))),
		ucfirst(strtolower(addslashes(trim($_POST['quizansoption_three'.$i])))),
		ucfirst(strtolower(addslashes(trim($_POST['quizansoption_four'.$i])))),
		$_POST['quizcorrectans_'.$i]
		);
		
		if($resP)
		{
			$query='1';
		}else{
			$query='';
		}
		}
	}
   
    
    
    if($query)
    {
        $_SESSION['SuccessMessage']='Detail has been updated successfully';
		header("location:managequiz.php");
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while updating detail';
		header("location:managequiz.php");
    }
    
}

if(isset($_GET['id']))
{
	$flag=true;
    $id=base64_decode($_GET['id']);
    $res=$obj->getquizlistById($id);
    $data_les=$res->fetch_assoc();
	
	
    $res_quiz=$obj->getquizanslistByLId($data_les['id']);
	$res_quiz_count=$res_quiz->num_rows;

    
	  
   
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
              <h2> Add/Edit Quiz </h2>
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
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span>  Add/Edit Quiz 
                  </div>
                </div>
                
                 <div class="widget-body">
                    <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="">
					<input type="hidden" value="<?php if($flag){ echo base64_decode($_GET['id']);} ?>" name="eqid">
                    <div class="row-fluid">
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="email1">Category*</label>
                      <div class="controls">
                           <select name="course_cat" id="course_cat" class="span12" onchange="catByCourse();">
                            <option value="">Select Course Category</option>
							<?php	
						$obj=new Common();
						$query=$obj->getAllCategory();
                        while($row = $query->fetch_assoc())
                        {
						?>
						<option value="<?php echo $row['Id']; ?>" <?php if($flag){if($row['Id']==$data_les['course_cat']){ echo "selected";}}?>><?php echo $row['categoryname'];?></option>
						<?php }?>
						
                        </select>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Course*</label>
                      <div class="controls">
                        <select name="course" id="course" class="span12">
                            <option value="">Select Course</option>
                          </select>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="quiz_title">Quiz Title*</label>
                      <div class="controls">
                        <input type="text" name="title" id="title" class="span12" placeholder="Enter Quiz Title" value="<?php if($flag){ echo $data_les['title'];}?>">
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">No of Retake Quiz*</label>
                      <div class="controls">
                        <input type="text" name="retake" id="retake" class="span12" placeholder="Enter retake quiz" value="<?php if($flag){ echo $data_les['retake'];}?>">
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">Passing Grade*</label>
                      <div class="controls">
                        <input type="text" name="passing_grade" id="passing_grade" class="span12" placeholder="Enter Passing Grade" value="<?php if($flag){ echo $data_les['passing_grade'];}?>">
						<span style="color: #e91616;font-weight: 700;">Passing grade in percentage</span>
                      </div>
                    </div>
                    <div class="control-group span6 left-0">
                      <label class="control-label" for="password5">
                        Quiz Time Duration
                      </label>
                      <div class="controls">
                         <input type="text" name="duration" class="span12" value="<?php if($flag){ echo $data_les['duration'];}?>" placeholder="Quiz Time Duration">
						 <span style="color: #e91616;font-weight: 700;">Time Duration in Min</span>
                      </div>
                    </div>
                </div>
				
				<div class="row-fluid">
				<input type="hidden" id="totalimage" name="count_ques" value="<?php if($flag){ echo $res_quiz_count; }else{ echo '1';}?>">
				<input type="hidden" id="pnumrows" name="pnumrows" value="1">
				  <div style="float:left;margin-left: 87%;">
				      <a href="javascript:void(0);" class="btn btn-info" style="margin-top:0px;float:right;margin-bottom:10px;" onclick="AddMore();" data-original-title=""> Add More</a>
					  </div>
					  <div id="removebtn" style="float:right;">
				<a href="javascript:void(0);" id="removebtn" class="btn btn-danger" style="margin-top:0px; margin-right:0px;" onclick="removeLast();" data-original-title="">Delete</a>
				</div>
				
				</div>
				
				<?php if($flag){ 
				$i=1;
				 while($data_quiz=$res_quiz->fetch_assoc())
				{
				?>
				<div class="row-fluid">
				<input type="hidden" value="<?php echo $data_quiz['qid']?>" name="eid<?php echo $i?>">
				<div class="control-group span12 left-0">
                      <label class="control-label" for="password5">
                        Question: 
                      </label>
                      <div class="controls">
                         <input type="text" name="question_<?php echo $i;?>" class="span12" value="<?php echo $data_quiz['question']?>" placeholder="Enter Question">
                      </div>
                </div>
				
				<div class="control-group span12 left-0">
                      <label class="control-label" for="password5">Answer: </label>
                      <div class="controls">
                       <input type="text" name="quizansoption_one<?php echo $i;?>" id="quizansoption_one<?php echo $i;?>" class="span6" placeholder="Enter Answer Option" value="<?php echo $data_quiz['ans1']?>">
					   <input type="radio" name="quizcorrectans_<?php echo $i;?>" value="1" <?php if($data_quiz['correntans']=='1'){echo "checked";}?>> 
                      </div>
                      
                     <div class="controls" style="margin-top: 10px;">
                       <input type="text" name="quizansoption_two<?php echo $i;?>" id="quizansoption_two<?php echo $i;?>" class="span6" placeholder="Enter Answer Option" value="<?php echo $data_quiz['ans2']?>">
					   <input type="radio" name="quizcorrectans_<?php echo $i;?>" value="2" <?php if($data_quiz['correntans']=='2'){echo "checked";}?>> 
                      </div>
                      <div class="controls" style="margin-top: 10px;">
                       <input type="text" name="quizansoption_three<?php echo $i;?>" id="quizansoption_three<?php echo $i;?>" class="span6" placeholder="Enter Answer Option" value="<?php echo $data_quiz['ans3']?>"> 
					   <input type="radio" name="quizcorrectans_<?php echo $i;?>" value="3" <?php if($data_quiz['correntans']=='3'){echo "checked";}?>> 
                      </div>
                      <div class="controls" style="margin-top: 10px;">
                       <input type="text" name="quizansoption_four<?php echo $i;?>" id="quizansoption_four<?php echo $i;?>" class="span6" placeholder="Enter Answer Option" value="<?php echo $data_quiz['ans4']?>">
					   <input type="radio" name="quizcorrectans_<?php echo $i;?>" value="4" <?php if($data_quiz['correntans']=='4'){echo "checked";}?>> 
                      </div>
                    </div>
                       
                      
                   		
                </div>
				<?php $i++;}}else{?>
				
				<div class="row-fluid">
				<input type="hidden" value="" name="eid_1">
				<div class="control-group span12 left-0">
                      <label class="control-label" for="password5">
                        Question: 
                      </label>
                      <div class="controls">
                         <input type="text" name="question_1" class="span12" value="" placeholder="Enter Question">
                      </div>
                </div>
				
				<div class="control-group span12 left-0">
                      <label class="control-label" for="password5">Answer: </label>
                      <div class="controls">
                       <input type="text" name="quizansoption_one1" id="quizansoption_one1" class="span6" placeholder="Enter Answer Option" value="">
					   <input type="radio" name="quizcorrectans_1" value="1"> 
                      </div>
                      
                     <div class="controls" style="margin-top: 10px;">
                       <input type="text" name="quizansoption_two1" id="quizansoption_two1" class="span6" placeholder="Enter Answer Option" value="">
					   <input type="radio" name="quizcorrectans_1" value="2"> 
                      </div>
                      <div class="controls" style="margin-top: 10px;">
                       <input type="text" name="quizansoption_three1" id="quizansoption_three1" class="span6" placeholder="Enter Answer Option" value=""> 
					   <input type="radio" name="quizcorrectans_1" value="3"> 
                      </div>
                      <div class="controls" style="margin-top: 10px;">
                       <input type="text" name="quizansoption_four1" id="quizansoption_four1" class="span6" placeholder="Enter Answer Option" value="">
					   <input type="radio" name="quizcorrectans_1" value="4"> 
                      </div>
                    </div>
                       
                      
                   		
                </div>
				<?php }?>
				<div id="addmore">
				</div>
				 <div class="row-fluid">
                      
                        
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <input type="submit" name="submit" class="btn btn-info pull-right" value="Submit" onclick="saveQuiz();">
                      <div class="clearfix">
                      </div>
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
		
		catByCourse();
    });
	
	///////////////////////////////   Category Courses ////////////////////////
	function catByCourse()
    {
       var category=$('#course_cat').val();
	   <?php if($flag){?>
       var subcat=<?php echo $data_les['course'];?>;
	   <?php }else{?>
	   var subcat='';
	   <?php }?>
		$("#course").html('Please wait ...');
		$.post("../ajax/ajax-common.php",{
			q:'coursecatByCourse',
			category:category,
			subcat:subcat,
		},function(data){
			$('#course').html(data);
		});
        
    }
    ///////////////////////////////   Category Courses ////////////////////////
	
	
	
	
    ///////////////////////////////   add more ////////////////////////
	
	function AddMore()
{
       var total = $("#totalimage").val();
	   
		 total++;
	    $("#totalimage").val(total);
        $("#removebtn").show();
        $('#addmore').append('<div class="row-fluid'+total+'"><input type="hidden" value="" name="eid'+total+'"><div class="control-group span12 left-0"><label class="control-label" for="password5">Question: </label><div class="controls"><input type="text" name="question_'+total+'" class="span12" value="" placeholder="Enter Question"></div></div><div class="control-group span12 left-0"><label class="control-label" for="password5">Answer: </label><div class="controls"><input type="text" name="quizansoption_one'+total+'" id="quizansoption_one'+total+'" class="span6" placeholder="Enter Answer Option"  value="" /><input type="radio" name="quizcorrectans_'+total+'" value="1"></div><div class="controls"  style="margin-top: 10px;"><input type="text" name="quizansoption_two'+total+'" id="quizansoption_two'+total+'" class="span6" placeholder="Enter Answer Option"  value="" /><input type="radio" name="quizcorrectans_'+total+'" value="2"> </div><div class="controls" style="margin-top: 10px;"><input type="text" name="quizansoption_three'+total+'" id="quizansoption_three'+total+'" class="span6" placeholder="Enter Answer Option"  value="" /><input type="radio" name="quizcorrectans_'+total+'" value="3"> </div><div class="controls" style="margin-top: 10px;"><input type="text" name="quizansoption_four'+total+'" id="quizansoption_four'+total+'" class="span6" placeholder="Enter Answer Option"  value="" /><input type="radio" name="quizcorrectans_'+total+'"  value="4"> </div></div></div>');
        
    
    $("#totalimage").val(total);
}

 function removeLast()
{

    var numrows=$("#totalimage").val();
	$(".row-fluid"+numrows).remove();
	numrows--;
	$("#totalimage").val(numrows);
} 


 ///////////////////////////////   add more ////////////////////////
 
 
 ///////////////////////////////   validation ////////////////////////
 function saveQuiz()
    {
        var category=$("#course_cat").val();
        var course=$("#course").val();
        var quiz_title=$("#quiz_title").val();
        var retake=$("#retake").val();
        var passing_grade=$("#passing_grade").val();
        var duration=$("#duration").val();
		
		
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
 
 ///////////////////////////////   validation ////////////////////////
 
 
 </script>
  
  </body>
</html>