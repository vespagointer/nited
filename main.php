<?php
@define("KRITSADAPONG", true);
require_once "conn.php";
require_once "db.php";

$max = 5;
$sName = ["ศ.ว.", "ศ.น.", "บส.ว", "น.อ.", "ม.ร.", "บ.ล.", "น.น.", "ปว.", "ศ.ศ.", "ม.ง.", "ม.ก.จ", "ท.พ.", "ส.ว.", "น.พ.", "ม.ว.", "ส.", "สธ.ร.", "ส.ท.พ.", "ท.ช.", "ช.ก.", "พ.พ.", "น.ม.", "ม.ล.", "ส.พ.ค.", "บ.ก.", "ต.ร.", "น.ค.", "ศ.น.น.", "ม.พ.", "น.ว."];

$sql = "SELECT * FROM `tb_statistics` WHERE `name`='award'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

unset($data["id"]);
unset($data["name"]);
$aCount = array_sum($data);
ksort($data, SORT_NUMERIC);
arsort($data);
if ($aCount > 0) {
 $count = 1;
 foreach ($data as $key => $val) {
  //$aLabels[] = getschool($conn, "name", substr($key, 2));
  $aLabels[] = $sName[(substr($key, 2) - 1)];
  $aData[] = $val;
  if ($count == $max) {
   break;
  }
  $count++;
 }
}

$sql = "SELECT * FROM `tb_statistics` WHERE `name`='project'";
$result = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($result);

unset($data["id"]);
unset($data["name"]);
$pCount = array_sum($data);
ksort($data, SORT_NUMERIC);
arsort($data);
//var_dump($data);
if ($pCount > 0) {
 $count = 1;
 foreach ($data as $key => $val) {
  //$pLabels[] = getschool($conn, "name", substr($key, 2));
  $pLabels[] = $sName[(substr($key, 2) - 1)];
  $pData[] = $val;
  if ($count == $max) {
   break;
  }
  $count++;
 }
}
?>


<?php
$sql = "SELECT * FROM `tb_gallery` ORDER BY `id` DESC LIMIT 5";
$result = mysqli_query($conn, $sql);
$row = mysqli_num_rows($result);
?>
<div class="mt-3"></div>
<div class="offset-1 col-10">
    <div id="NanGallery" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php if ($row == 0): ?>
            <button type="button" data-bs-target="#NanGallery" data-bs-slide-to="0" aria-label="Slide 1" class="active"
                aria-current="true"></button>
            <button type="button" data-bs-target="#NanGallery" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#NanGallery" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <?php endif;

for ($i = 0; $i < $row; $i++):
 $ac = "";
 if ($i == 0) {$ac = "class=\"active\" aria-current=\"true\"";}
 ?>
            <button type="button" data-bs-target="#NanGallery" data-bs-slide-to="<?=$i;?>" aria-label="Slide <?=$i;?>"
                <?=$ac;?>></button>
            <?php endfor?>
        </div>
        <div class="carousel-inner">
            <?php
$i = 0;
while ($data = mysqli_fetch_assoc($result)):
 extract($data);
 $ac = "";
 if ($i == 0) {
  $ac = "active";
  $i++;}
 $school = getschool($conn, "name", $sc_id);
 ?>

            <div class="center-cropped carousel-item <?=$ac;?>" style="background-image: url('gallery/<?=$id;?>.jpg');">
                <a href="index.php?module=gallery&id=<?=$id;?>">
                    <img src="gallery/<?=$id;?>.jpg" alt="<?=$name;?>" />
                    <div class="carousel-caption d-none d-md-block ">
                        <div class="myCaption">
                            <?=$name;?>
                        </div>
                    </div>
                </a>
            </div>
            <?php
endwhile;
?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#NanGallery" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#NanGallery" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<br clear=all>
<div class="row my-3">
    <div class="col-lg-10 offset-lg-1">
        <div class="text-center fw-bold fs-4 text-dark mb-3"><i class="fas fa-bullhorn"></i>
            ข่าวประชาสัมพันธ์จากโรงเรียน</div>
        <table class="table">
            <tbody>
                <?php
$sql = "SELECT * FROM `tb_scpr` ORDER BY `id` DESC LIMIT 5";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  ?>
                <tr class="news news<?=$i;?>">
                    <td scope="row"><i class="fas fa-bullhorn text-white fs-5"></i></td>
                    <td>
                        <a href="index.php?module=news&id=<?=$data["id"];?>" target="_blank"><?=$data["name"];?></a>
                        <br />เมื่อ : <?=renderDate2($data["date"]);?>
                    </td>
                    <td>
                        <?php
if ($data["sc_id"] == 99) {
   echo LinkSchool2($conn, $data["sc_id"]);
  } else {
   echo LinkSchool($conn, $data["sc_id"]);
  }
  ?>

                    </td>
                </tr>
                <?php
$i++;
 }
}?>
            </tbody>
        </table>
        <div class="text-end mb-2">
            <a href="index.php?module=list&mode=scpr" type="button" class="btn btn-danger text-white fs-6">
                <i class="fas fa-bullhorn"></i> ดูข่าวทั้งหมด</a>
        </div>
    </div>
</div>


<?php
$sql = "SELECT * FROM `tb_statistics` WHERE `name`='perupdate'";
$result = mysqli_query($conn, $sql);
$per = mysqli_fetch_row($result);
array_shift($per);
array_shift($per);
$sql = "SELECT `name` FROM `tb_school` WHERE `id`!=99";
$result = mysqli_query($conn, $sql);
$name = mysqli_fetch_all($result, MYSQLI_ASSOC);
$name = array_column($name, "name");

$sPer = json_encode($per, JSON_UNESCAPED_UNICODE);
$sName = json_encode($name, JSON_UNESCAPED_UNICODE);

?>
<div style="height:400px" class="mb-5">
    <h6 class="text-center mt-4 mb-2 fw-bold text-primary">ร้อยละของครูที่กรอกข้อมูลรายโรงเรียน</h6>
    <canvas id="PerChart"></canvas>
    <div class="text-muted text-center">*หมายเหตุ : ข้อมูลอัพเดททุกๆ ชั่วโมง</div>
    <div class="text-center my-3"><a href="index.php?module=report"
            class="btn btn-warning btn-sm text-white">ดูสถิติทั้งหมด คลิกที่นี่</a></div>
</div>
<script>
var sPer = <?=$sPer;?>;
var sName = ["ศ.ว.", "ศ.น.", "บส.ว", "น.อ.", "ม.ร.", "บ.ล.", "น.น.", "ปว.", "ศ.ศ.", "ม.ง.", "ม.ก.จ", "ท.พ.", "ส.ว.",
    "น.พ.", "ม.ว.", "ส.", "สธ.ร.", "ส.ท.พ.", "ท.ช.", "ช.ก.", "พ.พ.", "น.ม.", "ม.ล.", "ส.พ.ค.", "บ.ก.", "ต.ร.",
    "น.ค.", "ศ.น.น.", "ม.พ.", "น.ว."
];
</script>
<br clear="all" />
<br clear="all" />

<div class="row my-3">
    <div class="col-lg-6">
        <div class=" chart-container">
            <canvas id="award" height="250px"></canvas>
        </div>
        <?php if ($aCount == 0): ?>
        <div class="text-muted text-center mt-2">ข้อมูลตัวอย่าง<br />จะแสดงข้อมูลจริงเมื่อโรงเรียนกรอกข้อมูล</div>
        <?php endif?>
    </div>
    <div class="col-lg-6">
        <div class="chart-container">
            <canvas id="project" height="250px"></canvas>
        </div>
        <?php if ($pCount == 0): ?>
        <div class="text-muted text-center mt-2">ข้อมูลตัวอย่าง<br />จะแสดงข้อมูลจริงเมื่อโรงเรียนกรอกข้อมูล</div>
        <?php endif?>
    </div>
</div>



<div class="row my-3">
    <div class="col-lg-6">
        <div class="text-center fw-bold fs-7 text-dark mb-3">10 รางวัลล่าสุดของโรงเรียน</div>
        <table class="table table-sm">
            <tbody>
                <?php
$sql = "SELECT * FROM `tb_scaward` ORDER BY `id` DESC LIMIT 10";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  ?>
                <tr class="pastel pastel<?=$i;?>">
                    <td scope="row"><i class="fas fa-trophy text-white fs-5"></i></td>
                    <td><a href="index.php?module=award&id=<?=$data["id"];?>" target="_blank"><?=$data["name"];?></a>
                    </td>
                    <td><?=LinkSchool($conn, $data["sc_id"]);?></td>
                </tr>
                <?php
$i++;
 }
}?>
            </tbody>
        </table>
        <div class="text-end mb-5">
            <a href="index.php?module=list&mode=scaward" type="button" class="btn btn-danger text-white fs-6">
                <i class="fas fa-bullhorn"></i> รางวัลทั้งหมด</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="text-center fw-bold fs-7 text-dark mb-3">10 รางวัลล่าสุดของครู</div>
        <table class="table table-sm">
            <tbody>
                <?php
$sql = "SELECT * FROM `tb_taward_school` UNION SELECT * FROM `tb_taward_self`UNION SELECT * FROM `tb_taward_student`ORDER By `id` DESC LIMIT 10;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  //$text = preg_replace('\.\.\/', '', $data["adoc1"]);
  $type = explode("/", $data["adoc1"]);
  if ($type[0] == "..") {
   array_shift($type);
  }
  // $type = explode("/", $text);
  ?>
                <tr class="pastel pastel<?=$i;?>">
                    <td scope="row"><i class="fas fa-award text-white fs-5"></i></td>
                    <td><a href="../index.php?module=taward&atype=<?=$type[1];?>&id=<?=$data["id"];?>"
                            target="_blank"><?=$data["aname"];?></a></td>
                    <td><a href="../index.php?module=profile&id=<?=$data["tid"];?>"
                            target="_blank"><?=getteacher($conn, "name", $data["tid"]);?></a></td>
                </tr>
                <?php
$i++;
 }
}?>
            </tbody>
        </table>
        <div class="text-end mb-5">
            <a href="index.php?module=list&mode=taward" type="button" class="btn btn-danger text-white fs-6">
                <i class="fas fa-bullhorn"></i> รางวัลทั้งหมด</a>
        </div>
    </div>
</div>

<div class="row my-3">
    <div class="col-lg-6">
        <div class="text-center fw-bold fs-7 text-dark mb-3">10 รายงานการอบรม/ประชุม/สัมนา</div>
        <table class="table table-primary table-striped table-sm">
            <tbody>
                <?php
$sql = "SELECT * FROM `tb_train1` ORDER By `id` DESC LIMIT 10;";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
 ?>
                <tr>
                    <td><a href="index.php?module=train&type=train1&id=<?=$data["id"];?>" target="_blank">
                            <?=$data["tName"];?></a></td>
                    <td><a href="index.php?module=profile&id=<?=$data["tid"];?>"
                            target="_blank"><?=getteacher($conn, "name", $data["tid"]);?></a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="text-end mb-5">
            <a href="index.php?module=list&mode=train1" type="button" class="btn btn-danger text-white fs-6">
                <i class="fas fa-bullhorn"></i> ดูทั้งหมด</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="text-center fw-bold fs-7 text-dark mb-3">10 รายงานการพัฒนาตนเองล่าสุด</div>
        <table class="table table-primary table-striped table-sm">
            <tbody>
                <?php
$sql = "SELECT * FROM `tb_train2` ORDER By `id` DESC LIMIT 10;";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
 ?>
                <tr>
                    <td><a href="index.php?module=train&type=train2&id=<?=$data["id"];?>" target="_blank">
                            <?=$data["tName"];?></a></td>
                    <td><a href="index.php?module=profile&id=<?=$data["tid"];?>"
                            target="_blank"><?=getteacher($conn, "name", $data["tid"]);?></a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="text-end mb-5">
            <a href="index.php?module=list&mode=train2" type="button" class="btn btn-danger text-white fs-6">
                <i class="fas fa-bullhorn"></i> ดูทั้งหมด</a>
        </div>
    </div>
</div>
<script>
const aLabels = <?=json_encode($aLabels, JSON_UNESCAPED_UNICODE);?>;
const aData = <?=json_encode($aData);?>;
const pLabels = <?=json_encode($pLabels, JSON_UNESCAPED_UNICODE);?>;
const pData = <?=json_encode($pData);?>;
</script>
