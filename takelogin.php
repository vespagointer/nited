<?php
session_start();
define("KRITSADAPONG", true);
require_once "conn.php";
$uname = mysqli_real_escape_string($conn, @$_POST["uname"]);
$upass = mysqli_real_escape_string($conn, @$_POST["upass"]);

if (empty($uname) || empty($upass)) {
 @header("location:login.php");
}
$sql = "SELECT * FROM `tb_user`WHERE `uname`='$uname' AND `upass`='$upass'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) >= 1) {
 $data = mysqli_fetch_array($result);
 $_SESSION["ss_id"] = $data["id"];
 $_SESSION["ss_status"] = $data["status"];
 $_SESSION["ss_name"] = $data["name"];
 $_SESSION["ss_surname"] = $data["surname"];
 $_SESSION["logined"] = true;
 echo "OK";
} else {
 $sql = "SELECT * FROM `tb_school`WHERE `id10`='$uname' AND `id8`='$upass'";
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) >= 1) {
  $data = mysqli_fetch_array($result);
  $_SESSION["ss_id"] = $data["id"];
  $_SESSION["ss_status"] = "school";
  $_SESSION["ss_name"] = $data["name"];
  $_SESSION["ss_surname"] = "";
  $_SESSION["logined"] = true;
  echo "school";
 } else {
  $sql = "SELECT * FROM `tb_teacher`WHERE `cid`='$uname' AND `pwd`='$upass'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) >= 1) {
   $data = mysqli_fetch_array($result);
   $_SESSION["ss_id"] = $data["id"];
   $_SESSION["ss_status"] = "teacher";
   $_SESSION["ss_name"] = $data["name"];
   $_SESSION["ss_surname"] = "";
   $_SESSION["logined"] = true;
   echo "teacher";
  } else {
   echo "FAIL";
  }
 }
}