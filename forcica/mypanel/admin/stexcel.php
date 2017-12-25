<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");
if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}

$stmonth=$_REQUEST['stmonth'];
$monthName = date('F', mktime(0, 0, 0, $stmonth, 10));


$styear=$_REQUEST['styear'];
    
$filename ="Service-Tax-For-The-Month-".$monthName."-".$styear.".xlsx";

$obj=new Common();
    $tabledata='<table id="data-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">S.No.</th>
                <th width="12%">Date</th>
                <th width="10%">Fee</th>
                <th width="15%">Service Tax</th>
            </tr>
        </thead>
        <tbody>';
            
            $res=$obj->getAllMemberSTLIST($stmonth, $styear);
            $i=1;
            $totalservicetax=0;
            while($row=$res->fetch_assoc())
            {
                $tabledata .='<tr>
                    <td>'.$i.'</td>
                    <td>'.date('d M, Y',strtotime($row['created_on'])).'</td>     
                    <td>'.($row['fee']-$row['service_tax']).'</td> 
                    <td>'.$row['service_tax'].'</td> 
                </tr>'; 
            $totalservicetax=$totalservicetax+$row['service_tax'];
        $i++; }
        $tabledata .='<tr><td colspan="3" align="right"><b>Total service tax for the month of '.$monthName.' '.$styear.' is - </b></td><td>'.$totalservicetax.'</td></tr>';
        $tabledata .='</tbody>
    </table>';

$file_location = "excel/".$filename;

file_put_contents($file_location,$tabledata); 

header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $tabledata;
?>