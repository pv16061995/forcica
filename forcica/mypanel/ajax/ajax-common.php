<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");
include_once("../controls/clsUser.php");
include_once("../controls/clsAlerts.php");

if($_POST['q']=='checkUserExist')
checkUserExist();
else if($_POST['q']=='saveOnetimeInput')
saveOnetimeInput();
else if($_POST['q']=='applyProfit')
applyProfit();
else if($_POST['q']=='getUserDetails')
getUserDetails();
else if($_POST['q']=='searchMember')
searchMember();
else if($_POST['q']=='saveRequest')
saveRequest();
else if($_POST['q']=='closeRequest')
closeRequest();
else if($_POST['q']=='searchNeftList')
searchNeftList();
else if($_POST['q']=='setemail')
setemail();
else if($_POST['q']=='setstemail')
setstemail();
else if($_POST['q']=='settdsemail')
settdsemail();
else if($_POST['q']=='mailthis')
mailthis();
else if($_POST['q']=='searchStList')
searchStList();
else if($_POST['q']=='searchTDSList')
searchTDSList();
else if($_POST['q']=='getUserTSSDetails')
getUserTSSDetails();
else if($_POST['q']=='changeStatus')
changeStatus();
else if($_POST['q']=='saveCategory')
saveCategory();
else if($_POST['q']=='addCourse')
addCourse();
else if($_POST['q']=='addVideo')
addVideo();
else if($_POST['q']=='getFollowupDetails')
getFollowupDetails();
else if($_POST['q']=='saveCourse')
saveCourse();
else if($_POST['q']=='saveVideo')
saveVideo();
else if($_POST['q']=='getPayoutDetails')
getPayoutDetails();
else if($_POST['q']=='approveRequest')
approveRequest();
else if($_POST['q']=='getTeamData')
getTeamData();
else if($_POST['q']=='getStudentPayoutdataBySegment')
getStudentPayoutdataBySegment();
else if($_POST['q']=='coursecatByCourse')
coursecatByCourse();
else if($_POST['q']=='searchdataquiz')
searchdataquiz();
else if($_POST['q']=='getresultDetails')
getresultDetails();
else if($_POST['q']=='getWebsiteEnquiry')
getWebsiteEnquiry();
else if($_POST['q']=='getWebsiteFeedback')
getWebsiteFeedback();
else if($_POST['q']=='Deletefeedbackquery')
Deletefeedbackquery();
else if($_POST['q']=='changeStatusfeedback')
changeStatusfeedback();
else if($_POST['q']=='deleteVideo')
deleteVideo();
else if($_POST['q']=='editVideo')
editVideo();
else if($_POST['q']=='saveQuery')
saveQuery();
else if($_POST['q']=='saveFollowup')
saveFollowup();

function changeStatusfeedback()
{
    $id=$_POST['id'];
    $status=$_POST['status'];
    $objCom= new Common();
    $res_save=$objCom->changeStatusfeedback($id,$status);
    
}

function Deletefeedbackquery()
{
    $deleteid=$_POST['del_id'];
    
    $objCom= new Common();
    $res_save=$objCom->Deletefeedbackquery($deleteid);
    
}

function getWebsiteFeedback()
{
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
    $enquiry_type=$_POST['enquiry_type'];
    $obj=New Common();

    $tabledata='<table id="data-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="8%">S.No. &nbsp;&nbsp; <input name="checkbox_all" type="checkbox" id="checkbox_all" onclick="CheckAll()"></th>
                            <th width="12%">Feedback Date</th>
                            <th width="10%">Name</th>
                            <th width="12%">E-mail</th>
                            <th width="8%">Phone</th>
                            <th width="10%">Category</th>
                            <th width="25%">Message</th>
                            <th width="8%">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>';

                    if($enquiry_type=='')
                    {
                        $resST=$obj->getAllWebsiteFeedback($fromdate,$todate);
                    }else{
                        $resST=$obj->getWebsiteFeedback($fromdate,$todate,$enquiry_type);
                    }

        
        $i=1;
        $useridstr='';
        while($rowST=$resST->fetch_assoc()) 
        {
           
                $tabledata .='<tr>';
                $tabledata .='<td>'.$i.' &nbsp;&nbsp; <input type="checkbox" name="checkbox[]" id="checkbox'.$rowST['id'].'"  value="'.$rowST['id'].'" class="chk_delete" onclick="addvalidate();"></td>';
                $tabledata .='<td>'.$rowST['created_on'].'</td>';
                $tabledata .='<td>'.ucfirst($rowST['first_name'].' '.$rowST['last_name']).'</td>';
                $tabledata .='<td>'.$rowST['email'].'</td>';
                $tabledata .='<td>'.$rowST['phone1'].'</td>';
                $tabledata .='<td>'.$rowST['category'].'</td>';
                $tabledata .='<td>'.$rowST['message'].'</td>';
                $tabledata .='<td class=" ">';
                $tabledata .='<a href="editfeeback.php?fid='.base64_encode($rowST['id']).'" class="btn btn-mini btn-success" data-toggle="tooltip" data-original-title="Edit"><i class="icon icon-pencil"></i></a>';

                    if($rowST['status']=='1')
                    {
                       $tabledata .=' <a href="javascript:void(0);" class="btn btn-mini btn-danger" data-toggle="tooltip" data-original-title="Unpublish" 
                       onclick="changeStatus(\''.$rowST['id'].'\',\'0\')"><i class="icon icon-thumbs-down icon-white"></i></a>'; 
                   }else if($rowST['status']=='0'){
                     $tabledata .=' <a href="javascript:void(0);" class="btn btn-mini btn-success" data-toggle="tooltip" data-original-title="Publish" onclick="changeStatus(\''.$rowST['id'].'\',\'1\')"><i class="icon icon-thumbs-up icon-white"></i></a>';
                   }
                    
                     
                    
                     $tabledata .='</td>';
                $tabledata .='</tr>';

        $i++;}
                $tabledata .='</tbody></table>';
        echo $tabledata;
    
}


function getWebsiteEnquiry()
{
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
    $enquiry_type=$_POST['enquiry_type'];
    $obj=New Common();

    $tabledata='<table id="data-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">S.No.</th>
                            <th width="12%">Enquiry Date</th>
                            <th width="10%">Name</th>
                            <th width="12%">E-mail</th>
                            <th width="8%">Phone</th>
                            <th width="20%">Subject</th>
                            <th width="33%">Message</th>
                            
                        </tr>
                    </thead>
                    <tbody>';

        $resST=$obj->getWebsiteEnquiry($fromdate,$todate,$enquiry_type);
        $i=1;
        $useridstr='';
        while($rowST=$resST->fetch_assoc()) 
        {
           
                $tabledata .='<tr>';
                $tabledata .='<td>'.$i.'</td>';
                $tabledata .='<td>'.$rowST['created_on'].'</td>';
                $tabledata .='<td>'.ucfirst($rowST['name']).'</td>';
                $tabledata .='<td>'.$rowST['email'].'</td>';
                $tabledata .='<td>'.$rowST['phone'].'</td>';
                $tabledata .='<td>'.$rowST['subject'].'</td>';
                $tabledata .='<td>'.$rowST['message'].'</td>';
                $tabledata .='</tr>';

        $i++;}
                $tabledata .='</tbody></table>';
        echo $tabledata;
    
}





function coursecatByCourse()
{
	$catid=$_POST['category'];
	$subcat=$_POST['subcat'];
	$str=$_POST['str'];
	$obj=new Common();
    $res=$obj->getAllCourseByCatId($catid);
	if($str==''){
	?><option value="">Select Course</option><?php }
	 while($row=$res->fetch_assoc())
	 {?>
		 <option value="<?php echo $row['Id'];?>" <?php if(isset($subcat)){ if($row['Id']==$subcat){echo 'selected';}}?>><?php echo $row['coursename']?></option>
	 <?php }
	
}

function checkUserExist()
{
    $enr_no=$_POST['enr_no'];
    
    $obj=new Common();
    
    $res=$obj->checkUserExist($enr_no);
    
    // $result->fetch_assoc()
            
    if($res->num_rows>0)
    {
        $row=$res->fetch_assoc();
        
//        $usermeta=array();
//        $resUMD=$obj->getusermetadata($row['ID']);
//        $i=0;
//        while($rowUMD=$resUMD->fetch_array())
//        {
//            $key=$rowUMD['meta_key'];
//            $usermeta[$key]=$rowUMD['meta_value'];
//        }
        //user_activation_status
        
        $resUTC=$obj->checkUserTradingDetails($row['ID']);
        $rowUTC=$resUTC->fetch_array();
        $flagtradecheck=FALSE;
        $trading_amount=0;
        $trading_id='';
        if($rowUTC['trading_account_id']!='') 
        {
            $flagtradecheck=TRUE;
            $trading_id=$rowUTC['trading_account_id'];
            $total_money_withdrawn=$rowUTC['total_money_withdrawn'];
            $total_money_deposited=$rowUTC['total_money_deposited'];
            $trading_amount=$total_money_deposited-$total_money_withdrawn;
        }
        
        $tabledata='<table id="data-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td width="70%">
                                    <table id="data-table" class="table table-bordered table-striped">
                                        <tr><th width="25%">Name</th>
                                        <td width="25%">'.ucfirst($row['first_name']).' '.($row['last_name']).'</td></tr>
                                        <tr><th width="25%">Email</th>
                                            <td width="25%">'.$row['user_email'].'</td></tr> 
                                        <tr>
                                            <th width="25%">Referred By</th>
                                            <td width="25%">'.$row['student_parent_id'].'</td>
                                        </tr> 
                                        <tr>
                                            <th width="25%">Date of birth</th>
                                            <td width="25%">'.date('d M, Y',strtotime($row['dob'])).'</td>
                                        </tr> 
                                    </table>
                                </td>
                                <td width="30%">
                                    <img src="../userdocs/'.$row['ID'].'/'.$row['profile_image'].'" width="120" height="180">
                                </td>
                            </tr>
                        </table>
                        <table id="data-table" class="table table-bordered table-striped">
                            <tr>
                                <th width="25%">Address</th>
                                <td width="75%">'.$row['address1'].', '.$row['city'].', '.$row['state'].', '.$row['country'].' - '.$row['pincode'].'</td>
                                
                            </tr>';
                        if($flagtradecheck) 
                        {
                            $tabledata .='<tr>
                                <th width="25%">Trading Account ID</th>
                                <td width="25%">'.$trading_id.'</td>
                                </tr>
                                <tr>
                                <th width="25%">Margin Money Deposited</th>
                                <td width="75%">'.$trading_amount.'</td>
                            </tr>';
                        } 
                        $tabledata .='</thead>
                        <tbody>';
        $tabledata .='</tbody></table>';
        
        
        echo 's^exist^'.$tabledata.'^'.$row['ID'].'^'.$trading_amount.'^'.$trading_id;
    }
    else 
    {
        echo 's^wrong^test';
    }
}

function saveOnetimeInput()
{
    $enr_no=$_POST['enr_no'];
    $trading_account_id=$_POST['trading_account_id'];
    $margin_money_deposited=$_POST['margin_money_deposited'];
    $margin_money_withdrawn=$_POST['margin_money_withdrawn'];
    $trading_activation_date=$_POST['trading_activation_date'];
    $userid=$_POST['userid'];
    $pre_trading_account_id=$_POST['pre_trading_account_id'];
    $pre_margin_money_deposited=$_POST['pre_margin_money_deposited'];
    
    $obj=new Common();
    $checktradingidflag=FALSE;
    
    if($pre_trading_account_id=='')
    {
        $resTC=$obj->checkTradingIdExist($trading_account_id);
        if($resTC->num_rows>0) {
            $checktradingidflag=FALSE;
        } else {
            $checktradingidflag=TRUE;
        }
    }
    else 
    {
        $checktradingidflag=TRUE;
    }
    
    if($checktradingidflag) 
    {
        
        
        
        
        $date1=date('d',strtotime($trading_activation_date));
        if($margin_money_withdrawn=='') 
        {
            $totalmarginmoney=$pre_margin_money_deposited+$margin_money_deposited;
            $noofdays= 30-($date1+3);
        } 
        else 
        {
            $totalmarginmoney=$pre_margin_money_deposited-$margin_money_withdrawn;
            $noofdays= 30-($date1);
        }
        
        $accounttype='';
        if($totalmarginmoney>=1000 && $totalmarginmoney<=4999) 
        {
            $accounttype='Standard';
        }
        else if($totalmarginmoney>=5000 && $totalmarginmoney<=9999) 
        {
            $accounttype='Prime';
        }
        else if($totalmarginmoney>=10000 && $totalmarginmoney<=24999) 
        {
            $accounttype='Signature';
        }
        else if($totalmarginmoney>=25000) 
        {
            $accounttype='President';
        }
        
        $res=$obj->saveUserTradingDetails($userid,$enr_no,$trading_account_id,$margin_money_deposited,$margin_money_withdrawn,$trading_activation_date,$noofdays,$accounttype);

        if($res) 
        {
            $_SESSION['SuccessMessage']='Details has been saved successfully';
            echo 's^saved^test';
        } 
        else 
        {
            echo 's^notsaved^test';
        }
    }
    else 
    {
        echo 's^tradeidexist^test';
    }
}

function applyProfit()
{
    $profit=$_POST['profit'];
    $profitmonth=$_POST['profitmonth'];
    $profityear=$_POST['profityear'];
    
    $obj=new Common();
    
    $resMTC=$obj->checkMonthlyTradingexist($profitmonth,$profityear,'tss');
    if($resMTC->num_rows>0)
    {
        echo 's^exist^test';
    }
    else 
    {
        $trading_category=array();
        $res=$obj->getTradingAccountCategory();
        $i=0;
        while($row=$res->fetch_assoc()) {
            $trading_category[$i]= array('title'=>$row['title'], 'amount_range'=>$row['amount_range'], 'percentage'=>$row['percentage']);
            $i++;
        }

        $tabledata='<table id="data-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="10%">S.No.</th>
                            <th width="15%">ENR No.</th>
                            <th width="15%">Name</th>
                            <th width="15%">Total Profit ('.$profit.' %)</th>
                            <th width="15%">Student Profit Amount</th>
                            <th width="15%">Forcica Profit Amount</th>
                            
                        </tr></thead><tbody>';

        $resST=$obj->getTradingStudentList($profitmonth,$profityear);
        $i=1;
        $useridstr='';
        while($rowST=$resST->fetch_assoc()) 
        {
            /*
            $resUMD=$obj->getusermetadata($rowST['user_id']);

            while($rowUMD=$resUMD->fetch_array())
            {
                $key=$rowUMD['meta_key'];
                $usermeta[$key]=$rowUMD['meta_value'];
            }
            */
            $prfitamount=0;
            $forcicatotalprfitamount=0;
            $tabledata .='<tr>';
                $tabledata .='<td>'.$i.'</td>';
                $tabledata .='<td>'.$rowST['enr_no'].'</td>';
                $tabledata .='<td>'.ucfirst($rowST['first_name']).' '.($rowST['last_name']).'</td>';

                $resTSA=$obj->gettotalTradingAmountofStudent($profitmonth,$profityear,$rowST['user_id']);
                $rowTSA=$resTSA->fetch_assoc();
                $totalmarginmoney=$rowTSA['total_money_deposited']-$rowTSA['total_money_withdrawn'];
                
                $applyslabpercentage=0;
                
                if($totalmarginmoney>=1000 && $totalmarginmoney<=4999) 
                {
                    $applyslabpercentage=$trading_category[0]['percentage'];
                }
                else if($totalmarginmoney>=5000 && $totalmarginmoney<=9999) 
                {
                    $applyslabpercentage=$trading_category[1]['percentage'];
                }
                else if($totalmarginmoney>=10000 && $totalmarginmoney<=24999) 
                {
                    $applyslabpercentage=$trading_category[2]['percentage'];
                }
                else if($totalmarginmoney>=25000) 
                {
                    $applyslabpercentage=$trading_category[3]['percentage'];
                }
                
                $resSA=$obj->getpreTradingAmountofStudent($profitmonth,$profityear,$rowST['user_id']);
                $rowSA=$resSA->fetch_assoc();
                $previousmonthmarginmoney=$rowSA['total_money_deposited']-$rowSA['total_money_withdrawn'];

                if($previousmonthmarginmoney>0) 
                {
                    $prfitamount=$prfitamount+(calculateprofit($previousmonthmarginmoney,30,$applyslabpercentage));
                    $forcicatotalprfitamount=$forcicatotalprfitamount+(calculateprofit($previousmonthmarginmoney,30,$profit));
                }
                
                $curplusamount=0;
                $curminusamount=0;

                $curforcicaminusamount=0;
                $curforcicaplusamount=0;

                $resSCA=$obj->getcurTradingAmountofStudent($profitmonth,$profityear,$rowST['user_id']);
                while($rowSCA=$resSCA->fetch_assoc())
                {
                    if($rowSCA['money_deposited']>0)
                    {
                        $curplusamount=$curplusamount+(calculateprofit($rowSCA['money_deposited'],$rowSCA['noofdays'],$applyslabpercentage));
                        $curforcicaplusamount=$curforcicaplusamount+(calculateprofit($rowSCA['money_deposited'],$rowSCA['noofdays'],$profit));
                    }
                    else 
                    {
                        $curminusamount=$curminusamount+(calculateprofit($rowSCA['money_withdrawn'],$rowSCA['noofdays'],$applyslabpercentage));
                        
                        $curforcicaminusamount=$curforcicaminusamount+(calculateprofit($rowSCA['money_withdrawn'],$rowSCA['noofdays'],$profit));
                    }
                }
                
                $prfitamount=($prfitamount+$curplusamount)-$curminusamount;
                $forcicatotalprfitamount=($forcicatotalprfitamount+$curforcicaplusamount)-$curforcicaminusamount;
                $tabledata .='<td>'.round(($forcicatotalprfitamount),2).'<input type="hidden" name="studentprofit'.$rowST['user_id'].'" id="studentprofit'.$rowST['user_id'].'" value="'.round($prfitamount,2).'"><input type="hidden" name="forcicaprofit'.$rowST['user_id'].'" id="forcicaprofit'.$rowST['user_id'].'" value="'.round(($forcicatotalprfitamount-$prfitamount),2).'"><input type="hidden" name="totalprofit'.$rowST['user_id'].'" id="totalprofit'.$rowST['user_id'].'" value="'.round(($forcicatotalprfitamount),2).'"></td>';
                $tabledata .='<td>'.round($prfitamount,2).' <a href="#myModal" class="btn btn-success btn-mini pull-right" data-toggle="modal" data-original-title="View" onclick="getUserTSSDetails(\''.$rowST['enr_no'].'\');"><i class="icon icon-zoom-in"></i></a></td>';
                $tabledata .='<td>'.round(($forcicatotalprfitamount-$prfitamount),2).'</td>';
                
            $tabledata .='</tr>';
        $i++;

          $useridstr .=','.$rowST['user_id'];  
        }
        $useridstr=substr($useridstr,1);
        $tabledata .='</tbody></table><input type="hidden" name="totaluser" id="totaluser" value="'.$useridstr.'">';
        echo 's^notexist^'.$tabledata;
    }
}

function calculateprofit($amount,$noofdays,$percentage)
{
    $profitamount=(($amount*$percentage*$noofdays)/(30*100));
    return $profitamount;
}

function searchMember()
{
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
    
    $tabledata='<table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="5%">S.No.</th>
            <th width="8%">ENR No.</th>
            <th width="12%">Name</th>
            <th width="12%">DOB</th>
            <th width="15%">Address</th>
            <th width="10%">Email</th>
            <th width="8%">Ref. By</th>
            <th width="12%">Course</th>
            <th width="8%">PAN</th>
            <th width="8%">Gender</th>
            <th width="10%">Date of Admission</th>
            <th width="10%">Date of PA</th>
            <th width="10%">Date of DSA</th>
            <th width="10%">Status</th>
          </tr>
        </thead>
        <tbody>';
            $obj=new Common();
            $res=$obj->getAllMemberListDateWise($fromdate, $todate);
            $i=1;
            while($row=$res->fetch_assoc())
            {
//                $usermeta=array();
//                $resUMD=$obj->getusermetadata($row['ID']);
//                while($rowUMD=$resUMD->fetch_array())
//                {
//                    $key=$rowUMD['meta_key'];
//                    $usermeta[$key]=$rowUMD['meta_value'];
//                }
            $tabledata .='<tr>
                <td>'.$i.'</td>
                <td>'.$row['user_login'].'</td>
                <td>'.ucfirst($row['first_name']).' '.($row['last_name']).'</td>
                <td>'.date('d M, Y',strtotime($row['dob'])).'</td>  
                <td>'.$row['address1'].', '.$row['city'].', '.$row['state'].', '.$row['country'].' - '.$row['pincode'].'</td>    
                <td>'.$row['user_email'].'</td>
                <td>'.$row['student_parent_id'].'</td>   
                <td>'.$row['post_title'].'</td>';
            $panno='';
            if($row['pa_pan']!='') { $panno= $row['pa_pan']; } else if($row['dsa_pan']!='') { $panno= $row['dsa_pan']; }
               $tabledata .=' <td>'.$panno.'</td>';
               
                $tabledata .='<td>'.$row['gender'].'</td>    
                <td>'.date('d M, Y', strtotime($row['user_registered'])).'</td>
                <td>'.(($row['pa_pan']!='')?date('d M, Y', strtotime($row['pa_created_on'])):"NA").'</td>
                <td>'.(($row['dsa_pan']!='')?date('d M, Y', strtotime($row['dsa_created_on'])):"NA").'</td>    
                <td>'.(($row['user_status']=='0')?"Active":"Inactive").' <br><a href="greenfieldinfo.php?enrno='.base64_encode($row['user_login']).'" target="_blank" class="btn btn-info btn-mini" data-toggle="tooltip" data-original-title="View Green Field"><i class="icon icon-zoom-in"></i></a></td>    
            </tr>';    
        $i++; }
        $tabledata .='</tbody>
    </table>';
    
    echo $tabledata;
}



function getUserDetails()
{
    $enr_no=$_POST['enrno'];
    $obj=new Common();
    $res=$obj->checkUserExist($enr_no);
    if($res->num_rows>0)
    {
        $row=$res->fetch_assoc();
        
//        $usermeta=array();
//        $resUMD=$obj->getusermetadata($row['ID']);
//        $i=0;
//        while($rowUMD=$resUMD->fetch_array())
//        {
//            $key=$rowUMD['meta_key'];
//            $usermeta[$key]=$rowUMD['meta_value'];
//        }
        //user_activation_status
        
        $resUTC=$obj->checkUserTradingDetails($row['ID']);
        $rowUTC=$resUTC->fetch_array();
        $flagtradecheck=FALSE;
        $trading_amount=0;
        $trading_id='';
        if($rowUTC['trading_account_id']!='') 
        {
            $flagtradecheck=TRUE;
            $trading_id=$rowUTC['trading_account_id'];
            $total_money_withdrawn=$rowUTC['total_money_withdrawn'];
            $total_money_deposited=$rowUTC['total_money_deposited'];
            $trading_amount=$total_money_deposited-$total_money_withdrawn;
        }
        
        $tabledata='<table id="data-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="25%">Name</th>
                                <td width="25%">'.ucfirst($row['first_name']).' '.($row['last_name']).'</td>
                                <th width="25%">Email</th>
                                <td width="25%">'.$row['user_email'].'</td>
                            </tr>
                            <tr>
                                <th width="25%">Referred By</th>
                                <td width="25%">'.$row['student_parent_id'].'</td>
                                <th width="25%">Date of birth</th>
                                <td width="25%">'.date('d M, Y',strtotime($row['dob'])).'</td>
                            </tr>
                            <tr>
                                <th width="25%">Address</th>
                                <td width="75%" colspan="3">'.$row['address1'].'</td>
                                
                            </tr>
                            <tr>
                                <th width="25%">City</th>
                                <td width="25%">'.$row['city'].'</td>
                                <th width="25%">State</th>
                                <td width="25%">'.$row['state'].'</td>
                                
                            </tr>
                            <tr>
                                <th width="25%">Country</th>
                                <td width="25%">'.$row['country'].'</td>
                                <th width="25%">Pin code</th>
                                <td width="75%">'.$row['pincode'].'</td>
                            </tr>';
                        if($flagtradecheck) {
                            $tabledata .='<tr>
                                <th width="25%">Trading Account ID</th>
                                <td width="25%">'.$trading_id.'</td>
                                <th width="25%">Margin Money Deposited</th>
                                <td width="75%">'.$trading_amount.'</td>
                            </tr>';
                        } 
                        $tabledata .='</thead>
                        <tbody>';
        $tabledata .='</tbody></table>';
    }
    echo $tabledata;
}

function saveRequest()
{
    $request=$_POST['request'];
    $userid=$_POST['userid'];
    $obj=new Common();
    
    if($res=$obj->saveUserRequestDetails($userid,$request))
    {
        $_SESSION['SuccessMessage']='Request details has been saved successfully';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while saving request details';
    }
    
}
function closeRequest()
{
    $reqId=$_POST['reqId'];
    $obj=new Common();
    
    if($res=$obj->closeRequestById($reqId))
    {
        //$_SESSION['SuccessMessage']='Request has been closed successfully';
        echo 's^closed^test';
    }
    else 
    {
        //$_SESSION['ErrorMessage']='Error occured while closing request';
        echo 's^notclosed^test';
    }
    
}

function searchNeftList()
{
    $neftmonth=$_POST['neftmonth'];
    $neftyear=$_POST['neftyear'];
    $obj=new Common();
    $resSD=$obj->getSettings();
    $rowSD=$resSD->fetch_assoc();
    
    $tabledata='<table id="data-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">S.No.</th>
                <th width="12%">A/C No. Debit</th>
                <th width="10%">Amount(Rs)</th>
                <th width="14%">Beneficary Name</th>
                <th width="10%">Benf Bank Name</th>
                <th width="15%">Benf Add 1</th>
                <th width="15%">Benf Add 2</th>
                <th width="10%">Benf A/C No.</th>
                <th width="8%">Benf IFSC</th>
                <th width="8%">Purpose1</th>
                <th width="10%">Remitter Name</th>
                <th width="10%">Remitter Add</th>
            </tr>
        </thead>
        <tbody>';
            
            $res=$obj->getAllMemberNEFTLIST($neftmonth, $neftyear);
            $i=1;
            while($row=$res->fetch_assoc())
            {
//                $usermeta=array();
//                $resUMD=$obj->getusermetadata($row['userid']);
//                while($rowUMD=$resUMD->fetch_array())
//                {
//                    $key=$rowUMD['meta_key'];
//                    $usermeta[$key]=$rowUMD['meta_value'];
//                }
                
//                $tdsamount=($row['totalstudentprofit']*$rowSD['tds'])/100;
//                $amount=$row['totalstudentprofit']-$tdsamount;
                
            $tabledata .='<tr>
                <td>'.$i.'</td>
                <td>'.$rowSD['debit_accountno'].'</td>
                <td>'.$row['totalstudentprofit'].'</td>
                <td>'.ucfirst($row['first_name']).' '.($row['last_name']).'</td>
                <td>'.ucfirst($row['bank_name']).'</td> 
                <td>'.ucfirst(strtolower($row['address1'])).'</td> 
                <td>'.ucfirst(strtolower($row['address2'])).'</td> 
                <td>'.$row['account_no'].'</td>     
                <td>'.$row['ifsc_code'].'</td> 
                <td>'.$rowSD['purpose'].'</td>     
                <td>'.$rowSD['remitter_name'].'</td>
                <td>'.$rowSD['remitter_address'].'</td>    
            </tr>';    
        $i++; }
        $tabledata .='</tbody>
    </table>';
    
    echo $tabledata;
}

function setemail()
{
    $neftmonth=$_POST['neftmonth'];
    $neftyear=$_POST['neftyear'];
    
    $monthName = date('F', mktime(0, 0, 0, $neftmonth, 10));
    
    $excelpath= BASEPATH.'admin/excel/';
    
    $filename="NEFT-List-Of-".$monthName."-".$neftyear.".xls";
    
    $sourcePath = $excelpath."NEFT-List-Of-".$monthName."-".$neftyear.".xls";
    
    $filefound=0;
    $AgetHeaders = @get_headers($sourcePath);
    if (preg_match("|200|", $AgetHeaders[0])) {
        $filefound = 1;                         
    }
    $obj=new Common();
    $resSD=$obj->getSettings();
    $rowSD=$resSD->fetch_assoc();
    
    echo 's^'.$filefound.'^'.$rowSD['admin_email'].'^'.$rowSD['bank_email'].'^'.$sourcePath.'^'.$filename.'^test';
    
}
function setstemail()
{
    $stmonth=$_POST['stmonth'];
    $styear=$_POST['styear'];
    
    $monthName = date('F', mktime(0, 0, 0, $neftmonth, 10));
    
    $excelpath= BASEPATH.'admin/excel/';
    
    $filename = "Service-Tax-For-The-Month-".$monthName."-".$styear.".xls";
    
    $sourcePath = $excelpath."Service-Tax-For-The-Month-".$monthName."-".$styear.".xls";
    
    $filefound=0;
    $AgetHeaders = @get_headers($sourcePath);
    if (preg_match("|200|", $AgetHeaders[0])) {
        $filefound = 1;                         
    }
    $obj=new Common();
    $resSD=$obj->getSettings();
    $rowSD=$resSD->fetch_assoc();
    
    echo 's^'.$filefound.'^'.$rowSD['admin_email'].'^'.$rowSD['bank_email'].'^'.$sourcePath.'^'.$filename.'^test';
    
}

function settdsemail()
{
    $stmonth=$_POST['stmonth'];
    $styear=$_POST['styear'];
    
    $monthName = date('F', mktime(0, 0, 0, $stmonth, 10));
    
    $excelpath= BASEPATH.'admin/excel/';
    
    $filename = "TDS-List-Of-".$monthName."-".$styear.".xls";
    
    $sourcePath = $excelpath."TDS-List-Of-".$monthName."-".$styear.".xls";
    
    $filefound=0;
    $AgetHeaders = @get_headers($sourcePath);
    if (preg_match("|200|", $AgetHeaders[0])) {
        $filefound = 1;                         
    }
    $obj=new Common();
    $resSD=$obj->getSettings();
    $rowSD=$resSD->fetch_assoc();
    
    echo 's^'.$filefound.'^'.$rowSD['admin_email'].'^'.$rowSD['bank_email'].'^'.$sourcePath.'^'.$filename.'^test';
    
}

function mailthis(){
    
    $to=$_POST['to'];
    $subject=$_POST['subject'];
    $filepath=$_POST['filename'];
    $from=$_POST['emailfrom'];
    $mess = $_POST['bodymessage']; 
    $filename = $_POST['filenames'];
    
    $monthName = date('F', mktime(0, 0, 0, $neftmonth, 10));
    
    
    $fileatt = $filepath; 
    $fileatt_type = "application/ms-excel"; 
    $fileatt_name = $filename; 
    
    
    
    $headers = "From: $from"; 
    $file = fopen($fileatt, "rb"); 
    $data = fread($file, filesize($fileatt)); 
    fclose($file); 

    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

    // Add the headers for a file attachment 
    $headers .= "\nMIME-Version: 1.0\r\n" . 
              "Content-Type: multipart/mixed;\r\n" . 
              " boundary=\"{$mime_boundary}\""; 

    // Add a multipart boundary above the plain message 
    $tmessage = "This is a multi-part message in MIME format.\r\n\r\n" . 
             "--{$mime_boundary}\r\n" . 
             "Content-Type: text/html; charset=\"iso-8859-1\"\r\n" . 
             "Content-Transfer-Encoding: 7bit\r\n\r\n" . 
             $mess . "\r\n\r\n"; 

    // Base64 encode the file data 
    $data = chunk_split(base64_encode($data)); 

    // Add file attachment to the message 
    $tmessage .= "--{$mime_boundary}\r\n" . 
              "Content-Type: {$fileatt_type};\r\n" . 
              " name=\"{$fileatt_name}\"\r\n" . 
              "Content-Transfer-Encoding: base64\r\n\r\n" . 
              $data . "\r\n\r\n" . 
              "--{$mime_boundary}--\r\n"; 
    
    if(@mail($to, $subject, $tmessage,$headers))
    $_SESSION['SuccessMessage']='Mail has been sent successfully';  
    else
    $_SESSION['ErrorMessage']='Error occured while sending mail';
}

function searchStList()
{
    $stmonth=$_POST['stmonth'];
    $styear=$_POST['styear'];
    $obj=new Common();
//    $resSD=$obj->getSettings();
//    $rowSD=$resSD->fetch_assoc();
    
    $tabledata='<table id="data-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">S.No.</th>
                <th width="12%">ENR No.</th>
                <th width="10%">Name</th>
                <th width="14%">Course</th>
                <th width="10%">Fee</th>
                <th width="15%">Service Tax</th>
            </tr>
        </thead>
        <tbody>';
            
            $res=$obj->getAllMemberSTLIST($stmonth, $styear);
            $i=1;
            $total=0;
            while($row=$res->fetch_assoc())
            {
//                $usermeta=array();
//                $resUMD=$obj->getusermetadata($row['user_id']);
//                while($rowUMD=$resUMD->fetch_array())
//                {
//                    $key=$rowUMD['meta_key'];
//                    $usermeta[$key]=$rowUMD['meta_value'];
//                }
            $tabledata .='<tr>
                <td>'.$i.'</td>
                <td>'.$row['user_login'].'</td>
                <td>'.ucfirst($row['first_name']).' '.($row['last_name']).'</td>
                <td>'.ucfirst($row['post_title']).'</td> 
                <td>'.($row['fee']-$row['service_tax']).'</td>     
                <td>'.$row['service_tax'].'</td> 
            </tr>';
            $total=$total+$row['service_tax'];
        $i++; }
        $tabledata .='</tbody>
    </table><div class="clearfix"></div>
        <div class="pull-right" style="display:none;"><h4>Total service tax for the month of june '.$styear.' is - '.$total.'</h4></div>';
    $monthName = date('F', mktime(0, 0, 0, $stmonth, 10));
    echo 's^'.$tabledata.'^'.$total.'^'.$monthName;
}


function searchTDSList()
{
    $neftmonth=$_POST['stmonth'];
    $neftyear=$_POST['styear'];
    $obj=new Common();
    
    $tabledata='<table id="data-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">S.No.</th>
                <th width="14%">Date</th>
                <th width="14%">Name</th>
                <th width="15%">Address</th>
                <th width="8%">Pancard</th>
                <th width="8%">Amount Paid Gross</th>
                <th width="10%">TDS Percentage</th>
                <th width="10%">TDS Amount</th>
                <th width="10%">Net Payment</th>
            </tr>
        </thead>
        <tbody>';
            
            $res=$obj->getAllMemberTDSLIST($neftmonth, $neftyear);
            $i=1;
            while($row=$res->fetch_assoc())
            {
            $tabledata .='<tr>
                <td>'.$i.'</td>
                <td>'.date('d M, Y', strtotime($row['addedDate'])).'</td>    
                <td>'.ucfirst($row['first_name']).' '.($row['last_name']).'</td>
                <td>'.ucfirst(strtolower($row['address1'])).'</td> 
                <td>'.$row['pan'].'</td> 
                <td>'.$row['studentprofit'].'</td> 
                <td>'.$row['tdsPercentage'].'</td> 
                <td>'.$row['tdsAmount'].'</td>  
                <td>'.$row['netPayment'].'</td>     
            </tr>';    
        $i++; }
        $tabledata .='</tbody>
    </table>';
    
    echo $tabledata;
}

function getUserTSSDetails()
{
    $enrno=$_POST['enr_no'];
    
    $obj=new Common();
    
    $res=$obj->checkUserExist($enrno);
    $row=$res->fetch_assoc();
    
    $user_id=$row['ID'];
    
//    $usermeta2=array();
//    $ress=$obj->getusermetadata($user_id);
//    while($rowss=$ress->fetch_array())
//    {
//        $key=$rowss['meta_key'];
//        $usermeta2[$key]=$rowss['meta_value'];
//    }
        $alldatasrr=array();
        $resTSSD=$obj->getStudenttradeDetails($user_id); 
        $i=0;
        while($rowTSSD=$resTSSD->fetch_assoc())
        {
            $alldatasrr[$i]=array('tdate'=>$rowTSSD['trading_date_activation'],'particulars'=> (($rowTSSD['money_deposited']>0)?"Deposit":"Withdrawn"),'accounttype'=>$rowTSSD['accounttype'],'marginmoney'=> (($rowTSSD['money_deposited']>0)?$rowTSSD['money_deposited']:$rowTSSD['money_withdrawn']),'amountearned'=>'','dues'=>'');
        $i++;
        }

        $resTSSPD=$obj->getStudenttradeProfitDetails($user_id,'tss'); 
        while($rowTSSPD=$resTSSPD->fetch_assoc())
        {
            $alldatasrr[$i]=array('tdate'=>$rowTSSPD['addedDate'],'particulars'=> 'Profit', 'accounttype'=>'','marginmoney'=> '','amountearned'=>$rowTSSPD['studentprofit'],'dues'=>$rowTSSPD['forcicaprofit']);
        $i++;
        }
        function cust_sort($a,$b) {
            return strtolower($a['tdate']) < strtolower($b['tdate']);
        }
        @sort($alldatasrr, 'cust_sort');
        $tabledata ='<table id="data-table" class="table table-bordered table-striped">';
            $tabledata .='<tr><th width="10%">Name</th><td width="15%">'.ucfirst($row['first_name']).' '.($row['last_name']).'</td><th width="10%">Email</th><td width="15%">'.$row['user_email'].'</td></tr>';
        $tabledata .='</table>';
        
        $tabledata .='<table id="data-table" class="table table-bordered table-striped">
            <tr>
                <th width="8%">Date</th>
                <th width="15%">Particulars</th>
                <th width="10%">A/C Type</th>
                <th width="15%">Margin Money</th>
                <th width="10%">Amount Earned</th>
                <th width="15%">Dues</th>
            </tr>';
            $i=1;
            foreach($alldatasrr as $key=>$value)
            {
            
            $tabledata .='<tr>
                <td>'.date('d M, Y', strtotime($alldatasrr[$key]['tdate'])).'</td>
                <td>'.$alldatasrr[$key]['particulars'].'</td>
                <td>'.$alldatasrr[$key]['accounttype'].'</td>
                <td>'.$alldatasrr[$key]['marginmoney'].'</td>
                <td>'.$alldatasrr[$key]['amountearned'].'</td>
                <td>'.$alldatasrr[$key]['dues'].'</td>
            </tr>';
            $i++; }
        $tabledata .='</table>';
        
    echo $tabledata;
}
function changeStatus()
{
    $userId = $_POST['userId'];
    $status = $_POST['status'];
    
    $obj=new User();
    $res=$obj->changeStatusById($userId,$status);
    
    if($res) {
        if($status==1) {
            $_SESSION['SuccessMessage']='User has been disabled successfully';
        } else {
            $_SESSION['SuccessMessage']='User has been enabled successfully';
        }
    }
    else {
       if($status==1) { 
        $_SESSION['ErrorMessage']='Error occured while disabling user'; 
       } else {
        $_SESSION['ErrorMessage']='Error occured while enabling user';   
       }
    }
}
function saveCategory()
{
    $categoryname = $_POST['categoryname'];
    $catId = $_POST['catId'];
    
    $obj=new Common();
    $res=$obj->saveCategory($catId,$categoryname);
    
    if($res) {
            $_SESSION['SuccessMessage']='Category details has been saved successfully';
    }
    else {
        $_SESSION['ErrorMessage']='Error occured while saving category details'; 
    }
}
/* function saveCourse()
{
    $coursecatId = $_POST['coursecatId'];
    $courseId = $_POST['courseId'];
    $coursename = $_POST['coursename'];
    $price = $_POST['price'];
    $pacamount = $_POST['pacamount'];
    
    $obj=new Common();
    $res=$obj->saveCourse($coursecatId,$courseId,$coursename,$price,$pacamount);
    
    if($res) 
    {
        $_SESSION['SuccessMessage']='Course details has been saved successfully';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while saving course details'; 
    }
} */

function saveVideo()
{
    $lessonId = $_POST['lessonId'];
    $vId = $_POST['vId'];
    $videodata = $_POST['videodata'];
    
    $obj=new Common();
    $res=$obj->saveVideoData($lessonId,$vId,$videodata);
    
    if($res) 
    {
        $_SESSION['SuccessMessage']='Video details has been saved successfully';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while saving video details'; 
    }
} 

function deleteVideo()
{
    $lessonId = $_POST['lessonId'];
    $vId = $_POST['vId'];
    
    $obj=new Common();
    $res=$obj->deleteVideoData($vId);
    
    if($res) 
    {
        $_SESSION['SuccessMessage']='Video details has been deleted successfully';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while deleting video details'; 
    }
} 

function editVideo()
{
    $lessonId = $_POST['lessonId'];
    $vId = $_POST['vId'];
    
    $obj=new Common();
    $res=$obj->getVideoDataById($vId);
    $row = $res->fetch_assoc();
    
    $videodata=$row['vediodata'];
    
    echo 's^'.$videodata.'^test';
}

function addCourse()
{
    $catId = $_POST['catId'];
    
    $obj=new Common();
    
    $coursedata ='
            
         <table width="70%" class="table" id="cfrm" style="display:none;">
              <tr>
                <td width="10%" style="border-top:0px;"><b>Course Name</b></td>
                <td width="20%" style="border-top:0px;"><b>Price</b></td>
                <td width="20%" style="border-top:0px;"><b>PASC Amount</b></td>
                <td width="20%" style="border-top:0px; display:none;"><b>Upload Study Document</b></td>
              </tr>
            ';
                $coursedata .='<tr>
                    <td style="border-top:0px;"><input type="hidden" name="coursecatId" id="coursecatId" value="'.$catId.'"><input type="hidden" name="courseId" id="courseId" value=""><input type="text" name="coursename" id="coursename" placeholder="Enter Course Name" readonly></td>
                    <td style="border-top:0px;"><input type="text" name="price" id="price" placeholder="Enter Price"></td>
                    <td style="border-top:0px;"><input type="text" name="pacamount" id="pacamount" placeholder="Enter Pasc Amount"></td>
                    <td style="border-top:0px; display:none;"><input type="file" name="studydoc" id="studydoc" style="width:100%;"><input style="display:none;" type="text" name="pre_studydoc" id="pre_studydoc" style="width:100%;">
					<span style="color: #e20c0c;font-size: 12px;font-weight: 600;">Upload Only Pdf</span>
					</td>
                </tr>';
            $coursedata .='</table>';
      $coursedata .= ShowAlerts();
      
    $query=$obj->getAllCourseByCatId($catId);
    if($query->num_rows>0)
    {
    $coursedata .='
            
         <table id="data-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">Sr.No.</th>
                <th width="20%">Course Name</th>
                <th width="20%">Price</th>
                <th width="20%">PASC Amount</th>
                <th width="20%" style="display:none;" >Study Document</th>
                <th width="15%">Action</th>
              </tr>
            </thead>
            <tbody >';
                $i=1;
                
                while($row = $query->fetch_assoc())
                {
                
                $coursedata .='<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['coursename'].'</td>
                    <td>'.$row['price'].'</td>    
                    <td>'.$row['course_pasc'].'</td> <td style="display:none;" >';
					if($row['study_doc']!='')
					{
						$coursedata .='<a href="'.$row['study_doc'].'" target="_blank">Download File</a>';
					}
                        
                    $coursedata .=' </td><td>
                        <a href="javascript:void(0);" onclick="editCourse(\''.$row['Id'].'\',\''.$row['catId'].'\',\''.$row['coursename'].'\',\''.$row['price'].'\',\''.$row['course_pasc'].'\',\''.$row['study_doc'].'\');" class="btn btn-success btn-mini" data-original-title="Edit"><i class="icon icon-pencil"></i></a> 
                        
                    </td>
                </tr>';
                $i++; }
            $coursedata .='</tbody>
        </table>';
    }
        echo $coursedata;
}


function addVideo()
{
    $lessonId = $_POST['lessonId'];
    
    $obj=new Common();
    
    $coursedata ='
            
         <table width="70%" class="table" id="cfrm">
              <tr>
                <td width="20%" style="border-top:0px;"><b>Video</b></td>
              </tr>
            ';
                $coursedata .='<tr>
                    <td style="border-top:0px;"><input type="hidden" name="lessonId" id="lessonId" value="'.$lessonId.'"><input type="hidden" name="vId" id="vId" value=""><textarea name="videodata" id="videodata" placeholder="Enter Video Data" class="span6" style="resize:none;"></textarea><br><span style="color:#f30909">Note : Please set Width=300 and Height=150</span></td>
                </tr>';
            $coursedata .='</table>';
      $coursedata .= ShowAlerts();
      
    $query=$obj->getAllVideoByLessonId($lessonId);
    if($query->num_rows>0)
    {
    $coursedata .='
            
         <table id="data-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">Sr.No.</th>
                <th width="60%">Video</th>
                <th width="15%">Action</th>
              </tr>
            </thead>
            <tbody >';
                $i=1;
                
                while($row = $query->fetch_assoc())
                {
                
                $coursedata .='<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['vediodata'].'</td>';
                    $coursedata .='<td>
                        <a href="javascript:void(0);" onclick="editVideo(\''.$row['Id'].'\',\''.$row['lessonId'].'\');" class="btn btn-success btn-mini" data-original-title="Edit"><i class="icon icon-pencil"></i></a> 
                        <a href="javascript:void(0);" onclick="deleteVideo(\''.$row['lessonId'].'\',\''.$row['Id'].'\');" class="btn btn-danger btn-mini" data-original-title="Delete"><i class="icon icon-trash icon-white"></i></a>
                    </td>
                </tr>';
                $i++; }
            $coursedata .='</tbody>
        </table>';
    }
        echo $coursedata;
}
function getPayoutDetails()
{
    $enrno=$_POST['enrno'];
    $month=$_POST['month'];
    $year=$_POST['year'];
    
    $obj=new Common();
    $res=$obj->checkUserExist($enrno);
    if($res->num_rows>0)
    {
        $row=$res->fetch_assoc();
        $user_id=$row['ID'];
        
        $tabledata ='<table id="data-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="40%">Description</th>
                <th width="20%">Amount</th>
              </tr>
            </thead>
            <tbody >';
                $i=1;
                $resSD=$obj->getStudentPayoutdata($user_id,$month,$year);
                $total=0;
                $incomeheadarr=array();
                $incomesumarr=array();
                $paincomestr = 'pasc,pac,fi,lb,tss,sb,fb';
                $paincomearr=  explode(',', $paincomestr);
                $j=0;
                while($rows=$resSD->fetch_assoc())
                {
                    $incomeheadarr[$j]=$rows['incomeof'];
                    $incomesum[$j]=$rows['totalpayment'];

                    $j++;
                }
                foreach($paincomearr as $paincome) 
                {
                    $tabledata .='<tr><td style="font-weight:bold;text-transform: uppercase;">'.$paincome.'</td>';
                    if(in_array($paincome,$incomeheadarr)) 
                    {
                        $key=array_search($paincome,$incomeheadarr);
                        $tabledata .='<td>'.$incomesum[$key].'</td>';

                        $total=$total+$incomesum[$key];
                    }
                    else 
                    {
                        $tabledata .='<td>0</td>';
                        $total=$total+0;
                    }
                    $tabledata .='<tr>';
                }
                $tabledata .='<tr><th colspan="1" style="text-align:right; margin-right:10px;">Total : </th><th>'.number_format($total).'</th></tr>';
            $tabledata .='</tbody>
        </table>';
        
        
        
        echo 's^exist^'.$tabledata.'^test';
    }
    else
    {
        echo 's^notexist^test';
    }
    
}

function approveRequest()
{
    $Id=$_POST['Id'];
    $user_id=$_POST['user_id'];
    $courseId=$_POST['courseId'];
    $fee=$_POST['fee'];
    $service_tax=$_POST['service_tax'];
    
    $obj=new Common();
    
    if($res=$obj->approveCourseRequest($Id,$user_id,$courseId,$fee,$service_tax))
    {
        $_SESSION['SuccessMessage']='Course request has been approved successfully';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while approving course request';
    }
    
}

function getTeamData()
{
    $enrno=$_POST['enrno'];
    $chstatus=$_POST['chstatus'];
    $first=0;
    
    
    $enrstr=$_POST['enrstr'];
    
    $obj=new Common();
    $ctr1=0;
    
    if($chstatus==1)
    {
        $enrstr = $enrstr.','.$enrno; 
        $arr=explode(',',$enrstr);
    }
    else 
    {
        $arr=explode(',',$enrstr);
        array_pop($arr);
        $enrstr=implode(',',$arr);
    }
    
    $charrcount=count($arr);
    $teamdata='';
    
    
    
    if(count($arr)>=2)
    {
        $charrcount=$charrcount-2;
        $teamdata .='<a href="javascript:void(0);" class="btn btn-info btn-smaill" onclick="getTeamData(\''.$arr[$charrcount].'\',\''.$ctr1.'\');">Back</a><br><br>';
    }
    
    $teamdata .='<table id="data-table" class="table table-bordered table-striped">
        <tr>
            <th width="8%">S.No.</th>';
			if(isset($_SESSION['adminloggedin']))
			{
				 $teamdata .='<th width="15%">ENR No.</th>';
			}
            
			 
             $teamdata .='<th width="10%">Name</th>
            <th width="15%">Status</th>
            <th width="10%">T.Business</th>
            <th width="15%">T.TSS</th>
            <th width="15%">Total Business</th>
            <th width="15%">Total Pay-out Taken</th>
        </tr>';
        $resTD=$obj->getAllRefferedStudentDetails($enrno);
        $i=1;
        while($rowTD=$resTD->fetch_assoc())
        {

            $resTB=$obj->getAllRefferedStudentDetails($rowTD['user_login']);

            $resUTC=$obj->checkUserTradingDetails($rowTD['user_id']);
            $rowUTC=$resUTC->fetch_array();
            $flagtradecheck=FALSE;
            $trading_amount=0;
            $trading_id='';
            if($rowUTC['trading_account_id']!='') 
            {
                $flagtradecheck=TRUE;
                $trading_id=$rowUTC['trading_account_id'];
                $total_money_withdrawn=$rowUTC['total_money_withdrawn'];
                $total_money_deposited=$rowUTC['total_money_deposited'];
                $trading_amount=$total_money_deposited-$total_money_withdrawn;
            }

            $resTPT=$obj->getTeamStudentPayoutdata($rowTD['user_id']);
            $rowTPT=$resTPT->fetch_assoc();

            $resTTB=$obj->getTeamTotalBusiness($rowTD['user_login']);
            $rowTTB=$resTTB->fetch_assoc();
            $ctr=1;
        $teamdata .='<tr class="'.(($resTB->num_rows==0)?"error":"success").'">
            <td '.(($resTB->num_rows>0)?"onclick='getTeamData(\"".$rowTD['user_login']."\",\"".$ctr."\");' style='cursor:pointer;'":"").'>'.$i.'</td>';
			
			if(isset($_SESSION['adminloggedin']))
			{
				$teamdata .='<td '.(($resTB->num_rows>0)?"onclick='getTeamData(\"".$rowTD['user_login']."\",\"".$ctr."\");' style='cursor:pointer;'":"").'>'.$rowTD['user_login'].'</td>';
			}
			
            $teamdata .='<td '.(($resTB->num_rows>0)?"onclick='getTeamData(\"".$rowTD['user_login']."\",\"".$ctr."\");' style='cursor:pointer;'":"").'>'.ucfirst($rowTD['first_name']).' '.($rowTD['last_name']).'</td>
            <td '.(($resTB->num_rows>0)?"onclick='getTeamData(\"".$rowTD['user_login']."\",\"".$ctr."\");' style='cursor:pointer;'":"").'>'.(($rowTD['user_status']=='0')?"Active":"Inactive").'</td>
            <td '.(($resTB->num_rows>0)?"onclick='getTeamData(\"".$rowTD['user_login']."\",\"".$ctr."\");' style='cursor:pointer;'":"").'>'.number_format((($rowTTB['totalfee']-$rowTTB['totalservice_tax'])),2).'</td>
            <td '.(($resTB->num_rows>0)?"onclick='getTeamData(\"".$rowTD['user_login']."\",\"".$ctr."\");' style='cursor:pointer;'":"").'>'.$trading_amount.'</td>
            <td '.(($resTB->num_rows>0)?"onclick='getTeamData(\"".$rowTD['user_login']."\",\"".$ctr."\");' style='cursor:pointer;'":"").'>'.number_format(((($rowTTB['totalfee']+$trading_amount)-$rowTTB['totalservice_tax'])),2).'</td>
            <td '.(($resTB->num_rows>0)?"onclick='getTeamData(\"".$rowTD['user_login']."\",\"".$ctr."\");' style='cursor:pointer;'":"").'>'.(($rowTPT['totalpayment']>0)?$rowTPT['totalpayment']:0).'</td>
        </tr>';
        $i++; }
$teamdata .='</table><input type="hidden" name="enrstr" id="enrstr" value="'.$enrstr.'">';
    echo $teamdata;
}


function getStudentPayoutdataBySegment()
{
	$month = $_POST['month'];
	$year = $_POST['year'];
	$monthdate = $_POST['monthdate'];
	
	if($monthdate==10)
	{
		$startDate = date($year.'-'.$month.'-01');
		$endDate = date($year.'-'.$month.'-10');
	}
	else if($monthdate==20){
		
		$startDate = date($year.'-'.$month.'-11');
		$endDate = date($year.'-'.$month.'-20');
	}
	else if($monthdate==30){
		
		$startDate = date($year.'-'.$month.'-21');
		
		$endDate= date("Y-m-t", strtotime($startDate));
	}
	
	$obj=new Common();
	
	$res = $obj->checkStudentPayoutdataBySegment($startDate,$endDate);

	if($res->num_rows==0)
	{
		
		
		$result = $obj->getStudentPayoutdataBySegment($startDate,$endDate);
		 
		$tabledata ='<table id="data-table" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th width="">S.No.</th>
					<th width="">ENR No.</th>
					<th width="">Name</th>
					<th width="">Email</th>
					<th width="">Total Payout</th>
					<th width="">TDS %</th>
					<th width="">TDS Amount</th>
					<th width="">Net Payment</th>
					
				  </tr>
				</thead>
				<tbody >';
				
				$i=1;
				$userArray = array();
				$payAmtArray =  array();
				while($row = $result->fetch_assoc())
				{
					$tabledata .='<tr>';
						$tabledata .='<td>'.$i.'</td>';
						$tabledata .='<td>'.$row['user_login'].'</td>';
						$tabledata .='<td>'.$row['first_name'].' '.$row['first_name'].'</td>';
						$tabledata .='<td>'.$row['user_email'].'</td>';
						$tabledata .='<td>'.$row['total_payout'].'</td>';
						$tabledata .='<td>'.$row['tdsPercentage'].'</td>';
						$tabledata .='<td>'.$row['total_TDSAmount'].'</td>';
						$tabledata .='<td>'.$row['TotalNetAmount'].'</td>';
						
					$tabledata .='</tr>';
					
					$userArray[]=$row['userid'];
					$payAmtArray[$row['userid']] = $row['total_payout'];
					
					$i++;
				}
					
					$users = implode(",", $userArray);
					$payoutAmount = implode(",", $payAmtArray);
				
				  $tabledata .='<input type="hidden" name="users" id="users" value="'.$users.'">'; 
				   $tabledata .='<input type="hidden" name="payoutAmount" id="payoutAmount" value="'.$payoutAmount.'">'; 
				   
				   
				$tabledata .='</tbody>
			</table>';
			
			
			echo 'test^notexist^'.$tabledata;
	}
	else{
		
		echo 'test^exist^'.$tabledata;
	}
}

function searchdataquiz()
{
	
	$tabledata='<table id="data-table" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th width="5%">S.No.</th>
                                    <th width="12%">Created Date</th>
                                    <th width="30%">Title</th>
                                    <th width="12%" style="display:none;">Retake Exam</th>
                                    <th width="12%">Passing Grade</th>
                                    <th width="12%">Duration</th>
                                    <th width="12%">Action</th>
                                  
                                  </tr>
                                </thead>
                                <tbody>';
                                    $obj=new Common();
                                    $res=$obj->getallquizlist($_POST['category'],$_POST['course']);
                                    $i=1;
                                    while($row=$res->fetch_assoc())
                                    {
                                    $tabledata .='<tr>
                                        <td>'.$i.'</td>
										<td>'.date('d M, Y',strtotime($row['datetime'])).'</td>  
                                        <td>'.$row['title'].'</td>
                                        <td style="display:none;">'.$row['retake'].'</td>
                                        
                                        <td>'.$row['passing_grade'].'</td>    
                                        <td>'.$row['duration'].'</td>    
                                         <td><a href="addeditquiz.php?id='.base64_encode($row['id']).'" class="btn btn-mini btn-success" data-toggle="tooltip" data-original-title="Edit"><i class="icon icon-pencil"></i></a> &nbsp;&nbsp; <a href="#myModal" class="btn btn-mini btn-info" data-toggle="modal" data-original-title="Add Video" onclick="addVideo(\''.$row['id'].'\');"><i class="icon icon-facetime-video icon-white"></i></a></td>
                                    </tr>';    
                                $i++; }
                                $tabledata .='</tbody>
                            </table>';

                            echo $tabledata;
	
	
}

function getresultDetails()
{
    $studentId=$_POST['studentId'];
    $lessionId=$_POST['lessionId'];
    $student_retake=$_POST['student_retake'];
    
    $obj=new Common();
    
    $tabledata='<table id="data-table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="10%">S.No</th>
            <th width="70%">Question</th>
            <th width="20%">Answer (Right/Wrong)</th>
        </tr>
        ';
        $res=$obj->getStudentresultDetails($studentId,$lessionId,$student_retake);
        $j=1;
        while($row=$res->fetch_assoc())
        {
            $tabledata .='<tr>';
                $tabledata .='<td>'.$j.'</td>';
                $tabledata .='<td>'.$row['question'].'</td>';
                $tabledata .='<td>'.(($row['canswer']=='right')?"<a class='btn btn-mini btn-success' data-toggle='tooltip' data-original-title='Correct'><i class='icon icon-ok icon-white'></i></a>":"<a class='btn btn-mini btn-danger' data-toggle='tooltip' data-original-title='Wrong'><i class='icon icon-close'></i></a>").'</td>';
            $tabledata .='</tr>';
        $j++;
        }
    
        $tabledata .='</thead><tbody>';
        
        
        $tabledata .='</tbody></table>';
        
        
    echo $tabledata;
    
}
function saveQuery()
{
    $message=$_POST['message'];
    $objC=new Common();
    $res=$objC->saveQueryDetails($message,$_SESSION['studentuserid']);
    if($res)
    {
        $_SESSION['SuccessMessage']='Query has been send successfully. Forcica Team will reply soon.';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while sending query';
    }
}

function saveFollowup()
{
    $ticketId=$_POST['ticketId'];
    $ticketNo=$_POST['ticketNo'];
    $comment=$_POST['comment'];
    
    if($_SESSION['membertype']=='admin') { $enterby=$_SESSION['adminuserid']; } else { $enterby=$_SESSION['studentuserid']; }
    $objC=new Common();
    $res=$objC->saveFollowupDetails($ticketId,$ticketNo,$comment,$enterby);
    if($res)
    {
        $_SESSION['SuccessMessage']='Query has been send successfully. Forcica Team will reply soon.';
    }
    else 
    {
        $_SESSION['ErrorMessage']='Error occured while sending query';
    }
}

function getFollowupDetails()
{
    $ticketId = $_POST['ticketId'];
    $ticketNo = $_POST['ticketNo'];
    
    $obj=new Common();
    
    if($_SESSION['membertype']=='admin') { $text='Comment'; } else { $text='Query'; }
    
    $coursedata ='
            
         <table width="70%" class="table" id="cfrm">
              <tr>
                <td width="20%" style="border-top:0px;"><b>'.$text.'</b></td>
              </tr>
            ';
                $coursedata .='<tr>
                    <td style="border-top:0px;"><input type="hidden" name="ticketId" id="ticketId" value="'.$ticketId.'"><input type="hidden" name="ticketNo" id="ticketNo" value="'.$ticketNo.'"><textarea name="comment" id="comment" placeholder="Enter '.$text.'" class="span6" style="resize:none;"></textarea></td>
                </tr>';
            $coursedata .='</table>';
      $coursedata .= ShowAlerts();
      
    $query=$obj->getAllFollowupByTicketId($ticketId);
    if($query->num_rows>0)
    {
    $coursedata .='
            
         <table id="data-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">Sr.No.</th>
                <th width="15%">Follow Date</th>
                <th width="10%">Enter By</th>
                <th width="60%">Comment</th>
              </tr>
            </thead>
            <tbody>';
                $i=1;
                if($_SESSION['membertype']!='admin') 
                { 
                    //$enterby=$_SESSION['adminuserid']; } else { $enterby=$_SESSION['studentuserid']; }
                    while($row = $query->fetch_assoc())
                    {

                    $coursedata .='<tr>
                        <td>'.$i.'</td>
                        <td>'.date('d-m-Y h:i:s',strtotime($row['generate_date'])).'</td><td>'.(($row['enterby']==$_SESSION['studentuserid'])?"Self":"Forcica").'</td>';
                        $coursedata .='<td>'.$row['query'].'</td>
                    </tr>';
                    $i++; }
                }
                else 
                {
                    while($row = $query->fetch_assoc())
                    {

                    $coursedata .='<tr>
                        <td>'.$i.'</td>
                        <td>'.date('d-m-Y h:i:s',strtotime($row['generate_date'])).'</td><td>'.(($row['enterby']==$_SESSION['adminuserid'])?"Forcica":"Student").'</td>';
                        $coursedata .='<td>'.$row['query'].'</td>
                    </tr>';
                    $i++; }
                }
            $coursedata .='</tbody>
        </table>';
    }
        echo $coursedata;
}
?>