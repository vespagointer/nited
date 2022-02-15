<?php
$sql = "SELECT `id`,`name` FROM `tb_school`";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_row($result)) {
 $school[$data[0]] = $data[1];
}

$sql = "SELECT `id`,`name` FROM `tb_dep`";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_row($result)) {
 $depname[$data[0]] = $data[1];
}

$sql = "UPDATE `tb_teacher` SET  `tb_teacher`.`upd`=TRUE WHERE EXISTS (SELECT NULL FROM `tb_train1` WHERE `tb_teacher`.`id` = `tb_train1`.`tid`)";
mysqli_query($conn, $sql);

$sql = "UPDATE `tb_teacher` SET  `tb_teacher`.`upd`=TRUE WHERE EXISTS (SELECT NULL FROM `tb_train2` WHERE `tb_teacher`.`id` = `tb_train2`.`tid`)";
mysqli_query($conn, $sql);

$sql = "UPDATE `tb_teacher` SET  `tb_teacher`.`upd`=TRUE WHERE EXISTS (SELECT NULL FROM `tb_taward_student` WHERE `tb_teacher`.`id`  = `tb_taward_student`.`tid`)";
mysqli_query($conn, $sql);

$sql = "UPDATE `tb_teacher` SET  `tb_teacher`.`upd`=TRUE WHERE EXISTS (SELECT NULL FROM `tb_taward_self` WHERE `tb_teacher`.`id`  = `tb_taward_self`.`tid`)";
mysqli_query($conn, $sql);

$sql = "UPDATE `tb_teacher` SET  `tb_teacher`.`upd`=TRUE WHERE EXISTS (SELECT NULL FROM `tb_taward_student` WHERE `tb_teacher`.`id`  = `tb_taward_student`.`tid`)";
mysqli_query($conn, $sql);

$sql = "UPDATE `tb_teacher` SET  `tb_teacher`.`upd`=TRUE WHERE EXISTS (SELECT NULL FROM `tb_tpublish` WHERE `tb_teacher`.`id`  = `tb_tpublish`.`tid`)";
mysqli_query($conn, $sql);

require_once "db.php";
if (isset($_GET["scid"]) && (int) $_GET["scid"] != 0) {
 $scid = (int) $_GET["scid"];
 $sql = "SELECT `id`,`sc_id`,`name`,`pos`,`dep`,`upd` FROM `tb_teacher` WHERE `sc_id`=$scid";
} else {
 $sql = "SELECT `id`,`sc_id`,`name`,`pos`,`dep`,`upd` FROM `tb_teacher` WHERE `sc_id`!=99 AND `sc_id`!=0";
}
$result = mysqli_query($conn, $sql);

?>

<div class="row mt-md-3">
    <div class="text-center mb-2">
        <h3>รายชื่อบุคลากร สังกัด สพม.น่าน</h3>
        <?php
if (isset($scid)) {
 echo "<h5 class='mb-3'>โรงเรียน" . getschool($conn, "name", $scid) . "</h5>";
}
?>
    </div>
    <table class="display nowrap mb-2" id="teacher" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">โรงเรียน</th>
                <th class="text-center">ชื่อ - สกุล</th>
                <th class="text-center">ตำแหน่ง</th>
                <th class="text-center">กลุ่มสาระฯ</th>
                <th class="text-center">กรอกข้อมูล</th>
            </tr>
        </thead>
        <tbody>
            <?php

while ($data = mysqli_fetch_assoc($result)):
 extract($data);
 if ($upd == true) {
  $ck = '<i class="fas fa-check text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="กรอกข้อมูลแล้ว"></i>';
 } else {
  $ck = '<i class="far fa-times-circle text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="ยังไม่กรอกข้อมูล"></i>';
 }
 if ($dep == 11) {
  $ck = "";
 }
 ?>
            <tr>
                <td><?=$school[$sc_id];?></td>
                <td><a href="index.php?module=profile&id=<?=$id;?>"><?=$name;?></a></td>
                <td><?=$pos;?></td>
                <td><?=$depname[$dep];?></td>
                <td class="text-center"><?=$ck;?></td>
            </tr>
            <?php endwhile?>
        </tbody>
    </table>
</div>
