<?php

define('WEBSITE_TITLE', "Listings");

/*set database variables*/

define('DB_TYPE','mysql');
define('DB_NAME','listings');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_HOST','localhost');
define('DB_PORT','8889');

/*protocal type http or https*/
define('PROTOCAL','http');

/*root and asset paths*/
$localhost = $_SERVER['SERVER_NAME'].":90";

$path = str_replace("\\", "/",PROTOCAL ."://" . $localhost . __DIR__  . "/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);

//define('ROOT', str_replace("app/core", "public", $path));
//define('ASSETS', str_replace("app/core", "public/assets", $path));
define('ROOT', 'http://'.$localhost."/");
//define('ASSETS', '/assets/landlist/');
define('ASSETS', '/assets/jlist/');

/*set to true to allow error reporting
set to false when you upload online to stop error reporting*/

define('DEBUG',true);

if(DEBUG)
{
	ini_set("display_errors",1);
}else{
	ini_set("display_errors",0);
}