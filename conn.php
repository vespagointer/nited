<?php
//define("KRITSADAPONG", true);
define("__FFF___", "https://nited.spmnan.go.th/index.php?module=profile&id=17");
if (!defined("KRITSADAPONG")) {
//die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}

$db_host = "119.59.100.49";
$db_name = "spmnan_nited";
$db_user = "nitedspmnan";
$db_pwd = "J%63goe8";

$adminID = 1;
$anonID = 0;
$pwdPrefix = "Krit_";
global $conn;
$conn = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);
mysqli_set_charset($conn, "utf8");

//https://119.59.100.49:8443/phpMyAdmin/
