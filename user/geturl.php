<?php
session_start();
$id = @$_SESSION["ss_id"];
define("KRITSADAPONG", true);
require_once "../conn.php";
$lurl      = trim(@$_POST["lurl"]);
$name      = htmlspecialchars(trim(@$_POST["name"]));
$surl      = trim(@$_POST["ssurl"]);
$gurl      = trim(@$_POST["gurl"]);
$tmpschool = $_POST["school"][0];
$cr_on     = date("Y-m-d H:i:s");
if (empty($lurl)) {
 die("false");
}
$sql    = "SELECT * FROM `urls` WHERE `lurl`='$lurl'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) >= 1) {
 $data = mysqli_fetch_array($result);
 $surl = $data["surl"];
 die($surl);
}

if (!empty($surl)) {
 $sql    = "SELECT * FROM `urls` WHERE `surl`='$surl'";
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) >= 1) {
  die("dup");
 }
} else {
 do {
  $surl   = substr(md5(time()), 0, 8);
  $sql    = "SELECT * FROM `urls` WHERE `surl`='$surl'";
  $result = mysqli_query($conn, $sql);
 } while (mysqli_num_rows($result) >= 1);
}

if (empty($id)) {
 $id = $anonID;
}
$school = implode(",", $tmpschool);
$sql    = "INSERT INTO `urls` (`url_id`, `id`, `name`, `surl`, `lurl`, `gurl`,`school`,`create_on`) VALUES (NULL, '$id','$name','$surl','$lurl','$gurl','$school','$cr_on')";

if ($result = mysqli_query($conn, $sql)) {
 echo $surl;

 //$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'qrcode' . DIRECTORY_SEPARATOR;
 $PNG_TEMP_DIR = "../qrcode/";
 //html PNG location prefix
 //$PNG_WEB_DIR = 'qrcode/';

 include "../phpqrcode/qrlib.php";

 //ofcourse we need rights to create temp dir
 if (!file_exists($PNG_TEMP_DIR)) {
  mkdir($PNG_TEMP_DIR);
  fopen($PNG_TEMP_DIR . "/index.html", "w");
 }

 $filename = $PNG_TEMP_DIR . $surl . '.png';

 QRcode::png('http://spmnan.ga/' . $surl, $filename, 'Q', '10', 1);
} else {
 //echo "false";
 echo mysqli_error($conn);
}

mysqli_close($conn);
//echo htmlspecialchars_decode(htmlspecialchars($surl));