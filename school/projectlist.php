<?php
@session_start();
if ($_SESSION["logined"] != true) {@header("location:login.php");}
@define("KRITSADAPONG", true);
require_once "../conn.php";
$scid = $_SESSION["ss_id"];
$sql = "SELECT * FROM `tb_project`";
$result = mysqli_query($conn, $sql);
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
 $pID[$i] = $row['id'];
 $pName[$row["id"]] = $row["pname"];
 $i++;
}

$sql = "SELECT `id`,`pid` FROM `tb_uproject` WHERE `scid`='$scid' ORDER BY `pid` ASC";
$result = mysqli_query($conn, $sql);
//$scpid=[];
$i = 0;
if (mysqli_num_rows($result) > 0) {
 while ($data = mysqli_fetch_assoc($result)) {
  $scpid[$i] = $data["pid"];
  $delID[$data["pid"]] = $data["id"];

  $i++;
 }
}
@$pID = array_diff($pID, $scpid);
@$pID = array_values($pID);
?>

<div class="card mb-3">
    <div class="card-title mt-2 fs-6 fw-bold ps-2">โครงการที่โรงเรียนเข้าร่วม</div>
    <div class="mx-3 mb-4 card-body">
        <?php
if (@count($scpid) > 0) {
 echo "<ol>";
 foreach ($scpid as $key => $id) {
  echo "<li>";
  echo $pName[$id];
  echo " <a data-id='$id' data-del='" . $delID[$id] . "' style='color:red' class='delbtnp' data-bs-toggle='tooltip' data-bs-placement='top' title='ลบ'><i class='fas fa-times'></i></a><br />";
  echo "</li>";
 }
 echo "</ol>";
} else {
 echo "ยังไม่มีข้อมูลโครงการที่เข้าร่วม";
}

?>
    </div>
</div>
<!--
<div class="card mb-3">
    <div class="card-title mt-2 fs-6 fw-bold ps-2">โครงการของโรงเรียน</div>
    <div class="mx-3 mb-4 card-body">
        <?php
$sql = "SELECT * FROM `tb_aproject` WHERE `scid`='$scid' AND `ptype`=1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
 echo "<ol>";
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<li>";
  echo $data["pname"];
  echo " <a data-del='" . $data["id"] . "' style='color:red' class='delbtnpo' data-bs-toggle='tooltip' data-bs-placement='top' title='ลบ'><i class='fas fa-times'></i></a><br />";
  echo "</li>";
 }
 echo "</ol>";
} else {
 echo "ยังไม่มีข้อมูลโครงการในส่วนนี้";
}
?>
    </div>
</div>
-->
<div class="card mb-3">
    <div class="card-title mt-2 fs-6 fw-bold ps-2">โครงการของหน่วยงานอื่น</div>
    <div class="mx-3 mb-4 card-body">
        <?php
$sql = "SELECT * FROM `tb_aproject` WHERE `scid`='$scid' AND `ptype`=2";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
 echo "<ol>";
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<li>";
  echo $data["pname"];
  echo " (" . $data["funder"] . ")";
  echo " <a data-del='" . $data["id"] . "' style='color:red' class='delbtnpo' data-bs-toggle='tooltip' data-bs-placement='top' title='ลบ'><i class='fas fa-times'></i></a><br />";
  echo "</li>";
 }
 echo "</ol>";
} else {
 echo "ยังไม่มีข้อมูลโครงการในส่วนนี้";
}
?>
    </div>
</div>
