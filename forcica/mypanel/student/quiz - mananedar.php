<?php
include_once('../controls/config.php');
include_once('../controls/clsCommon.php');
include_once('../controls/clsUser.php');
include_once('../controls/clsAlerts.php');

if (isset($_SESSION['studentloggedin']) && $_SESSION['studentuserid'] != 1) {
    
} else {
    header('location: ../index.php');
}

unset($_SESSION['lessonId']);
unset($_SESSION['startlimit']);
unset($_SESSION['retake']);
unset($_SESSION['deleteFlag']);
unset($_SESSION['courseId']);

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
                            <h2>Quiz</h2>
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
                                    if (isset($_GET['catId'])) {
                                    $catId = base64_decode($_GET['catId']);

                                    $courseId = base64_decode($_GET['courseId']);

                                    $query = $objC->getallquizlist($catId, $courseId);
                                    $i = 1;
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
                                                <p><a href="javascript:void(0);">Study Material</a></p>
                                                <p><a href="javascript:void(0);" onclick="startQuiz('<?php echo $row['id']; ?>', '0', '<?php echo $courseId; ?>');" >Quiz</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="span8">
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
                    </div>
                </div>
            </div><!-- dashboard-container -->
        </div><!-- container-fluid -->
    <script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay_progress.min.js"></script>
        <script>
            $(document).ready(function () {
                $(".custom-dt").datepicker({dateFormat: 'yy-mm-dd', minDate: 0, });
                    $('#data-table2').dataTable({
                        "sPaginationType": "full_numbers"
                    });
                    var lastdistance = $.cookie("lastdistance");
                    var formatDate = $.cookie("formatDate");

                    <?php if (isset($_SESSION['startlimit'])) { ?>

                                        /* startQuiz(<?php echo $_SESSION['lessonId']; ?>, <?php echo $_SESSION['startlimit']; ?>, <?php echo $_SESSION['courseId']; ?>); */
                                        //StartQuizTime(<?php echo $_SESSION['lessonId']; ?>, <?php echo $_SESSION['startlimit']; ?>, <?php echo $_SESSION['courseId']; ?>, formatDate, lastdistance);



                    <?php } ?>

                    $(window).bind("beforeunload", function (event) {
                        return "You have some unsaved changes if you leave this page quiz start from first";
                    });
            });

                function startQuiz(lessionId, startId, courseId)
                {
                    //$("#startQuiz").LoadingOverlay("show");
                    $("#quizQuestions").html('');
                    $.post("../ajax/ajax-quiz.php", {
                        q: 'checkLessonRetake',
                        lessionId: lessionId,
                        startId: startId,
                        courseId: courseId,
                    }, function (data) {

                        var rt = data.split("^");

                        if (rt[1] == "start")
                        {
                            $("#startQuiz").show("slow");

                            $("#startQuiz").html('<p>You will get 1 point for each correct answer. At the end of the Quiz, your total score will be displayed.</p><p>Good luck!</p><button class="btn btn-success" onclick="startQuizByClick(' + lessionId + ', ' + startId + ', ' + courseId + ');" >Start the Quiz</button>');


                        }
                        else if (rt[1] == "started")
                        {
                            getQuizDetails(lessionId, startId, courseId);
                        }
                        else
                        {
                            $("#startQuiz").show("slow");
                            $("#startQuiz").html(data);
                        }

                        //$("#startQuiz").LoadingOverlay("hide");			
                    });
                }

                function startQuizByClick(lessionId, startId, courseId)
                {
                    $.post("../ajax/ajax-quiz.php", {
                        q: 'getQuizTimeDuration',
                        lessionId: lessionId,
                    }, function (data) {
                        var rt = data.split("^");

                        getQuizDetails(lessionId, startId, courseId);

                        StartQuizTime(lessionId, startId, courseId, rt[1], '');
                    });
                }



                function getQuizDetails(lessionId, startId, courseId)
                {
                    $("#startQuiz").hide();
                    $("#quizQuestions").LoadingOverlay("show");
                    $.post("../ajax/ajax-quiz.php", {
                        q: 'getQuizDetails',
                        lessionId: lessionId,
                        startId: startId,
                        courseId: courseId,
                    }, function (data) {
                        $("#quizQuestions").html(data);
                        $("#quizQuestions").LoadingOverlay("hide");
                    });
                }

                function saveStudentQuizAns(lessionId, startId, courseId)
                {
                    var quesId = $('#quesId').val();

                    var ans = $("input:radio[name=answer]:checked").val();

                    var correctAns = $('#correctAns').val();
                    $("#quizQuestions").LoadingOverlay("show");
                    $.post("../ajax/ajax-quiz.php", {
                        q: 'saveStudentQuizAns',
                        lessionId: lessionId,
                        courseId: courseId,
                        quesId: quesId,
                        ans: ans,
                        correctAns: correctAns,
                    }, function (data) {

                        getQuizDetails(lessionId, startId, courseId);
                        $("#quizQuestions").LoadingOverlay("hide");
                    });

                }

                function getStudentResult(lessionId, courseId)
                {
                    clearInterval();

                    $("#quizQuestions").LoadingOverlay("show");
                    $.post("../ajax/ajax-quiz.php", {
                        q: 'getStudentResult',
                        lessionId: lessionId,
                        courseId: courseId,
                    }, function (data) {

                        $("#quizQuestions").html(data);
                        $("#quizQuestions").LoadingOverlay("hide");

                        $(window).unbind("beforeunload", function (event) {

                            return "You have some unsaved changes if you leave this page quiz start from first";
                        });
                    });

                }


                function checkRadio()
                {
                    if ($("input:radio[name=answer]").is(":checked"))
                    {

                        $("input[type=button]").removeAttr("disabled");
                    }

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
                            $("#quizQuestions").html('<h1 style="color:red;"> Time Out !</h2><a href="javascript:void(0);" onclick="startQuiz(' + lessionId + ', ' + startId + ', ' + courseId + ');">Click here to try again</a>');
                            unsetQuiz();
                        }
                    }, 1000);
                }

                function unsetQuiz()
                {
                    $.post("../ajax/ajax-quiz.php", {
                        q: 'unsetQuiz',
                    }, function (data) {





                    });
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
    <script src="<?php echo BASEPATH; ?>bootstrap/js/wizard/bwizard.js"></script>

    </body>
</html>