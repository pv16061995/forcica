<?php
include 'mypanel/controls/config.php';

///////////////////////////  Client Mail ///////////////////////

$subject='Contact - Forcica';

$message='
         <div style="width:500px;margin:auto;font-family:Helvetica,Arial;font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;">
		 <div style="margin-bottom:35px; text-align:center;background:#3b3772;"><img src="'.WEBPATH.'images/logo-2.png" style="height:70px;margin-top: 10px;margin-bottom: 10px;" /></div>
		 <div style="margin-bottom:20px;">Dear '.$name.',</div>
		 <div style="margin-bottom:20px;">Welcome and thank you for contacting at Forcica. We appreciate you getting in touch. <br><br> This is an automatic response to your email, we shall contact you as soon as possible.<br><br> Have a great day ahead.
		 <br><br>'; 

$message .='</div>';
$message .='
   		   <div style="margin-bottom:20px;">
		   <br>
		   Regards,<br><br>
		   <b>Forcica Team</b><br>Forcica Commodity Solutions OPC Private Limited,<br>113-115, SS Plaza, Sector-1 Dwarka,<br>New Delhi-110075.<br>Tel: +91-7042782924, +91-7042782925<br>E-mail: support@forcica.com<br>www.forcica.com
		   </div>
		   <div style="background:#1c1a30; padding:10px; width:100%; color:#fff; box-sizing: border-box; text-align:center;">
		   <div style="font-size:18px; font-weight:bold; margin-bottom:5px;">Forcica </div>
		   <div style="margin-bottom:10px;">www.forcica.com</div>
		   <div>
		 <a href="'.WEBPATH.'index.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Home</a>
		 &nbsp;&nbsp;|&nbsp;&nbsp;
		  <a href="'.WEBPATH.'classes.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Courses</a>
		   &nbsp;&nbsp;|&nbsp;&nbsp;
		    <a href="'.WEBPATH.'paying-admission-fee.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Get Admission</a>
		    &nbsp;&nbsp;|&nbsp;&nbsp;
		    <a href="'.WEBPATH.'predictions.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Predictions</a>
		    &nbsp;&nbsp;|&nbsp;&nbsp;
		    <a href="'.WEBPATH.'reports.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Reports</a>
		    &nbsp;&nbsp;|&nbsp;&nbsp;
		    <a href="'.WEBPATH.'contact.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Contact Us</a>
		    </div>
		   </div></div>';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
$headers .= "From: Forcica Team  <".$from."> \r\n";

//echo $message;
///////////////////////  Admin Mail ////////////////////////////

$subject_admin='Contact - Forcica';

$message_admin='
         <div style="width:500px;margin:auto;font-family:Helvetica,Arial;font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;">
		 <div style="margin-bottom:35px; text-align:center;background:#3b3772;"><img src="'.WEBPATH.'images/logo-2.png" style="height:70px;margin-top: 10px;margin-bottom: 10px;" /></div>
		 <div style="margin-bottom:20px;">Dear Admin,</div>
		 <div style="margin-bottom:20px;">New contact enquiry has been received. Details are here under. <br><br>';

$message_admin .='<b>Name : </b>'.$name.'<br>';
$message_admin .='<b>Phone :  </b>'.$Phone.'<br>';
$message_admin .='<b>E-mail : </b>'.$email.'<br>';
$message_admin .='<b>Subject : </b>'.$subject_message.'<br>';
$message_admin .='<b>Message : </b>'.$mess.'<br>'; 

$message_admin .='</div>';
$message_admin .='
   		   
		   <div style="background:#1c1a30; padding:10px; width:100%; color:#fff; box-sizing: border-box; text-align:center;">
		   <div style="font-size:18px; font-weight:bold; margin-bottom:5px;">Forcica </div>
		   <div style="margin-bottom:10px;">www.forcica.com</div>
		   <div>
		 <a href="'.WEBPATH.'index.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Home</a>
		 &nbsp;&nbsp;|&nbsp;&nbsp;
		  <a href="'.WEBPATH.'classes.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Courses</a>
		   &nbsp;&nbsp;|&nbsp;&nbsp;
		    <a href="'.WEBPATH.'paying-admission-fee.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Get Admission</a>
		    &nbsp;&nbsp;|&nbsp;&nbsp;
		    <a href="'.WEBPATH.'predictions.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Predictions</a>
		    &nbsp;&nbsp;|&nbsp;&nbsp;
		    <a href="'.WEBPATH.'reports.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Reports</a>
		    &nbsp;&nbsp;|&nbsp;&nbsp;
		    <a href="'.WEBPATH.'contact.php" target="_blank" style="color:#BFBFBF; text-decoration:none;">Contact Us</a>
		    </div>
		   </div></div>';

$headers_admin  = 'MIME-Version: 1.0' . "\r\n";
$headers_admin .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
$headers_admin .= "From: Forcica Team  <".$to."> \r\n";

echo $message_admin;



