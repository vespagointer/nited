<?php
session_start();
if ($_SESSION["logined"] != true) {
    @header("location:../login.php");
}
define("KRITSADAPONG", true);
require_once "../conn.php";

if (isset($_POST["submit"])) {
    extract($_POST);
    $sql = "INSERT INTO `tb_document` VALUES (NULL,'$name','$number')";

    if (isset($_FILES)) {
        $tmp_name = $_FILES["files"]["tmp_name"];
        $filename = basename($_FILES["files"]["name"]);
        $ext      = pathinfo($filename, PATHINFO_EXTENSION);
        if (strtoupper($ext) == "PHP") {
            exit();
        }
        $newname = $number . "." . $ext;
        $path = "doc/$newname";
        if (file_exists($path)) unlink($path);
        move_uploaded_file($tmp_name, $path);
    }

    if (file_exists($path)) {
        $sql = "INSERT INTO `tb_document` VALUES (NULL,'$name','$number','$newname')";
    } else {
        $sql = "INSERT INTO `tb_document` VALUES (NULL,'$name','$number')";
    }

    mysqli_query($conn, $sql);
    header("location:index.php?module=doc");
}
