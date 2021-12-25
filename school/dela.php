<?php
@session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}
$sc_id = $_SESSION["ss_id"];
define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";

if (@$_GET["do"] == "del") {
 @$id = $_GET["id"];
 $sql = "DELETE FROM `tb_scaward` WHERE `id`=$id";
 if (mysqli_query($conn, $sql)) {
  dec_stat($conn, $sc_id, "award");
  echo ("OK");
 } else {
  echo (mysqli_error($conn));
 }

 $sql2 = "SELECT * FROM `tb_scafile` WHERE `aid`='$id'";
 $result2 = mysqli_query($conn, $sql2);
 while ($data2 = mysqli_fetch_array($result2)) {
  $file = "../scafiles/" . $data2["year"] . "/" . $data2["filename"];
  //echo $file;
  @unlink($file);
  $fid = $data2["id"];
  $sql3 = "DELETE FROM `tb_file` WHERE`id`='$fid'";
  mysqli_query($conn, $sql3);
 }
}