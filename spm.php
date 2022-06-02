<?php
require_once "db.php";
$scid = 99;
$imgPro = "pictures/logo/" . $scid . ".png";
if (!file_exists($imgPro)) {
 $imgPro = "img/spmnan_logo.png";
}
$sql = "SELECT * FROM `tb_school` WHERE `id`=$scid";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
extract($data);
?>

<div class="col-md-8 offset-md-2">
    <div class=" alert alert-success text-center my-3 fs-6 fw-bold">
        <?=$name;?>
    </div>
    <div class="text-center my-3">
        <img src="<?=$imgPro;?>" style="height:300px;" id="imgProfile">
    </div>
    <table class="table table-striped">
        <tbody>
            <tr>
                <th scope="row" class="fit">ผู้อำนวยการ</th>
                <td><?=$director;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?=$ditel;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td><?=$subdi1;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?=$subditel1;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td><?=$subdi2;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?=$subditel2;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td><?=$subdi3;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?=$subditel3;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td><?=$subdi4;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?=$subditel4;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">จำนวนบุคลากร</th>
                <td><?=$teacher;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">ข้อมูลบุคลากร</th>
                <td> <a href="index.php?module=spmlist">คลิ๊กที่นี่</a> </td>
            </tr>
        </tbody>
    </table>
</div>






<div class=" alert alert-success text-center my-3 fs-6 fw-bold">
    รางวัลที่ได้รับ
</div>
<table class="table table-striped table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th class="text-center">#</a></th>
            <th class="text-center">รางวัล</th>
            <th class="text-center">วันที่ได้รับ</th>
            <th class="text-center">หน่วยงานที่มอบ</th>
        </tr>
    </thead>
    <tbody>
        <?php
$sql = "SELECT * FROM `tb_scaward` WHERE `sc_id`=$scid ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
$nost = mysqli_num_rows($result);
while ($data = @mysqli_fetch_assoc($result)) {
 @extract($data);
 ?>
        <tr>
            <td scope="row" class="text-center"><?=$nost;?></td>
            <td><a href="index.php?module=award&id=<?=$id;?>"><?=$name;?></a></td>
            <td><?=$adate;?></td>
            <td><?=$afrom;?></td>
        </tr>
        <?php

 $nost--;

}?>
    </tbody>
</table>
<div class=" alert alert-success text-center my-3 fs-6 fw-bold">
    ข่าวประชาสัมพันธ์
</div>
<table class="table table-striped table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th class="text-center">#</a></th>
            <th class="text-center">เรื่อง</th>
            <th class="text-center">เผยแพร่เมื่อ</th>
        </tr>
    </thead>
    <tbody>
        <?php
$sql = "SELECT * FROM `tb_scpr` WHERE `sc_id`=$scid ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
$nost = mysqli_num_rows($result);
while ($data = @mysqli_fetch_assoc($result)) {
 @extract($data);
 ?>
        <tr>
            <td scope="row" class="text-center"><?=$nost;?></td>
            <td><a href="index.php?module=news&id=<?=$id;?>" target="_blank"><?=$name;?></a></td>
            <td><?=renderDate2($date);?></td>
        </tr>
        <?php

 $nost--;

}?>
    </tbody>
</table>

<div class=" alert alert-success text-center my-3 fs-6 fw-bold">
    ภาพกิจกรรมของสำนักงานเขตพื้นที่ฯ
</div>

<table class="table table-striped table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">ชื่อกิจกรรม</th>
            <th class="text-center">วันที่</th>
        </tr>
    </thead>
    <tbody>
        <?php

$sql = "SELECT * FROM `tb_gallery` WHERE `sc_id`=$scid ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
$nost = mysqli_num_rows($result);
while ($data = @mysqli_fetch_assoc($result)) {
 @extract($data);
 ?>
        <tr>
            <td scope="row" class="text-center"><?=$nost;?></td>
            <td><a href="../index.php?module=gallery&id=<?=$id;?>" target="_blank"><?=$name;?></a></td>
            <td><?=renderDate2($date);?></td>
        </tr>
        <?php $nost--;}?>
    </tbody>
</table>
