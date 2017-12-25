<?php
include('controls/config.php');

if(isset($_GET['tokenid'])) {
    $userid=  base64_decode($_GET['tokenid']); 
    if($userid==1) 
    {
        $_SESSION['adminloggedin'] = true;
        $_SESSION['adminuserid'] = $userid;
        header('location: admin/index.php');
    }
    else 
    {
        $_SESSION['studentloggedin'] = true;
        $_SESSION['studentuserid'] = $userid;
        header('location: student/index.php');
    }
}
else 
{
    header('location: ../index.php');
}


?>