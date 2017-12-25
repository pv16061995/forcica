<?php
include_once('../controls/config.php');
include_once('../controls/clsCommon.php');
include_once('../controls/clsUser.php');
include_once('../controls/clsAlerts.php');

if (isset($_SESSION['studentloggedin']) && $_SESSION['studentuserid'] != 1) {
    
} else {
    header('location: ../index.php');
}
$objC = new Common;
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
        <link rel="icon" href="<?php echo BASEPATH;
; ?>bootstrap/images/admin-logo.png" type="image/x-icon">
        <!-- fullcalendar css -->
        <link href='<?php echo BASEPATH; ?>bootstrap/css/fullcalendar/fullcalendar.css' rel='stylesheet' />
        <link rel="stylesheet" href="<?php echo BASEPATH; ?>js/chosen/chosen.css" />

        <link href='<?php echo BASEPATH; ?>bootstrap/css/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
        <link href='<?php echo BASEPATH; ?>bootstrap/css/jquery-ui.css' rel='stylesheet' />
        <link href='<?php echo BASEPATH; ?>bootstrap/css/validationEngine.jquery.css' rel='stylesheet' />
        <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript">
$(document).ready(function () {

    //Disable cut copy paste
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
   
    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });
});
</script>

        <script src="<?php echo BASEPATH; ?>js/jquery.validate.min.js"></script>
        <script src="<?php echo BASEPATH; ?>bootstrap/js/validatesubmit.js"></script>
        <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-ui-date.js"></script>
        <script type="text/javascript" src="<?php echo BASEPATH; ?>js/chosen/chosen.jquery.js"></script> 
        <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.validationEngine.js"></script>
        <script src="<?php echo BASEPATH; ?>bootstrap/js/languages/jquery.validationEngine-en.js"></script>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



    </head>


    <body>
<?php include_once('include/header.php'); ?>
        <div class="container-fluid">
        <?php // include_once('include/left-navigation.php');  ?>
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
                            <h2>Study Material <span style="font-size:16px; text-align: right; color: #f90909; display: none;" id="warn">Please don't reload the page otherwise your 1 take will be completed </span></h2>
                            
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
                                <li class="color-second" style="display:none;" id="quiztimerht">
                                    <span class="fs1" aria-hidden="true" data-icon="&#xe04b;"></span>
                                    <div class="details" id="">
                                        <span id="quiztimer" class="big"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    <?php
                    ShowAlerts();
                    ?>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="span4">
                                <div id="accordion3" class="accordion no-margin">

                                    <?php
                                    if (isset($_GET['catId'])) 
                                    {
                                        $catId = base64_decode($_GET['catId']);

                                        $courseId = base64_decode($_GET['courseId']);
                                        
                                        $lessionId=array();
                                        $result=array();
                                        $query2 = $objC->getStudentQuizgiven($courseId,$_SESSION['studentuserid']);
                                        while($row2=$query2->fetch_assoc())
                                        {
                                            $lessionIds=$row2['lessionId'];
                                            $lessionId[$lessionIds]=$row2['lessionId'];
                                            $result[$lessionIds]=$row2['result'];
                                        }
                                        
                                        
                                        $query = $objC->getallquizlist($catId, $courseId);
                                        $i = 1;
                                        $prelessonid='';
                                        while ($row = $query->fetch_assoc()) 
                                        {
                                            
                                    ?>
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a href="#collaps<?php echo $i; ?>" data-parent="#accordion3" data-toggle="collapse" class="accordion-toggle collapsed" data-original-title="">
                                                    <span class="fs1" aria-hidden="true" data-icon=""></span><?php echo $row['title']; ?>
                                                </a>
                                            </div>
                                            <div class="accordion-body collapse" id="collaps<?php echo $i; ?>" style="height: 0px;">
                                                <div class="accordion-inner">
                                                    <?php if($i==1) { ?>
                                                    <a href="javascript:void(0);" onclick="getQuizContent('<?php echo $row['id']; ?>', '<?php echo $courseId; ?>', '1');" class="btn btn-small btn-success"><i class="icon icon-list-alt icon-white"></i> Study Material</a>
                                                    <?php } else { if($result[$prelessonid]=='Pass') { ?>
                                                    <a href="javascript:void(0);" onclick="getQuizContent('<?php echo $row['id']; ?>', '<?php echo $courseId; ?>', '1');" class="btn btn-small btn-success"><i class="icon icon-list-alt icon-white"></i> Study Material</a>
                                                    <?php } else { ?> 
                                                    <a href="javascript:void(0);" style="display:none;" class="btn btn-small btn-success"><i class="icon icon-list-alt icon-white"></i> Study Material</a>  
                                                    <?php } } ?>
                                                    
                                                    <?php if($i==1) { ?>
                                                    <a href="javascript:void(0);" onclick="getQuizContent('<?php echo $row['id']; ?>', '<?php echo $courseId; ?>', '2');" class="btn btn-small btn-info"><i class="icon icon-facetime-video icon-white"></i> Video</a>
                                                    <?php } else { if($result[$prelessonid]=='Pass') { ?>
                                                    <a href="javascript:void(0);" onclick="getQuizContent('<?php echo $row['id']; ?>', '<?php echo $courseId; ?>', '2');" class="btn btn-small btn-info"><i class="icon icon-facetime-video icon-white"></i> Video</a>
                                                    <?php } else { ?> 
                                                    <a href="javascript:void(0);" class="btn btn-small btn-info"><i class="icon icon-facetime-video icon-white"></i> Video</a>   
                                                    <?php } } ?>
                                                    
                                                    <?php if($i==1) { $currenlessonid=$row['id']; if($result[$currenlessonid]=='Pass') { ?>
                                                    <a href="javascript:void(0);" class="btn btn-small btn-warning2"><i class="icon icon-check icon-white"></i> Quiz (Pass)</a>
                                                    <?php } else { ?>
                                                    <a href="javascript:void(0);" class="btn btn-small btn-warning2" onclick="startQuiz('<?php echo $row['id']; ?>', '0', '<?php echo $courseId; ?>');" ><i class="icon icon-check icon-white"></i> Quiz</a></p>
                                                    <?php } } else { if($result[$prelessonid]=='Pass') { $currenlessonid=$row['id']; if($result[$currenlessonid]=='Pass') { ?>
                                                    <a href="javascript:void(0);" class="btn btn-small btn-warning2"><i class="icon icon-check icon-white"></i> Quiz (Pass)</a>
                                                    <?php } else { ?>
                                                    <a href="javascript:void(0);" class="btn btn-small btn-warning2" onclick="startQuiz('<?php echo $row['id']; ?>', '0', '<?php echo $courseId; ?>');" ><i class="icon icon-check icon-white"></i> Quiz</a>
                                                    <?php } } else { ?> 
                                                    <a href="javascript:void(0);" class="btn btn-small btn-warning2"><i class="icon icon-check icon-white"></i> Quiz</a>
                                                    <?php } } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $i++;
                                        $prelessonid=$row['id'];
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="span8" id="quizarea" style="display:none;">
                                <div class="widget">
                                    <div class="widget-header">
                                        <div class="title">
                                            <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span>Quiz
                                        </div>
                                    </div>
                                    <div class="widget-body">
                                        <div class="row-fluid" id="startQuiz" style="display:none;"></div>
                                        
                                        <div class="row-fluid" id="quizQuestions"></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="span8" id="contentarea" style="display:none;">
                                
                            </div>
                        </div>
                    </div>
                </div><!-- dashboard-container -->
            </div><!-- container-fluid -->
        

    <script src="<?php echo BASEPATH; ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/moment.js"></script>


    <!-- Google Visualization JS -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- Easy Pie Chart JS -->
   <!-- <script src="<?php echo BASEPATH; ?>bootstrap/js/pie-charts/jquery.easy-pie-chart.js"></script>  -->

    <!-- Tiny scrollbar js -->
   <!-- <script src="<?php echo BASEPATH; ?>bootstrap/js/tiny-scrollbar.js"></script> -->

    <!-- Sparkline charts -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/sparkline.js"></script>

    <!-- Datatables JS -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.dataTables.js"></script>

    <!-- Calendar Js -->
    <script src='<?php echo BASEPATH; ?>bootstrap/js/fullcalendar/jquery-ui-1.10.2.custom.min.js'></script>
    <script src='<?php echo BASEPATH; ?>bootstrap/js/fullcalendar/fullcalendar.min.js'></script>

    <!-- Custom Js -->
  <!--  <script src="<?php echo BASEPATH; ?>bootstrap/js/custom-index.js"></script> -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom-calendar.js"></script>

    <script src="<?php echo BASEPATH; ?>bootstrap/js/theming.js"></script>
   <!-- <script src="<?php echo BASEPATH; ?>bootstrap/js/custom.js"></script> -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/wizard/bwizard.js"></script>

    <style>
	table{
	width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
	border: 1px solid #ddd;
	
	}
	tr,td{
		border: 1px solid #ddd;
		padding: 8px;
	}
	th{
		border: 1px solid #ddd;
		padding: 8px;
		text-align:left;
	}
	thead{
	font-size: 14px;
    line-height: 1.42857143;
    color: #333;
	padding: 8px;
	}
	</style>
	

<script>

    $(document).ready(function () {
        $(".custom-dt").datepicker({dateFormat: 'yy-mm-dd', minDate: 0, });
        $('#data-table2').dataTable({
            "sPaginationType": "full_numbers"
        });
		
    });
    
/*     $(document).ready(function () {
       
        $('body').bind('cut copy paste', function (e) {
            e.preventDefault();
        });

       
        $("body").on("contextmenu",function(e){
            return false;
        });
    }); */
    
    function startQuiz(lessionId, startId, courseId)
    {
        $("#contentarea").hide('fast');
        $("#quizarea").show('fast');
        $("#quizQuestions").html('<img src="../img/ajax-loader1.gif">');
        $.post("../ajax/ajax-quiz.php", {
            q: 'checkLessonRetake',
            lessionId: lessionId,
            startId: startId,
            courseId: courseId,
        }, function (data) {
            var rt = data.split("^");
            if (rt[1] == "start")
            {
                $("#quizQuestions").html('');
                $("#startQuiz").show("slow");
                $("#startQuiz").html('<p>You will get 1 point for each correct answer. At the end of the Quiz, your total score will be displayed.</p><p>Good luck!</p><button class="btn btn-success" onclick="startQuizByClick(' + lessionId + ', ' + startId + ', ' + courseId + ');" >Start the Quiz</button>');
            }
//            else if (rt[1] == "started")
//            {
//                getQuizDetails(lessionId, startId, courseId);
//            }
            else
            {
                $("#quizQuestions").html('');
                $("#startQuiz").show("slow");
                $("#startQuiz").html("You can't start quiz. You have already tried maximum time");
            }
            //$("#startQuiz").LoadingOverlay("hide");			
        });
    }
    function getQuizContent(lessionId, courseId, contentof)
    {
        $("#quizarea").hide('fast');
        $("#contentarea").show('fast');
        $("#contentarea").html('<img src="../img/ajax-loader1.gif">');
        $.post("../ajax/ajax-quiz.php", {
            q: 'getQuizContent',
            lessionId: lessionId,
            courseId:courseId,
            contentof:contentof,
        }, function (data) {
            $("#contentarea").html(data);  
        });
    }
    
    function startQuizByClick(lessionId, startId, courseId)
    {
        var r=confirm("Are you sure you want to start this quiz ? Please don't reload the page otherwise your 1 take will be completed.");
        if(r)
        {
            $("#warn").show('fast');
            $.post("../ajax/ajax-quiz.php", {
                q: 'getQuizTimeDuration',
                lessionId: lessionId,
                courseId:courseId,
            }, function (data) {
                var rt = data.split("^");
                getQuizDetails(lessionId, startId, courseId);
                $("#quiztimerht").show('fast');
                StartQuizTime(lessionId, startId, courseId, rt[1], '');
                document.onkeydown = function() {
                    if(event.keyCode == 116) {
                        event.returnValue = false;
                        event.keyCode = 0;
                        return false;
                    }
                }
            });
        }
    }
    function getQuizDetails(lessionId, startId, courseId)
    {
        $("#startQuiz").hide();
        $("#quizQuestions").html('<img src="../img/ajax-loader1.gif">');
        $.post("../ajax/ajax-quiz.php", {
            q: 'getQuizDetails',
            lessionId: lessionId,
            startId: startId,
            courseId: courseId,
        }, function (data) {
           // alert(data);
            $("#quizQuestions").html(data);
            //$("#quizQuestions").html('');
        });

    }
    function saveStudentQuizAns(lessionId, startId, courseId)
    {
        var quesId = $('#quesId').val();

        var ans = $("input:radio[name=answer]:checked").val();

        var correctAns = $('#correctAns').val();
        $("#quizQuestions").html('<img src="../img/ajax-loader1.gif">');
        $.post("../ajax/ajax-quiz.php", {
            q: 'saveStudentQuizAns',
            lessionId: lessionId,
            courseId: courseId,
            quesId: quesId,
            ans: ans,
            correctAns: correctAns,
        }, function (data) {

            getQuizDetails(lessionId, startId, courseId);
            //$("#quizQuestions").html('');
        });

    }
    
    function StartQuizTime(lessionId, startId, courseId, formatDate, quizLastDistance)
    {

        
        // Set the date we're counting down to
        var countDownDate = new Date(formatDate).getTime();
        // Update the count down every 1 second
        var x = setInterval(function () {
        // Get todays date and time
        var now = new Date().getTime();

        /* if(quizLastDistance=="")
         { */
        var distance = countDownDate - now;

        /* }else{

         var distance = quizLastDistance;
         } */
        // Find the distance between now an the count down date

            $.cookie("lastdistance", distance);

            $.cookie("formatDate", formatDate);

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("quiztimer").innerHTML =
                    +minutes + "m " + seconds + "s ";
            var stopquiz = $("#stopquiz").val();
            // If the count down is over, write some text 
            if (stopquiz == 1)
            {
                clearInterval(x);
            }

            if (distance < 0) {


                clearInterval(x);
                document.getElementById("quiztimer").innerHTML = "EXPIRED";
                $("#quizQuestions").html('<h1 style="color:red;"> Time Out !</h2><button type="button" name="finish" id="finish" class="btn btn-success" onclick="getStudentResult(' + lessionId + ', ' + courseId + ');">Click To See Result</button>');
                unsetQuiz();
            }
        }, 1000);
    }
    function checkRadio()
    {
        if ($("input:radio[name=answer]").is(":checked"))
        {

            $("input[type=button]").removeAttr("disabled");
        }

    }
    function getStudentResult(lessionId, courseId)
    {
        clearInterval();
        $("#warn").hide('fast');
        $("#quiztimerht").hide('fast');
        $("#quizQuestions").html('<img src="../img/ajax-loader1.gif">');
        $.post("../ajax/ajax-quiz.php", {
            q: 'getStudentResult',
            lessionId: lessionId,
            courseId: courseId,
        }, function (data) {

            $("#quizQuestions").html(data);
            //$("#quizQuestions").html('');
            $(window).unbind("beforeunload", function (event) {
                return "You have some unsaved changes if you leave this page quiz start from first";
            });
            document.onkeydown = function() {
                if(event.keyCode == 116) {
                        event.returnValue = true;
                        event.keyCode = 0;
                        return true;
                       }
            }
        });

    }
    
    function unsetQuiz()
    {
        $.post("../ajax/ajax-quiz.php", {
            q: 'unsetQuiz',
        }, function (data) {
        });
    }
</script>
        
</body>
</html>