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
	$resMTC=$obj->checkMonthlyTradingexist($month,$year,'lb');
	if($resMTC->num_rows>0)
	{
		echo 's^exist^test';
	}
	else 
	{
		$res=$obj->getPAUserList($month,$year);
		
		
		
			$i=1;
			$useridstr='';
			$lbamountArray = array();
			while($row=$res->fetch_assoc())
			{
				
				$totalbusiness=$obj->getPAFiveLevelBusiness($row['user_login'],$month,$year,0,0);
				//if($totalbusiness >= 30000000)
				if($totalbusiness >= 30000000)
				{
					$lbamount= ($totalbusiness*0.1)/100;
					$lbamount=round($lbamount,2);
					
					$userid = $row['user_id'];
					$lbamountArray[$userid] = $lbamount;
					
					$i++;
					$useridstr .=','.$row['user_id'];
				}
			} 
			
			$useridstr=substr($useridstr,1);
			
			if(count($lbamountArray)>0)
			{
				$resSD=$obj->getSettings();
				$rowSD=$resSD->fetch_assoc();
				
				$res=$obj->saveLBdataByCronJob('lb',$rowSD['tds'], $lbamountArray, $useridstr, $month, $year);
				
				if($res)
				{
					echo "success";
				}
				else{
					
					echo "fail";
				}
			}
	}
}


?>