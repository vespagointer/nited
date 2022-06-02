<?php

function inc_stat($conn, $id, $name)
{
 $parm = "sc" . $id;
 $sql = "SELECT `$parm` FROM `tb_statistics` WHERE `name`='$name'";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_row($result);
 $tmpData = $data[0];
 $tmpData++;

 $sql = "UPDATE `tb_statistics` SET `$parm` = '$tmpData' WHERE `name`='$name'";
 return mysqli_query($conn, $sql);
}

function dec_stat($conn, $id, $name)
{
 $parm = "sc" . $id;
 $sql = "SELECT `$parm` FROM `tb_statistics` WHERE `name`='$name'";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_row($result);
 $tmpData = $data[0];
 $tmpData--;

 $sql = "UPDATE `tb_statistics` SET `$parm` = '$tmpData' WHERE `name`='$name'";
 return mysqli_query($conn, $sql);
}

function getschool($conn, $parm, $id)
{
 $sql = "SELECT `$parm` FROM `tb_school` WHERE `id`='$id'";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_row($result);
 return $data[0];
}

function getteacher($conn, $parm, $id)
{
 $sql = "SELECT `$parm` FROM `tb_teacher` WHERE `id`='$id'";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_row($result);
 return $data[0];
}

function LinkTeacher($conn, $id)
{
 $link = "<a href=\"index.php?module=profile&id=$id\" target=\"_blank\">";
 $link .= getteacher($conn, "name", $id);
 $link .= "</a>";
 return $link;
}

function LinkSchool($conn, $id)
{
 $link = "<a href=\"index.php?module=showschool&id=$id\" target=\"_blank\">โรงเรียน";
 $link .= getschool($conn, "name", $id);
 $link .= "</a>";
 return $link;
}

function LinkSchool2($conn, $id)
{
 $link = "<a href=\"index.php?module=showschool&id=$id\" target=\"_blank\">";
 $link .= getschool($conn, "name", $id);
 $link .= "</a>";
 return $link;
}

function getdep($conn, $id)
{
 $sql = "SELECT `name` FROM `tb_dep` WHERE `id`='$id'";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_row($result);
 return $data[0];
}

function renderDate($date)
{
 $month = array(
  "01" => "มกราคม",
  "02" => "กุมภาพันธ์",
  "03" => "มีนาคม",
  "04" => "เมษายน",
  "05" => "พฤษภาคม",
  "06" => "มิถุนายน",
  "07" => "กรกฎาคม",
  "08" => "สิงหาคม",
  "09" => "กันยายน",
  "10" => "ตุลาคม",
  "11" => "พฤศจิกายน",
  "12" => "ธันวาคม",
 );
 $list = explode("-", $date);
 $thaiDate = (int) $list[2] . " " . $month[$list[1]] . " " . $list[0];
 return $thaiDate;
}

function renderYear($date)
{

 $list = explode("-", $date);
 $thaiDate = (int) $list[2] . " " . $month[$list[1]] . " " . $list[0];
 return $thaiDate;
}

function renderDate2($date)
{
 $month = array(
  "01" => "มกราคม",
  "02" => "กุมภาพันธ์",
  "03" => "มีนาคม",
  "04" => "เมษายน",
  "05" => "พฤษภาคม",
  "06" => "มิถุนายน",
  "07" => "กรกฎาคม",
  "08" => "สิงหาคม",
  "09" => "กันยายน",
  "10" => "ตุลาคม",
  "11" => "พฤศจิกายน",
  "12" => "ธันวาคม",
 );
 $list = explode("-", $date);
 $thaiDate = (int) $list[2] . " " . $month[$list[1]] . " " . ((int) $list[0] + 543);
 return $thaiDate;
}

function renderDate3($date)
{
 $month = array(
  "01" => "มกราคม",
  "02" => "กุมภาพันธ์",
  "03" => "มีนาคม",
  "04" => "เมษายน",
  "05" => "พฤษภาคม",
  "06" => "มิถุนายน",
  "07" => "กรกฎาคม",
  "08" => "สิงหาคม",
  "09" => "กันยายน",
  "10" => "ตุลาคม",
  "11" => "พฤศจิกายน",
  "12" => "ธันวาคม",
 );
 $list = explode("/", $date);
 $thaiDate = (int) $list[0] . " " . $month[$list[1]] . " " . $list[2];
 return $thaiDate;
}

function renderDate4($date)
{
 $list = explode("-", $date);
 $thaiDate = $list[0] . "/" . $list[1] . "/" . $list[2];
 return $thaiDate;
}

function DocTrain($conn, $table, $id)
{
 $sql = "SELECT `tDoc` FROM `$table` WHERE `id`='$id'";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_row($result);
 return $data[0];
}

function DocAward($conn, $parm, $table, $id)
{
 $sql = "SELECT `$parm` FROM `$table` WHERE `id`='$id'";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_row($result);
 return $data[0];
}

function getSpmDep($conn, $id)
{
 $sql = "SELECT `name` FROM `tb_spmdep` WHERE `tid`='$id'";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_row($result);
 return $data[0];
}

function upstat($conn, $name, $val, $id)
{
 $feild = "sc" . $id;
 $sql = "UPDATE `tb_statistics` SET `$feild` = '$val' WHERE `name`='$name'";
 mysqli_query($conn, $sql);
}

function getstat($conn, $name, $id)
{
 $feild = "sc" . $id;
 $sql = "SELECT `$feild` FROM `tb_statistics` WHERE `name`='$name'";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_row($result);
 return $data[0];
}

function TeacherSchool($conn, $tid)
{
 $sc_id = getteacher($conn, "sc_id", $tid);
 return LinkSchool2($conn, $sc_id);
}
