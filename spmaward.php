<?php
@define("KRITSADAPONG", true);
require_once "conn.php";
require_once "db.php";
?>

<div class="mt-md-3">

    <?php

$scid = 99;
$sql = "SELECT * FROM `tb_scaward` WHERE `sc_id`=$scid ORDER BY `id` ASC";

$result = mysqli_query($conn, $sql);
?>
    <div class="text-center mb-3">
        <h3>รางวัลที่ได้รับ</h3>
        ?>
    </div>
    <table class="display mb-2" id="scaward" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อรางวัล</th>
                <th>หน่วยงานที่มอบ</th>
                <th>วันที่ได้รับ</th>
                <th>ปี</th>
            </tr>
        </thead>
        <tbody>
            <?php
$i = 1;
while ($data = mysqli_fetch_assoc($result)):

?>
            <tr>
                <td><?=$i;?></td>
                <td><a href="index.php?module=showaward&id=<?=$data["id"];?>" target="_blank"><?=$data["name"];?></a>
                </td>
                <td><?=$data["afrom"];?></td>
                <td><?=renderDate3($data["adate"]);?></td>
                <td><?=explode("/", $data["adate"])[2];?></td>
            </tr>
            <?php
$i++;
endwhile;
?>
        </tbody>
    </table>
