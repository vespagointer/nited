<?php
//session_start();
//if ($_SESSION["logined"] != true || $_SESSION["ss_status"] != "teacher") {@header("location:index.php");}
define("KRITSADAPONG", true);
require_once "conn.php";
require_once "db.php";
$type = $_GET["type"];
$id = (int) $_GET["id"];
$dbTable = sprintf("tb_%s", $type);
if ($type == "train1" || $type == "train2") {
 $doc = DocTrain($conn, $dbTable, $id);
}

if ($type == "self" || $type == "school" || $type == "student") {
 $parm = $_GET["parm"];
 $dbTable = sprintf("tb_taward_%s", $type);
 $doc = DocAward($conn, $parm, $dbTable, $id);
}

echo "<a href='$doc' target='_blank'><i class='fas fa-file-contract'></i></a>&nbsp;";
