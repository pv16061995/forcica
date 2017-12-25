<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");

if($_POST['q']=="checkLessonRetake")
{
    checkLessonRetake();
}
else if($_POST['q']=="getQuizTimeDuration")
{
    getQuizTimeDuration();
}
else if($_POST['q']=="getQuizDetails")
{
    getQuizDetails();
}
else if($_POST['q']=="saveStudentQuizAns")
{
    saveStudentQuizAns();
}
else if($_POST['q']=="getStudentResult")
{
    getStudentResult();
}
else if($_POST['q']=="unsetQuiz")
{
    unsetQuiz();
}
else if($_POST['q']=="getQuizContent")
{
    getQuizContent();
}


function checkLessonRetake()
{
    $objC = new Common(); 
    
    $lessonId = $_POST['lessionId'];
    
    $totalRetake = $objC->getStudentLessonRetake($_SESSION['studentuserid'], $lessonId);
    
    $totalRetake=$totalRetake+1;
    
    $_SESSION['retake']= $totalRetake;
    
    /*
    $query = $objC->getQuizDetailBylessonId($lessonId);
    $row = $query->fetch_assoc();

    $retake = $row['retake'];
    $passing_grade = $row['passing_grade'];
    $duration = $row['duration'];
    
     * 
     */
//    if($totalRetake <= $retake)
//    {
//        echo 's^start';
//    }
//    else
//    {
//        unset($_SESSION['retake']);
//        echo 's^noretake';
//    }
    
    echo 's^start';
}
function getQuizTimeDuration()
{
    date_default_timezone_set('Asia/Kolkata');
    
    $objC = new Common(); 
    $lessonId = $_POST['lessionId'];
    $courseId = $_POST['courseId'];
    $query = $objC->getQuizDetailBylessonId($lessonId);
    $row = $query->fetch_assoc();
    
    $retake=$objC->getStudentLessonRetake($_SESSION['studentuserid'], $lessonId);
    
    if($retake>0)
    {
        $retake=$retake+1;
        $objC->updateStudentResult($_SESSION['studentuserid'], $lessonId, 'pending', $retake);
    }
    else
    {
        $retake=1;
        $objC->saveStudentResult($_SESSION['studentuserid'], $lessonId, 'pending', $retake, $courseId);
    }
    
    $duration = $row['duration'];

    $date = date('M d, Y H:i:s');
    $currentDate = strtotime($date);
    $futureDate = $currentDate+(60*$duration+1);
    $formatDate = date("M d, Y H:i:s", $futureDate);

    echo "test^".$formatDate; 
}

function getQuizDetails()
{
    ini_set('display_errors',1);
    
    $objC = new Common();
	
    $lessionId = $_POST['lessionId'];
    $courseId = $_POST['courseId'];
    $startId = $_POST['startId'];
    
    
    if($startId>0)
    {
        $startlimit = $_POST['startId'];
    }
    else
    {
        $startlimit = 0;
    }
    
    	if($objC->getTotalQuestionAnsByLId($lessionId)>$startlimit)
        {
            $query = $objC->getQuestionAnsByLId($lessionId, $startlimit);
            while($row = $query->fetch_assoc())
            {
                $quesNo = $startlimit+1;
        ?>
            <p style="margin-bottom:20px; font-size:14px; font-weight:bold; margin-top:10px;"><?php echo $quesNo.'.  '.$row['question']; ?></p>
            <form name="quizform" name="quizform" class="form-horizontal no-margin" method="post">
                <input type="hidden" name="lessId" id="lessId" value="<?php echo $row['lid']; ?>" >
                <input type="hidden" name="courseId" id="courseId" value="<?php echo $courseId; ?>"  >
                <input type="hidden" name="quesId" id="quesId" value="<?php echo $row['qid']; ?>" >
                <input type="hidden" name="correctAns" id="correctAns" value="<?php echo $row['correntans']; ?>">
                <input type="hidden" name="stopquiz"  id="stopquiz" value="0">

                <div class="radio">
                    <label class="" style="font-size:13px;" ><input type="radio" name="answer" value="1" onclick="checkRadio();" ><?php echo $row['ans1']; ?></label>
                </div>
                <div class="radio">
                    <label class="" style="font-size:13px;" ><input type="radio" name="answer" value="2" onclick="checkRadio();" ><?php echo $row['ans2']; ?></label>
                </div>
                <div class="radio">
                    <label style="font-size:13px;" ><input type="radio" name="answer" value="3" onclick="checkRadio();" ><?php echo $row['ans3']; ?></label>
                </div>
                <?php
                if(!empty($row['ans4']))
                {
                ?>
                <div class="radio">
                       <label style="font-size:13px;" ><input type="radio" name="answer" value="4" onclick="checkRadio();" ><?php echo $row['ans4']; ?></label>

                </div>
                <?php } ?>
					 
		<div class="control-group pull-right">
                       <input type="button" class="btn btn-warning2" name="submit" id="submit" value="NEXT" onclick="saveStudentQuizAns('<?php echo $lessionId; ?>', '<?php echo $startlimit+1; ?>', '<?php echo $courseId; ?>', );" disabled="disabled">
                </div>
            </form>
            <div class="clearfix"></div>
            <?php
                }
            }
            else
            {
                //unset($_SESSION['startlimit']);
            ?>
            <div>
                <p>Quiz Finish</p>
                <input type="hidden" name="stopquiz"  id="stopquiz" value="1">
                <button type="button" name="finish" id="finish" class="btn btn-success" onclick="getStudentResult('<?php echo $lessionId; ?>', '<?php echo $courseId; ?>');">Click To See Result</button>
            </div>
            <?php
            }
	
}

function saveStudentQuizAns()
{
	$objC = new Common();
	
	$studentId = $_SESSION['studentuserid'];
	$courseId = $_POST['courseId'];
	$lessId = $_POST['lessionId'];
	$question = $_POST['quesId'];
	
	$ans = $_POST['ans'];
	$correctAns = $_POST['correctAns'];
	
	if($correctAns==$ans)
	{
            $CAnswer = "right";
	}
	else
        {
            $CAnswer = "wrong";
	}
	
	$retake= $_SESSION['retake'];
	
//	if(!isset($_SESSION['deleteFlag']))
//	{
//            echo "deleted";
//            $_SESSION['deleteFlag']=true;
//            $objC->deletePreviousAnswers($studentId, $lessId);
//	}
//	else
//        {
//            echo $_SESSION['deleteFlag']; echo "notdeleted";
//	}
	 
	if($objC->saveQuizAnswers($studentId, $courseId, $lessId, $question, $ans, $retake, $CAnswer))
	{
            //$_SESSION['startlimit']++;
	}
}

function getStudentResult()
{
	
	$studentId = $_SESSION['studentuserid'];
	
	$lessId = $_POST['lessionId'];
	
	$courseId = $_POST['courseId'];
	
	$objC = new Common(); 
	
	 $totalRightAns  = $objC->getTotalRightAnswers($studentId, $lessId);
	 
	 $totalQuestion = $objC->getTotalQuestionAnsByLId($lessId);
	 
	 $query = $objC->getLessPassingGrade($lessId);
	 
	 $row = $query->fetch_assoc();
	 
	 $studentPercent = ($totalRightAns*100)/$totalQuestion;
	 
	$studentPercent  = round($studentPercent, 2);
	 
	$passingGrade = $row['passing_grade'];
	
	//$totalRetake = $objC->getStudentLessonRetake($_SESSION['studentuserid'], $lessonId);
	
	$retake = $_SESSION['retake'];
	
	if($studentPercent>=$passingGrade)
	{
		$result = "Pass";
	}
	else{
		$result = "Fail";
	}
	
//	if($_SESSION['retake']>1)
//	{
		$preRetake = $_SESSION['retake'];
		
		//$objC->deletePreviousResult($studentId, $lessonId, $preRetake);
		
		$objC->updateStudentResult($studentId, $lessId, $result, $retake);
		
//	}
//	else
//        {
		//$objC->saveStudentResult($studentId, $lessId, $result, $retake);
		
//	}
	
	
	
	if($studentPercent>=$passingGrade)
	{
		?>
		<h4 style="color:#48b162;">Congratulation you are passed this lesson</h4>
		
		<strong style="color:#48b162;">You have got <?php echo $studentPercent; ?>% score of the lession</strong>
		
		<?php
		
	}
	else
	{
	?>
		<h4 style="color:#e2231f;" >Sorry ! you are failed in this lesson </h4>
		<strong style="color:#48b162;">You have got <?php echo $studentPercent; ?>% score of the lession</strong>
		<a href="javascript:void(0);" onclick="startQuiz('<?php echo $lessId; ?>','0','<?php echo $courseId; ?>');"> Click to try again</a>
	<?php
	}
	//unset($_SESSION['startlimit']);
	unset($_SESSION['retake']);
	//unset($_SESSION['deleteFlag']);
	//unset($_SESSION['lessonId']);
	//unset($_SESSION['courseId']);
}
function unsetQuiz()
{
	//unset($_SESSION['lessonId']);
	//unset($_SESSION['startlimit']);
	unset($_SESSION['retake']);
	//unset($_SESSION['deleteFlag']);
	//unset($_SESSION['courseId']);
}

function getQuizContent()
{
    $lessonId=$_POST['lessionId'];
    $courseId=$_POST['courseId'];
    $contentof=$_POST['contentof'];
    
    $objC = new Common(); 
    if($contentof==1)
    {
        $query = $objC->getQuizDetailBylessonId($lessonId);
        $row = $query->fetch_assoc();
        
        $data ='<div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            <span class="fs1" aria-hidden="true" data-icon="&#xe098;">Study Material</span>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="row-fluid" style="max-height:1000px; overflow:auto;">'.$row['study_doc'].'</div>
                    </div>
                </div>';
    }
    else 
    {
        $query=$objC->getAllVideoByLessonId($lessonId);
        $data ='<div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            <span class="fs1" aria-hidden="true" data-icon="&#xe098;">Video</span>
                        </div>
                    </div>
                    <div class="widget-body">';
                    if($query->num_rows==0)
                    {
                        $data .='<div class="row-fluid" style="max-height:500px; overflow:auto;">No video found</div>';
                    }
                    else 
                    {
                        $data .='<div class="row-fluid" style="max-height:500px; overflow:auto;">';
                            while($row = $query->fetch_assoc())
                            {
                                $data .='<div class="span6">'.$row['vediodata'].'</div>';
                            }
                        $data .='</div>';
                    }
                    $data .='</div>
                </div>';
    }
    
    
    echo $data;
}
?>