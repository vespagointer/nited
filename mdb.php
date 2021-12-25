<?php
@$key  = $_GET["key"];
@$key1 = $_GET["key1"];
@$key2 = $_GET["key2"];
@$key3 = $_GET["key3"];
define("KRITSADAPONG", true);
require_once "conn.php";
if (isset($key1)) {
 if ($key1 == 1) {
  $sql = "SELECT `sch_id`,`sch_name` FROM `tb_person` WHERE `sch_id`<=30";
 } else {
  $sql = "SELECT `sch_id`,`sch_name` FROM `tb_person` WHERE `sch_id`>30";
 }
 $result = mysqli_query($conn, $sql);
 $data   = mysqli_fetch_all($result, MYSQLI_ASSOC);
 $array  = array_intersect_key($data, array_unique(array_map('serialize', $data)));
 foreach ($array as $key) {
  extract($key);
  echo "<option value='$sch_id'>$sch_name</option>";
 }
} else if (isset($key2)) {
 $sql    = "SELECT `id`,`name` FROM `tb_person` WHERE `sch_id`=$key2";
 $result = mysqli_query($conn, $sql);
 $data   = mysqli_fetch_all($result, MYSQLI_ASSOC);
 $array  = array_intersect_key($data, array_unique(array_map('serialize', $data)));
 foreach ($array as $key) {
  extract($key);
  echo "<option value='$id'>$name</option>";
 }
} else if (isset($key3)) {
 $sql    = "SELECT * FROM `tb_person` WHERE `id`=$key3";
 $result = mysqli_query($conn, $sql);
 $data   = mysqli_fetch_assoc($result);
 extract($data);
 echo $name . "<br />";
 echo '<span class="fs-5 fw-bold">';
 echo $tel . "</span><br />";
 if ($sch_id <= 30) {
  echo $pos . "โรงเรียน" . $sch_name;
 } else {
  echo $pos . " สพม.น่าน";
 }
} else if (isset($key)) {
 $key    = mysqli_real_escape_string($conn, $key);
 $sql    = "SELECT * FROM `tb_person` WHERE `name` LIKE '%$key%' OR `sch_name` LIKE '%$key%'";
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {
  while ($data = mysqli_fetch_assoc($result)) {
   extract($data);
   echo $name . "<br />";
   echo '<span class="fs-5 fw-bold">';
   echo $tel . "</span><br />";
   if ($sch_id <= 30) {
    echo $pos . "โรงเรียน" . $sch_name;
   } else {
    echo $pos . " สพม.น่าน";
   }
   echo "<hr />";
  }
 } else {
  echo "ไม่พบข้อมูล";
 }
}