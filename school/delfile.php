<?php
@session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}

if (isset($_GET["mode"])) {
 define("KRITSADAPONG", true);
 require_once "../conn.php";
 extract($_GET);

 if ($mode == "award") {
  $sql = "SELECT * FROM `tb_scafile` WHERE `id`='$fid'";
  if ($result = mysqli_query($conn, $sql)) {
   $data = mysqli_fetch_array($result);
   $file = "../scafiles/" . $data["year"] . "/" . $data["filename"];
   if (@unlink($file)) {
    $fid = $data["id"];
    $sql2 = "DELETE FROM `tb_scafile` WHERE`id`='$fid'";
    mysqli_query($conn, $sql2);
   }
  }
 }
}
@header("location:index.php?module=" . $mode . "detail&id=" . $aid);