<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}
require_once "db.php";
if (@$_POST["key"] != null && (@$_POST["key"] != "all")) {
 $key = mysqli_real_escape_string($conn, $_POST["key"]);
 $sql = "SELECT * FROM `tb_school` WHERE `area`='$key'";
} else {
 $sql = "SELECT * FROM `tb_school`";
}
$result = mysqli_query($conn, $sql);
?>

<div class="text-center">
    <h6 class="fw-bold mt-5 mb-3">รายชื่อโรงเรียนสังกัด สพม.น่าน</h6>
</div>
<form action="index.php?module=school" method="post" class="mb-2">
    <div class="text-end ">
        <div class="d-inline-flex">
            <span class="fw-bold fs-7">เลือกสหวิทยาเขต :</span>
        </div>
        <div class="d-inline-flex">
            <select name="key" id="key" class="form-control-sm">
                <option value="วรนคร">วรนคร</option>
                <option value="ศิลาทอง">ศิลาทอง</option>
                <option value="เวียงป้อ">เวียงป้อ</option>
                <option value="เวียงภูเพียง">เวียงภูเพียง</option>
                <option value="all">ทั้งหมด</option>
            </select>
        </div>
        <div class="d-inline-flex">
            <button type="submit" class="btn btn-danger btn-sm text-white">กรอง</button>
        </div>
    </div>
</form>


<table class="table table-hover table-sm table-bordered table-striped">
    <thead>
        <tr class="table-success">
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">รหัส 10 หลัก</th>
            <th scope="col" class="text-center">รหัส 8 หลัก</th>
            <th scope="col" class="text-center">รหัส 6 หลัก</th>
            <th scope="col" class="text-center">ชื่อโรงเรียน</th>
            <th scope="col" class="text-center">ผู้อำนวยการ</th>
            <th scope="col" class="text-center">สหวิทยาเขต</th>
        </tr>
    </thead>
    <tbody>
        <?php
$i = 1;
while ($data = mysqli_fetch_array($result)) {
 extract($data);
 ?>
        <tr>
            <th scope="row" class="text-center"><?=$i;?></th>
            <td class="text-center"><?=$id10;?></td>
            <td class="text-center"><?=$id8;?></td>
            <td class="text-center"><?=$id6;?></td>
            <td class="ps-1"><a href="index.php?module=showschool&id=<?=$id;?>" target="_blank"><?=$name;?></a></td>
            <td class="ps-1"><?=$director;?></a></td>
            <td class="ps-1"><?=$area;?></a></td>
        </tr>
        <?php $i++;}?>
    </tbody>
</table>