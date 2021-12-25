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