<?php
 ini_set('display_errors', 1);
include_once('controls/config.php');

$mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
$sql = "SELECT * FROM `forc_crm_student_income`";
$query = $mysqli->query($sql);

while($row = $query->fetch_assoc())
{
	$month = $row['profitmonth'];
	
	$monthfDate = date('Y-'.$month.'-01');
	
	if($row['monthdate']==10)
	{
		$addedDate= date('Y-'.$month.'-10');
		
	}
	else if($row['monthdate']==20)
	{
		
		$addedDate= date('Y-'.$month.'-20');
	}
	else if($row['monthdate']==30)
	{
		$addedDate= date("Y-m-t", strtotime($monthfDate));
	}
	else
	{
		$addedDate= date("Y-m-t", strtotime($monthfDate));
	}
	
	$sql2 = "UPDATE `forc_crm_student_income` SET addedDate='".$addedDate."' where Id='".$row['Id']."'";
	$query2 = $mysqli->query($sql2); 
	
}


?>