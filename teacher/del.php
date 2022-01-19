<?php
@session_start();
if ($_SESSION["ss_status"] != "teacher") {@header("location:../index.php");}

define("KRITSADAPONG", true);
require_once "../conn.php";
$id = $_GET["id"];
$do = $_GET["do"];

if ($do == "self") {
 $sql = "SELECT * FROM `tb_taward_self` WHERE `id`='$id'";
 if ($result = mysqli_query($conn, $sql)) {
  $data = mysqli_fetch_assoc($result);
  $file1 = $data["adoc1"];
  $file2 = $data["adoc2"];

  @unlink($file1);
  @unlink($file2);

  $sql2 = "DELETE FROM `tb_taward_self` WHERE`id`='$id'";
  if (mysqli_query($conn, $sql2)) {
   echo "OK";
  } else {
   echo mysqli_error($conn);
  }
 }
}

if ($do == "school") {
 $sql = "SELECT * FROM `tb_taward_school` WHERE `id`='$id'";
 if ($result = mysqli_query($conn, $sql)) {
  $data = mysqli_fetch_assoc($result);
  $file1 = $data["adoc1"];
  $file2 = $data["adoc2"];

  @unlink($file1);
  @unlink($file2);

  $sql2 = "DELETE FROM `tb_taward_school` WHERE`id`='$id'";
  if (mysqli_query($conn, $sql2)) {
   echo "OK";
  } else {
   echo mysqli_error($conn);
  }
 }
}

if ($do == "student") {
 $sql = "SELECT * FROM `tb_taward_student` WHERE `id`='$id'";
 if ($result = mysqli_query($conn, $sql)) {
  $data = mysqli_fetch_assoc($result);
  $file1 = $data["adoc1"];
  $file2 = $data["adoc2"];

  @unlink($file1);
  @unlink($file2);

  $sql2 = "DELETE FROM `tb_taward_student` WHERE`id`='$id'";
  if (mysqli_query($conn, $sql2)) {
   echo "OK";
  } else {
   echo mysqli_error($conn);
  }
 }
}

if ($do == "deltrain1") {
 $sql = "SELECT * FROM `tb_train1` WHERE `id`='$id'";
 if ($result = mysqli_query($conn, $sql)) {
  $data = mysqli_fetch_assoc($result);
  $file1 = $data["tDoc"];

  @unlink($file1);

  $sql2 = "DELETE FROM `tb_train1` WHERE`id`='$id'";
  if (mysqli_query($conn, $sql2)) {
   echo "OK";
  } else {
   echo mysqli_error($conn);
  }
 }
}

if ($do == "deltrain2") {
 $sql = "SELECT * FROM `tb_train2` WHERE `id`='$id'";
 if ($result = mysqli_query($conn, $sql)) {
  $data = mysqli_fetch_assoc($result);
  $file1 = $data["tDoc"];

  @unlink($file1);

  $sql2 = "DELETE FROM `tb_train2` WHERE`id`='$id'";
  if (mysqli_query($conn, $sql2)) {
   echo "OK";
  } else {
   echo mysqli_error($conn);
  }
 }
}
