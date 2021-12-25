<?php
@session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}

define("KRITSADAPONG", true);
require_once "../conn.php";
$url_id = $_GET["id"];

$sql2    = "SELECT `surl` FROM `urls` WHERE `url_id`='$url_id'";
$result2 = mysqli_query($conn, $sql2);
$data2   = mysqli_fetch_array($result2);
$file    = "../qrcode/" . $data2["surl"] . ".png";
//echo $file;
@unlink($file);
$sql3 = "DELETE FROM `urls` WHERE `url_id`='$url_id'";
mysqli_query($conn, $sql3);

@header("location:index.php?module=shorturl");