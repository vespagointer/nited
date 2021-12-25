<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}
define("KRITSADAPONG", true);
require_once "../conn.php";

//echo $BookNo . "<br />";
$bid = 0;
extract(@$_POST);
$today    = date("Y-m-d H:i:s");
$BookNo   = htmlentities($BookNo);
$BookName = htmlentities($BookName);
if ($mode == "addbook") {
 $GotNo    = htmlentities($GotNo);
 $BookFrom = htmlentities($BookFrom);

 $sql = "INSERT INTO `tb_book` VALUES (NULL,'$BookNo','$BookDate','$GotNo','$GotDate','$BookName','$BookFrom','$person','$today' )";
 if (mysqli_query($conn, $sql)) {
  $bid = mysqli_insert_id($conn);
 }
 $b = "book";
} else if ($mode == "addnewbook") {
 $BookTo = htmlentities($BookTo);
 $sql    = "INSERT INTO `tb_newbook` VALUES (NULL,'$BookID','$BookNo','$BookDate','$BookName','$BookTo','$person','$today' )";
 if (mysqli_query($conn, $sql)) {
  $bid = mysqli_insert_id($conn);
  $b   = "newbook";
 }
}

$year   = date('Y') + 543;
$folder = "../files/" . $year;
if (!@is_dir($folder)) {
 $oldmask = umask(0);
 mkdir($folder, 0777);
 umask($oldmask);
 fopen($folder . "/index.html", "w");
}

//echo $bid;
$name = $bid . "_" . (date('Y') + 543) . date("mdHis");
foreach ($_FILES["att"]["error"] as $key => $error) {
 if ($error == UPLOAD_ERR_OK) {
  $tmp_name = $_FILES["att"]["tmp_name"][$key];
  // basename() may prevent filesystem traversal attacks;
  // further validation/sanitation of the filename may be appropriate
  $filename = basename($_FILES["att"]["name"][$key]);
  $ext      = pathinfo($filename, PATHINFO_EXTENSION);
  if (strtoupper($ext) == "PHP") {exit();}

  $newname = $b . $name . "_" . $key . "." . $ext;

  $filename = $attName[$key];
  if (empty($filename)) {
   $filename = "เอกสารที่ " . ((int) $key + 1);
  }
  //echo $newname . "<br />";
  if (move_uploaded_file($tmp_name, "$folder/$newname")) {
   $sql = "INSERT INTO `tb_file` VALUES (NULL,'$b','$bid','$year','$newname','$filename')";
   mysqli_query($conn, $sql);
  }
 }
}
@header("location:index.php?module=" . $b . "detail&id=" . $bid);

//htmlentities
//html_entity_decode

//extract(@$_FILES);
//echo $att["name"][0];
//echo $name;