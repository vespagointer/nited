<?php
session_start();
if ($_SESSION["ss_status"] != "admin") {@header("location:../user/");}
define("KRITSADAPONG", true);

$id = $_GET["id"];
require_once "../conn.php";
$sql = "DELETE FROM `tb_user` WHERE `id` = '$id'";
mysqli_query($conn, $sql);

header("location:index.php?module=listuser");

//echo $id;
