<?php
//var_dump($_POST);
session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}
define("KRITSADAPONG", true);
require_once "../conn.php";

extract($_POST);
$pName = htmlentities($pName);
//echo $mode;
if ($mode == "addproject") {
 $sql = "INSERT INTO `tb_project` VALUES (NULL, '$pName','$budget','0','$mYear','$person')";
 if (mysqli_query($conn, $sql)) {
  $pid = mysqli_insert_id($conn);
  $b   = "project";
 }
 $school = $_POST["school"];

 $sql    = "SELECT `id`,`name` FROM `tb_school`";
 $result = mysqli_query($conn, $sql);
 while ($row = mysqli_fetch_assoc($result)) {
  $scname[$row["id"]] = $row["name"];
 }

 foreach ($school as $key => $scid) {
  $sql = "INSERT INTO `tb_uproject`(`id`,`pid`,`scid`,`scname`) VALUES(NULL,'$pid','$scid','$scname[$scid]')";
  mysqli_query($conn, $sql);
 }

}

$year   = date('Y') + 543;
$folder = "../files/" . $year;
if (!@is_dir($folder)) {
 $oldmask = umask(0);
 mkdir($folder, 0777);
 umask($oldmask);
 fopen($folder . "/index.html", "w");
}

$name = $pid . "_" . (date('Y') + 543) . date("mdHis");
foreach ($_FILES["att"]["error"] as $key => $error) {
 if ($error == UPLOAD_ERR_OK) {
  $tmp_name = $_FILES["att"]["tmp_name"][$key];

  $filename = basename($_FILES["att"]["name"][$key]);
  $ext      = pathinfo($filename, PATHINFO_EXTENSION);
  if (strtoupper($ext) == "PHP") {exit();}

  $newname = $b . $name . "_" . $key . "." . $ext;

  $filename = $attName[$key];
  if (empty($filename)) {
   $filename = "เอกสารที่ " . ((int) $key + 1);
  }
  if (move_uploaded_file($tmp_name, "$folder/$newname")) {
   $sql = "INSERT INTO `tb_file` VALUES (NULL,'$b','$pid','$year','$newname','$filename')";
   mysqli_query($conn, $sql);
  }
 }
}
@header("location:index.php?module=" . $b . "detail&id=" . $pid);