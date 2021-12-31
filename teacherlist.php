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

?>
<div class="row mt-md-3">
    <div class="text-center mb-2">
        <h3>รายชื่อครู สังกัด สพม.น่าน</h3>
    </div>
    <table class="display nowrap mb-2" id="teacher" style="width:100%">
        <thead>
            <tr>
                <th>โรงเรียน</th>
                <th>ชื่อ - สกุล</th>
                <th>ตำแหน่ง</th>
                <th>กลุ่มสาระฯ</th>
            </tr>
        </thead>
        <tbody>
            <?php
//require_once "db.php";
$sql = "SELECT `id`,`sc_id`,`name`,`pos`,`dep` FROM `tb_teacher` WHERE `sc_id`<31";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)):
 extract($data);
 ?>
            <tr>
                <td><?=$school[$sc_id];?></td>
                <td><a href="index.php?module=profile&id=<?=$id;?>"><?=$name;?></a></td>
                <td><?=$pos;?></td>
                <td><?=$depname[$dep];?></td>
            </tr>
            <?php endwhile?>
        </tbody>
    </table>
</div>