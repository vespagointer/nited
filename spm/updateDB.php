<?php
session_start();

if (@$_SESSION["ss_status"] != "spm") {
 exit("ACCESS DENINED!");
}

define("KRITSADAPONG", true);
require_once "../conn.php";

try {
 $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pwd);
 // set the PDO error mode to exception
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 //echo "Connected successfully";
} catch (PDOException $e) {
 echo "Connection failed: " . $e->getMessage();
}
$db->exec("SET NAMES utf8");

extract($_POST);
//$id = (int) $id;
if ($parm == "spmdep" && $mode == "teacher") {

 try {
  $stmt = $db->prepare("SELECT `name` FROM `tb_spmdep` WHERE `tid`=:id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
   try {
    $stmt = $db->prepare("UPDATE `tb_spmdep` SET `name` = :tmpData WHERE `tid`=:id");
    $stmt->bindParam(':tmpData', $tmpData);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "OK";
   } catch (PDOException $e) {
    echo $e->getMessage();
   }
  } else {
   try {
    $stmt = $db->prepare("INSERT INTO  `tb_spmdep` (`tid`,`name`) VALUES(:id,:tmpData)");
    $stmt->bindParam(':tmpData', $tmpData);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "OK";
   } catch (PDOException $e) {
    echo $e->getMessage();
   }
  }
 } catch (PDOException $e) {
  echo $e->getMessage();
 }
}

if ($parm != "spmdep" && $mode == "teacher") {
 try {
  $stmt = $db->prepare("UPDATE tb_teacher SET `$parm` = :tmpData WHERE `id`=:id");
  $stmt->bindParam(':tmpData', $tmpData);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  echo "OK";
 } catch (PDOException $e) {
  echo $e->getMessage();
 }
}

if (@$_GET["do"] == "delt") {
 try {
  $stmt = $db->prepare("DELETE FROM tb_teacher WHERE `id`=:id");
  $stmt->bindParam(':id', $_GET["id"]);
  $stmt->execute();
  echo "OK";
 } catch (PDOException $e) {
  echo $e->getMessage();
 }
}

$db = null;
