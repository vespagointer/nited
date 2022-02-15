<?php
session_start();
$id = $_SESSION["ss_id"];
require_once "../simpleimage.php";
$base = "pictures" . DIRECTORY_SEPARATOR . "profile";

if (isset($_FILES["img"])) {
 @$tmp_name = $_FILES["img"]["tmp_name"];
 $filename = basename($_FILES["img"]["name"]);
 //$ext = pathinfo($filename, PATHINFO_EXTENSION);
 $name = ".." . DIRECTORY_SEPARATOR . $base . DIRECTORY_SEPARATOR . $id . ".jpg";
 if (file_exists($name)) {
  unlink($name);
 }
 $image = new SimpleImage($tmp_name);
 //$image->maxarea(200);
 $image->resizeToHeight(300);
 $image->save($name);

 if (file_exists($name)) {
  $name = str_replace("\\", "/", $name);
  echo $name;
 } else {
  echo "FAIL";
 }
}
