<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");

$month = date('m');
$year = date('Y');

$date = $year."-".$month."-1";
$monthlastdate = date("t", strtotime($date));
$monthcdate = date('d');

if($monthcdate==$monthlastdate)
{
	$obj=new Common();
	$resMTC=$obj->checkMonthlyTradingexist($month,$year,'fi');
	if($resMTC->num_rows>0)
	{
		echo 's^exist^test';
	}
	else 
	{
		$res=$obj->getPAUserList($month,$year);
		
			$i=1;
			$useridstr='';
			$fiamountArray = array();
			while($row=$res->fetch_assoc())
			{
				$pacourseId=$row['current_courseId'];
				
				$resSR=$obj->getPARUserList($month,$year,$row['user_login'],$pacourseId);
				if($resSR->num_rows >= 5)
				{
					$PACourseFee=($row['current_fee']-$row['current_servicetax']);
					$resPACA=$obj->getPACAmount($month,$year,$row['user_id'],'pac');
					$rowPACA=$resPACA->fetch_assoc();
					
					$totalFIAmount=$PACourseFee-$rowPACA['totalpacamount'];
					if($totalFIAmount>0) {
						
						$userid =$row['user_id'];
						
						$fiamountArray[$userid] = $totalFIAmount;
						
					   
					$i++;
					
					
					$useridstr .=','.$row['user_id'];
					
					}
					$useridstr=substr($useridstr,1);
					
					if(count($fiamountArray)>0)
					{
						$resSD=$obj->getSettings();
						$rowSD=$resSD->fetch_assoc();
						
						 $res=$obj->saveFIdataByCronJob('fi',$rowSD['tds'], $fiamountArray, $useridstr, $month, $year);
						
						if($res)
						{
							echo "success";
						}
						else{
							
							echo "fail";
						}
					}
					 
					
				}
				else  
				{
					$resDR=$obj->deletePADSADetails($row['user_id']);
				}
				
				
			} 
	}
}
	
?>