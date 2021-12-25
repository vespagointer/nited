<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}

?>
<div class="row mb-3">
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body text-center" style="background-color:Lightgreen;font-color:#9efd9e;">
                <h6 class="card-title">จำนวนหนังสือเข้า</h6>
                <p class="card-text fw-bold" style="font-size:2rem;">
                    <?php
$result = mysqli_query($conn, "SELECT COUNT(*) FROM `tb_book`");
$cnt    = mysqli_fetch_array($result)[0];
echo $cnt;
?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body text-center alert-success">
                <h6 class="card-title">จำนวนหนังสือออก</h6>
                <p class="card-text fw-bold" style="font-size:2rem;">
                    <?php
$result = mysqli_query($conn, "SELECT COUNT(*) FROM `tb_newbook`");
$cnt    = mysqli_fetch_array($result)[0];
echo $cnt;
?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body text-center alert-secondary">
                <h6 class="card-title">จำนวนโครงการ</h6>
                <p class="card-text fw-bold" style="font-size:2rem;">
                    <?php
$result = mysqli_query($conn, "SELECT COUNT(*) FROM `tb_project`");
$cnt    = mysqli_fetch_array($result)[0];
echo $cnt;
?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body text-center" style="background-color:#deea94;font-color:#ffb97f;">
                <h6 class="card-title">จำนวนลิงก์</h6>
                <p class="card-text fw-bold" style="font-size:2rem;">
                    <?php
$result = mysqli_query($conn, "SELECT COUNT(*) FROM `urls`");
$cnt    = mysqli_fetch_array($result)[0];
echo $cnt;
?>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="text-center" style="padding:20px 0 10px;">
    <h4>5 หนังสือเข้าล่าสุด</h4>
</div>

<table class="table table-hover table-sm table-bordered">
    <thead>
        <tr class="table-success">
            <th scope="col" style="width:5%;" class="text-center">id
            </th>
            <th scope="col" style="width:14%;" class="text-center">เลขหนังสือ</th>
            <th scope="col" style="width:10%;" class="text-center">ลงวันที่</a>
            </th>
            <th scope="col" style="width:7%;" class="text-center">เลขรับ</a>
            </th>
            <th scope="col" style="width:10%;" class="text-center">รับวันที่</a>
            </th>
            <th scope="col" style="width:30%;" class="text-center">ชื่อหนังสือ</th>
            <th scope="col" style="width:6%;" class="text-center">ผู้ส่ง</th>
            <th scope="col" style="width:10%;" class="text-center">ผู้รับผิดชอบ</th>
        </tr>
    </thead>
    <tbody>
        <?php

$sql    = "SELECT * FROM `tb_book` ORDER BY `id` DESC LIMIT 5";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($result)) {
 extract($data);
 ?>
        <tr>
            <th scope="row" class="text-center"><?=$id;?></th>
            <td><?=html_entity_decode($bookno);?></td>
            <td><?=$bookdate;?></td>
            <td><?=html_entity_decode($gotno);?></td>
            <td><?=$gotdate;?></td>
            <td><a href="index.php?module=bookdetail&id=<?=$id;?>"><?=html_entity_decode($bookname);?></a></td>
            <td><?=html_entity_decode($bookfrom);?></td>
            <td>ศน.<?=$snName[$person];?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="my-2 text-end">
    <a class="btn btn-primary btn-sm text-white" href="index.php?module=book" role="button">
        <i class="fas fa-layer-group"></i>
        ดูทั้งหมด</a>
</div>

<div class="text-center" style="padding:20px 0 10px;">
    <h4>5 หนังสือออกล่าสุด</h4>
</div>
<table class="table table-hover table-sm table-bordered">
    <thead>
        <tr class="table-success">
            <th scope="col" style="width:5%;" class="text-center">id</th>
            <th scope="col" style="width:10%;" class="text-center">เลขหนังสือ</th>
            <th scope="col" style="width:10%;" class="text-center">ลงวันที่</a></th>
            <th scope="col" style="width:35%;" class="text-center">ชื่อหนังสือ</th>
            <th scope="col" style="width:20%;" class="text-center">ส่งถึง</th>
            <th scope="col" style="width:10%;" class="text-center">ผู้รับผิดชอบ</th>
        </tr>
    </thead>
    <tbody>
        <?php

$sql    = "SELECT * FROM `tb_newbook` ORDER BY `id` DESC LIMIT 5";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($result)) {
 extract($data);
 ?>
        <tr>
            <th scope="row" class="text-center"><?=$id;?></th>
            <td><?=html_entity_decode($bookno);?></td>
            <td><?=$bookdate;?></td>
            <td><a href="index.php?module=newbookdetail&id=<?=$id;?>"><?=html_entity_decode($bookname);?></a></td>
            <td><?=html_entity_decode($bookto);?></td>
            <td>ศน.<?=$snName[$person];?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="my-2 text-end">
    <a class="btn btn-primary btn-sm text-white" href="index.php?module=newbook" role="button">
        <i class="fas fa-layer-group"></i>
        ดูทั้งหมด</a>
</div>

<div class="text-center" style="padding:20px 0 10px;">
    <h4>5 โครงการ ล่าสุด</h4>
</div>
<table class="table table-hover table-sm table-bordered">
    <thead>
        <tr class="table-success">
            <th scope="col" style="width:10%;" class="text-center">id</th>
            <th scope="col" style="width:30%;" class="text-center">ชื่อโครงการ</th>
            <th scope="col" style="width:10%;" class="text-center">งบประมาณ</th>
            <th scope="col" style="width:10%;" class="text-center">ปีงบประมาณ</th>
            <th scope="col" style="width:10%;" class="text-center">ผู้รับผิดชอบ</th>
        </tr>
    </thead>
    <tbody>
        <?php

$sql    = "SELECT * FROM `tb_project` ORDER BY `id` DESC LIMIT 5";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($result)) {
 extract($data);
 ?>
        <tr>
            <th scope="row" class="text-center"><?=$id;?></th>
            <td><a href="index.php?module=projectdetail&id=<?=$id;?>"><?=html_entity_decode($pname);?></a></td>
            <td class="text-end pe-2"><?=number_format((int) $budget, 2, '.', ',');?></td>
            <!--            <td class="text-end pe-2"><?=number_format((int) $pay, 2, '.', ',');?></td>
            <td class="text-end pe-2"><?=number_format(((int) $budget - (int) $pay), 2, '.', ',');?></td> -->
            <td class="text-center"><?=$myear;?></td>
            <td>ศน.<?=$snName[$person];?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="my-2 text-end">
    <a class="btn btn-primary btn-sm text-white" href="index.php?module=project" role="button">
        <i class="fas fa-layer-group"></i>
        ดูทั้งหมด</a>
</div>
<div class="text-center" style="padding:20px 0 10px;">
    <h4>5 Short Links ล่าสุด</h4>
</div>
<?php

$sql    = "SELECT * FROM `urls` ORDER BY `urls`.`url_id` DESC LIMIT 5";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) >= 1) {
 ?>
<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr>

            <th scope="col" class="text-center" style="width:45%">ชื่อ Link</th>
            <th scope="col" class="text-center" style="width:25%">Short URL</th>
            <th scope="col" class="text-center" style="width:10%">Check School</th>
            <th scope="col" class="text-center" style="width:10%">QR Code</th>
        </tr>
    </thead>
    <tbody>
        <?php
$url = "http://spmnan.ga/";
 while ($data = mysqli_fetch_array($result)) {
  $url_id = $data["url_id"];
  $surl   = $data["surl"];
  $gurl   = $data["gurl"];
  ?>
        <tr>
            <td><?=htmlspecialchars_decode($data["name"]);?></td>
            <td><a href="<?=$url . $surl;?>" target="_blank"><?=$url . $surl;?></a></td>
            <td class="text-center">
                <?php
if (!empty($gurl)) {

   ?>
                <a href="index.php?module=ckschoolv3&id=<?=$url_id;?>" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="คลิ๊กเพื่อตรวจสอบการ กรอกข้อมูลของโรงเรียน"><i class="fas fa-school text-success"></i></a>
                <?php }?>
            </td>
            <td class="text-center"><a href="../qrcode/<?=$surl;?>.png" target="_blank" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="คลิ๊กเพื่อเปิด QR Code"><img src="../img/qr.png" /></a>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="my-2 text-end">
    <a class="btn btn-primary btn-sm text-white" href="index.php?module=shorturl" role="button">
        <i class="fas fa-layer-group"></i>
        ดูทั้งหมด</a>
</div>
<?php }?>