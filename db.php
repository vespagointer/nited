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