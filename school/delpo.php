<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:login.php");}
if ($_SESSION["ss_status"] != "school") {@header("location:../logout.php");}
define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";
$scid = $_SESSION["ss_id"];
$id = $_POST["pid"];
//var_dump($_POST);
$sql = "DELETE FROM `tb_aproject` WHERE `id`='$id'";
if (mysqli_query($conn, $sql)) {
    dec_stat($conn, $scid, "project");
    echo "OK";
} else {
    echo mysqli_error($conn);
}