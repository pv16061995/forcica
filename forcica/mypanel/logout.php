<?php
include('controls/config.php');

if($_REQUEST['cmd']=='logout')
{
    session_destroy();
    header("location: index.php");
}
