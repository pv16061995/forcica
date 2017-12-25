<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");

$month = date('m');
$year = date('Y');
$monthdate = date('d');

if($month==02) 
{
	if( (0 == $year % 4) and (0 != $year % 100) or (0 == $year % 400) )
	{
		 $SetDateArray = array(10, 20,29);
	}
	else
	{
		 $SetDateArray = array(10, 20, 28);
	}
	
   
}
else {
    $SetDateArray = array(10, 20, 30);
}


 
 
 
if($monthdate==10) { $segmentstartdate = date($year.'-'.$month.'-01'); $segmentenddate = date($year.'-'.$month.'-'.$monthdate); } else if($monthdate==20) { $segmentstartdate = date($year.'-'.$month.'-11'); $segmentenddate = date($year.'-'.$month.'-'.$monthdate); } else if($monthdate==30) { $segmentstartdate = date($year.'-'.$month.'-21'); $segmentenddate = date($year.'-'.$month.'-30'); }else if($monthdate==28 && $month==02){ $segmentstartdate = date($year.'-'.$month.'-21'); $segmentenddate = date($year.'-'.$month.'-30'); }else if($monthdate==29 && $month==02){ $segmentstartdate = date($year.'-'.$month.'-21'); $segmentenddate = date($year.'-'.$month.'-30'); }

if(in_array($monthdate, $SetDateArray))
{
$obj=new Common();
    $resMTC=$obj->checkPASCexist($month,$year,$monthdate,'pasc');
    if($resMTC->num_rows>0)
    {
        echo 's^exist^test';
    }
    else 
    {
        $res=$obj->getPAUserListForPASC($month,$year,$monthdate);
		$i=1;
		$useridstr='';
		$percentage=15;
		
		$userIdArray = array();
		$paymentIdArray = array();
		$noofpascArray = array();
		$pascamountArray = array();
		while($row=$res->fetch_assoc())
		{
			
				$studentsegmentstartdate= date('Y-m-d', strtotime($row['created_on'].'+1 days'));
				
				$resSAF=$obj->getStudentFEEDetails($row['user_id']);
				
				if((strtotime($studentsegmentstartdate) >= strtotime($segmentstartdate)) && (strtotime($studentsegmentstartdate) < strtotime($segmentenddate))) 
				{
					$paymentid='';
					$noofpasc='';
					while($rowSAF=$resSAF->fetch_assoc()) 
					{
						
						
						
						
						$paymentid .=','.$rowSAF['id'];
						$noofpasc .=','.($rowSAF['noofpasc']+1);
						
						if($rowSAF['noofpasc']==0)
						{
							$datetime1 = new DateTime($studentsegmentstartdate);
							$datetime2 = new DateTime($segmentenddate);
							$difference = $datetime1->diff($datetime2);
							$days=$difference->d;
							
							$totalfees=$rowSAF['fee']-$rowSAF['service_tax'];
                                                        $percentageamount=$rowSAF['course_pasc'];
//							$percentageamount=($totalfees*$percentage)/100;
							$percentageamount=$percentageamount/3;
                                                        
							$pascamount=($percentageamount*$days)/10;
						}
					}
				}
				else 
				{
					
					$paymentid='';
					$noofpasc='';
					while($rowSAF=$resSAF->fetch_assoc()) 
					{
						$paymentid .=','.$rowSAF['id'];
						$noofpasc .=','.($rowSAF['noofpasc']+1);
						
						if($rowSAF['noofpasc']==35)
						{
							$padate=date('d',strtotime($studentsegmentstartdate));
							$padate=$padate+1;
							$studentsegmentstartdate = date($year.'-'.$month.'-'.$padate);
							$datetime1 = new DateTime($studentsegmentstartdate);
							$datetime2 = new DateTime($segmentenddate);
							$difference = $datetime1->diff($datetime2);
							$days=$difference->d;
						}
						else 
						{
							$days=10;
						}
						$totalfees=$rowSAF['fee']-$rowSAF['service_tax'];
                                                $percentageamount=$rowSAF['course_pasc'];
//						$percentageamount=($totalfees*$percentage)/100;
						$percentageamount=$percentageamount/3;
                                                
						//$percentageamount=($totalfees*$percentage)/100;
						//$percentageamount=$percentageamount/3;
                                                
						$pascamount=($percentageamount*$days)/10;
					}
				}
				
				
				$paymentid=substr($paymentid,1);
				$noofpasc=substr($noofpasc,1);
				
				
				$userid = $row['user_id'];
				$paymentIdArray[$userid] =$paymentid; 
				$noofpascArray[$userid] = $noofpasc;
				$pascamountArray[$userid] = $pascamount;
				
				$i++;
				
			$useridstr .=','.$row['user_id'];  
		}
		
		$useridstr=substr($useridstr,1);
		
		$resSD=$obj->getSettings();
		$rowSD=$resSD->fetch_assoc();
		
		$res = $obj->savePASCdataByCronJob('pasc',$rowSD['tds'], $paymentIdArray, $noofpascArray, $pascamountArray, $useridstr, $month, $year, $monthdate);
		
		if($res)
		{
			echo "success";
		}
		else{
			
			echo "fail";
		}
		
	}
}
?>