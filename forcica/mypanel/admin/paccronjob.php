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
		 $SetDateArray = array(10, 20, 29);
	}
	else
	{
		 $SetDateArray = array(10, 20, 28);
	}
	
   
}
else {
    $SetDateArray = array(10, 20, 30);
}




if(in_array($monthdate, $SetDateArray))
{
	$obj=new Common();
		$resMTC=$obj->checkPASCexist($month,$year,$monthdate,'pac');
		if($resMTC->num_rows>0)
		{
			echo 's^exist^test';
		}
		else 
		{
			$res=$obj->getPACUserList($month,$year,$monthdate);
			$student_parent_id='';
			
			
			
			while($row=$res->fetch_assoc())
			{
				$student_parent_id .=','.$row['user_login'];
			}
			
			$student_parent_id=substr($student_parent_id,1);
			
			
			$i=1;
			
			$useridstr='';
			
			$pacamountArray = array();
			
			$dsapacamountArray = array();
			
			$dsa_user_idArray = array();
                        
                        $pa_user_idArray = array();
			
			$res2=$obj->getPACserList($month,$year,$monthdate,$student_parent_id);
			
			
			
			if($res2->num_rows>0)
			{	
				while($row2=$res2->fetch_assoc())
				{
					$feeamount=$row2['fee']-$row2['service_tax'];
						$reffered_student_parent_id=$row2['reffered_student_parent_id'];
						
						$dsaflag=FALSE;
						$dsa_user_id='';
						$dsa_user_login='';
						
						if(@is_numeric($reffered_student_parent_id)) 
						{
							$pacreated_on=$row2['pacreated_on'];
							
							$dsa_user = $obj->getuplineDSA($reffered_student_parent_id,$pacreated_on);
							$dsa_user=@explode('^',$dsa_user);
							if($dsa_user[0]!='')
							{
								$dsa_user_id=$dsa_user[0];
								$dsa_user_login=$dsa_user[1];
								$dsaflag=TRUE;
							}
						}
						$dsapacamount=0;
						if($dsaflag) 
						{
							$pacamount=($feeamount*5)/100;
							$pacamount=round($pacamount,2);
							
							$dsapacamount=($feeamount*5)/100;
							$dsapacamount=round($dsapacamount,2);
						}
						else 
						{
							$pacamount=($feeamount*10)/100;
							$pacamount=round($pacamount,2);
						}
					if($pacamount>0){

					
					$userid = $row2['user_id'];
					
					$pacamountArray[$userid] = $pacamount;
			
					$dsapacamountArray[$userid] = $dsapacamount;
					
					$dsa_user_idArray[$userid] = $dsa_user_id;
					
					$pa_user_idArray[$userid] = $row2['reffered_user_id'];
                                        
					$i++;
					
					$useridstr .=','.$row2['user_id']; 
				
					}
				}
				$useridstr=substr($useridstr,1);
				//print_r($dsa_user_idArray); 
				
				
				$resSD=$obj->getSettings();
				$rowSD=$resSD->fetch_assoc();
				
				$res=$obj->savePACdataByCronJob('pac',$rowSD['tds'], $pacamountArray, $dsapacamountArray, $dsa_user_idArray, $useridstr, $month, $year, $monthdate,$pa_user_idArray);
				
				
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