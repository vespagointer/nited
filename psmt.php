<?php
$sql = "SELECT `id`,`name` FROM `tb_school`";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_row($result)) {
 $school[$data[0]] = $data[1];
}

require_once "db.php";
$sql = "SELECT `id`,`sc_id`,`name`,`pos`,`psmt`,`psmtno`,`bdname` FROM `tb_teacher` WHERE `psmt`!='' ORDER BY `psmtno` ASC";

$result = mysqli_query($conn, $sql);

?>

<div class="row mt-md-3">
    <div class="text-center my-4">
        <h3>ทำเนียบ สควค. สังกัด สพม.น่าน</h3>
        <h5>ทุนโครงการส่งเสริมการผลิตครูที่มีความสามารถพิเศษทางวิทยาศาสตร์และคณิตศาสตร์</h5>
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
                <th class="text-center">ทุน</th>
                <th class="text-center">รุ่นที่</th>
                <th class="text-center">วิชาเอก</th>
            </tr>
        </thead>
        <tbody>
            <?php

while ($data = mysqli_fetch_assoc($result)):
 extract($data);
 ?>
            <tr>
                <td><?=$school[$sc_id];?></td>
                <td><a href="index.php?module=profile&id=<?=$id;?>"><?=$name;?></a></td>
                <td><?=$pos;?></td>
                <td><?=$psmt;?></td>
                <td><?=$psmtno;?></td>
                <td><?=$bdname;?></td>
            </tr>
            <?php endwhile?>
        </tbody>
    </table>


</div>

<br />
<a class="btn btn-primary" href="https://www.facebook.com/groups/591405904598280" target="_blank"> <i
        class="fab fa-facebook"></i>
    เครือข่ายครู
    สควค.น่าน</a>
