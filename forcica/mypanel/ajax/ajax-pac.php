<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");

if($_POST['q']=='getPACLIST')
getPACLIST();
else if($_POST['q']=='getFILIST')
getFILIST();
else if($_POST['q']=='getLBLIST')
getLBLIST();
else if($_POST['q']=='getSBLIST')
getSBLIST();

function getPACLIST()
{
    $month=$_POST['month'];
    $year=$_POST['year'];
    $monthdate=$_POST['monthdate'];
    
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
        
        $tabledata='<table id="data-table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="10%">S.No.</th>
                            <th width="15%">PA ENR No.</th>
                            <th width="15%">Student ENR No.</th>
                            <th width="15%">Fee</th>
                            <th width="15%">Date Of Admission</th>
                            <th width="15%">PAC Amount</th>
                            <th width="15%">DSA ENR NO / Amount</th>
                        </tr></thead><tbody>';
                        $i=1;
                        $useridstr='';
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
                                if($pacamount>0) {    
                                $tabledata .='<tr>';
                                    $tabledata .='<td>'.$i.'</td>';
                                    $tabledata .='<td>'.$row2['student_parent_id'].'</td>';
                                    $tabledata .='<td>'.$row2['user_login'].'</td>';
                                    

                                    
                                    $tabledata .='<td>'.$feeamount.'</td>';
                                    $tabledata .='<td>'.date('d M, Y',strtotime($row2['user_registered'])).'</td>';

                                    $tabledata .='<td>'.number_format($pacamount).'<input type="hidden" name="pacamount'.$row2['user_id'].'" id="pacamount'.$row2['user_id'].'" value="'.$pacamount.'"><input type="hidden" name="reffered_user_id'.$row2['user_id'].'" id="reffered_user_id'.$row2['user_id'].'" value="'.$row2['reffered_user_id'].'"><input type="hidden" name="dsapacamount'.$row2['user_id'].'" id="dsapacamount'.$row2['user_id'].'" value="'.$dsapacamount.'"><input type="hidden" name="dsauserid'.$row2['user_id'].'" id="dsauserid'.$row2['user_id'].'" value="'.$dsa_user_id.'"></td>';
                                    if($dsaflag) {
                                        $tabledata .='<td><b>ENR No.</b> : '.$dsa_user_login.' <br> <b>Amount :</b> '.$dsapacamount.'</td>';
                                    } else {
                                        $tabledata .='<td></td>';
                                    }
                                $tabledata .='</tr>';
                                
                            $i++;
                            $useridstr .=','.$row2['user_id']; 
                                }
                            }
                        }
                        $useridstr=substr($useridstr,1);
            $tabledata .='</tbody></table><input type="hidden" name="totaluser" id="totaluser" value="'.$useridstr.'">';
        echo 's^notexist^'.$tabledata.'^test';
    }
}


function getFILIST()
{
    $month=$_POST['month'];
    $year=$_POST['year'];
    $obj=new Common();
    $resMTC=$obj->checkMonthlyTradingexist($month,$year,'fi');
    if($resMTC->num_rows>0)
    {
        echo 's^exist^test';
    }
    else 
    {
        $res=$obj->getPAUserList($month,$year);
        
        
        $tabledata='<table id="data-table" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th width="10%">S.No.</th>
                                <th width="15%">PA ENR No.</th>
                                <th width="15%">No. Of Student</th>
                                <th width="15%">FI Amount</th>
                            </tr></thead><tbody>';
                            $i=1;
                            $useridstr='';
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
                                    $tabledata .='<tr>';
                                        $tabledata .='<td>'.$i.'</td>';
                                        $tabledata .='<td>'.$row['user_login'].'</td>';
                                        $tabledata .='<td>'.$resSR->num_rows.'</td>';
                                        $tabledata .='<td>'.number_format($totalFIAmount,2).'<input type="hidden" name="fiamount'.$row['user_id'].'" id="fiamount'.$row['user_id'].'" value="'.$totalFIAmount.'"></td>';
                                    $tabledata .='</tr>';    
                                    $i++;
                                    $useridstr .=','.$row['user_id'];
                                    }
                                }
                                else  
                                {
                                    $resDR=$obj->deletePADSADetails($row['user_id']);
                                }
                            }  
                            $useridstr=substr($useridstr,1);
        $tabledata .='</tbody></table><input type="hidden" name="totaluser" id="totaluser" value="'.$useridstr.'">';
    }
    echo 's^notexist^'.$tabledata.'^test';
}

function getLBLIST()
{
    $month=$_POST['month'];
    $year=$_POST['year'];
    $obj=new Common();
    $resMTC=$obj->checkMonthlyTradingexist($month,$year,'lb');
    if($resMTC->num_rows>0)
    {
        echo 's^exist^test';
    }
    else 
    {
        $res=$obj->getPAUserList($month,$year);
        
        
        $tabledata='<table id="data-table" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th width="10%">S.No.</th>
                                <th width="15%">PA ENR No.</th>
                                <th width="15%">Total Business</th>
                                <th width="15%">LB Amount</th>
                            </tr></thead><tbody>';
                            $i=1;
                            $useridstr='';
                            while($row=$res->fetch_assoc())
                            {
                                
                                $totalbusiness=$obj->getPAFiveLevelBusiness($row['user_login'],$month,$year,0,0);
                                if($totalbusiness >= 30000000)
                                {
                                    $lbamount= ($totalbusiness*0.1)/100;
                                    $lbamount=round($lbamount,2);
                                    $tabledata .='<tr>';
                                        $tabledata .='<td>'.$i.'</td>';
                                        $tabledata .='<td>'.$row['user_login'].'</td>';
                                        $tabledata .='<td>'.number_format($totalbusiness).'</td>';
                                        $tabledata .='<td>'.$lbamount.'<input type="hidden" name="lbamount'.$row['user_id'].'" id="lbamount'.$row['user_id'].'" value="'.$lbamount.'"></td>';
                                    $tabledata .='</tr>';    
                                    $i++;
                                    $useridstr .=','.$row['user_id'];
                                }
                            }  
                            $useridstr=substr($useridstr,1);
        $tabledata .='</tbody></table><input type="hidden" name="totaluser" id="totaluser" value="'.$useridstr.'">';
    }
    echo 's^notexist^'.$tabledata.'^test';
}

function getSBLIST()
{
    ini_set('display_errors',1);
    
    $month=$_POST['month'];
    $year=$_POST['year'];
    $obj=new Common();
    $resMTC=$obj->checkMonthlyTradingexist($month,$year,'sb');
    if($resMTC->num_rows>0)
    {
        echo 's^exist^test';
    }
    else 
    {
        $res=$obj->getPASBUserList($month,$year);
        
        
        $tabledata='<table id="data-table" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th width="10%">S.No.</th>
                                <th width="15%">PA ENR No.</th>
                                <th width="15%">SB Amount</th>
                            </tr></thead><tbody>';
                            $i=0;
                            $useridstr='';
                            $useramountsum=array();
                            $parentamountsum=array();
                            $reg=  array();
                            
                            while($row=$res->fetch_assoc())
                            {
                                $paarray=array();
                                $totalbusiness=$obj->getPAFiveLevelPA($row['user_login'],$month,$year,0,'','','',$row['user_id']);
                                //if($totalbusiness >= 30000000)
                                $user_id=$row['user_id'];
				$student_parent_id=$row['student_parent_id'];
                                $ulogin=$row['user_login'];
                                if($totalbusiness[$user_id]>0) 
                                {
                                    
                                    $reg[$i]=  array('user_login'=>$row['user_login'],'user_id'=>$row['user_id'],'totalbusiness'=>$totalbusiness[$user_id]);
                                    $i++;
                                    
                                    $parentamountsum[$student_parent_id]=$parentamountsum[$student_parent_id]+((($totalbusiness[$user_id]+$parentamountsum[$ulogin])*10)/100);
                                    
                                }
                            }
                            $i=1;
                            
                            
                            for($k=0; $k < count($reg); $k++)
                            {
                                $user_login=$reg[$k]['user_login'];
                                $tabledata .='<tr>';
                                    $tabledata .='<td>'.$i.'</td>';
                                    $tabledata .='<td>'.$reg[$k]['user_login'].'</td>';
                                    
                                    $amount=$reg[$k]['totalbusiness'];
                                    
                                    if(array_key_exists($user_login,$parentamountsum)) {
                                        $amount=$amount+($parentamountsum[$user_login]);
                                    }
                                    
                                    $tabledata .='<td>'.number_format($amount,2).'<input type="hidden" name="sbamount'.$reg[$k]['user_id'].'" id="sbamount'.$reg[$k]['user_id'].'" value="'.$amount.'"></td>';
                                $tabledata .='</tr>';    
                                $i++;
                                $useridstr .=','.$reg[$k]['user_id'];
                            }
                            
                            
                            
                            $useridstr=substr($useridstr,1);
        $tabledata .='</tbody></table><input type="hidden" name="totaluser" id="totaluser" value="'.$useridstr.'">';
    }
    echo 's^notexist^'.$tabledata.'^test';
}
?>