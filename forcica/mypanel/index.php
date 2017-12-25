<?php 
error_reporting(1);
$msgs="this is error message";
include('controls/config.php');
require_once 'controls/clsAlerts.php';
require_once 'controls/clsUser.php';
require_once 'controls/clsCommon.php';


if(isset($_POST['loginadmin']))
{
    $objUS=new User();
    if ($_POST['captcha'] == $_SESSION['cap_code']) 
    {
        $resLC=$objUS->checkLicence();
        if($resLC->num_rows=='0')
        {
            $uname=$_POST['uname'];
            $pass=  sha1($_POST['pass']);
            $result=$objUS->checkUserLogin($uname,$pass);
        
            //$result=mysql_query($qry);
            $row=$result->fetch_assoc();
        
            $select_panel=$row['ID'];
            
            if(($row['user_login']==$uname) && ($row['user_pass_text']==$pass))
            {
                if($result) 
                {
                    if($result->num_rows > 0) 
                    {		
                        if ($row['membertype'] == 'admin' || $row['membertype'] =='user') 
                        {
                            $_SESSION['adminloggedin'] = true;
                            $_SESSION['adminuserid'] = $select_panel;
                            $_SESSION['membertype'] = $row['membertype'];
                            $_SESSION['userpermission'] = $row['userpermission'];
                            $_SESSION['name'] = $row['user_nicename'];
                            $_SESSION['profile_image'] = $row['user_image'];
                            header('location: admin/index.php');
                        }
                        else 
                        {
                            $_SESSION['studentloggedin'] = true;
                            $_SESSION['studentuserid'] = $select_panel;
                            $_SESSION['name'] = $row['first_name'].' '.$row['last_name'];
                            $_SESSION['profile_image'] = $row['profile_image'];
                            $_SESSION['user_login'] = $row['user_login'];
                            header('location: student/index.php');
                        }
                    }
                    else
                    {
                        $msgs='Username and Password is Invalid';
                        $ShowAlerts=$_SESSION['ErrorMessage']=$msgs; 
                    }
                }
                else
                {
                    $msgs='Username and Password is Invalid';
                    $ShowAlerts=$_SESSION['ErrorMessage']=$msgs; 
                }
            }
            else
            {
                $msgs='Username and Password is Invalid';
                $ShowAlerts=$_SESSION['ErrorMessage']=$msgs; 
            }
        }
        else 
        {
            $msgs='License Duration has been expired';
            $ShowAlerts=$_SESSION['ErrorMessage']=$msgs; 
        }
    }
    else 
    {
        $msgs='Please enter correct code';
        $ShowAlerts=$_SESSION['ErrorMessage']=$msgs; 
    }
}


if(isset($_SESSION['adminloggedin']))
{
	if($_SESSION['adminloggedin'])
	{
		header('location: admin/index.php');
	}
	else if($_SESSION['studentloggedin'])
	{
		header('location: student/index.php');
	}
}


if(isset($_POST['forget_password']))
{
    $obj=New Common();
    $ADMINMAIL=$obj->getAdminDetailEmail();

    
    $objUS=new User();
    $for_uname=$_POST['for_uname'];

    

    $chkusername=$objUS->checkusernameExist($for_uname);

   // print_r($chkusername->num_rows);

    if($chkusername->num_rows==0)
    {
        $msgs='Username is Invalid';
        $ShowAlerts=$_SESSION['ErrorMessage']=$msgs;

    }else if($chkusername->num_rows==1){

            $pass=mt_rand(9999,999999);
            $password=sha1($pass);
            $result=$chkusername->fetch_assoc();

            $email=$result['user_email'];

            $chnge_pass=$objUS->updatePasswordByUserNamenPass($for_uname,$email,$password);

            if($chnge_pass>0)
            {
                $subject='Change Password';
                
				$message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
				$message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
				$message .='<b>Dear Student,</b><br><br>';
				$message .="Your password has been update successfully.Your login detail has been given below.<br><br>";
				
				$message .='<b>Username    : </b>'.$for_uname.'<br>';
				$message .='<b>Password   : </b>'.$pass.'<br>';
				
				$message .='<div style="margin-bottom:20px;"><br>
				   Regards,<br>
				   <b>Forcica Team</b><br>Forcica Commodity Solutions OPC Private Limited,<br>113-115, SS Plaza, Sector-1 Dwarka,<br>New Delhi-110075.<br>Tel: +91-7042782924, +91-7042782925<br>E-mail: support@forcica.com<br>www.forcica.com
				   </div>';
				 

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
				$headers .= "From: Forcica Team  <".$ADMINMAIL."> \r\n";

			$sendmail=@mail($email,$subject,$message,$headers,'-f '.$ADMINMAIL);

            //$msgs='Your password has been update successfully. Please Check your email.';
            //$ShowAlerts=$_SESSION['SuccessMessage']=$msgs;
			
			echo '<script type="text/javascript"> alert("Your password has been update successfully. Please Check your email."); </script>';
			
            header("location:".BASEPATH);

            ?>
                <script>
                    $('#loginform').show();
                    $('#forgetform').hide();
                </script>
            <?php

            }else{

                //$msgs='Error occur while reset your password';
                //$ShowAlerts=$_SESSION['ErrorMessage']=$msgs;
				
				echo '<script type="text/javascript"> alert("Error occur while reset your password."); </script>';
            }

    }


}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forcica School Of Trading</title>
<link href="<?php echo BASEPATH; ?>bootstrap/main.css" rel="stylesheet">
<link href="<?php echo BASEPATH; ?>bootstrap/login.css" rel="stylesheet">

</head>

<body>
<div class="main_header">
    <div class="login_logo"><img src="<?php echo BASEPATH; ?>bootstrap/img/logo.png" style="height:60px;" /></div>
</div>


<div class="login-container">
    <label>
        <?php 

         if($ShowAlerts !=null){ 

                if($_SESSION['SuccessMessage']!=''){
            echo '<div class="row-fluid" id="ooopp">
            <div class="span12">
              <div class="widget">                
                <div class="widget-body">
                  <div class="alert alert-block alert-success fade in">
                    <button data-dismiss="alert" class="close" type="button" id="hide">x</button>
                        <p> '.$msgs.'</p>
                  </div>
                </div>
              </div>
            </div>
        </div>';
        unset($_SESSION['SuccessMessage']);
            }else{
                  echo '<div class="row-fluid" id="ooopp">
            <div class="span12">
              <div class="widget">                
                <div class="widget-body">
                  <div class="alert alert-block alert-error fade in">
                    <button data-dismiss="alert" class="close" type="button" id="hide">x</button>
                        <p> '.$msgs.'</p>
                  </div>
                </div>
              </div>
            </div>
        </div>';
            }
        }else{
            if($_SESSION['SuccessMessage']!=''){
            echo '<div class="row-fluid" id="ooopp">
            <div class="span12">
              <div class="widget">                
                <div class="widget-body">
                  <div class="alert alert-block alert-success fade in">
                    <button data-dismiss="alert" class="close" type="button" id="hide">x</button>
                        <p> '.$_SESSION['SuccessMessage'].'</p>
                  </div>
                </div>
              </div>
            </div>
        </div>';
        unset($_SESSION['SuccessMessage']);
            }
        }
        ?>
  </label>

 <!-- //////////////////////  Login /////////////////////// -->
<div id="loginform">
  <div class="login-box">
    <form id=""  name="myForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
      <div class="login-form">
        <h2>Log in Panel</h2>
        <div id="messages" style="margin:10px; font-weight:bold;"> </div>
        <div class="login_img"><img src="<?php echo BASEPATH; ?>bootstrap/img/login.png" alt=""/></div>
        <div class="login_right">
          <div class="input-box input-left">
              
            <label for="username">User Name:</label>
            <input type="text" id="username" name="uname" placeholder="Enter Username" class="input-text">
          </div>
          <div class="input-box input-right">
            <label for="login">Password:</label>
            <input type="password" id="login" name="pass" placeholder="Enter Password" class="input-text" value="">
          </div>
          <div class="input-box input-right">
            <input type="text" name="captcha" id="captcha" class="input-text validate[required] code" placeholder="Enter Code Here :"  /> <img src="captcha.php" style="height: 34px; margin-left: 15px; margin-top:-6px;" /> 
          </div>
          <div class="clear"></div>
          <div class="form-buttons">

            <input type="submit" class="login-button" name="loginadmin" value="Login" title="Login">
			
			
          </div>
		   <div class="clear"></div>
		   <div class="input-box input-right">
		 <!-- <div class="row" style="margin-left:0; margin-top:18px;"> If you don't have an account please click to <a href="registration.php" style="color:#428bca;">register</a> </div>  -->
         <div style="font-size: 17px;font-weight: 700;margin-top: 5%;"><a href="javascript:;" onclick="chageform();" style="color: #038228;">I forgot my password?</a></div>
 
        </div>
        </div>
      </div>
    </form>
</div>
</div>

<!-- //////////////////////  Login /////////////////////// -->

<!-- //////////////////////  Forget Password /////////////////////// -->
<div id="forgetform" style="display:none;">
<div class="login-box">
    <form id=""  name="myForgetForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForgetForm()">
      <div class="login-form">
        <h2>Reset Password</h2>
        <div id="messages" style="margin:10px; font-weight:bold;"> </div>
        <div class="login_img"><img src="<?php echo BASEPATH; ?>bootstrap/img/login.png" alt=""/></div>
        <div class="login_right">
          <div class="input-box input-left">
              
            <label for="username">User Name:</label>
            <input type="text" id="for_uname" name="for_uname" placeholder="Enter Username" class="input-text">
          </div>
          <div class="input-box input-right">
            <!-- <input type="text" name="for_captcha" id="for_captcha" class="input-text validate[required] code" placeholder="Enter Code Here :"  /> <img src="captcha.php" style="height: 34px; margin-left: 15px; margin-top:-6px;" />  -->
&nbsp;&nbsp;&nbsp;

          </div>
          <div class="clear"></div>
          <div class="form-buttons">

            <input type="submit" class="login-button" name="forget_password" value="Reset Password" title="Reset Password">
            
            
          </div>
           <div class="clear"></div>
          <!-- <div class="input-box input-right">
        
          <div style="font-size: 17px;font-weight: 700;margin-top: 5%;"><a href="javascript:;" onclick="chageform();" style="color: #038228;">I forgot my password?</a></div> 
 
        </div>-->
        </div>
      </div>
    </form>
</div>
</div>

<!-- //////////////////////   Forget Password /////////////////////// -->


</div>
<?php
    $obj=new User();
    $resLD=$obj->getLicenceDuration();
    $rowLD=$resLD->fetch_assoc()
?>
<!-----footer---->
<div class="login_footer_main">
  <div class="login_footer">
    <div class="license">License Duration: <?php echo $rowLD['valid_from']. " - ".$rowLD['valid_to']; ?></div>
    <div class="legal">(C)2017 Focica Commodity Solution OPC Pvt Ltd. All Rights Reserved.</div>
  </div>
</div>



</body>
</body>
</html>
<script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-3.1.1.min.js"></script>
<script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("#ooopp").hide();
    });
    
});

function chageform()
{
    $('#loginform').hide();
    
    $('#forgetform').show();
}

</script>
<script type="text/javascript">
    
    function validateForm() 
    {
        var username = document.forms["myForm"]["uname"].value;
        if (username == null || username == "") {
            alert("Please Enter Your Username");
            document.myForm.uname.focus();
            return false;
        }
        if(document.myForm.pass.value == "")
        {
            alert('Please Enter Your  Password');
            document.myForm.pass.focus();		
            return false;
        }	
    }

    function validateForgetForm() 
    {
        var username = document.forms["myForgetForm"]["for_uname"].value;
        if (username == null || username == "") {
            alert("Please Enter Your Username");
            document.myForm.uname.focus();
            return false;
        }


        var captcha = document.forms["myForgetForm"]["for_captcha"].value;
        if (captcha == null || captcha == "") {
            alert("Please Enter Captcha Code");
            document.myForm.for_captcha.focus();
            return false;
        }
    }

</script>
