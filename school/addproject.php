<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:login.php");}
define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";
$scid = $_SESSION["ss_id"];

if (isset($_POST["pid"])) {
 $pid = $_POST["pid"];
 $scname = $_POST["sname"];
 $scperson = $_POST["tname"];
 $sctel = $_POST["tel"];
 $sql = "INSERT INTO `tb_uproject` VALUES(NULL,'$pid','$scid','$scname','$scperson','$sctel')";
 if (mysqli_query($conn, $sql)) {
  inc_stat($conn, $scid, "project");
  echo "OK";
 } else {
  echo mysqli_error($conn);
 }
}

if (isset($_POST["pname"])) {
 $pname = $_POST["pname"];
 $ptype = $_POST["ptype"];
 $funder = $_POST["funder"];
 $scname = $_POST["scname"];
 $scperson = $_POST["scperson"];
 $sctel = $_POST["sctel"];
 $sql = "INSERT INTO `tb_aproject` VALUES(NULL,'$pname','$ptype','$funder','$scid','$scname','$scperson','$sctel')";
 if (mysqli_query($conn, $sql)) {
  inc_stat($conn, $scid, "project");
  echo "OK";
 } else {
  echo mysqli_error($conn);
 }
}