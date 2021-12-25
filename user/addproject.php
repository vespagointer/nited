<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}
$StartYear = date('Y') + 542;
//echo $StartYear;
?>
<div class="row col-lg-6 offset-lg-3">
    <div class="text-center pt-2">
        <h6>เพิ่มโครงการ</h6>
    </div>
    <div class="row mx-auto">
        <form action="projectDB.php" id="addproject" enctype="multipart/form-data" method="POST">

            <div class="mb-3">
                <label for="pName" class="form-label">ชื่อโครงการ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="pName" id="pName" maxlength="250" required>
            </div>

            <div class="mb-3">
                <label for="budget" class="form-label">งบประมาณ (บาท) <span style="color:red">*</span></label>
                <input type="number" class="form-control" name="budget" id="budget" maxlength="50" required>
            </div>
            <div class="mb-3">
                <label for="mYear" class="form-label">ปีงบประมาณ <span style="color:red">*</span></label>
                <select class="form-control" name="mYear" id="mYear" required>
                    <?php
for ($i = 0; $i <= 4; $i++) {
 $yy = $StartYear + $i;
 $sl = "";
 if ($i == 1) {$sl = "selected";}
 echo "<option vaue='$yy' $sl>$yy</option>\n";
}
?>

                </select>
            </div>
            <div class="mb-3">
                <label for="person" class="form-label">ผู้รับผิดชอบโครงการ <span style="color:red">*</span></label>
                <select class="form-control" name="person" id="person" required>
                    <option></option>
                    <?php
$no = sizeof($person["id"]);
for ($i = 0; $i < $no; $i++) {
 echo "<option value=\"" . $person["id"][$i] . "\">ศน." . $person["name"][$i] . "</option>\n";
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

$sql    = "SELECT `id`,`name` FROM `tb_school`";
$result = mysqli_query($conn, $sql);
while ($school = mysqli_fetch_assoc($result)) {
 echo "<option value='" . $school["id"] . "'>" . $school["name"] . "</option>";
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



            <div class="mb-1" id="attFile">
                <label for="att" class="form-label">แนบเอกสาร</label>
                <input type="file" class="form-control" name="att[]" id="att"><input type="text"
                    class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
                <input type="file" class="form-control" name="att[]" id="att"><input type="text"
                    class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
            </div>
            <div class="mb-3 text-end">
                <button type="button" class="btn btn-secondary btn-block btn-sm" id="addAtt">เพิ่มช่อง</button>
            </div>
            <div class="mb-3 text-center">
                <input type="hidden" name="mode" value="addproject">
                <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
            </div>
        </form>
    </div>
</div>