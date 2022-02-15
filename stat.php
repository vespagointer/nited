<?php
/*define("KRITSADAPONG", true);
require_once "conn.php";
require_once "db.php";

$id = (int) $_GET["id"];*/
$sql = "SELECT `tb_teacher`.`id`FROM `tb_train1`INNER JOIN `tb_teacher`on `tb_train1`.`tid`=`tb_teacher`.`id` WHERE `tb_teacher`.`sc_id`=$id";
$result = mysqli_query($conn, $sql);
$train1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
$train1 = array_unique(array_column($train1, "id"));
$cnt_train1 = count($train1);
upstat($conn, "train1", $cnt_train1, $id);

$sql = "SELECT `tb_teacher`.`id`FROM `tb_train2`INNER JOIN `tb_teacher`on `tb_train2`.`tid`=`tb_teacher`.`id` WHERE `tb_teacher`.`sc_id`=$id";
$result = mysqli_query($conn, $sql);
$train2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
$train2 = array_unique(array_column($train2, "id"));
$cnt_train2 = count($train2);
upstat($conn, "train2", $cnt_train2, $id);

$sql = "SELECT `tb_teacher`.`id`FROM `tb_taward_school`INNER JOIN `tb_teacher`on `tb_taward_school`.`tid`=`tb_teacher`.`id` WHERE `tb_teacher`.`sc_id`=$id";
$result = mysqli_query($conn, $sql);
$school = mysqli_fetch_all($result, MYSQLI_ASSOC);
$school = array_unique(array_column($school, "id"));
$cnt_school = count($school);
upstat($conn, "school", $cnt_school, $id);

$sql = "SELECT `tb_teacher`.`id`FROM `tb_taward_self`INNER JOIN `tb_teacher`on `tb_taward_self`.`tid`=`tb_teacher`.`id` WHERE `tb_teacher`.`sc_id`=$id";
$result = mysqli_query($conn, $sql);
$self = mysqli_fetch_all($result, MYSQLI_ASSOC);
$self = array_unique(array_column($self, "id"));
$cnt_self = count($self);
upstat($conn, "self", $cnt_self, $id);

$sql = "SELECT `tb_teacher`.`id`FROM `tb_taward_student`INNER JOIN `tb_teacher`on `tb_taward_student`.`tid`=`tb_teacher`.`id` WHERE `tb_teacher`.`sc_id`=$id";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_all($result, MYSQLI_ASSOC);
$student = array_unique(array_column($student, "id"));
$cnt_student = count($student);
upstat($conn, "student", $cnt_student, $id);

$sql = "SELECT `tb_teacher`.`id`FROM `tb_tpublish`INNER JOIN `tb_teacher`on `tb_tpublish`.`tid`=`tb_teacher`.`id` WHERE `tb_teacher`.`sc_id`=$id";
$result = mysqli_query($conn, $sql);
$publish = mysqli_fetch_all($result, MYSQLI_ASSOC);
$publish = array_unique(array_column($publish, "id"));
$cnt_publish = count($publish);
upstat($conn, "tpublish", $cnt_publish, $id);

$sql = "SELECT count(`id`) FROM `tb_uproject` WHERE `scid`=$id";
$result = mysqli_query($conn, $sql);
$cnt_project = mysqli_fetch_row($result)[0];

$sql = "SELECT count(`id`) FROM `tb_aproject` WHERE `scid`=$id AND ptype=1";
$result = mysqli_query($conn, $sql);
$cnt_scproject = mysqli_fetch_row($result)[0];

$sql = "SELECT count(`id`) FROM `tb_aproject` WHERE `scid`=$id AND ptype=2";
$result = mysqli_query($conn, $sql);
$cnt_exproject = mysqli_fetch_row($result)[0];

$sumproject = $cnt_project + $cnt_scproject + $cnt_exproject;
upstat($conn, "project", $sumproject, $id);

$sql = "SELECT count(`id`) FROM `tb_scaward` WHERE `sc_id`=$id";
$result = mysqli_query($conn, $sql);
$cnt_scaward = mysqli_fetch_row($result)[0];
upstat($conn, "award", $cnt_scaward, $id);

$sql = "SELECT count(`id`) FROM `tb_scpr` WHERE `sc_id`=$id";
$result = mysqli_query($conn, $sql);
$cnt_scpr = mysqli_fetch_row($result)[0];
upstat($conn, "pr", $cnt_scpr, $id);

$sql = "SELECT count(`id`) FROM `tb_gallery` WHERE `sc_id`=$id";
$result = mysqli_query($conn, $sql);
$cnt_gallery = mysqli_fetch_row($result)[0];
upstat($conn, "gallery", $cnt_gallery, $id);

$sql = "SELECT count(`id`) FROM `tb_teacher` WHERE `sc_id`=$id AND `dep`!=11";
$result = mysqli_query($conn, $sql);
$cnt_teacher = mysqli_fetch_row($result)[0];
upstat($conn, "teacher", $cnt_teacher, $id);

$arr_all = array_unique(array_merge($train1, $train2, $school, $self, $student, $publish));
$cnt_all = count($arr_all);
upstat($conn, "all", $cnt_all, $id);

$per_train1 = sprintf("%.2f", ($cnt_train1 * 100) / $cnt_teacher);
upstat($conn, "per_train1", $per_train1, $id);

$per_train2 = sprintf("%.2f", ($cnt_train2 * 100) / $cnt_teacher);
upstat($conn, "per_train2", $per_train2, $id);

$per_school = sprintf("%.2f", ($cnt_school * 100) / $cnt_teacher);
upstat($conn, "per_school", $per_school, $id);

$per_self = sprintf("%.2f", ($cnt_self * 100) / $cnt_teacher);
upstat($conn, "per_self", $per_self, $id);

$per_student = sprintf("%.2f", ($cnt_student * 100) / $cnt_teacher);
upstat($conn, "per_self", $per_self, $id);

$per_publish = sprintf("%.2f", ($cnt_publish * 100) / $cnt_teacher);
upstat($conn, "per_tpublish", $per_publish, $id);

$per_all = sprintf("%.2f", ($cnt_all * 100) / $cnt_teacher);
upstat($conn, "perupdate", $per_all, $id);

$cValue = "[$per_train1,$per_train2,$per_school,$per_self,$per_student,$per_publish,$per_all]";
$cLabel = "['อบรม','พัฒนาตนเอง','รางวัลพัฒนาโรงเรียน','รางวัลพัฒนาตนเอง','รางวัลพัฒนานักเรียน','เยอแพร่ผลงาน','รวม']";

$sValue = "[$cnt_project,$cnt_scproject,$cnt_exproject,$cnt_scaward,$cnt_scpr,$cnt_gallery]";
$sLabel = "['โครงการ สพม.','โครงการโรงเรียน','โครงการภายนอก','ผลงานโรงเรียน','ข่าวประชาสัมพันธ์','ภาพกิจกรรม']";

?>

<div class="mb-5">
    <h5 class="text-center mt-4 mb-2 fw-bold text-primary">สถิติการรายงานของโรงเรียน</h5>
    <canvas id="sChart"></canvas>
    <h5 class="text-center mt-4 mb-2 fw-bold text-primary">สถิติการรายงานของครู</h5>
    <canvas id="tChart"></canvas>
</div>

<script>
var cValue = <?=$cValue;?>;
var cLabel = <?=$cLabel;?>;

var sValue = <?=$sValue;?>;
var sLabel = <?=$sLabel;?>;
</script>
