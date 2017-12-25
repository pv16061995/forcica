<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");
if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}

$neftmonth=$_REQUEST['neftmonth'];
$monthName = date('F', mktime(0, 0, 0, $neftmonth, 10));


$neftyear=$_REQUEST['neftyear'];
    
$filename ="NEFT-List-Of-".$monthName."-".$neftyear.".xls";

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

$file_location = "excel/".$filename;

file_put_contents($file_location,$tabledata); 

header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $tabledata;
?>