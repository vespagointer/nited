<?php
@session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}

if (isset($_GET["mode"])) {
 define("KRITSADAPONG", true);
 require_once "../conn.php";
 extract($_GET);

 if ($mode == "scout") {
  $sql = "SELECT * FROM `tb_scout` WHERE `id`='$fid'";
  if ($result = mysqli_query($conn, $sql)) {
   $data = mysqli_fetch_array($result);
   $file = "../scout/" . $data["year"] . "/" . $data["filename"];
   if (@unlink($file)) {
    $fid = $data["id"];
    $sql2 = "DELETE FROM `tb_scout` WHERE`id`='$fid'";
    mysqli_query($conn, $sql2);
   }
  }
 }

 if ($mode == "redcross") {
  $sql = "SELECT * FROM `tb_redcross` WHERE `id`='$fid'";
  if ($result = mysqli_query($conn, $sql)) {
   $data = mysqli_fetch_array($result);
   $file = "../redcross/" . $data["year"] . "/" . $data["filename"];
   if (@unlink($file)) {
    $fid = $data["id"];
    $sql2 = "DELETE FROM `tb_redcross` WHERE`id`='$fid'";
    mysqli_query($conn, $sql2);
   }
  }
 }

}
@header("location:index.php?module=scout");
