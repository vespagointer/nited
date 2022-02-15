<?php
session_start();
if ($_SESSION["logined"] != true || $_SESSION["ss_status"] != "teacher") {@header("location:index.php");}
define("KRITSADAPONG", true);
require_once "conn.php";
//require_once "../db.php";
if ($_SESSION["ss_id"] != $_POST["tid"]) {exit("Acsses Denined");}
$aType = @$_POST["mode"];
if ($aType == "train1" || $aType == "train2") {
 $folder = "train";
} else if ($aType == "self" || $aType == "student" || $aType == "school") {
 $folder = "taward";
}

if (!@is_dir($folder)) {
 $oldmask = umask(0);
 mkdir($folder, 0777);
 umask($oldmask);
 fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
}

$folder .= DIRECTORY_SEPARATOR . $aType;

if (!@is_dir($folder)) {
 $oldmask = umask(0);
 mkdir($folder, 0777);
 umask($oldmask);
 fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
}

$folder .= DIRECTORY_SEPARATOR . (date('Y') + 543);

if (!@is_dir($folder)) {
 $oldmask = umask(0);
 mkdir($folder, 0777);
 umask($oldmask);
 fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
}

$folder .= DIRECTORY_SEPARATOR . date('m');

if (!@is_dir($folder)) {
 $oldmask = umask(0);
 mkdir($folder, 0777);
 umask($oldmask);
 fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
}

if (@$_POST["mode"] == "train1") {
 extract($_POST);
 if ($parm == "tDoc") {
  $tmpSql = "SELECT `tDoc` FROM `tb_train1` WHERE `id`='$id'";
  $tmpResult = mysqli_query($conn, $tmpSql);
  $xDoc = mysqli_fetch_row($tmpResult)[0];
  if ($_FILES["tmpData"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["tmpData"]["tmp_name"];
   $filename = basename($_FILES["tmpData"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `tb_train1` SET `tDoc` = '$newname' WHERE `id` = $id";

   }
  }

 } else {
  $sql = "UPDATE `tb_train1` SET `$parm` = '$tmpData' WHERE `id`='$id'";
 }
 if (mysqli_query($conn, $sql)) {
  echo "OK";
 } else {
  echo mysqli_error($conn);
 }
}

if (@$_POST["mode"] == "train2") {
 extract($_POST);
 if ($parm == "tDoc") {
  $tmpSql = "SELECT `tDoc` FROM `tb_train2` WHERE `id`='$id'";
  $tmpResult = mysqli_query($conn, $tmpSql);
  $xDoc = mysqli_fetch_row($tmpResult)[0];
  if ($_FILES["tmpData"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["tmpData"]["tmp_name"];
   $filename = basename($_FILES["tmpData"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `tb_train2` SET `tDoc` = '$newname' WHERE `id` = $id";

   }
  }

 } else {
  $sql = "UPDATE `tb_train2` SET `$parm` = '$tmpData' WHERE `id`='$id'";
 }
 if (mysqli_query($conn, $sql)) {
  @unlink(trim($xDoc, "../"));
  echo "OK";
 } else {
  echo mysqli_error($conn);
 }
}

if (@$_POST["mode"] == "self") {
 extract($_POST);
 if ($parm == "adoc1") {
  $tmpSql = "SELECT `adoc1` FROM `tb_taward_self` WHERE `id`='$id'";
  $tmpResult = mysqli_query($conn, $tmpSql);
  $xDoc = mysqli_fetch_row($tmpResult)[0];
  if ($_FILES["tmpData"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["tmpData"]["tmp_name"];
   $filename = basename($_FILES["tmpData"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `tb_taward_self` SET `adoc1` = '$newname' WHERE `id` = $id";

   }
  }

 } else if ($parm == "adoc2") {
  $tmpSql = "SELECT `adoc2` FROM `tb_taward_self` WHERE `id`='$id'";
  $tmpResult = @mysqli_query($conn, $tmpSql);
  $xDoc = @mysqli_fetch_row($tmpResult)[0];
  if ($_FILES["tmpData"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["tmpData"]["tmp_name"];
   $filename = basename($_FILES["tmpData"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `tb_taward_self` SET `adoc2` = '$newname' WHERE `id` = $id";

   }
  }
 } else {
  $sql = "UPDATE `tb_taward_self` SET `$parm` = '$tmpData' WHERE `id`='$id'";
 }
 if (mysqli_query($conn, $sql)) {
  @unlink(trim($xDoc, "../"));
  echo "OK";
 } else {
  echo mysqli_error($conn);
 }
}

if (@$_POST["mode"] == "student") {
 extract($_POST);
 if ($parm == "adoc1") {
  $tmpSql = "SELECT `adoc1` FROM `tb_taward_student` WHERE `id`='$id'";
  $tmpResult = mysqli_query($conn, $tmpSql);
  $xDoc = mysqli_fetch_row($tmpResult)[0];
  if ($_FILES["tmpData"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["tmpData"]["tmp_name"];
   $filename = basename($_FILES["tmpData"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `tb_taward_student` SET `adoc1` = '$newname' WHERE `id` = $id";

   }
  }

 } else if ($parm == "adoc2") {
  $tmpSql = "SELECT `adoc2` FROM `tb_taward_student` WHERE `id`='$id'";
  $tmpResult = @mysqli_query($conn, $tmpSql);
  $xDoc = @mysqli_fetch_row($tmpResult)[0];
  if ($_FILES["tmpData"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["tmpData"]["tmp_name"];
   $filename = basename($_FILES["tmpData"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `tb_taward_student` SET `adoc2` = '$newname' WHERE `id` = $id";

   }
  }
 } else {
  $sql = "UPDATE `tb_taward_student` SET `$parm` = '$tmpData' WHERE `id`='$id'";
 }
 if (mysqli_query($conn, $sql)) {
  @unlink(trim($xDoc, "../"));
  echo "OK";
 } else {
  echo mysqli_error($conn);
 }
}

if (@$_POST["mode"] == "school") {
 extract($_POST);
 if ($parm == "adoc1") {
  $tmpSql = "SELECT `adoc1` FROM `tb_taward_school` WHERE `id`='$id'";
  $tmpResult = mysqli_query($conn, $tmpSql);
  $xDoc = mysqli_fetch_row($tmpResult)[0];
  if ($_FILES["tmpData"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["tmpData"]["tmp_name"];
   $filename = basename($_FILES["tmpData"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `tb_taward_school` SET `adoc1` = '$newname' WHERE `id` = $id";

   }
  }

 } else if ($parm == "adoc2") {
  $tmpSql = "SELECT `adoc2` FROM `tb_taward_school` WHERE `id`='$id'";
  $tmpResult = @mysqli_query($conn, $tmpSql);
  $xDoc = @mysqli_fetch_row($tmpResult)[0];
  if ($_FILES["tmpData"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["tmpData"]["tmp_name"];
   $filename = basename($_FILES["tmpData"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `tb_taward_school` SET `adoc2` = '$newname' WHERE `id` = $id";

   }
  }
 } else {
  $sql = "UPDATE `tb_taward_school` SET `$parm` = '$tmpData' WHERE `id`='$id'";
 }
 if (mysqli_query($conn, $sql)) {
  @unlink(trim($xDoc, "../"));
  echo "OK";
 } else {
  echo mysqli_error($conn);
 }
}
