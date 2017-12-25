<?php
include_once("../controls/config.php");
include_once("../controls/clsMember.php");
include_once("../controls/clsCommon.php");

if($_POST['q']=='getStatListById')
getStatListById();
else if($_POST['q']=='checkPincode')
checkPincode();
else if($_POST['q']=='saveCourseRequest')
saveCourseRequest();
else if($_POST['q']=='getCousebycatId')
getCousebycatId();
else if($_POST['q']=='checkUserEmail')
checkUserEmail();
else if($_POST['q']=='getStatListById')
getStatListByIds();
else if($_POST['q']=='getCousebycatIdonload')
getCousebycatIdonload();
else if($_POST['q']=='checkRefMobileNo')
checkRefMobileNo();



function getCousebycatIdonload()
{
    $coursecatgory  = $_POST['coursecatgory'];
    $course=$_POST['course'];
    
    $courselist ='<option value="">Select the Level</option>';
    $obj=new Common();
    $ress=$obj->getAllCourseByCatId($coursecatgory);
    while($res=$ress->fetch_assoc()) 
    {
        $total = (int) $res['price'];
        $postedcourse = $total.'^'.$res['Id'].'^'.$res['coursename'];
        $selected1 = '';

        if($res['Id']==$course){ $sel='selected';}else{ $sel='';}

        $courselist .='<option value="'.$total.'^'.$res['Id'].'^'.$res['coursename'].'"  '.$sel.'>'.$res['coursename'].'</option>';
    }
    echo $courselist;
}

function getStatListById()
{
    $countryId=$_POST['countryId'];
    $statname=$_POST['statname'];
    
    $objM=new Member();
    $resS=$objM->getStateByCountryId($countryId);
    $data ='';
    
    $data .='<option value="">Select State</option>';
    while($rowS=$resS->fetch_assoc())
    {
        $data .='<option value="'.$rowS['name'].'" '.(($statname!='')?(($rowS['name']==$statname)?"selected":""):"").'>'.$rowS['name'].'</option>';
    }
    
    echo $data;
}
function checkPincode() 
{
    $pincode=$_POST['pincode'];
    $objM=new member();
    $resP=$objM->checkDSAPincode($pincode);
    if($resP->num_rows > 0) {
        echo 's^exist^test';
    } else {
        echo 's^notexist^test';
    }
}
function getCousebycatId()
{
    $coursecatgory  = $_POST['coursecatgory'];
    
    $courselist ='<option value="">Select the Level</option>';
    $obj=new Common();
    $ress=$obj->getAllCourseByCatId($coursecatgory);
    while($res=$ress->fetch_assoc()) 
    {
        $total = (int) $res['price'];
        $postedcourse = $total.'^'.$res['Id'].'^'.$res['coursename'];
        $selected1 = '';

        $courselist .='<option value="'.$total.'^'.$res['Id'].'^'.$res['coursename'].'">'.$res['coursename'].'</option>';
    }
    echo $courselist;
}

function checkUserEmail()
{
    $userEmail  = $_POST['email'];
    $phone  = $_POST['phone'];
    
    $objM=new Member();
    
    $query=$objM->checkUser('user_email',$userEmail);
    $query2=$objM->checkUser('user_nicename',$phone);
    
    echo 'test^'.$query->num_rows.'^'.$query2->num_rows.'';
}

function getStatListByIds()
{
    $countrid  = $_POST['countryId'];
    $objM=new Member();
    $resS=$objM->getStateByCountryId($countrid);
    $statelist ='';
    
    $statelist .='<option value="">Select State</option>';
    while($rowS=$resS->fetch_assoc())
    {
        $statelist .='<option value="'.$rowS['name'].'">'.$rowS['name'].'</option>';
    }
    echo $statelist;
}


function checkRefMobileNo()
{
  $refno = $_POST['refno'];
  
  $objM=new Member();
  
 $query =  $objM->checkUser('user_login', $refno);
  if($query->num_rows>0)
  {
	 echo"test^1";  
  }
  else
  {
	  echo"test^notexist";  
  }

  
}
?>