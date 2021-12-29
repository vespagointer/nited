<?php
$scid = $_GET["id"];
$sql = "SELECT * FROM `tb_school` WHERE `id`=$scid";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
extract($data);
?>
<div class="toast text-white bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body" style="font-size:0.5rem">
            Tips: ข้อความที่มี <i class="far fa-edit"></i> ต่อท้าย สามารถ ดับเบิ้ลคลิ๊กเพื่อแก้ไขข้อความได้
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto btn-sm" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>

<div class="col-md-8 offset-md-2">
    <div class=" alert alert-success text-center my-3 fs-6 fw-bold">
        โรงเรียน<?=$name;?>
    </div>
    <table class="table table-striped">
        <tbody>
            <tr>
                <th scope="row" class="fit">รหัส 10 หลัก</th>
                <td><?=$id10;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รหัส 8 หลัก</th>
                <td><?=$id8;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รหัส 6 หลัก</th>
                <td><?=$id6;?></td>
            </tr>
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
                <th scope="row" class="fit">จำนวนครู</th>
                <td><?=$teacher;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">จำนวนนักเรียน</th>
                <td><?=$student;?></td>
            </tr>
        </tbody>
    </table>

</div>
<div class=" alert alert-success text-center my-3 fs-6 fw-bold">
    โครงการ
</div>
<?php
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
  echo "</li>";
 }
 echo "</ol>";
} else {
 echo "ยังไม่มีข้อมูลโครงการที่เข้าร่วม";
}

?>
    </div>
</div>
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
  echo "</li>";
 }
 echo "</ol>";
} else {
 echo "ยังไม่มีข้อมูลโครงการในส่วนนี้";
}
?>
    </div>
</div>
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
  echo "</li>";
 }
 echo "</ol>";
} else {
 echo "ยังไม่มีข้อมูลโครงการในส่วนนี้";
}
?>
    </div>
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
            <td><?=$date;?></td>
        </tr>
        <?php

 $nost--;

}?>
    </tbody>
</table>

<div class=" alert alert-success text-center my-3 fs-6 fw-bold">
    ภาพกิจกรรมของโรงเรียน
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
            <td><?=$date;?></td>
        </tr>
        <?php $nost--;}?>
    </tbody>
</table>