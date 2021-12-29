<?php
$id = $_GET["id"];
require_once "db.php";
$sql = "SELECT * FROM `tb_gallery` WHERE `id` =$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
extract($data);
$school = LinkSchool($conn, $sc_id);
if ($id == 0) {
 $folder = "example/gallery/";
 $name = "ภาพกิจกรรมตัวอย่าง";
 $date = "12/12/2564 12:12:12";
 $school = "โรงเรียนตัวอย่างพิทยาคม";
}
$picture = glob($folder . "*.[jJ][pP][gG]");
$i = 1;
?>
<div class="my-3">
    <h5 class="fe-bold"><?=$name;?></h5>
    โดย <?=$school;?> (<?=$date;?>)
</div>
<div class="row g-3">
    <?php foreach ($picture as $val) {?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="<?=$val;?>" data-lightbox="Nan">
            <img src="<?=$val;?>" class="img-fluid img-thumbnail" alt="nan" />
        </a>
    </div>
    <?php }?>
</div>