<?php
@session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}
if ($_SESSION["ss_status"] != "school") {@header("location:../logout.php");}
$sc_id = $_SESSION["ss_id"];
define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";

if (@$_GET["do"] == "del") {
    @$id = $_GET["id"];
    $sql = "DELETE FROM `tb_studentaward` WHERE `id`=$id";
    if (mysqli_query($conn, $sql)) {
        dec_stat($conn, $sc_id, "award");
        echo ("OK");
    } else {
        echo (mysqli_error($conn));
    }

    $sql2 = "SELECT * FROM `tb_stdawdfile` WHERE `aid`='$id'";
    $result2 = mysqli_query($conn, $sql2);
    while ($data2 = mysqli_fetch_array($result2)) {
        $file = "../stdawdfile/" . $data2["year"] . "/" . $data2["file"];
        //echo $file;
        @unlink($file);
        $fid = $data2["id"];
        $sql3 = "DELETE FROM `tb_stdawdfile` WHERE`id`='$fid'";
        mysqli_query($conn, $sql3);
    }
}