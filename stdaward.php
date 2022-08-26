<?php
@define("KRITSADAPONG", true);
require_once "conn.php";
require_once "db.php";
if (isset($_GET["scid"]) and (int) $_GET["scid"] != 0) {
    $scid = $_GET["scid"];
    $sql = "SELECT * FROM `tb_studentaward` WHERE `sc_id`=$scid ORDER BY `id` ASC";
} else {
    $sql = "SELECT * FROM `tb_studentaward` ORDER BY `id` ASC";
}
?>

<div class="mt-3">
    <div class="text-center mb-3 fw-bold text-primary">
        <h3>รางวัลที่นักเรียนได้รับ</h3>
        <?php
if (isset($scid)) {
    echo "<h4 >โรงเรียน" . getschool($conn, "name", $scid) . "</h4>";
}
?>
    </div>
    <div class="clearfix mb-3"></div>
    <div class="mt-3">
        <table class="table table-hover mt-3" id="stdaward">
            <thead>
                <tr>
                    <th>#</th>
                    <?php if (!isset($_GET["scid"])) {?>
                    <th>โรงเรียน</th>
                    <?php }?>
                    <th>ชื่อรางวัล</th>
                    <th>ระดับ</th>
                    <th>รายชื่อนักเรียน</th>
                    <th>ปีการศึกษา</th>
                    <th>หน่วยงานที่มอบ</th>
                    <th>วันที่ได้รับรางวัล</th>
                </tr>
            </thead>
            <tbody>
                <?php

$result = mysqli_query($conn, $sql);
//$nost = mysqli_num_rows($result);
$i = 1;
while ($data = @mysqli_fetch_assoc($result)) {
    @extract($data);
    ?>
                <tr>
                    <td><?=$i;?></td>
                    <?php if (!isset($_GET["scid"])) {?>
                    <td><?=LinkSchool($conn, $sc_id);?></td>
                    <?php }?>
                    <td><a href="index.php?module=stdawdshow&id=<?=$id;?>" target="_blank"><?=$name;?></a></td>
                    <td><?=$rank;?></td>
                    <td>
                        <?php
$arr = explode(',', $student);
    foreach ($arr as $val) {
        echo $val . "<br>";
    }
    ?>
                    </td>
                    <td><?=$year;?></td>
                    <td><?=$organize;?></td>
                    <td><?=renderDate3($adate);?></td>
                </tr>
                <?php
$i++;
}
?>
            </tbody>
        </table>
    </div>


</div>