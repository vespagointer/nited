<?php
@session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}

if (isset($_POST["pName"])) {
 define("KRITSADAPONG", true);
 require_once "../conn.php";
 extract($_POST);
 $sql = "UPDATE `tb_project` SET `pname` = '$pName',`budget` ='$budget',`myear` ='$mYear',`person`='$person' WHERE `id`='$id'";
 mysqli_query($conn, $sql);
 $school   = $_POST["school"];
 $sql      = "SELECT `scid` FROM `tb_uproject` WHERE `pid`=$id";
 $result   = mysqli_query($conn, $sql);
 $data     = mysqli_fetch_all($result, MYSQLI_ASSOC);
 $selected = array();
 foreach ($data as $key2 => $value2) {
  array_push($selected, $value2["scid"]);
 }
 if (empty($school)) {
  $del = $selected;
 } else {
  $del = array_diff($selected, $school);
 }
 foreach ($del as $key => $scid) {
  $sql = "DELETE FROM `tb_uproject` WHERE `pid`='$id' AND `scid` = '$scid'";
  mysqli_query($conn, $sql);
 }
 //var_dump($del);
 $sql    = "SELECT `id`,`name` FROM `tb_school`";
 $result = mysqli_query($conn, $sql);
 while ($row = mysqli_fetch_assoc($result)) {
  $scname[$row["id"]] = $row["name"];
 }

 $ins = array_diff($school, $selected);
 foreach ($ins as $key => $scid) {
  $sql = "INSERT INTO `tb_uproject`(`id`,`pid`,`scid`,`scname`) VALUES(NULL,'$id','$scid','$scname[$scid]')";
  mysqli_query($conn, $sql);
 }
 //var_dump($ins);
 @header("location:index.php?module=projectdetail&id=$id");
}

if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
$id = $_GET["id"];

$sql    = "SELECT * FROM `tb_project` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_array($result);
extract($data, EXTR_PREFIX_SAME, "b");

?>
<div class="row col-lg-6 offset-lg-3">
    <div class="text-center pt-2">
        <h6>แก้ไขโครงการ</h6>
    </div>
    <div class="row mx-auto">
        <form action="editproject.php" method="POST">
            <div class="mb-3">
                <label for="pName" class="form-label">ชื่อโครงการ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="pName" id="pName" maxlength="250" value="<?=$pname;?>"
                    required>
            </div>

            <div class="mb-3">
                <label for="budget" class="form-label">งบประมาณ (บาท) <span style="color:red">*</span></label>
                <input type="number" class="form-control" name="budget" id="budget" maxlength="50" value="<?=$budget;?>"
                    step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="mYear" class="form-label">ปีงบประมาณ <span style="color:red">*</span></label>
                <select class="form-control" name="mYear" id="mYear" required>
                    <?php
for ($i = 2563; $i <= (date('Y') + 546); $i++) {
 //$yy = $StartYear + $i;
 $sl = "";
 if ($i == $myear) {$sl = "selected";}
 echo "<option vaue='$i ' $sl>$i </option>\n";
}
?>

                </select>
            </div>
            <div class="mb-3">
                <label for="person" class="form-label">ผู้รับผิดชอบ <span style="color:red">*</span></label>
                <select class="form-control" name="person" id="person" data-placeholder="เลือกผู้รับผิดชอบ" required>
                    <option></option>
                    <?php
$no = sizeof($person["id"]);
for ($i = 0; $i < $no; $i++) {
 if ($b_person == $person["id"][$i]) {
  $sl = "selected";
 } else {
  $sl = "";
 }
 echo "<option value=\"" . $person["id"][$i] . "\" $sl>ศน." . $person["name"][$i] . "</option>\n";
}
?>
                </select>
            </div>

            <div>
                <label for="school" class="form-label">โรงเรียนที่เข้าร่วมโครงการ</label>
                <select multiple class="chosen-select form-control" name="school[]" id="school"
                    data-placeholder="เลือกโรงเรียนที่เข้าร่วมโครงการ">
                    <option></option>
                    <?php
$sql      = "SELECT `scid` FROM `tb_uproject` WHERE `pid`=$id";
$result   = mysqli_query($conn, $sql);
$data     = mysqli_fetch_all($result, MYSQLI_ASSOC);
$selected = array();
foreach ($data as $key2 => $value2) {
 array_push($selected, $value2["scid"]);
}

$sql    = "SELECT `id`,`name` FROM `tb_school`";
$result = mysqli_query($conn, $sql);
$school = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($school as $key => $value) {
 if (in_array($value["id"], $selected)) {
  $att = "selected";
 } else {
  $att = "";
 }
 echo "<option value='" . $value["id"] . "' $att>" . $value["name"] . "</option>";
}
?>
                </select>

            </div>
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="" id="ckAll" value="checkedValue">
                <label class="form-check-label" for="">
                    เลือกทั้งหมด
                </label>
            </div>
            <div class="mb-3 text-center">
                <input type="hidden" name="id" value="<?=$id;?>">
                <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
            </div>
        </form>
    </div>
</div>