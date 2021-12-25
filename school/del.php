<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}

define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";

$sc_id = $_SESSION["ss_id"];
$m = @$_GET["m"];
$id = @$_GET["id"];
if ($m == "pr") {
 $sql = "DELETE FROM `tb_scpr` WHERE `id` = $id AND `sc_id`=$sc_id";
 if (mysqli_query($conn, $sql)) {
  echo "OK";
  dec_stat($conn, $sc_id, "pr");
 } else {
  echo mysqli_error($conn);
 }
}