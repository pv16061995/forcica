<?php
include_once("../controls/config.php");
include_once("../controls/clsCommon.php");
if(isset($_SESSION['adminloggedin'])) {
    
} else {
    header('location: ../index.php');
}

$fromdate=$_REQUEST['fromdate'];
$todate=$_REQUEST['todate'];
    
$filename ="Student-List-From-".date('d-m-Y', strtotime($fromdate))."-To-".date('d-m-Y', strtotime($todate)).".xls";

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
//                $row=array();
//                $resUMD=$obj->getusermetadata($row['ID']);
//                while($rowUMD=$resUMD->fetch_array())
//                {
//                    $key=$rowUMD['meta_key'];
//                    $row[$key]=$rowUMD['meta_value'];
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
                <td>'.(($row['user_status']=='0')?"Active":"Inactive").'</td>    
            </tr>';    
        $i++; }
        $tabledata .='</tbody>
    </table>';

header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $tabledata;
?>