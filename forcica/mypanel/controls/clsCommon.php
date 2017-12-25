<?php
require_once("config.php");

class Common {
    
    public function checkUserExist($enr_no) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $sql="select fu.*,fa.pan as pa_pan, fa.created_on as pa_created_on,fad.created_on as dsa_created_on,fad.pan as dsa_pan,fp.coursename as post_title,fsd.*,fcc.categoryname from forc_crm_users fu left join forc_crm_agency fa on fu.ID=fa.user_id left join forc_crm_agency_dsa fad on fu.ID=fad.user_id left join forc_crm_student_details fsd on fu.ID=fsd.user_id left join forc_crm_courses fp on fsd.current_courseId=fp.Id left join forc_crm_course_category fcc on fp.catId=fcc.Id where fu.membertype='student' and fu.user_login='$enr_no'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getusermetadata($userid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_usermeta where user_id='$userid'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllCategory() {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_course_category";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllCourseByCatId($catId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_courses where catId='$catId'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllVideoByLessonId($lessonId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_lesson_video where lessonId='$lessonId'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllFollowupByTicketId($ticketId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_query where ticketId='$ticketId' order by Id asc";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllEnrolledStudentByCourseId($courseId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_levels_payment where post_id='$courseId'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function saveCategory($catId,$categoryname) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            if($catId=='')
            {
                $sql = "insert into forc_crm_course_category set categoryname='".$categoryname."'";
            }
            else 
            {
                $sql = "update forc_crm_course_category set categoryname='".$categoryname."' where Id='$catId'";
            }
            
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function saveCourse($coursecatId,$courseId,$coursename,$price,$pacamount,$studydoc) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            if($courseId=='')
            {
                $sql = "insert into forc_crm_courses set catId='".$coursecatId."', coursename='".$coursename."', price='".$price."', course_pasc='".$pacamount."', study_doc='".$studydoc."'";
            }
            else 
            {
                $sql = "update forc_crm_courses set catId='".$coursecatId."', coursename='".$coursename."', price='".$price."', course_pasc='".$pacamount."', study_doc='".$studydoc."' where Id='$courseId'";
            }
            
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function saveVideoData($lessonId,$vId,$videodata) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            if($vId=='')
            {
                $sql = "insert into forc_crm_lesson_video set lessonId='".$lessonId."', vediodata='".$videodata."', status='1'";
            }
            else 
            {
                $sql = "update forc_crm_lesson_video set vediodata='".$videodata."' where Id='$vId'";
            }
            
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function deleteVideoData($vId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "delete from forc_crm_lesson_video where Id='$vId'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getVideoDataById($vId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_lesson_video where Id='$vId'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getStudentPADetails($userid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_agency where user_id='$userid'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getStudentCurrentCourse($userid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_levels_payment where user_id='$userid' and status='1' order by id desc limit 1";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllRefferedStudentDetails($enrno) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select fcud.*, fu.user_login, fu.user_status from forc_crm_student_details fcud left join forc_crm_users fu on fcud.USER_ID=fu.ID where fcud.student_parent_id='$enrno'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getStudentUploadDetails($userid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_cimy_uef_data where USER_ID='$userid' and (FIELD_ID='9' OR FIELD_ID='10' OR FIELD_ID='11')";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getStudentRequestDetails($userid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_user_request where user_id='$userid'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function closeRequestById($reqId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "update forc_crm_user_request set status='1' where Id='$reqId'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getStudentFEEDetails($userid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select flp.*,fp.coursename as post_title,fcc.categoryname,fp.course_pasc from forc_crm_levels_payment flp left join forc_crm_courses fp on flp.post_id=fp.Id left join forc_crm_course_category fcc on fp.catId=fcc.Id WHERE flp.user_id='$userid'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllMemberListDateWise($fromdate, $todate) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select fu.*,fa.pan as pa_pan, fa.created_on as pa_created_on,fad.created_on as dsa_created_on,fad.pan as dsa_pan,fp.coursename as post_title,fsd.*,fcc.categoryname from forc_crm_users fu left join forc_crm_agency fa on fu.ID=fa.user_id left join forc_crm_agency_dsa fad on fu.ID=fad.user_id left join forc_crm_student_details fsd on fu.ID=fsd.user_id left join forc_crm_courses fp on fsd.current_courseId=fp.Id left join forc_crm_course_category fcc on fp.catId=fcc.Id where fu.membertype='student' and Date(fu.user_registered) between '$fromdate' and '$todate' order by fu.user_registered desc";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllMemberList() {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select fu.*,fa.pan as pa_pan, fa.created_on as pa_created_on,fad.created_on as dsa_created_on,fad.pan as dsa_pan,fp.coursename as post_title,fsd.*,fcc.categoryname from forc_crm_users fu left join forc_crm_agency fa on fu.ID=fa.user_id left join forc_crm_agency_dsa fad on fu.ID=fad.user_id left join forc_crm_student_details fsd on fu.ID=fsd.user_id left join forc_crm_courses fp on fsd.current_courseId=fp.Id left join forc_crm_course_category fcc on fp.catId=fcc.Id where fu.membertype='student' order by fu.user_registered desc";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkUserTradingDetails($userid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select SUM(money_deposited) as total_money_deposited, SUM(money_withdrawn) as total_money_withdrawn, trading_account_id from forc_crm_user_trade where user_id='$userid'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkTradingIdExist($trading_account_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select Id from forc_crm_user_trade where trading_account_id='$trading_account_id'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getTradingAccountCategory() {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_trading_account_category";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getStudenttradeDetails($userid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_user_trade where user_id='$userid' ";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getStudenttradeProfitDetails($userid,$incomeof) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_student_income where userid='$userid' and incomeof='$incomeof'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkMonthlyTradingexist($profitmonth,$profityear,$incomeof) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select Id from forc_crm_student_income where profitmonth='".$profitmonth."' and profityear='".$profityear."' and incomeof='".$incomeof."'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkPASCexist($profitmonth,$profityear,$monthdate,$incomeof) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select Id from forc_crm_student_income where profitmonth='".$profitmonth."' and profityear='".$profityear."' and incomeof='".$incomeof."' and monthdate='".$monthdate."'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function saveUserTradingDetails($userid,$enr_no,$trading_account_id,$margin_money_deposited,$margin_money_withdrawn,$trading_activation_date,$noofdays,$accounttype) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "insert into forc_crm_user_trade set user_id='$userid', enr_no='".$enr_no."', trading_account_id='".$trading_account_id."', money_deposited='".$margin_money_deposited."', money_withdrawn='".$margin_money_withdrawn."', trading_date_activation='".$trading_activation_date."', noofdays='".$noofdays."', accounttype='".$accounttype."', updated_date=NOW()";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getTradingStudentList($profitmonth,$profityear) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $lastday=date($profityear.'-'.$profitmonth.'-31');
            
            $sql = "select fud.user_id,fud.enr_no,fsd.first_name,fsd.last_name from forc_crm_user_trade fud left join forc_crm_student_details fsd on fud.user_id=fsd.user_id where fud.trading_date_activation <='$lastday' group by fud.user_id";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getpreTradingAmountofStudent($profitmonth,$profityear,$user_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $firstday=date($profityear.'-'.$profitmonth.'-01');
            
            $sql = "select SUM(money_deposited) as total_money_deposited, SUM(money_withdrawn) as total_money_withdrawn from forc_crm_user_trade where trading_date_activation < '$firstday' and user_id='$user_id'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function gettotalTradingAmountofStudent($profitmonth,$profityear,$user_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $lastday=date($profityear.'-'.$profitmonth.'-31');
            
            $sql = "select SUM(money_deposited) as total_money_deposited, SUM(money_withdrawn) as total_money_withdrawn from forc_crm_user_trade where trading_date_activation <= '$lastday' and user_id='$user_id'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getcurTradingAmountofStudent($profitmonth,$profityear,$user_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_user_trade where month(trading_date_activation)='$profitmonth' and year(trading_date_activation)='$profityear' and user_id='$user_id'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function saveMonthlyinputdata($incomeof,$tdsPercentage) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$_POST['totaluser']);
            $profitmonth=$_POST['profitmonth'];
            $profityear=$_POST['profityear'];
            $profit=$_POST['profit'];
            $sql ='';
            $i=1;
            foreach($totaluser as $userid)
            {
                $studentprofit=$_POST['studentprofit'.$userid];
                $forcicaprofit=$_POST['forcicaprofit'.$userid];
                $totalprofit=$_POST['totalprofit'.$userid];
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                
                if($i<count($totaluser)) {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, profit_precentage, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$profit."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, profit_precentage, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$profit."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function saveUserRequestDetails($userid,$request) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $sql1 = "select MAX(Id) as maxid from forc_crm_user_request";
            $query1 = $mysqli->query($sql1);
            $row1=$query1->fetch_assoc();
            
            $requestId=$row1['maxid']+1;
            
            if($requestId<10) {
                $requestNo= 'FRN000'.$requestId;
            } else if($requestId>=10 && $requestId <100) {
                $requestNo= 'FRN00'.$requestId;
            } else if($requestId>=100 && $requestId <1000) {
                $requestNo= 'FRN0'.$requestId;
            } else {
                $requestNo= 'FRN'.$requestId;
            }
            
            $sql = "insert into forc_crm_user_request set user_id='$userid', requestDetails='".$request."', requestDate=NOW(), status='0', requestNo='".$requestNo."'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllMemberNEFTLIST($neftmonth, $neftyear) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select sum(netPayment) as totalstudentprofit,fstp.*,fa.bank_name,fa.account_no,fa.ifsc_code,fsd.* from forc_crm_student_income fstp left join forc_crm_agency fa on fstp.userid=fa.user_id left join forc_crm_student_details fsd on fstp.userid=fsd.user_id where profitmonth='$neftmonth' and profityear='$neftyear' group by userid";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllMemberTDSLIST($neftmonth, $neftyear) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select fstp.*,fa.bank_name,fa.account_no,fa.ifsc_code,fa.pan,fsd.* from forc_crm_student_income fstp left join forc_crm_agency fa on fstp.userid=fa.user_id left join forc_crm_student_details fsd on fstp.userid=fsd.user_id where profitmonth='$neftmonth' and profityear='$neftyear'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllMemberSTLIST($stmonth, $styear) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select flp.*,fu.user_login,fp.coursename as post_title,fsd.* from forc_crm_levels_payment flp left join forc_crm_users fu on flp.user_id=fu.ID left join forc_crm_courses fp on flp.post_id=fp.ID left join forc_crm_student_details fsd on flp.user_id=fsd.user_id WHERE month(flp.created_on)='$stmonth' and year(flp.created_on)='$styear' and fu.user_login IS NOT NULL";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getSettings() {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_settings";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getPAUserList($month,$year) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            //$firstday=date($year.'-'.$month.'-01');
            $date = $year."-".$month."-01";
            $monthlastdate = date("t", strtotime($date));

            $monthlastdate=$year."-".$month."-".$monthlastdate;
            
            $sql = "select fa.*,fu.user_login,fsd.current_courseId,fsd.current_fee,fsd.current_servicetax from forc_crm_agency fa left join forc_crm_users fu on fa.user_id=fu.ID left join forc_crm_student_details fsd on fa.user_id=fsd.user_id where Date(DATE_ADD(fa.created_on, INTERVAL 1 DAY)) < '$monthlastdate' and fu.user_login IS NOT NULL order by fa.created_on asc";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getPASBUserList($month,$year) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            //$firstday=date($year.'-'.$month.'-01');
            $date = $year."-".$month."-01";
            $monthlastdate = date("t", strtotime($date));

            $monthlastdate=$year."-".$month."-".$monthlastdate;
            
            $sql = "select fa.*,fu.user_login,fsd.current_courseId,fsd.current_fee,fsd.current_servicetax,fsd.student_parent_id from forc_crm_agency fa left join forc_crm_users fu on fa.user_id=fu.ID left join forc_crm_student_details fsd on fa.user_id=fsd.user_id  where Date(DATE_ADD(fa.created_on, INTERVAL 1 DAY)) < '$monthlastdate' and fu.user_login IS NOT NULL order by fa.created_on desc";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getPARUserList($month,$year,$user_login,$pacourseId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
             $sql = "select fsd.Id from forc_crm_users fu left join forc_crm_student_details fsd on fu.ID=fsd.user_id where month(fu.user_registered)='$month' and year(fu.user_registered)='$year' and fsd.student_parent_id='$user_login' and fsd.current_courseId >= '$pacourseId'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getPACAmount($month,$year,$user_id,$incomeof) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
             $sql = "select sum(studentprofit) as totalpacamount from forc_crm_student_income where profitmonth='".$month."' and  profityear='".$year."' and userid='".$user_id."' and incomeof='".$incomeof."'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function deletePADSADetails($user_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
             $sql = "delete from forc_crm_agency_dsa where user_id='".$user_id."'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getPACUserList($month,$year,$monthdate) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $lastday=date($year.'-'.$month.'-'.$monthdate);
            $sql = "select fa.*,fu.user_login from forc_crm_agency fa left join forc_crm_users fu on fa.user_id=fu.ID where Date(DATE_ADD(fa.created_on, INTERVAL 1 DAY)) < '$lastday' and fu.user_login IS NOT NULL";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getPAUserListForPASC($month,$year,$monthdate) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $lastday=date($year.'-'.$month.'-'.($monthdate-1));
            $sql = "select fa.*,fu.user_login from forc_crm_agency fa left join forc_crm_users fu on fa.user_id=fu.ID left join forc_crm_levels_payment flp on fa.user_id=flp.user_id where Date(fa.created_on) < '$lastday' and flp.noofpasc < 36 and fu.user_login IS NOT NULL group by fa.user_id";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function savePASCdata($incomeof,$tdsPercentage) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$_POST['totaluser']);
            $profitmonth=$_POST['month'];
            $profityear=$_POST['year'];
            $monthdate=$_POST['monthdate'];
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $paymentid=explode(',', $_POST['paymentid'.$userid]);
                $noofpasc=explode(',', $_POST['noofpasc'.$userid]);
                
                for($i=0; $i<count($paymentid);$i++) 
                {
                    $sql2="update forc_crm_levels_payment set noofpasc='".$noofpasc[$i]."' where id='".$paymentid[$i]."'";
                    $query2 = $mysqli->query($sql2);
                }
            }
            
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$_POST['pascamount'.$userid];
                $forcicaprofit=0;
                $totalprofit=0;
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                
                if($i<count($totaluser)) {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, monthdate, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$monthdate."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, monthdate, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$monthdate."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getPACserList($month,$year,$monthdate,$student_parent_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            if($monthdate==10) { $admissionstartdate=date($year.'-'.$month.'-01'); $admissionenddate=date($year.'-'.$month.'-10'); }
            else if($monthdate==20) { $admissionstartdate=date($year.'-'.$month.'-11'); $admissionenddate=date($year.'-'.$month.'-20'); }
            else if($monthdate==30) { $admissionstartdate=date($year.'-'.$month.'-21'); $admissionenddate=date($year.'-'.$month.'-31'); }
            
			$sql = "select fsd.current_fee as fee,fsd.current_servicetax as service_tax,fu.user_login,fsd.student_parent_id,fu.user_registered,fsr.student_parent_id as reffered_student_parent_id,fsd.user_id, fa.created_on as pacreated_on, fur.ID as reffered_user_id from forc_crm_student_details fsd left join forc_crm_users fu on fsd.user_id=fu.ID left join forc_crm_users as fur on fsd.student_parent_id=fur.user_login left join forc_crm_student_details as fsr on fur.ID=fsr.user_id left join forc_crm_agency fa on fur.ID=fa.user_id where Date(fu.user_registered) between '$admissionstartdate' and '$admissionenddate' and fsd.student_parent_id in ($student_parent_id) order by fu.user_registered desc";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function getTeamTotalBusiness($student_parent_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $sql = "select SUM(fee) as totalfee,SUM(service_tax) as totalservice_tax from forc_crm_levels_payment flp left join forc_crm_student_details fsd on flp.user_id=fsd.user_id where fsd.student_parent_id='$student_parent_id'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function getuplineDSA($student_parent_id,$pacreated_on) {
        
        $resf = $this->checkDSA($student_parent_id,date('Y-m-d',strtotime($pacreated_on)));
	$rowf = $resf->fetch_assoc();	
        
	if($rowf['user_id']!='')	
        {
            return $rowf['user_id'].'^'.$student_parent_id;
            die;
        }
        else 
        {
            if($rowf['student_parent_id']!='' && is_numeric($rowf['student_parent_id'])) 
            {
                $this->getuplineDSA($rowf['student_parent_id'],$rowf['created_on']);
            } 
            else 
            {
                return '';
            }
        }
    }
    
    public function checkDSA($user_login,$pacreated_on) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select fad.user_id,fsd.student_parent_id,fa.created_on from forc_crm_users fu left join forc_crm_agency_dsa fad on fu.ID=fad.user_id left join forc_crm_student_details fsd on fu.ID=fsd.user_id left join forc_crm_agency fa on fu.ID=fa.user_id where fu.user_login='".$user_login."' and Date(fad.created_on) <= '$pacreated_on'";
           
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function savePACdata($incomeof,$tdsPercentage) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$_POST['totaluser']);
            $profitmonth=$_POST['month'];
            $profityear=$_POST['year'];
            $monthdate=$_POST['monthdate'];
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$_POST['pacamount'.$userid];
                $forcicaprofit=0;
                $totalprofit=0;
                $dsauserid=$_POST['dsauserid'.$userid];
                
                
                
                if($dsauserid!='') 
                {
                    $dsapacamount=$_POST['dsapacamount'.$userid];
                    
                    $tdsAmount=($dsapacamount*$tdsPercentage)/100;
                    $tdsAmount=round($tdsAmount,2);
                    $netPayment=$dsapacamount-$tdsAmount;
                    
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, monthdate, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$dsauserid."', '".$monthdate."', '".$dsapacamount."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                    
                if($i<count($totaluser)) {
                    
                    
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, monthdate, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$_POST['reffered_user_id'.$userid]."', '".$monthdate."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, monthdate, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$_POST['reffered_user_id'.$userid]."', '".$monthdate."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function saveFIdata($incomeof,$tdsPercentage) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$_POST['totaluser']);
            $profitmonth=$_POST['month'];
            $profityear=$_POST['year'];
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$_POST['fiamount'.$userid];
                $forcicaprofit=0;
                $totalprofit=0;
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                
                if($i<count($totaluser)) {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function saveLBdata($incomeof,$tdsPercentage) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$_POST['totaluser']);
            $profitmonth=$_POST['month'];
            $profityear=$_POST['year'];
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$_POST['lbamount'.$userid];
                $forcicaprofit=0;
                $totalprofit=0;
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                
                if($i<count($totaluser)) {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function saveSBdata($incomeof,$tdsPercentage) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$_POST['totaluser']);
            $profitmonth=$_POST['month'];
            $profityear=$_POST['year'];
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$_POST['sbamount'.$userid];
                $forcicaprofit=0;
                $totalprofit=0;
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                
                if($i<count($totaluser)) {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function getPAFiveLevelBusiness($student_parent_id,$month,$year,$level,$tb) {
        
        if($level < 5)
        {
            if($level==0)
            {
                $resAB = $this->getUsersAdmissionBusiness($student_parent_id,$month,$year);
                $rowAB = $resAB->fetch_assoc();
                $admissionbussiness=($rowAB['total_fee']-$rowAB['total_servicetax']);

                $resTRB = $this->getUsersTradingBusiness($student_parent_id,$month,$year);
                $rowTRB = $resTRB->fetch_assoc();
                $tradingbussiness=($rowTRB['total_money_deposited']-$rowTRB['total_money_withdrawn']);
                
                $tb=$tb+$admissionbussiness+$tradingbussiness;
            }
            
            $resf = $this->getPAListByPAref($student_parent_id,$month,$year);
            $useridstr='';
            $user_login_str='';
            while($rowf = $resf->fetch_assoc()) 
            {
                $useridstr .=','.$rowf['user_id'];
                $user_login_str .=','.$rowf['user_login'];
            }
            //$useridstr=substr($useridstr,1);
            $student_parent_id=substr($user_login_str,1);
            if($student_parent_id!='')
            {
                $resAB = $this->getUsersAdmissionBusiness($student_parent_id,$month,$year);
                $rowAB = $resAB->fetch_assoc();
                $admissionbussiness=($rowAB['total_fee']-$rowAB['total_servicetax']);

                $resTRB = $this->getUsersTradingBusiness($student_parent_id,$month,$year);
                $rowTRB = $resTRB->fetch_assoc();
                $tradingbussiness=($rowTRB['total_money_deposited']-$rowTRB['total_money_withdrawn']);
                
                $tb=$tb+$admissionbussiness+$tradingbussiness;
                $this->getPAFiveLevelBusiness($student_parent_id,$month,$year,($level+1),$tb);
            }
            else 
            {
                $this->getPAFiveLevelBusiness($student_parent_id,$month,$year,5,$tb);
            }
        }
        return $tb;
    }
    
    public function getUsersTradingBusiness($student_parent_id,$month,$year) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $lastday=date($year.'-'.$month.'-31');
            $sql = "select SUM(fsd.money_deposited) as total_money_deposited, SUM(fsd.money_withdrawn) as total_money_withdrawn from forc_crm_user_trade fsd where fsd.enr_no IN ($student_parent_id) and fsd.trading_date_activation <= '$lastday'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getUsersAdmissionBusiness($student_parent_id,$month,$year) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
           echo $sql = "select SUM(fsd.current_fee) as total_fee, SUM(fsd.current_servicetax) as total_servicetax from forc_crm_student_details fsd left join forc_crm_users fu on fsd.user_id=fu.ID where fsd.student_parent_id IN ($student_parent_id) and month(fu.user_registered)='$month' and year(fu.user_registered)='$year'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getPAListByPAref($student_parent_id,$month,$year) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $lastday=date($year.'-'.$month.'-31');
            $sql = "select fa.*,fu.user_login,fsd.student_parent_id,fup.ID as parent_user_id from forc_crm_agency fa left join forc_crm_student_details fsd on fa.user_id=fsd.user_id left join forc_crm_users fu on fsd.user_id=fu.ID left join forc_crm_users fup on fsd.student_parent_id=fup.user_login where Date(DATE_ADD(fa.created_on, INTERVAL 1 DAY)) < '$lastday' and fsd.student_parent_id IN ($student_parent_id) and fu.user_login IS NOT NULL";
           
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getPAFiveLevelPA($student_parent_id,$month,$year,$level,$useridstr,$user_login_str,$parent_id,$main_parent_id) {
        $sumArray = array();
        if($level < 5)
        {
            $resf = $this->getPAListByPAref($student_parent_id,$month,$year);
            $useridstr2='';
            $user_login_str2='';
            $parent_id2='';
            
//            if($level==0) { 
//                $useridstr .=','.$main_parent_id;
//                $user_login_str .=','.$student_parent_id;
//                $parent_id2 .=',';
//            }
            
            if($resf->num_rows>0)
            {
                while($rowf = $resf->fetch_assoc()) 
                {
                    $useridstr2 .=','.$rowf['user_id'];
                    $user_login_str2 .=','.$rowf['user_login'];
                    $parent_id2 .=','.$rowf['parent_user_id'];
                }
            }
            $useridstr2=substr($useridstr2,1);
            $student_parent_id=substr($user_login_str2,1);
            
            $parent_id2=substr($parent_id2,1);

            $useridstr .=','.$useridstr2;
            $user_login_str .=','.$user_login_str2;
            $parent_id .=','.$parent_id2;
            
            
            if($student_parent_id!='')
            {
                $this->getPAFiveLevelPA($student_parent_id,$month,$year,$level+1,$useridstr,$user_login_str,$parent_id,$main_parent_id);
            }
            else 
            {
                $this->getPAFiveLevelPA($student_parent_id,$month,$year,5,$useridstr,$user_login_str,$parent_id,$main_parent_id);
            }
        }
            $useridstr=  ltrim($useridstr,',');
            $useridstr=  rtrim($useridstr,',');

            $parent_id=  ltrim($parent_id,',');
            $parent_id=  rtrim($parent_id,',');

            $user_idarr=  explode(',',$useridstr);
            //$user_loginarr=explode(',',$student_parent_id);
            $parent_idarr=explode(',',$parent_id);

            $user_idarr=array_reverse($user_idarr);
            $parent_idarr=array_reverse($parent_idarr);

            $userincome=array();
            
            $i=0;
            foreach($user_idarr as $user_id)
            {
                $resI=$this->getPACSumAmount($month,$year,$user_id);
                $rowI=$resI->fetch_assoc();
                $userincome[$user_id]=$rowI['totalpacamount'];
                $i++;
            }
            
            $sumArray = array();
            foreach($user_idarr as $user_id)
            {
                $key=array_search($user_id,$user_idarr);
                
                $preamount= @$sumArray[$user_id];
                
                $sumArray[$user_idarr[$key]] = $preamount+$userincome[$user_idarr[$key]];
                
                if($parent_idarr[$key]!='')
                {
                    if($parent_idarr[$key]!=$user_idarr[$key])
                    {
                        $preamount2= @$sumArray[$parent_idarr[$key]];
                        
                        $precentageamount=($sumArray[$user_idarr[$key]]*10)/100;

                        $sumArray[$parent_idarr[$key]] = $preamount2+$precentageamount;
                    }
                }
            }
            
        //print_r($sumArray);

        return $sumArray;
        //die();
        
    }
    
    public function getPACSumAmount($month,$year,$user_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);

            $sql = "select sum(studentprofit) as totalpacamount from forc_crm_student_income where profitmonth='".$month."' and  profityear='".$year."' and userid='$user_id'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function getStudentPayoutdata($user_id,$month,$year) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            if($month!='') {
               $sql = "select sum(studentprofit) as totalpayment,fsi.incomeof from forc_crm_student_income fsi left join forc_crm_income_type fit on fsi.incomeof=fit.income_type  where profitmonth='".$month."' and profityear='".$year."' and userid='".$user_id."' group by fsi.incomeof order by fit.sort_no";
            } else 
            {
                $sql = "select fsi.profitmonth,fsi.profityear from forc_crm_student_income fsi where userid='".$user_id."' group by fsi.profitmonth,fsi.profityear order by fsi.profitmonth,fsi.profityear asc";
            }
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function getTeamStudentPayoutdata($user_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
                $sql = "select sum(studentprofit) as totalpayment from forc_crm_student_income fsi left join forc_crm_income_type fit on fsi.incomeof=fit.income_type  where userid='".$user_id."'";
            
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getAllMemberCourseRequest() {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
                $sql = "select flp.*,fsd.first_name,fsd.last_name,fu.user_login,fu.user_email,fc.coursename from forc_crm_levels_payment flp left join forc_crm_student_details fsd on flp.user_id=fsd.user_id left join forc_crm_users fu on fsd.user_id=fu.ID left join forc_crm_courses fc on flp.post_id=fc.Id where flp.status=0";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function approveCourseRequest($Id,$user_id,$courseId,$fee,$service_tax) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
                $sql = "update forc_crm_levels_payment set status='1' where id='$Id'";
                $query = $mysqli->query($sql);
                
                $sql2 = "update forc_crm_student_details set current_courseId='$courseId', current_fee='$fee', current_servicetax='$service_tax' where user_id='$user_id'";
                $query2 = $mysqli->query($sql2);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
	
	public function savePASCdataByCronJob($incomeof,$tdsPercentage, $paymentIds, $noofPasc, $pascAmount, $userIds, $profitmonth, $profityear, $monthdate) {
		 try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$userIds);
            /* $profitmonth=$_POST['month'];
            $profityear=$_POST['year'];
            $monthdate=$_POST['monthdate']; */
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $paymentid = explode(',', $paymentIds[$userid]);
                $noofpasc = explode(',', $noofPasc[$userid]);
                
                for($i=0; $i<count($paymentid);$i++) 
                {
                    $sql2="update forc_crm_levels_payment set noofpasc='".$noofpasc[$i]."' where id='".$paymentid[$i]."'";
                    $query2 = $mysqli->query($sql2);
                }
            }
            
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$pascAmount[$userid];
				
                $forcicaprofit=0;
                $totalprofit=0;
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                
                if($i<count($totaluser)) {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, monthdate, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$monthdate."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, monthdate, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$monthdate."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
	 public function savePACdataByCronJob($incomeof,$tdsPercentage, $pacamount, $dsapacamount, $dsa_user_id, $totaluser, $profitmonth, $profityear, $monthdate,$pa_user_idArray) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$totaluser);
            /* $profitmonth=$_POST['month'];
            $profityear=$_POST['year'];
            $monthdate=$_POST['monthdate']; */
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$pacamount[$userid];
                $forcicaprofit=0;
                $totalprofit=0;
                $dsauserid=$dsa_user_id[$userid];
                
                
                
                if($dsauserid!='') 
                {
                    $dsapacamount=$dsapacamount[$userid];
                    
                    $tdsAmount=($dsapacamount*$tdsPercentage)/100;
                    $tdsAmount=round($tdsAmount,2);
                    $netPayment=$dsapacamount-$tdsAmount;
                    
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, monthdate, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$dsauserid."', '".$monthdate."', '".$dsapacamount."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                    
                if($i<count($totaluser)) {
                    
                    
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, monthdate, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$pa_user_idArray[$userid]."', '".$monthdate."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, monthdate, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$pa_user_idArray[$userid]."', '".$monthdate."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	public function saveFIdataByCronJob($incomeof,$tdsPercentage, $fiamountArray, $totaluser, $profitmonth, $profityear) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$totaluser);
            /* $profitmonth=$_POST['month'];
            $profityear=$_POST['year']; */
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$fiamountArray[$userid];
                $forcicaprofit=0;
                $totalprofit=0;
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                
                if($i<count($totaluser)) {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
	public function saveLBdataByCronJob($incomeof,$tdsPercentage, $libamounArray, $totaluser, $profitmonth, $profityear) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$_POST['totaluser']);
            /* $profitmonth=$_POST['month'];
            $profityear=$_POST['year']; */
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$libamounArray[$userid];
                $forcicaprofit=0;
                $totalprofit=0;
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                
                if($i<count($totaluser)) {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
	public function saveSBdataByCronJob($incomeof,$tdsPercentage, $sbamountArray, $totaluser, $profitmonth, $profityear) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $totaluser=explode(',',$totaluser);
            /* $profitmonth=$_POST['month'];
            $profityear=$_POST['year']; */
            $sql ='';
            $i=1;
            
            foreach($totaluser as $userid)
            {
                $studentprofit=$sbamountArray[$userid];
                $forcicaprofit=0;
                $totalprofit=0;
                
                $tdsAmount=($studentprofit*$tdsPercentage)/100;
                $tdsAmount=round($tdsAmount,2);
                $netPayment=$studentprofit-$tdsAmount;
                
                if($i<count($totaluser)) {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."');";
                }
                else {
                    $sql .= "INSERT INTO forc_crm_student_income (profitmonth, profityear, userid, studentprofit, forcicaprofit, totalprofit, incomeof, addedDate, tdsPercentage, tdsAmount, netPayment)VALUES ('".$profitmonth."', '".$profityear."', '".$userid."', '".$studentprofit."', '".$forcicaprofit."', '".$totalprofit."', '".$incomeof."', NOW(), '".$tdsPercentage."', '".$tdsAmount."', '".$netPayment."')";
                }
                $i++;    
            }
            $query = $mysqli->multi_query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	public function getStudentPayoutdataBySegment($startDate,$endDate) {
        try {
			
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
           
			 $sql = "select SUM(fsi.studentprofit) as total_payout, fsi.tdsPercentage, SUM(fsi.tdsAmount) as total_TDSAmount, SUM(fsi.netPayment) as TotalNetAmount, fsi.userid,  ud.first_name, ud.last_name, fu.user_login, fu.user_email from forc_crm_student_income fsi left join forc_crm_users fu on fsi.userid=fu.ID left join forc_crm_student_details ud on ud.user_id=fsi.userid  where fsi.addedDate between '".$startDate."' and '".$endDate."' group by fsi.userid";
            
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	public function getStudentDetailsById($userid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
            $sql = "select ud.first_name, ud.last_name, fu.user_login, fu.user_email from forc_crm_users fu  left join forc_crm_student_details ud on ud.user_id=fu.ID  where fu.ID='$userid'";
			
			 $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	public function updatePayoutSegment($startDate, $endDate) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
           $sql = "update forc_crm_student_income set payout_status='1' where addedDate between '".$startDate."' and '".$endDate."'";
		   
		    $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
	public function checkStudentPayoutdataBySegment($startDate,$endDate) {
        try {
			
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
           
			 $sql = "select Id from forc_crm_student_income  where payout_status='1' and addedDate between '".$startDate."' and '".$endDate."' ";
            
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	public function sendsms($mobileNo,$sendsmsmsg)
    {
        //$url="http://sms.thinkbuyget.com/api.php?username=BuySell&password=223392&sender=BUYSEL&sendto=".$mobileNo."&message=".urlencode($sendsmsmsg)."";
    
	//sms.thinkbuyget.com/api.php?username=BuySell&password=223392&sender=BUYSEL&sendto=8745851427&message=hello
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
         
    }
	
	
    public function savelessonquiz($course_cat,$course,$title,$retake,$passing_grade,$duration,$studydoc, $sortno) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "insert into forc_lesson_quiz set course_cat='$course_cat',course='$course',title='$title',retake='$retake',passing_grade='$passing_grade',duration='$duration',study_doc='$studydoc', sortId='$sortno'";
            $query = $mysqli->query($sql);
             $query = mysqli_insert_id($mysqli);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function updatelessonquiz($course_cat,$course,$title,$retake,$passing_grade,$duration,$studydoc,$id, $sortno) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "update forc_lesson_quiz set course_cat='$course_cat',course='$course',title='$title',retake='$retake',passing_grade='$passing_grade',duration='$duration', study_doc='$studydoc', sortId='$sortno' where id='$id'";
            $query = $mysqli->query($sql);
             $query = mysqli_insert_id($mysqli);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
    public function savequestionanswer($lid,$question,$ans1,$ans2,$ans3,$ans4,$correntans) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "insert into forc_question_answer set lid='$lid',question='$question',ans1='$ans1',ans2='$ans2',ans3='$ans3',ans4='$ans4',correntans='$correntans'";
            $query = $mysqli->query($sql);
             $query = mysqli_insert_id($mysqli);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function updatequestionanswer($lid,$question,$ans1,$ans2,$ans3,$ans4,$correntans,$qid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "update forc_question_answer set lid='$lid',question='$question',ans1='$ans1',ans2='$ans2',ans3='$ans3',ans4='$ans4',correntans='$correntans' where qid='$qid'";
            $query = $mysqli->query($sql);
             $query = mysqli_insert_id($mysqli);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
    public function getallquizlist($cat_id,$course) {
        try {
			
			if($cat_id!='')
			{
				$cat=" and course_cat='$cat_id'";
			}
			if($course!='')
			{
				$crse=" and course='$course'";
			}
			
			$orderby = "order by sortId asc";
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql1 = "select * from forc_lesson_quiz where id!=''";
			$sql=$sql1.$cat.$crse.$orderby;
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
    public function getquizlistById($id) {
        try {
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql= "select * from forc_lesson_quiz where id='$id'";
			
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function getStudentQuizgiven($courseid,$studentuserid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql= "select * from forc_studen_quiz_result where courseId='$courseid' and studentId='$studentuserid'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
    public function getquizanslistByLId($id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_question_answer where lid='$id'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
	
	public function getQuestionAnsByLId($id, $startlimit) {
        try {
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
            $sql = "select * from forc_question_answer where lid='$id' limit $startlimit, 1";
			
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	public function getTotalQuestionAnsByLId($id) {
        try {
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
            $sql = "select qid from forc_question_answer where lid='$id'";
			
            $query = $mysqli->query($sql);
			
			$count = $query->num_rows;
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $count;
    }
	
	public function saveQuizAnswers($studentId, $courseId, $lessId, $question, $ans, $retake, $CAnswer) {
        try {
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
            $sql = "INSERT INTO `forc_student_quiz_answers`(`studentId`, `courseId`, `lessId`, `question`, `answer`, `student_retake`, `canswer`) values('$studentId', '$courseId','$lessId','$question','$ans','$retake', '$CAnswer')";
			
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
	public function getTotalRightAnswers($studentId, $lessId) {
        try {
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
            $sql = "select Id from forc_student_quiz_answers where studentId='$studentId' and  	lessId='$lessId' and canswer='right'";
			
            $query = $mysqli->query($sql);
			
			$count = $query->num_rows;
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $count;
    }
	
	public function getLessPassingGrade($lessId) {
        try {
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
            $sql = "select passing_grade, retake from forc_lesson_quiz where id='$lessId'";
			
            $query = $mysqli->query($sql);
			
		
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	public function saveStudentResult($studentId, $lessionId, $result, $retake, $courseId) {
        try {
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
            $sql = "insert into forc_studen_quiz_result set studentId='$studentId', lessionId='$lessionId', result='$result', student_retake='$retake', courseId='$courseId'";
			
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	public function getStudentResult($studentId, $lessionId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_studen_quiz_result where studentId='$studentId' and lessionId='$lessionId'";
            $query = $mysqli->query($sql);
	} catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
    public function getStudentLessonRetake($studentId, $lessionId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select student_retake from forc_studen_quiz_result where studentId='$studentId' and lessionId='$lessionId'";
            $query = $mysqli->query($sql);
            $row = $query->fetch_assoc();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $row['student_retake'];
    }
	
	
	public function getQuizDetailBylessonId($id) {
        
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql= "select retake, passing_grade, duration, study_doc from forc_lesson_quiz where id='$id'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
	public function deletePreviousResult($studentId, $lessonId, $retake) {
        try {
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql= "delete from forc_studen_quiz_result where studentId='$studentId' and lessionId='$lessonId' and student_retake='$retake'";
			
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
	public function deletePreviousAnswers($studentId, $lessonId) {
        try {
			$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
            $sql= "delete from forc_student_quiz_answers where studentId='$studentId' and lessId='$lessonId'";
			
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
    public function updateStudentResult($studentId, $lessionId, $result, $retake) {
        try {
            $cdate=date('Y-m-d');
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
			
            $sql = "update  forc_studen_quiz_result set result='$result', passing_date='$cdate' where studentId='$studentId' and lessionId='$lessionId'";
			
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
    public function getPassedMemberList() {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select sqr.*,csd.first_name,csd.last_name,csd.phone1,cu.user_email,cu.user_login,cc.coursename,ccc.categoryname, lq.title from forc_studen_quiz_result sqr LEFT JOIN forc_crm_student_details csd ON sqr.studentId=csd.user_id LEFT JOIN forc_crm_users cu ON csd.user_id=cu.ID LEFT JOIN forc_crm_courses cc ON sqr.courseId=cc.Id LEFT JOIN forc_crm_course_category ccc ON cc.catId=ccc.Id LEFT JOIN forc_lesson_quiz lq ON sqr.lessionId=lq.id where sqr.result='Pass'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
	
    
    public function getStudentresultDetails($studentId, $lessId, $student_retake) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select sqa.*,fqa.question from forc_student_quiz_answers sqa left join forc_question_answer fqa on sqa.question=fqa.qid where sqa.studentId='$studentId' and sqa.lessId='$lessId' and sqa.student_retake='$student_retake'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
	
	public function getAdminDetailEmail()
	{
		try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * from forc_crm_users where ID='1' and membertype='admin'";
            $query = $mysqli->query($sql);
			$result=$query->fetch_assoc();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $result['user_email'];
	}


    
    public function getAllCountryList()
    {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql = "select * from forc_crm_country where status='1'";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }
	


    
    public function getCoursesListWithCategory()
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql = "select cou.Id,cou.catId,cou.coursename,cou.price,cat.categoryname from forc_crm_courses cou left join forc_crm_course_category cat on cou.catId=cat.Id ";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

     public function savecontactform($name,$email,$phone,$subject,$message,$enquiry_for)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql = "insert into forc_crm_enquiry set name='$name',email='$email',phone='$phone',subject='$subject',message='$message',enquiry_for='$enquiry_for' ";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function savegetaddmissionenq($name,$email,$phone,$enquiry_for)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql = "insert into forc_crm_enquiry set name='$name',email='$email',phone='$phone',enquiry_for='$enquiry_for' ";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }



    public function getWebsiteEnquiry($fromdate,$todate,$enquiry_type)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql = "select * from forc_crm_enquiry where enquiry_for='$enquiry_type' and date(created_on) between '$fromdate' and '$todate' ";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }


    public function getWebsiteFeedback($fromdate,$todate,$enquiry_type)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql = "select feed.*,pro.first_name,pro.last_name,pro.phone1,user.user_email as email from forc_crm_feedback feed left join forc_crm_student_details pro on pro.user_id=feed.sid left join forc_crm_users user on feed.sid=user.ID where feed.category='$enquiry_type' and date(feed.created_on) between '$fromdate' and '$todate' order by feed.created_on desc";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function getAllWebsiteFeedback($fromdate,$todate)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql = "select feed.*,pro.first_name,pro.last_name,pro.phone1,user.user_email as email from forc_crm_feedback feed left join forc_crm_student_details pro on pro.user_id=feed.sid left join forc_crm_users user on feed.sid=user.ID where  date(feed.created_on) between '$fromdate' and '$todate' order by feed.created_on desc ";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }


    public function Deletefeedbackquery($Id) {
        try {
            $conn = new PDO('mysql:host=' . MYSQLDB_HOST . ';dbname=' . MYSQLDB_DATABASE . '', MYSQLDB_USER, MYSQLDB_PASS);
            $da = str_replace(",", "','", $Id);
            $query="Delete from forc_crm_feedback where id In ('$da')";
            $query = $conn->prepare($query);
            $query->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        $conn= NULL ;
        return $query;
    }

    public function changeStatusfeedback($id,$status)
    {
        try {
            $conn = new PDO('mysql:host=' . MYSQLDB_HOST . ';dbname=' . MYSQLDB_DATABASE . '', MYSQLDB_USER, MYSQLDB_PASS);
            
            $query="update forc_crm_feedback set status=$status where id='$id'";
            $query = $conn->prepare($query);
            $query->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        $conn= NULL ;
        return $query;
    }

     public function getfeedbackById($fid)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql ="select feed.*,pro.first_name,pro.last_name,pro.phone1,user.user_email as email from forc_crm_feedback feed left join forc_crm_student_details pro on pro.user_id=feed.sid left join forc_crm_users user on feed.sid=user.ID where  feed.id='$fid'";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    
    public function getfeedbackOrderBySTATUS($status)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql ="select feed.*,pro.first_name,pro.last_name,pro.phone1,user.user_email as email,pro.profile_image as image,pro.gender from forc_crm_feedback feed left join forc_crm_student_details pro on pro.user_id=feed.sid left join forc_crm_users user on feed.sid=user.ID where feed.status='$status' order by feed.created_on desc limit 10";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }


    public function getservicetax()
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql ="select tax from forc_crm_tax where status='1' order by id desc";
        $query = $mysqli->query($sql);
        $row = $query->fetch_assoc();
        
        return $row['tax'];
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }


    public function getStudentDetailByUid($uid)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql ="select user.user_email as email,stu.first_name,stu.last_name,stu.phone1 as phone,pay.fee from  forc_crm_users user left join forc_crm_student_details stu on user.ID=stu.user_id left join forc_crm_levels_payment pay on stu.user_id=pay.user_id where user.ID='$uid'";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }


    public function getUpdateOrderIdByUid($uid,$payment_id)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql ="update forc_crm_levels_payment set order_id='$payment_id' where user_id='$uid'";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }


    public function updatepaymentdetail($order_id,$txn_id,$amt)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
     echo   $sql ="update forc_crm_levels_payment set txn_id='".$txn_id."',cheque_amount='".$amt."', payment_status='1' where order_id='$order_id'";
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }


    public function getdetailBYOrderId($order_id)
    {
        try {
        $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
        $sql ="select user.user_email,user.user_login,stu.first_name,stu.last_name,user.ID,cc.coursename,ccc.categoryname from forc_crm_levels_payment pay left join forc_crm_users as user on pay.user_id=user.ID left join forc_crm_student_details stu on stu.user_id=user.ID LEFT JOIN forc_crm_courses cc ON pay.post_id=cc.Id LEFT JOIN forc_crm_course_category ccc ON cc.catId=ccc.Id where order_id='$order_id'";
        
        $query = $mysqli->query($sql);
        
        return $query;
    } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    
	
    public function saveQueryDetails($message,$studentuserid) {
        try {
            $conn = new PDO('mysql:host=' . MYSQLDB_HOST . ';dbname=' . MYSQLDB_DATABASE . '', MYSQLDB_USER, MYSQLDB_PASS);
            
            $ticketId=$this->getNewTicketID();
            
            $ticketNo='';
            if($ticketId<10)
            $ticketNo="000".$ticketId;
            elseif($ticketId<100)
            $ticketNo="00".$ticketId;
            elseif($ticketId<1000)
            $ticketNo="0".$ticketId;
            else
            $ticketNo=$ticketId;

            $ticketNo='FC-'.$ticketNo;
            
            $query= "insert into forc_crm_query set ticketId='$ticketId', ticketNo='$ticketNo', query='".$message."', enterby='".$studentuserid."'";
            $query = $conn->prepare($query);
            $query->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        $conn= NULL ;
        return $query;
    }
    
    public function saveFollowupDetails($ticketId,$ticketNo,$comment,$studentuserid) {
        try {
            $conn = new PDO('mysql:host=' . MYSQLDB_HOST . ';dbname=' . MYSQLDB_DATABASE . '', MYSQLDB_USER, MYSQLDB_PASS);
            
            $query= "insert into forc_crm_query set ticketId='$ticketId', ticketNo='$ticketNo', query='".$comment."', enterby='".$studentuserid."'";
            $query = $conn->prepare($query);
            $query->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        $conn= NULL ;
        return $query;
    }
    
    public function getNewTicketID() {
        try {
            $conn = new PDO('mysql:host=' . MYSQLDB_HOST . ';dbname=' . MYSQLDB_DATABASE . '', MYSQLDB_USER, MYSQLDB_PASS);
            $query= "select max(ticketId) as newticketId from forc_crm_query";
            $query = $conn->prepare($query);
            $query->execute();
            
            $row=$query->fetch(PDO::FETCH_ASSOC);
            $newticketId=$row['newticketId']+1;
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        $conn= NULL ;
        return $newticketId;
    }
    
    public function getAllTicketByuserId($studentuserid) {
        try {
            $conn = new PDO('mysql:host=' . MYSQLDB_HOST . ';dbname=' . MYSQLDB_DATABASE . '', MYSQLDB_USER, MYSQLDB_PASS);
            $query= "select * from forc_crm_query where enterby='$studentuserid' group by ticketId order by Id asc";
            $query = $conn->prepare($query);
            $query->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        $conn= NULL ;
        return $query;
    }
    
    public function getAllTicketForAdmin() {
        try {
            $conn = new PDO('mysql:host=' . MYSQLDB_HOST . ';dbname=' . MYSQLDB_DATABASE . '', MYSQLDB_USER, MYSQLDB_PASS);
            $query= "select * from forc_crm_query group by ticketId order by Id asc";
            $query = $conn->prepare($query);
            $query->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        $conn= NULL ;
        return $query;
    }
	
    
}