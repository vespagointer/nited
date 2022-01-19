<?php
require_once "simpleimage.php";
$base = "pictures";
$y = date('Y') + 543;
$m = date('m');

$folder = $base . DIRECTORY_SEPARATOR . $y . DIRECTORY_SEPARATOR . $m;
if (!@is_dir($base)) {
 $oldmask = umask(0);
 mkdir($base, 0777);
 umask($oldmask);
 fopen($base . DIRECTORY_SEPARATOR . "index.html", "w");
}
$sub = $base . DIRECTORY_SEPARATOR . $y;
if (!@is_dir($sub)) {
 $oldmask = umask(0);
 mkdir($sub, 0777);
 umask($oldmask);
 fopen($sub . DIRECTORY_SEPARATOR . "index.html", "w");
}

if (!@is_dir($folder)) {
 $oldmask = umask(0);
 mkdir($folder, 0777);
 umask($oldmask);
 fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
}

if (isset($_FILES["upload"])) {
 @$tmp_name = $_FILES["upload"]["tmp_name"];
 $filename = basename($_FILES["upload"]["name"]);
 $ext = pathinfo($filename, PATHINFO_EXTENSION);
 $x = time();
 $name = $folder . DIRECTORY_SEPARATOR . $x . "." . $ext;
 $image = new SimpleImage($tmp_name);
 $image->maxarea(1024);
 $image->save($name);

 //if (move_uploaded_file($tmp_name, $name)) {
 // $name = $base . "/" . $y . "/" . $m . "/" . $x . "." . $ext;$name
 if (file_exists($name)) {
  $name = str_replace("\\", "/", $name);
  echo "{";
  echo "\"uploaded\": true,";
  echo "\"url\": \"../$name\"";
  echo "}";
 } else {
  echo "{";
  echo "\"uploaded\": false";
  echo "}";
 }
}
