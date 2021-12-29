<?php
define("KRITSADAPONG", true);
require_once "conn.php";
require_once "db.php";

$max = 5;

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
  $aLabels[] = getschool($conn, "name", substr($key, 2));
  $aData[] = $val;
  if ($count == $max) {
   break;
  }
  $count++;
 }
} else {
 $aLabels = ["โรงเรียนตัวอย่าง 1", "โรงเรียนตัวอย่าง 2", "โรงเรียนตัวอย่าง 3", "โรงเรียนตัวอย่าง 4", "โรงเรียนตัวอย่าง 5"];
 $aData = [9, 8, 8, 7, 5];
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
  $pLabels[] = getschool($conn, "name", substr($key, 2));
  $pData[] = $val;
  if ($count == $max) {
   break;
  }
  $count++;
 }
} else {
 $pLabels = ["โรงเรียนตัวอย่าง 1", "โรงเรียนตัวอย่าง 2", "โรงเรียนตัวอย่าง 3", "โรงเรียนตัวอย่าง 4", "โรงเรียนตัวอย่าง 5"];
 $pData = [20, 15, 11, 9, 3];
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
            <?php if($row==0): ?>
            <button type="button" data-bs-target="#NanGallery" data-bs-slide-to="0" aria-label="Slide 1" class="active"
                aria-current="true"></button>
            <button type="button" data-bs-target="#NanGallery" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#NanGallery" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <?php endif;

                for($i=0;$i<$row;$i++) :
                    $ac = "";
                    if ($i == 0) {$ac = "class=\"active\" aria-current=\"true\"";}
            ?>
            <button type="button" data-bs-target="#NanGallery" data-bs-slide-to="<?=$i;?>" aria-label="Slide <?=$i;?>"
                <?=$ac;?>></button>
            <?php endfor ?>
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
            if($row==0):        
            ?>
            <div class="center-cropped carousel-item active" style="background-image: url('example/1.jpg');">
                <a href="index.php?module=gallery&id=0">
                    <img src="example/1.jpg" alt="ตัวอย่าง" />
                    <div class="carousel-caption d-none d-md-block ">
                        <div class="myCaption">
                            กีฑามัธยมน่าน 2565
                        </div>
                    </div>
                </a>
            </div>
            <div class="center-cropped carousel-item" style="background-image: url('example/2.jpg');">
                <a href="index.php?module=gallery&id=0">
                    <img src="example/2.jpg" alt="ตัวอย่าง" />
                    <div class="carousel-caption d-none d-md-block ">
                        <div class="myCaption">
                            ปฐมนิเทศก์ โรงเรียนสารทิศพิทยาคม
                        </div>
                    </div>
                </a>
            </div>

            <div class="center-cropped carousel-item" style="background-image: url('example/3.jpg');">
                <a href="index.php?module=gallery&id=0">
                    <img src="example/3.jpg" alt="ตัวอย่าง" />
                    <div class="carousel-caption d-none d-md-block ">
                        <div class="myCaption">
                            กีฑามัธยมน่าน 2561
                        </div>
                    </div>
                </a>
            </div>
            <?php endif;?>
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
    $i=1;
 while ($data = mysqli_fetch_assoc($result)) {
     ?>
                <tr class="news news<?=$i;?>">
                    <td scope="row"><i class="fas fa-bullhorn text-white fs-5"></i></td>
                    <td>
                        <a href="index.php?module=news&id=<?=$data["id"];?>" target="_blank"><?=$data["name"];?></a>
                        <br />เมื่อ : <?=$data["date"];?>
                    </td>
                    <td><?=LinkSchool($conn,$data["sc_id"]);?></td>
                </tr>
                <?
 $i++;
}
} else {
 ?>

                <?php for ($i = 1; $i <= 5; $i++) {?>
                <tr class="news news<?=$i;?>">
                    <td scope="row"><i class="fas fa-bullhorn text-white fs-5"></i></td>
                    <td>
                        <a href="index.php?module=news&id=0" target="_blank">ข้อมูลตัวอย่าง <?=$i;?></a>
                        <br />เมื่อ : <?=date("Y-m-d H:i:s");?>
                    </td>
                    <td>โรงเรียน <?=$i;?></td>
                </tr>
                <?php
}
}?>
            </tbody>
        </table>
        <div class="text-end mb-5">
            <a href="#" type="button" class="btn btn-danger text-white fs-6">
                <i class="fas fa-bullhorn"></i> ดูข่าวทั้งหมด</a>
        </div>
    </div>
</div>


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
        <table class="table">
            <tbody>
                <?php
$sql = "SELECT * FROM `tb_scaward` ORDER BY `id` DESC LIMIT 10";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $i=1;
 while ($data = mysqli_fetch_assoc($result)) {
     ?>
                <tr class="pastel pastel<?=$i;?>">
                    <td scope="row"><i class="fas fa-trophy text-white fs-5"></i></td>
                    <td><a href="index.php?module=award&id=<?=$data["id"];?>" target="_blank"><?=$data["name"];?></a>
                    </td>
                    <td><?=LinkSchool($conn,$data["sc_id"]);?></td>
                </tr>
                <?
 $i++;
}
} else {
 ?>

                <?php for ($i = 1; $i <= 10; $i++) {?>
                <tr class="pastel pastel<?=$i;?>">
                    <td scope="row"><i class="fas fa-trophy text-white fs-5"></i></td>
                    <td><a href="index.php?module=award&id=0" target="_blank">ข้อมูลตัวอย่าง <?=$i;?></td>
                    <td>โรงเรียน <?=$i;?></td>
                </tr>
                <?php
}
}?>
            </tbody>
        </table>
        <div class="text-end mb-5">
            <a href="#" type="button" class="btn btn-danger text-white fs-6">
                <i class="fas fa-bullhorn"></i> รางวัลทั้งหมด</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="text-center fw-bold fs-7 text-dark mb-3">10 รางวัลล่าสุดของครู</div>
        <table class="table">
            <tbody>
                <?php
$sql = "SELECT * FROM `tb_tcaward` ORDER BY `id` DESC LIMIT 10";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $i=1;
 while ($data = mysqli_fetch_assoc($result)) {
     ?>
                <tr class="pastel pastel<?=$i;?>">
                    <td scope="row"><i class="fas fa-award text-white fs-5"></i></td>
                    <td><?=$data["name"];?></td>
                    <td><?=getteacher($conn,"name",$data["tc_id"]);?></td>
                </tr>
                <?
 $i++;
}
} else {
 ?>

                <?php for ($i = 1; $i <= 10; $i++) {?>
                <tr class="pastel pastel<?=$i;?>">
                    <td scope="row"><i class="fas fa-award text-white fs-5"></i></td>
                    <td>ข้อมูลตัวอย่าง <?=$i;?></td>
                    <td>ครู <?=$i;?></td>
                </tr>
                <?php
}
}?>
            </tbody>
        </table>
        <div class="text-end mb-5">
            <a href="#" type="button" class="btn btn-danger text-white fs-6">
                <i class="fas fa-bullhorn"></i> รางวัลทั้งหมด</a>
        </div>
    </div>
</div>

<script>
const aLabels = <?=json_encode($aLabels, JSON_UNESCAPED_UNICODE);?>;
const aData = <?=json_encode($aData);?>;
const pLabels = <?=json_encode($pLabels, JSON_UNESCAPED_UNICODE);?>;
const pData = <?=json_encode($pData);?>;
</script>