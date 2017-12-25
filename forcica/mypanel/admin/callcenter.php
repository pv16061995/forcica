<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsCommon.php');

if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}
$obj=new Common();
$flag=FALSE;
$error=0;
if(isset($_POST['submit']))
{
    $enrno = $_POST['enrno'];
    
    $res=$obj->checkUserExist($enrno);
    
    if($res->num_rows>0)
    {
        $flag=TRUE;
        $row=$res->fetch_assoc();

        $user_id=$row['ID'];

//        $usermeta2=array();
//        $ress=$obj->getusermetadata($user_id);
//        while($rowss=$ress->fetch_array())
//        {
//            $key=$rowss['meta_key'];
//            $usermeta2[$key]=$rowss['meta_value'];
//        }
    }
    else 
    {
        $error=1;
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Forcica School Of Trading</title>
    <meta name="author" content="" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="description" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/html5-trunk.js"></script>
    <link href="<?php echo BASEPATH; ?>bootstrap/icomoon/style.css" rel="stylesheet" />
    
    <!-- NVD graphs css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/nvd-charts.css" rel="stylesheet" />

    <!-- Bootstrap css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/main.css" rel="stylesheet" />
    <link rel="icon" href="<?php echo BASEPATH;; ?>bootstrap/images/admin-logo.png" type="image/x-icon">
    <!-- fullcalendar css -->
    
    </head>
  <body>
    <?php include_once('include/header.php'); ?>
    <div class="container-fluid">
      <?php // include_once('include/left-navigation.php'); ?>
    <div class="dashboard-wrapper no-margin">
        <?php include_once('include/menu.php'); ?>
        <div class="main-container">
          <div class="navbar hidden-desktop">
            <div class="navbar-inner">
              <div class="container">
                <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
<!--                <div class="nav-collapse collapse navbar-responsive-collapse">
                  <ul class="nav">
                    <li>
                      <a href="index.html">Dashboard</a>
                    </li>
                    
                    <li>
                      <a href="form.html">form</a>
                    </li>
                    <li>
                      <a href="list.html">list</a>
                    </li>
                    
                  </ul>
                </div>-->
              </div>
            </div>
          </div>
          <div class="page-header">
            <div class="pull-left">
                <h2>Call Center</h2>
            </div>
            <div class="pull-right">
              <ul class="stats">
<!--                <li class="color-first hidden-phone">
                  <span class="fs1" aria-hidden="true" data-icon="&#xe037;"></span>
                  <div class="details">
                    <span class="big">$879,89</span>
                    <span>Balance</span>
                  </div>
                </li>-->
                <li class="color-second">
                  <span class="fs1" aria-hidden="true" data-icon="&#xe052;"></span>
                  <div class="details" id="date-time">
                    <span>Date </span>
                    <span>Day, Time</span>
                  </div>
                </li>
              </ul>
            </div>
            <div class="clearfix"></div>
            <?php ShowAlerts(); ?>
          </div>
          
          <div class="row-fluid">
            <div class="span12">
              <div class="widget no-margin">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon=""></span> Search By ENR No.
                  </div>
                </div>
                <div class="widget-body">
                    <div class="span12">
                        <form name="categoryfrm" id="categoryfrm" method="post" action="">
                            <div class="row" style="margin-left:0;">
                                <div class="span3">
                                    <div class="controls">
                                        <label class="control-label">ENR No.</label>
                                        <div class="control-group">
                                            <input type="text" name="enrno" id="enrno" class="span12" placeholder="Enter ENR No." value="<?php if(isset($_POST['submit'])) { echo $_POST['enrno']; } ?>">
                                            <?php if($error==1) { ?>
                                            <br>
                                            <span class="form-errors">Please enter correct ENR No.</span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="controls">
                                        <label class="control-label">&nbsp;</label>
                                        <div class="control-group">
                                            <input type="submit" name="submit" id="submit" class="btn btn-small btn-success" value="Go" onclick="return validate();" style="margin-bottom: 10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php if($flag) { ?>
                    
                        <table id="data-table" class="table table-bordered table-striped">
                                <tr>
                                    <th width="15%" style="background-color: #3985b5; color:#fff;">ENR NO</th>
                                    <th width="20%" style="background-color: #3985b5; color:#fff;">Name</th>
                                    <th width="15%" style="background-color: #3985b5; color:#fff;">DOB</th>
                                    <th width="30%" style="background-color: #3985b5; color:#fff;">Address</th>
                                    <th width="20%" style="background-color: #3985b5; color:#fff;">Email</th>
                                </tr>
                                <tr>
                                    <td width="15%"><?php echo $enrno; ?></td>
                                    <td width="20%"><?php echo ucfirst($row['first_name']).' '.($row['last_name']); ?></td>
                                    <td width="15%"><?php echo date('d M, Y',strtotime($row['dob'])); ?></td>
                                    <td width="30%"><?php echo $row['address1'].', '.$row['city'].', '.$row['state'].', '.$row['country'].' - '.$row['pincode']; ?></td>
                                    <td width="20%"><?php echo $row['user_email']; ?></td>
                                </tr>
                                <tr>
                                    <th width="15%" style="background-color: #3985b5; color:#fff;">REF By</th>
                                    <th width="20%" style="background-color: #3985b5; color:#fff;">Course</th>
                                    <th width="15%" style="background-color: #3985b5; color:#fff;">PAN</th>
                                    <th width="30%" style="background-color: #3985b5; color:#fff;">Gender</th>
                                    <th width="20%" style="background-color: #3985b5; color:#fff;">Date of Admission</th>
                                </tr>
                                <tr>
                                    <td width="15%"><?php echo $row['student_parent_id']; ?></td>
                                    <td width="20%"><?php echo $row['post_title'].' ('.$row['categoryname'].')'; ?></td>
                                    <?php 
                                    $panno='';
                                    if($row['pa_pan']!='') { $panno= $row['pa_pan']; } else if($row['dsa_pan']!='') { $panno= $row['dsa_pan']; }
                                    ?>
                                    <td width="15%"><?php echo $panno; ?></td>
                                    <td width="30%"><?php echo $row['gender']; ?></td>
                                    <td width="20%"><?php echo date('d M, Y', strtotime($row['user_registered'])); ?></td>
                                </tr>
                                <tr>
                                    <th width="15%" style="background-color: #3985b5; color:#fff;">Date Of PA</th>
                                    <th width="20%" style="background-color: #3985b5; color:#fff;">Date Of DSA</th>
                                    <th width="15%" style="background-color: #3985b5; color:#fff;">Status</th>
                                    <th width="15%" style="background-color: #3985b5; color:#fff;" colspan="2">&nbsp;</th>
                                </tr>
                                <tr>
                                    <td width="15%"><?php echo (($row['pa_pan']!='')?date('d M, Y', strtotime($row['pa_created_on'])):"NA"); ?></td>
                                    <td width="20%"><?php echo (($row['dsa_pan']!='')?date('d M, Y', strtotime($row['dsa_created_on'])):"NA"); ?></td>
                                    <td width="15%"><?php echo (($row['user_status']=='0')?"Active":"Inactive"); ?></td>
                                    <td width="15%" colspan="2">&nbsp;</td>
                                </tr>
                        </table>
                    
                    <div id="tab" class="btn-group" data-toggle="buttons-radio">
                        <a href="#bankdetails" class="btn btn-success active" data-toggle="tab" data-original-title="">Bank Details</a>
                        <a href="#feedetails" class="btn btn-success" data-toggle="tab" data-original-title="">Fee Details</a>
                        <a href="#uploads" class="btn btn-success" data-toggle="tab" data-original-title="">Uploads</a>
                        <a href="#tssdetails" class="btn btn-success" data-toggle="tab" data-original-title="">TSS Details</a>
                        <a href="#passbookdetails" class="btn btn-success" data-toggle="tab" data-original-title="">Passbook Details</a>
                        <a href="#inboxdetails" class="btn btn-success" data-toggle="tab" data-original-title="">Inbox Details</a>
                        <a href="#teamdetails" class="btn btn-success" data-toggle="tab" data-original-title="">Team Details</a>
                        <a href="#payoutdetails" class="btn btn-success" data-toggle="tab" data-original-title="">Payout Details</a>
                        <a href="#requestdetails" class="btn btn-success" data-toggle="tab" data-original-title="">Request Details</a>
                    </div>
                    <div class="tab-content no-margin" style="margin-bottom:50px;">
                        <div class="tab-pane active" id="bankdetails">
                            <?php
                            $resBD=$obj->getStudentPADetails($user_id); 
                            $rowBD=$resBD->fetch_assoc();
                            ?>
                            <table id="data-table" class="table table-bordered table-striped">
                                <tr>
                                    <th width="25%">Account No</th>
                                    <th width="25%">Bank Name</th>
                                    <th width="25%">IFSC Code</th>
                                    <th width="25%">Branch City</th>
                                </tr>
                                <tr>
                                    <td width="25%"><?php echo $rowBD['account_no']; ?></td>
                                    <td width="25%"><?php echo ucwords($rowBD['bank_name']); ?></td>
                                    <td width="25%"><?php echo $rowBD['ifsc_code']; ?></td>
                                    <td width="25%"><?php echo $rowBD['bank_code']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane" id="feedetails">
                            <?php
                            $resFD=$obj->getStudentFEEDetails($user_id); 
                            ?>
                            <table id="data-table" class="table table-bordered table-striped">
                                <tr>
                                    <th width="8%">S.No.</th>
                                    <th width="15%">Course</th>
                                    <th width="10%">Mode</th>
                                    <th width="15%">Amount</th>
                                    <th width="10%">Date</th>
                                    <th width="15%">REF/UTR/CHQ No</th>
                                    <th width="15%">From Bank</th>
                                    <th width="20%">Remarks</th>
                                </tr>
                                <?php
                                $i=1;
                                while($rowFD=$resFD->fetch_assoc())
                                {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo ucfirst($rowFD['post_title']).' ('.$row['categoryname'].').'; ?></td>
                                    <td><?php echo ucfirst($rowFD['offline_paymet']); ?></td>
                                    <td><?php echo ($rowFD['fee']-$rowFD['service_tax']); ?></td>
                                    <td><?php echo date('d M, Y', strtotime($rowFD['created_on'])); ?></td>
                                    <?php if($rowFD['offline_paymet']=='neft') { ?>
                                    <td><?php echo $rowFD['transaction_reference_no']; ?></td>
                                    <?php } else { ?>
                                    <td><?php echo $rowFD['cheque_no']; ?></td>
                                    <?php } ?>
                                    <td><?php echo $rowFD['bank_name']; ?></td>
                                    <td></td>
                                </tr>
                                <?php $i++; } ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="uploads">
                            <table id="data-table" class="table table-bordered table-striped">
                                <?php
//                                $i=1;
//                                while($rowUD=$resUD->fetch_assoc())
//                                {
                                ?>
                                <tr>
                                    <td width="25%">Recent Uploaded Photo</td>
                                    <td width="75%"><a href="../userdocs/<?php echo $user_id; ?>/<?php echo $row['profile_image']; ?>" target="_blank"><?php echo $row['profile_image']; ?></a></td>
                                </tr>
                                <tr>
                                    <td width="25%">Uploaded Education Certificate</td>
                                    <td width="75%"><a href="../userdocs/<?php echo $user_id; ?>/<?php echo $row['education_certificate']; ?>" target="_blank"><?php echo $row['education_certificate']; ?></a></td>
                                </tr>
                                <tr>
                                    <td width="25%">Uploaded address proof</td>
                                    <td width="75%"><a href="../userdocs/<?php echo $user_id; ?>/<?php echo $row['address_proof']; ?>" target="_blank"><?php echo $row['address_proof']; ?></a></td>
                                </tr>
                                <?php //$i++; } ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="tssdetails">
                            <?php
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
                            ?>
                            <table id="data-table" class="table table-bordered table-striped">
                                <tr>
                                    <th width="8%">Date</th>
                                    <th width="15%">Particulars</th>
                                    <th width="10%">A/C Type</th>
                                    <th width="15%">Margin Money</th>
                                    <th width="10%">Amount Earned</th>
                                    <th width="15%">Dues</th>
                                </tr>
                                <?php
                                $i=1;
                                foreach($alldatasrr as $key=>$value)
                                {
                                ?>
                                <tr>
                                    <td><?php echo date('d M, Y', strtotime($alldatasrr[$key]['tdate'])); ?></td>
                                    <td><?php echo $alldatasrr[$key]['particulars']; ?></td>
                                    <td><?php echo $alldatasrr[$key]['accounttype']; ?></td>
                                    <td><?php echo $alldatasrr[$key]['marginmoney']; ?></td>
                                    <td><?php echo $alldatasrr[$key]['amountearned']; ?></td>
                                    <td><?php echo $alldatasrr[$key]['dues']; ?></td>
                                </tr>
                                <?php $i++; } ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="passbookdetails">
                            
                        </div>
                        <div class="tab-pane" id="inboxdetails">
                            
                        </div>
                        <div class="tab-pane" id="teamdetails">
                            <table id="data-table" class="table table-bordered table-striped">
                                <tr>
                                    <th width="8%">S.No.</th>
                                    <th width="15%">ENR No.</th>
                                    <th width="10%">Name</th>
                                    <th width="15%">Status</th>
                                    <th width="10%">T.Business</th>
                                    <th width="15%">T.TSS</th>
                                    <th width="15%">Total Business</th>
                                    <th width="15%">Total Pay-out Taken</th>
                                </tr>
                                <?php
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
                                ?>
                                <tr class="<?php if($resTB->num_rows==0) { ?>error<?php } else { ?>success<?php } ?>">
                                    <td <?php if($resTB->num_rows>0) { ?>onclick="getTeamData('<?php echo $rowTD['user_login']; ?>','1');" style="cursor:pointer;"<?php } ?>><?php echo $i; ?></td>
                                    <td <?php if($resTB->num_rows>0) { ?>onclick="getTeamData('<?php echo $rowTD['user_login']; ?>','1');"style="cursor:pointer;"<?php } ?>><?php echo $rowTD['user_login']; ?></td>
                                    <td <?php if($resTB->num_rows>0) { ?>onclick="getTeamData('<?php echo $rowTD['user_login']; ?>',,'1');"style="cursor:pointer;"<?php } ?>><?php echo ucfirst($rowTD['first_name']).' '.($rowTD['last_name']); ?></td>
                                    <td <?php if($resTB->num_rows>0) { ?>onclick="getTeamData('<?php echo $rowTD['user_login']; ?>','1');"style="cursor:pointer;"<?php } ?>><?php echo (($rowTD['user_status']=='0')?"Active":"Inactive"); ?></td>
                                    <td <?php if($resTB->num_rows>0) { ?>onclick="getTeamData('<?php echo $rowTD['user_login']; ?>','1');"style="cursor:pointer;"<?php } ?>><?php echo number_format((($rowTTB['totalfee']-$rowTTB['totalservice_tax'])),2); ?></td>
                                    <td <?php if($resTB->num_rows>0) { ?>onclick="getTeamData('<?php echo $rowTD['user_login']; ?>','1');"style="cursor:pointer;"<?php } ?>><?php echo $trading_amount; ?></td>
                                    <td <?php if($resTB->num_rows>0) { ?>onclick="getTeamData('<?php echo $rowTD['user_login']; ?>','1');"style="cursor:pointer;"<?php } ?>><?php echo number_format(((($rowTTB['totalfee']+$trading_amount)-$rowTTB['totalservice_tax'])),2); ?></td>
                                    <td <?php if($resTB->num_rows>0) { ?>onclick="getTeamData('<?php echo $rowTD['user_login']; ?>','1');"style="cursor:pointer;"<?php } ?>><?php echo (($rowTPT['totalpayment']>0)?$rowTPT['totalpayment']:0); ?></td>
                                </tr>
                                <?php $i++; } ?>
                                
                            </table><input type="hidden" name="enrstr" id="enrstr" value="<?php echo $enrno; ?>">
                        </div>
                        <div class="tab-pane" id="payoutdetails">
                            <?php
                            
                            $tabledata ='<table id="data-table" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th width="5%">Sr.No.</th>
                                <th width="10%">Month-Year</th>
                                <th width="8%">MODE</th>
                                <th width="8%">DASC</th>
                                <th width="8%">PASC</th>
                                <th width="8%">PAC</th>
                                <th width="8%">FI</th>
                                <th width="8%">LB</th>
                                <th width="8%">TSS</th>
                                <th width="8%">SB</th>
                                <th width="8%">FB</th>
                                <th width="15%">TOTAL</th>
                              </tr>
                            </thead>
                            <tbody >';
                                $i=1;
                                $resSD=$obj->getStudentPayoutdata($user_id,'','');
                                
                                while($rows = $resSD->fetch_assoc())
                                {
                                    $monthName = date('F', mktime(0, 0, 0, $rows['profitmonth'], 10));
                                $tabledata .='<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$monthName.'-'.$rows['profityear'].'</td>';
                                    $tabledata .='<td></td>';
                                    $tabledata .='<td></td>';
                                    
                                    $paincomestr = 'pasc,pac,fi,lb,tss,sb';
                                    $paincomearr=  explode(',', $paincomestr);
                                    
                                    $resSDD=$obj->getStudentPayoutdata($user_id,$rows['profitmonth'],$rows['profityear']);
                                    
                                    $incomeheadarr=array();
                                    $incomesumarr=array();
                                    
                                    $j=0;
                                    $total=0;
                                    while($rowSDD=$resSDD->fetch_assoc())
                                    {
                                        $incomeheadarr[$j]=$rowSDD['incomeof'];
                                        $incomesum[$j]=$rowSDD['totalpayment'];
                                    
                                        $j++;
                                    }
                                    foreach($paincomearr as $paincome) 
                                    {
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
                                    }
                                    $tabledata .='<td></td>';
                                    $tabledata .='<td>'.number_format($total).'</td>    
                                </tr>';
                                    
                                $i++; }
                            $tabledata .='</tbody>
                        </table>';
                            echo $tabledata;
                            ?>
                        </div>
                        <div class="tab-pane" id="requestdetails">
                            <div class="span12">
                                <div class="span6">
                                    <h4>Take Request</h4>
                                    <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="">
                                        <input type="hidden" name="userid" id="userid" value="<?php echo $user_id; ?>">
                                        <div class="control-group span12 left-0">
                                            <label class="control-label" for="email1">Enter Request *</label>
                                            <div class="controls">
                                                <textarea name="request" id="request" placeholder="Enter Request" class="span12" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions no-margin">
                                            <span class="form-errors" id="onetimeerror"></span>
                                            <button type="button" class="btn btn-info pull-right" onclick="saveRequest()">Submit</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="span6">
                                    <?php $resRD=$obj->getStudentRequestDetails($user_id); if($resRD->num_rows>0) { ?>
                                    <h4>Previous Request Status</h4>
                                    <table id="data-table" class="table table-bordered table-striped">
                                        <tr>
                                            <th width="8%">S.No.</th>
                                            <th width="10%">Date</th>
                                            <th width="10%">Req. No.</th>
                                            <th width="10%">Request</th>
                                            <th width="10%">Status</th>
                                        </tr>
                                        <?php $i=1; while($rowRD=$resRD->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo date('d M, Y', strtotime($rowRD['requestDate'])); ?></td>
                                            <td><?php echo $rowRD['requestNo']; ?></td>
                                            <td><?php echo $rowRD['requestDetails']; ?></td>
                                            <td id="clstb<?php echo $rowRD['Id']; ?>">
                                                <?php echo (($rowRD['status']==0)?"Open":"Closed"); ?>
                                                <?php if($rowRD['status']==0) { ?>
                                                <a href="javascript:void(0);" onclick="closeRequest('<?php echo $rowRD['Id']; ?>');" class="btn btn-success btn-mini pull-right" data-original-title="Close Request"><i class="icon icon-close"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- dashboard-container -->
    </div><!-- container-fluid -->


    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/moment.js"></script>

    <script src="<?php echo BASEPATH; ?>js/jquery.validate.min.js"></script>
    
    <!-- Google Visualization JS -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- Easy Pie Chart JS -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/pie-charts/jquery.easy-pie-chart.js"></script>

    <!-- Tiny scrollbar js -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/tiny-scrollbar.js"></script>
    
    <!-- Sparkline charts -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/sparkline.js"></script>

    <!-- Datatables JS -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.dataTables.js"></script>

    <script src="<?php echo BASEPATH; ?>bootstrap/js/theming.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom.js"></script>
    
    <link href='<?php echo BASEPATH; ?>bootstrap/css/jquery-ui.css' rel='stylesheet' />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-ui-date.js"></script>
    
    
<script>
    $(document).ready(function() {
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',maxDate:0,});
    });
    
    function validate()
    {
        var enrno=$("#enrno").val();
        if(enrno=='')
        {
            alert('Please enter ENR No. first');
            return false;
        }
        else 
        {
            return true;
        }
    }
    function saveRequest()
    {
        var request=$("#request").val();
        var userid=$("#userid").val();
        if(request=='')
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html("Please enter request.");
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
        }
        else 
        {
            $.post("../ajax/ajax-common.php",{
               q:'saveRequest', 
               request:request,
               userid:userid,
            },function(data){
                window.location.reload();
            });
        }
    }
    function closeRequest(reqId)
    {
        var r=confirm('Are you sure you want to close this request ?');
        if(r)
        {
            $.post("../ajax/ajax-common.php",{
               q:'closeRequest', 
               reqId:reqId,
            },function(data){
                var ret=data.split('^');
                if(ret[1]=='closed') {
                    $("#clstb"+reqId).html('Closed');
                }
                else {
                    alert('Error occured while closing request');
                }
            });
        }
    }
    function getTeamData(enrno,chstatus)
    {
        var enrstr=$("#enrstr").val();
        $("#teamdetails").html('<img src="../img/ajax-loader1.gif">');
        $.post("../ajax/ajax-common.php",{
               q:'getTeamData', 
               enrno:enrno,
               chstatus:chstatus,
               enrstr:enrstr,
            },function(data){
             $("#teamdetails").html(data);
        });
    }
</script>
  </body>
</html>