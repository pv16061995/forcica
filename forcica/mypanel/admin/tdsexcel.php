<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");
if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}

$neftmonth=$_REQUEST['stmonth'];
$monthName = date('F', mktime(0, 0, 0, $neftmonth, 10));


$neftyear=$_REQUEST['styear'];
    
$filename ="TDS-List-Of-".$monthName."-".$neftyear.".xls";


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

$file_location = "excel/".$filename;

file_put_contents($file_location,$tabledata); 

header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $tabledata;
?>