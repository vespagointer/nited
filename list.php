<?php
@define("KRITSADAPONG", true);
require_once "conn.php";
require_once "db.php";
?>
<style>
/*table.dataTable.stripe tbody tr.odd,
table.dataTable.display tbody tr.odd {
    background-color: #CDE3F5 !important;
}*/
</style>
<div class="mt-md-3">

    <?php

$mode = $_GET["mode"];
if ($mode == "scpr") {
    if (isset($_GET["scid"]) and (int) $_GET["scid"] != 0) {
        $scid = $_GET["scid"];
        $sql = "SELECT * FROM `tb_scpr` WHERE `sc_id`=$scid ORDER BY `id` ASC";
    } else {
        $sql = "SELECT * FROM `tb_scpr` ORDER BY `id` ASC";
    }
    $result = mysqli_query($conn, $sql);
    ?>
    <div class="text-center mb-3">
        <h3>ข่าวประชาสัมพันธ์</h3>
        <?php
if (isset($scid)) {
        echo "<h4>โรงเรียน" . getschool($conn, "name", $scid) . "</h4>";
    }
    ?>
    </div>
    <table class="display mb-2" id="scpr" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ข่าวประชาสัมพันธ์</th>
                <th>โรงเรียน</th>
                <th>วันที่เผยแพร่</th>
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
                <td><a href="index.php?module=news&id=<?=$data["id"];?>" target="_blank"><?=$data["name"];?></a></td>
                <td><?=LinkSchool($conn, $data["sc_id"]);?></td>
                <td><?=renderDate2($data["date"]);?></td>
                <td><?=((explode("-", $data["date"])[0]) + 543);?></td>
            </tr>
            <?php
$i++;
    endwhile;
    ?>
        </tbody>
    </table>
    <?
}

if ($mode == "gallery") {
 if (isset($_GET["scid"]) and (int) $_GET["scid"] != 0) {
  $scid = $_GET["scid"];
  $sql = "SELECT * FROM `tb_gallery` WHERE `sc_id`=$scid ORDER BY `id` ASC";
 } else {
  $sql = "SELECT * FROM `tb_gallery` ORDER BY `id` ASC";
 }
 $result = mysqli_query($conn, $sql);
 ?>
    <div class="text-center mb-3">
        <h3>ภาพกิจกรรม</h3>
        <?php
if (isset($scid)) {
        echo "<h4>โรงเรียน" . getschool($conn, "name", $scid) . "</h4>";
    }
    ?>
    </div>
    <table class="display mb-2" id="gallery" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>กิจกรรม</th>
                <th>โรงเรียน</th>
                <th>วันที่เผยแพร่</th>
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
                <td><a href="index.php?module=gallery&id=<?=$data["id"];?>" target="_blank"><?=$data["name"];?></a></td>
                <td><?=LinkSchool($conn, $data["sc_id"]);?></td>
                <td><?=renderDate2($data["date"]);?></td>
                <td><?=((explode("-", $data["date"])[0]) + 543);?></td>
            </tr>
            <?php
$i++;
    endwhile;
    ?>
        </tbody>
    </table>
    <?
}

if ($mode == "scaward") {
 if (isset($_GET["scid"]) and (int) $_GET["scid"] != 0) {
  $scid = $_GET["scid"];
  $sql = "SELECT * FROM `tb_scaward` WHERE `sc_id`=$scid ORDER BY `id` ASC";
 } else {
  $sql = "SELECT * FROM `tb_scaward` ORDER BY `id` ASC";
 }

 $result = mysqli_query($conn, $sql);
 ?>
    <div class="text-center mb-3">
        <h3>รางวัลที่โรงเรียนได้รับ</h3>
        <?php
if (isset($scid)) {
        echo "<h4>โรงเรียน" . getschool($conn, "name", $scid) . "</h4>";
    }
    ?>
    </div>
    <table class="display mb-2" id="scaward" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อรางวัล</th>
                <th>โรงเรียน</th>
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
                <td><a href="index.php?module=award&id=<?=$data["id"];?>" target="_blank"><?=$data["name"];?></a></td>
                <td><?=LinkSchool($conn, $data["sc_id"]);?></td>
                <td><?=renderDate3($data["adate"]);?></td>
                <td><?=explode("/", $data["adate"])[2];?></td>
            </tr>
            <?php
$i++;
    endwhile;
    ?>
        </tbody>
    </table>
    <?
}

if ($mode == "taward") {
 if (isset($_GET["tid"]) and (int) $_GET["tid"] != 0) {
  $tid = $_GET["tid"];
  $sql = "(SELECT * FROM `tb_taward_school` WHERE `tid`=$tid) UNION (SELECT * FROM `tb_taward_self` WHERE `tid`=$tid) UNION (SELECT * FROM `tb_taward_student` WHERE `tid`=$tid) ORDER By `adate` ASC ;";
 } else {
  $sql = "(SELECT * FROM `tb_taward_school`) UNION (SELECT * FROM `tb_taward_self`) UNION (SELECT * FROM `tb_taward_student`) ORDER By `adate` ASC;";
 }

 $result = mysqli_query($conn, $sql);
 ?>
    <div class="text-center mb-3">
        <h3>รางวัลที่ครูได้รับ</h3>
        <?php
if (isset($tid)) {
        echo "<h4>" . getteacher($conn, "name", $tid) . "</h4>";
    }
    ?>
    </div>
    <table class="display mb-2" id="taward" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อรางวัล</th>
                <th>ผู้ได้รับรางวัล</th>
                <th>โรงเรียน</th>
                <th>ระดับ</th>
                <th>ประเภท</th>
                <th>วันที่ได้รับ</th>
                <th>ปี</th>
            </tr>
        </thead>
        <tbody>
            <?php
$atype = array(
        "self" => "รางวัลด้านการพัฒนาตนเอง",
        "school" => "รางวัลด้านการพัฒนาโรงเรียน",
        "student" => "รางวัลด้านการพัฒนานักเรียน",
    );

    $i = 1;
    while ($data = mysqli_fetch_assoc($result)):
        $type = explode("/", $data["adoc1"]);
        if ($type[0] == "..") {
            array_shift($type);
        }
        ?>
            <tr>
                <td><?=$i;?></td>
                <td><a href="index.php?module=taward&atype=<?=$type[1];?>&id=<?=$data["id"];?>" target="_blank">
                        <?=$data["aname"];?></a></td>
                <td><a href="index.php?module=profile&id=<?=$data["tid"];?>" target="_blank"><?=getteacher($conn, "name", $data["tid"]);?></a></td>
                <td><?=TeacherSchool($conn, $data["tid"]);?></td>
                <td><?=$data["cate"];?></td>
                <td><?=$atype[$type[1]];?></td>
                <td><?=str_replace("-", "/", $data["adate"]);?></td>
                <td><?=explode("-", $data["adate"])[0];?></td>
            </tr>
            <?php
    $i++;
    endwhile;
    ?>
        </tbody>
    </table>
    <?
}

if ($mode == "train1") {
 if (isset($_GET["tid"]) and (int) $_GET["tid"] != 0) {
  $tid = $_GET["tid"];
  $sql = "SELECT * FROM `tb_train1` WHERE `tid`=$tid ORDER By `tDateEn` ASC;";
 } else {
  $sql = "SELECT * FROM `tb_train1` ORDER By `tDateEn` ASC;";
 }

 $result = mysqli_query($conn, $sql);
 ?>
    <div class="text-center mb-3">
        <h3>รายงานการอบรม/ประชุม/สัมนา</h3>
        <?php
if (isset($tid)) {
        echo "<h4>" . getteacher($conn, "name", $tid) . "</h4>";
    }
    ?>
    </div>
    <table class="display mb-2" id="train" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>รายการ</th>
                <th>ผู้รายงาน</th>
                <th>โรงเรียน</th>
                <th>ระดับ</th>
                <th>วันที่สำเร็จ</th>
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
                <td><a href="index.php?module=train&type=train1&id=<?=$data["id"];?>" target="_blank">
                        <?=$data["tName"];?></a></td>
                <td><a href="index.php?module=profile&id=<?=$data["tid"];?>" target="_blank"><?=getteacher($conn, "name", $data["tid"]);?></a></td>
                <td><?=TeacherSchool($conn, $data["tid"]);?></td>
                <td><?=$data["cate"];?></td>
                <td><?=renderDate($data["tDateEn"]);?></td>
                <td><?=explode("-", $data["tDateEn"])[0];?></td>
            </tr>
            <?php
$i++;
    endwhile;
    ?>
        </tbody>
    </table>
    <?
}

if ($mode == "train2") {
 if (isset($_GET["tid"])) {
  $tid = $_GET["tid"];
  $sql = "SELECT * FROM `tb_train2` WHERE `tid`=$tid ORDER By `tDateEn` ASC;";
 } else {
  $sql = "SELECT * FROM `tb_train2` ORDER By `tDateEn` ASC;";
 }
 $result = mysqli_query($conn, $sql);
 ?>
    <div class="text-center mb-3">
        <h3>รายงานการพัฒนาตนเอง</h3>
        <?php
if (isset($tid)) {
        echo "<h4>" . getteacher($conn, "name", $tid) . "</h4>";
    }
    ?>
    </div>
    <table class="display mb-2" id="train" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>หลักสูตร</th>
                <th>ผู้รายงาน</th>
                <th>โรงเรียน</th>
                <th>ระดับ</th>
                <th>วันที่สำเร็จ</th>
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
                <td><a href="index.php?module=train&type=train2&id=<?=$data["id"];?>" target="_blank">
                        <?=$data["tName"];?></a></td>
                <td><a href="index.php?module=profile&id=<?=$data["tid"];?>" target="_blank"><?=getteacher($conn, "name", $data["tid"]);?></a></td>
                <td><?=TeacherSchool($conn, $data["tid"]);?></td>
                <td><?=$data["cate"];?></td>
                <td>
                    <?=renderDate($data["tDateEn"]);?>
                </td>
                <td><?=explode("-", $data["tDateEn"])[0];?></td>
            </tr>
            <?php
$i++;
    endwhile;
    ?>
        </tbody>
    </table>
    <?
}

if ($mode == "publish") {
 if (isset($_GET["tid"])) {
  $tid = $_GET["tid"];
  $sql = "SELECT * FROM `tb_tpublish` WHERE `tid`=$tid ORDER By `id` ASC;";
 } else {
  $sql = "SELECT * FROM `tb_tpublish` ORDER By `id` ASC;";
 }

 $result = mysqli_query($conn, $sql);
 ?>
    <div class="text-center mb-3">
        <h3>เผยแพร่ผลงาน</h3>
        <?php
if (isset($tid)) {
        echo "<h4>" . getteacher($conn, "name", $tid) . "</h4>";
    }
    ?>
    </div>
    <table class="display mb-2" id="publish" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ผลงาน</th>
                <th>ผู้เผยแพร่</th>
                <th>วันที่เผยแพร่</th>
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
                <td><a href="<?=$data["link"];?>" target="_blank">
                        <?=$data["name"];?></a></td>
                <td><a href="index.php?module=profile&id=<?=$data["tid"];?>" target="_blank"><?=getteacher($conn, "name", $data["tid"]);?></a></td>
                <td><?=renderDate2($data["date"]);?></td>
                <td><?=((explode("-", $data["date"])[0]) + 543);?></td>
            </tr>
            <?php
$i++;
    endwhile;
    ?>
        </tbody>
    </table>
    <?php
}
?>

</div>


<?php
/*
SELECT `tb_taward_student`.* FROM (`tb_taward_student`INNER JOIN `tb_teacher` ON `tb_taward_student`.`tid` = `tb_teacher`.`id`) WHERE `tb_teacher`.`sc_id`=25;

 ****

WHERE `tid` IN ("1,2,3,4")

SELECT * FROM `tb_school`WHERE `id` IN ('1','2','3','4');
 */
?>