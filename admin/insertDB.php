<?php
session_start();
if ($_SESSION["ss_status"] != "admin" || $_SESSION["logined"] != true) {die("Access Denied!");}
define("KRITSADAPONG", true);
require_once "../conn.php";
//var_dump($_POST);
//extract(@$_POST);
$mode = @$_POST["mode"];
if (empty($mode)) {die("Unknown Mode");}

//echo $mode;
switch ($mode) {
 case "adduser":
  addUser($conn);
  break;
 case "addbook":
  break;

}
function addUser($conn)
{
 extract(@$_POST);
 $sql = "INSERT INTO `tb_user`" .
  "VALUES (NULL, '$uname','$upass','$prefix','$name','$surname','$tel','$email','$LineToken','user')";
 if (mysqli_query($conn, $sql)) {
  echo "OK";
 } else {
  echo mysqli_errno($conn) . " : " . mysqli_error($conn);
 }
 mysqli_close($conn);
}