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
	$resMTC=$obj->checkMonthlyTradingexist($month,$year,'sb');
	if($resMTC->num_rows>0)
	{
		echo 's^exist^test';
	}
	else 
	{
		$res=$obj->getPASBUserList($month,$year);
		
			$i=0;
                        $useridstr='';
                        $useramountsum=array();
                        $parentamountsum=array();
                        $reg=  array();
			$sbamountArray = array();
			while($row=$res->fetch_assoc())
			{
				$paarray=array();
				$totalbusiness =$obj->getPAFiveLevelPA($row['user_login'],$month,$year,0,'','','',$row['user_id']);
				//if($totalbusiness >= 30000000)
				$user_id=$row['user_id'];
                                $student_parent_id=$row['student_parent_id'];
			
				if($totalbusiness[$user_id]>0) {
                                    $reg[$i]=  array('user_login'=>$row['user_login'],'user_id'=>$row['user_id'],'totalbusiness'=>$totalbusiness[$user_id]);
                                    $i++;

                                    $parentamountsum[$student_parent_id]=$parentamountsum[$student_parent_id]+((($totalbusiness[$user_id]+$parentamountsum[$ulogin])*10)/100);
                                    
                                    //$sbamountArray[$user_id] = $totalbusiness[$user_id];

                                    //$i++;
                                   // $useridstr .=','.$row['user_id'];
				}
			}  
                        
                            
                            
                        for($k=0; $k < count($reg); $k++)
                        {
                            $user_login=$reg[$k]['user_login'];

                            $user_id=$reg[$k]['user_id'];
                            
                            $amount=$reg[$k]['totalbusiness'];

                            if(array_key_exists($user_login,$parentamountsum)) {
                                $amount=$amount+($parentamountsum[$user_login]);
                            }
                            
                            $sbamountArray[$user_id] = $amount;
                           
                            $useridstr .=','.$user_id;
                        }
                        
                        
                        
			$useridstr=substr($useridstr,1);
			
			if(count($sbamountArray)>0)
			{
				 $resSD=$obj->getSettings();
				
				$rowSD=$resSD->fetch_assoc();
				
				$res=$obj->saveSBdataByCronJob('sb',$rowSD['tds'], $sbamountArray, $useridstr, $month, $year);
				
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