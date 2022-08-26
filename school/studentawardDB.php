<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}
if ($_SESSION["ss_status"] != "school") {@header("location:../logout.php");}

define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";

if (!isset($_POST["submit"])) {
    die("Error");
}

extract($_POST);
$name = mysqli_real_escape_string($conn, $name);
$student = mysqli_real_escape_string($conn, $student);
$organize = mysqli_real_escape_string($conn, $organize);
$sc_id = $_SESSION["ss_id"];

$sql = "INSERT INTO `tb_studentaward` VALUES (NULL,'$sc_id','$name','$rank','$student','$year','$organize','$adate' ) ";

if (mysqli_query($conn, $sql)) {
    $aid = mysqli_insert_id($conn);
} else {
    @header("location:../index.php?module=studentaward");
    @exit();
}

$year = date('Y') + 543;
$folder = "../stdawdfile/" . $year;
if (!@is_dir($folder)) {
    $oldmask = umask(0);
    mkdir($folder, 0777);
    umask($oldmask);
    fopen($folder . "/index.html", "w");
}

$name = $aid . "_" . (date('Y') + 543) . date("mdHis");
foreach ($_FILES["att"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["att"]["tmp_name"][$key];
        $filename = basename($_FILES["att"]["name"][$key]);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (strtoupper($ext) == "PHP") {exit();}

        $newname = $name . "_" . $key . "." . $ext;

        $filename = $attName[$key];
        if (empty($filename)) {
            $filename = "เอกสารที่ " . ((int) $key + 1);
        }

        if (move_uploaded_file($tmp_name, "$folder/$newname")) {
            $sql = "INSERT INTO `tb_stdawdfile` VALUES (NULL,'$aid','$filename','$newname','$year')";
            mysqli_query($conn, $sql);
        }
    }
}

@header("location:index.php?module=studentaward");