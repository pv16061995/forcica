<?php
require_once '../libs/trupay_lib/Core/Libs/BasicFunctions.php';

BasicFunctions::session_start();

unset($_SESSION['orderNumber']);
echo "Payment Failed";

//add logic for loading failed Page;
