<?php
session_start();
if ($_SESSION["ss_status"] != "teacher") {
 die("Access Denied!");
}
define("KRITSADAPONG", true);
require_once "../conn.php";
/*
if (@$_POST["mode"] == "award") {
extract($_POST);
$sql = "UPDATE `tb_scaward` SET `$parm` = '$tmpData' WHERE `id`='$id'";
if (mysqli_query($conn, $sql)) {
echo "OK";
} else {
echo mysqli_error($conn);
}
}
 */

if (@$_POST["mode"] == "teacher") {
 extract($_POST);
 $sql = "UPDATE `tb_teacher` SET `$parm` = '$tmpData' WHERE `id`='$id'";
 if (mysqli_query($conn, $sql)) {
  echo "OK";
 } else {
  echo mysqli_error($conn);
 }
}

/*
if (@$_POST["mode"] == "school") {
extract($_POST);
$sql = "UPDATE `tb_school` SET `$parm` = '$tmpData' WHERE `id`='$id'";
if (mysqli_query($conn, $sql)) {
echo "OK";
} else {
echo mysqli_error($conn);
}
}
 */
