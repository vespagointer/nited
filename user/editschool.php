<?php
ob_start();
@session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}

if (isset($_POST["id"])) {
 $url_id    = $_POST["id"];
 $tmpschool = $_POST["school"];
 $schoolx   = implode(",", $tmpschool);

 $sql = "UPDATE `urls` SET `school` = '$schoolx' WHERE `url_id`='$url_id'";
 mysqli_query($conn, $sql);
 header("location:index.php?module=ckschoolv3&id=" . $url_id);
}

$url_id = $_GET["id"];
$sql    = "SELECT * FROM `urls` WHERE `url_id`='$url_id'";

$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_assoc($result);
extract($data);
$selected = array_map('trim', explode(',', $school));
//var_dump($selected);
$sql    = "SELECT `id`,`name` FROM `tb_school`";
$result = mysqli_query($conn, $sql);
$school = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="offset-3 col-6">
    <div class="mb-3 text-center fs-6 fw-bold">
        <a href="<?=$lurl;?>" target="_blank"><?=$name;?></a> (<a href="<?=$gurl;?>" target="_blank">Google Sheet</a>)
    </div>
    <form action="index.php?module=editschool&id=<?=$url_id;?>" method="post">
        <div>
            <label for="school" class="form-label">โรงเรียนที่เข้าร่วมโครงการ</label>
            <select multiple class="chosen-select form-control" name="school[]" id="school"
                data-placeholder="เลือกโรงเรียนที่เข้าร่วมโครงการ">
                <?php
foreach ($school as $key => $value) {
 if (in_array($value["name"], $selected)) {
  $att = "selected";
 } else {
  $att = "";
 }
 echo "<option value='" . $value["name"] . "' $att>" . $value["name"] . "</option>";
}
?>
            </select>

        </div>
        <div class="form-check form-check-inline  mb-3">
            <input type="checkbox" class="form-check-input" name="" id="ckAll" value="checkedValue">
            <label class="form-check-label" for="ckAll">
                เลือกทั้งหมด
            </label>
        </div>
        <div class="text-center">
            <input type="hidden" name="id" value="<?=$url_id;?>">
            <button type="submit" class="btn btn-dark">บันทึก</button>
        </div>
    </form>
    <div class="my-3 text-end">
        <a href="index.php?module=ckschoolv3&id=<?=$url_id;?>">
            <i class="fas fa-school"></i> ตรวจสอบการกรอกข้อมูล
        </a>
    </div>
</div>