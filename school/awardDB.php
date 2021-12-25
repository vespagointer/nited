<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}
define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";

//echo $BookNo . "<br />";
$aid = @$_POST["aid"];
extract(@$_POST);
if (@$_POST["mode"] == "addaward") {
 $name = mysqli_real_escape_string($conn, $name);
 $description = mysqli_real_escape_string($conn, $description);
 $afrom = mysqli_real_escape_string($conn, $afrom);
 $sc_id = $_SESSION["ss_id"];

 $sql = "INSERT INTO `tb_scaward` VALUES (NULL,'$sc_id','$name','$description','$adate','$afrom')";
 if (mysqli_query($conn, $sql)) {
  $aid = mysqli_insert_id($conn);
  inc_stat($conn, $sc_id, "award");
 }
}

$year = date('Y') + 543;
$folder = "../scafiles/" . $year;
if (!@is_dir($folder)) {
 $oldmask = umask(0);
 mkdir($folder, 0777);
 umask($oldmask);
 fopen($folder . "/index.html", "w");
}

//echo $bid;
$name = $aid . "_" . (date('Y') + 543) . date("mdHis");
foreach ($_FILES["att"]["error"] as $key => $error) {
 if ($error == UPLOAD_ERR_OK) {
  $tmp_name = $_FILES["att"]["tmp_name"][$key];
  // basename() may prevent filesystem traversal attacks;
  // further validation/sanitation of the filename may be appropriate
  $filename = basename($_FILES["att"]["name"][$key]);
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  if (strtoupper($ext) == "PHP") {exit();}

  $newname = $name . "_" . $key . "." . $ext;

  $filename = $attName[$key];
  if (empty($filename)) {
   $filename = "เอกสารที่ " . ((int) $key + 1);
  }
  //echo $newname . "<br />";
  if (move_uploaded_file($tmp_name, "$folder/$newname")) {
   $sql = "INSERT INTO `tb_scafile` VALUES (NULL,'$aid','$filename','$newname','$year')";
   mysqli_query($conn, $sql);
  }
 }
}
@header("location:index.php?module=awarddetail&id=" . $aid);

//htmlentities
//html_entity_decode

//extract(@$_FILES);
//echo $att["name"][0];
//echo $name;