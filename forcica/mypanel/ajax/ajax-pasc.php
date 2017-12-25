<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");

if($_POST['q']=='applyPASC')
applyPASC();

function applyPASC()
{
    $month=$_POST['month'];
    $year=$_POST['year'];
    $monthdate=$_POST['monthdate'];
	
    if($monthdate==10) { $segmentstartdate = date($year.'-'.$month.'-01'); $segmentenddate = date($year.'-'.$month.'-'.$monthdate); } else if($monthdate==20) { $segmentstartdate = date($year.'-'.$month.'-11'); $segmentenddate = date($year.'-'.$month.'-'.$monthdate); } else if($monthdate==30) { $segmentstartdate = date($year.'-'.$month.'-21'); $segmentenddate = date($year.'-'.$month.'-30'); }
    
    
    
    $obj=new Common();
    $resMTC=$obj->checkPASCexist($month,$year,$monthdate,'pasc');
    if($resMTC->num_rows>0)
    {
        echo 's^exist^test';
    }
    else 
    {
        $res=$obj->getPAUserListForPASC($month,$year,$monthdate);

        $tabledata='<table id="data-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="10%">S.No.</th>
                            <th width="15%">ENR No.</th>
                            <th width="15%">Name</th>
                            <th width="15%">Date Of PA</th>
                            <th width="15%">PASC Amount</th>

                        </tr></thead><tbody>';
                        $i=1;
                        $useridstr='';
                        $percentage=15;
                        while($row=$res->fetch_assoc())
                        {
                            $tabledata .='<tr>';
                                $tabledata .='<td>'.$i.'</td>';
                                $tabledata .='<td>'.$row['user_login'].'</td>';
                                $tabledata .='<td>'.$row['name'].'</td>';
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
//                                            $percentageamount=($totalfees*$percentage)/100;
//                                            $percentageamount=$percentageamount/3;
                                            
                                            $percentageamount=$rowSAF['course_pasc'];
//					    $percentageamount=($totalfees*$percentage)/100;
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
//                                      $percentageamount=($totalfees*$percentage)/100;
//                                      $percentageamount=$percentageamount/3;
                                        
                                        $percentageamount=$rowSAF['course_pasc'];
//					$percentageamount=($totalfees*$percentage)/100;
					$percentageamount=$percentageamount/3;
                                        
                                        $pascamount=($percentageamount*$days)/10;
                                    }
                                }
                                
                                $paymentid=substr($paymentid,1);
                                $noofpasc=substr($noofpasc,1);
                                
                                $tabledata .='<td>'.date('d M, Y',strtotime($row['created_on'])).'</td>';
                                
                                $tabledata .='<td>'.round($pascamount,2).'<input type="hidden" name="pascamount'.$row['user_id'].'" id="pascamount'.$row['user_id'].'" value="'.$pascamount.'"><input type="hidden" name="paymentid'.$row['user_id'].'" id="paymentid'.$row['user_id'].'" value="'.$paymentid.'"><input type="hidden" name="noofpasc'.$row['user_id'].'" id="noofpasc'.$row['user_id'].'" value="'.$noofpasc.'"></td>';
								
                            $tabledata .='</tr>';
                            $i++;
                            $useridstr .=','.$row['user_id'];  
                        }
                        $useridstr=substr($useridstr,1);
        $tabledata .='</tbody></table><input type="hidden" name="totaluser" id="totaluser" value="'.$useridstr.'">';
        echo 's^notexist^'.$tabledata.'^test';
    }
}

?>