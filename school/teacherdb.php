<?php
session_start();
if ($_SESSION["ss_status"] != "school") {
 die("Access Denied!");
}
define("KRITSADAPONG", true);
require_once "../conn.php";
$id = $_SESSION["ss_id"];
$scid = $_SESSION["ss_id"];
$id10 = $_SESSION["ss_id10"];

if (isset($_POST["cid"])) {
 extract($_POST);
 @$sql = "SELECT `id` FROM `tb_teacher` WHERE `cid`=$cid";
 $result = mysqli_query($conn, $sql);
 if (@mysqli_num_rows($result) > 0) {
  die("มีข้อมูลของ เลขประจำตัวประชาชน " . $cid . " ในระบบแล้ว");
 }

 @$sql = "INSERT INTO `tb_teacher` (`id`,`sc_id`,`sc_id10`,`cid`,`pwd`,`name`,`email`,`tel`,`dep`,`pos`) VALUES (NULL, $id, $id10, '$cid', '$pwd', '$name', '$email', '$tel', $dep,'$pos')";
 if (@mysqli_query($conn, $sql)) {
  die("OK");
 } else {
  die(@mysqli_error($conn));
 }

}

if (@$_GET["do"] == "move") {
 @$id = $_GET["id"];
 $sql = "UPDATE `tb_teacher` SET `sc_id` = 0,`sc_id10` =0  WHERE `id`=$id";
 if (mysqli_query($conn, $sql)) {
  die("OK");
 } else {
  die(mysqli_error($conn));
 }
//echo $id;*/
 // echo "OK";
}

if (@$_GET["do"] == "in") {
 @$id = $_GET["id"];
 $sql = "UPDATE `tb_teacher` SET `sc_id` = $scid,`sc_id10` = $id10 WHERE `id`=$id";
 if (mysqli_query($conn, $sql)) {
  die("OK");
 } else {
  die(mysqli_error($conn));
 }
 //echo $id;*/
 // echo "OK";
}

if (@$_GET["do"] == "del") {
 @$id = $_GET["id"];
 $sql = "DELETE FROM `tb_teacher` WHERE `id`=$id";
 if (mysqli_query($conn, $sql)) {
  die("OK");
 } else {
  die(mysqli_error($conn));
 }
}

if (@$_GET["do"] == "pwd") {
 @$id = $_GET["id"];
 @$pwd = $_GET["pwd"];
 $sql = "UPDATE `tb_teacher` SET `pwd` = '$pwd' WHERE `id`=$id";
 if (mysqli_query($conn, $sql)) {
  die("OK");
 } else {
  die(mysqli_error($conn));
 }
}
