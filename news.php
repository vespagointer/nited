<?php
$id = $_GET["id"];
include_once "conn.php";
include_once "db.php";
$wysiwyg = true;
$sql = "SELECT * FROM `tb_scpr` WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
extract($data);
if ($sc_id == 99) {
 $school = LinkSchool2($conn, $sc_id);
} else {
 $school = LinkSchool($conn, $sc_id);
}
if ($id == 0) {
 $school = "ตัวอย่างพิทยาคม";
 $name = "ข่าวประชาสัมพันธ์ ตัวอย่าง";
 $content = '<p style="text-align:center;"><span class="text-big" style="color:hsl(0, 75%, 60%);"><strong>กีฑามัธยม จังหวัดน่าน</strong></span></p><figure class="image image_resized" style="width:59.65%;"><img src="../pictures/2564/12/1640514436.jpg"></figure>';
 $date = "01/01/2565 01:02:03";
}
?>
<div class="col-12">
    <h5 class="mt-4 mb-3 fw-bold text-center"><?=$name;?></h5>
    <div class="col-12 mx-1 ck-content mb-3">
        <?=$content;?>
    </div>
    <div style="clear:both">
        <span class="fw-bold">เผยแพร่ข่าวโดย : </span><?=$school;?> (<?=$date;?>)
    </div>
</div>
