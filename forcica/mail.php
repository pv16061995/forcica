<?php 
include 'mypanel/controls/config.php';
include 'mypanel/controls/clsCommon.php';

if($_POST['q']=='contactform')
{
	contactform();
}else if($_POST['q']=='getaddmissionform')
{
	getaddmissionform();
}


//////////////////////   Contact Mail //////////////////////

function contactform()
{
	$obj=New Common();
	$ADMINMAIL=$obj->getAdminDetailEmail();

	$to=$_POST['email'];
	$from=$ADMINMAIL;



	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$subject_message=$_POST['subject'];
	$mess=$_POST['message'];

	$enquiry_for='1';

	$save_form=$obj->savecontactform($name,$email,$phone,$subject_message,$mess,$enquiry_for);



	///////////////////////////  Client Mail ///////////////////////

	$subject='Contact - Forcica';

	
		   
    $message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
	$message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
	$message .='<b>Dear '.$name.',</b><br><br>';
	$message .="Welcome and thank you for contacting at Forcica. We appreciate you getting in touch.<br><br>This is an automatic response to your email, we shall contact you as soon as possible.<br><br>Have a great day ahead.<br><br>";
	
	$message .='With Best Regards<br>Forcica';

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	$headers .= "From: Forcica Team  <".$from."> \r\n";


	$sendmail=@mail($to,$subject,$message,$headers,'-f '.$from);
	///////////////////////  Admin Mail ////////////////////////////

	$subject_admin='New Contact Enquiry - Forcica';		   
			   
    $message_admin='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
	$message_admin .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
	$message_admin .='<b>Dear Admin,</b><br><br>';
	$message_admin .="New contact enquiry has been received. Details are here under.<br><br>";
	$message_admin .='<b>Name    : </b>'.$name.'<br>';
	$message_admin .='<b>Phone   : </b>'.$phone.'<br>';
	$message_admin .='<b>E-mail  : </b>'.$email.'<br>';
	$message_admin .='<b>Subject : </b>'.$subject_message.'<br>';
	$message_admin .='<b>Message : </b>'.$mess.'<br><br><br>'; 

	$message_admin .='With Best Regards<br>Forcica </div>';
	

	$headers_admin  = 'MIME-Version: 1.0' . "\r\n";
	$headers_admin .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	$headers_admin .= "From: Forcica Team  <".$to."> \r\n";

	$sendmail=@mail($from,$subject_admin,$message_admin,$headers_admin,'-f '.$to);

	if($sendmail)
		{
			echo 'test^save^Your detail has been send successfully^test';
		}else{
			echo 'test^notsave^Error occured while sending details^test';
		}
	

}

//////////////////////   Contact Mail //////////////////////

//////////////////////   Get Admission Mail //////////////////////

function getaddmissionform()
{
	$obj=New Common();
	$ADMINMAIL=$obj->getAdminDetailEmail();

	$to=$_POST['email'];
	$from=$ADMINMAIL;

	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];

	$enquiry_for='2';

	$save_form=$obj->savegetaddmissionenq($name,$email,$phone,$enquiry_for);
	

	///////////////////////////  Client Mail ///////////////////////

	$subject='Get admission - Forcica';
   
		   
	$message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
	$message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
	$message .='<b>Dear '.$name.',</b><br><br>';
	$message .="Welcome and thank you for contacting at Forcica. We appreciate you getting in touch.<br><br>This is an automatic response to your email, we shall contact you as soon as possible.<br><br>Have a great day ahead.<br><br>";
	
	$message .='With Best Regards<br>Forcica';
	
	

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	$headers .= "From: Forcica Team  <".$from."> \r\n";

	//echo $message;

	$sendmail=@mail($to,$subject,$message,$headers,'-f '.$from);
	///////////////////////  Admin Mail ////////////////////////////

	$subject_admin='New Get admission Enquiry - Forcica';

	
	$message_admin='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
	$message_admin .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
	$message_admin .='<b>Dear Admin,</b><br><br>';
	$message_admin .="New contact enquiry has been received. Details are here under.<br><br>";
	$message_admin .='<b>Name    : </b>'.$name.'<br>';
	$message_admin .='<b>Phone   : </b>'.$phone.'<br>';
	$message_admin .='<b>E-mail  : </b>'.$email.'<br><br><br>';


	$message_admin .='With Best Regards<br>Forcica </div>';
	
	$headers_admin  = 'MIME-Version: 1.0' . "\r\n";
	$headers_admin .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	$headers_admin .= "From: Forcica Team  <".$to."> \r\n";

	$sendmail=@mail($from,$subject_admin,$message_admin,$headers_admin,'-f '.$to);

	if($sendmail)
		{
			echo 'test^save^Your detail has been send successfully^test';
		}else{
			echo 'test^notsave^Error occured while sending details^test';
		}
}


?>