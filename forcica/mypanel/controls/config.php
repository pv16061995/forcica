<?php
ob_start();
session_start();
$iLocal = 1;
global $conn;
if ($iLocal == 1)
{
    define('MYSQLDB_HOST' , 'localhost');
    define('MYSQLDB_USER' , 'root');
    define('MYSQLDB_PASS' , '');
    define('MYSQLDB_DATABASE', 'forcica_crm');
    define('MYSQLDB_PORT' , 3306);
    define('SUBFOLDER','forcica/mypanel/');
    define('BASEPATH','http://10.0.0.66/'.SUBFOLDER);
	define('WEBPATH','http://10.0.0.66/forcica/');
}
else
{
    define('MYSQLDB_HOST' , 'localhost');
    define('MYSQLDB_USER' , 'root');
    define('MYSQLDB_PASS' , '');
    define('MYSQLDB_DATABASE', 'forcica_crm');
    define('MYSQLDB_PORT' , 3306);
    define('SUBFOLDER','forcica/');
    define('BASEPATH','http://10.0.0.66/'.SUBFOLDER);
}
//date_default_timezone_set("Canada/Eastern");
ini_set('display_errors',0);

?>
	