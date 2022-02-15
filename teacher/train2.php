<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}

$folder = "../train";
$aType = "train2";

$tid = $_SESSION["ss_id"];
$dbtable = "tb_train2";

if (isset($_POST["tname"])) {
 extract($_POST);

 if (!@is_dir($folder)) {
  $oldmask = umask(0);
  mkdir($folder, 0777);
  umask($oldmask);
  fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
 }

 $folder .= DIRECTORY_SEPARATOR . $aType;

 if (!@is_dir($folder)) {
  $oldmask = umask(0);
  mkdir($folder, 0777);
  umask($oldmask);
  fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
 }

 $folder .= DIRECTORY_SEPARATOR . (date('Y') + 543);

 if (!@is_dir($folder)) {
  $oldmask = umask(0);
  mkdir($folder, 0777);
  umask($oldmask);
  fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
 }

 $folder .= DIRECTORY_SEPARATOR . date('m');

 if (!@is_dir($folder)) {
  $oldmask = umask(0);
  mkdir($folder, 0777);
  umask($oldmask);
  fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
 }

 $field = "`tid`, `tName`, `tBy`,`cate`,`tType`,`tCode`,`tHour`,`tYear`, `tDateSt`, `tDateEn`";
 $tname = mysqli_real_escape_string($conn, $tname);
 $tby = mysqli_real_escape_string($conn, $tby);
 $tcode = (int) $tcode;
 $thour = (int) $thour;
 $tyear = (int) $tyear;

 $data = "$tid,'$tname','$tby','$cate','$ttype','$tcode','$thour','$tyear','$tdatest','$tdateen'";
 $sql = "INSERT INTO `$dbtable` ($field) VALUES ($data)";
 if (mysqli_query($conn, $sql)) {
  $id = mysqli_insert_id($conn);
  if ($_FILES["tdoc"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["tdoc"]["tmp_name"];
   $filename = basename($_FILES["tdoc"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `$dbtable` SET `tDoc` = '$newname' WHERE `id` = $id";
    mysqli_query($conn, $sql);
   }
  }
 } else {
  echo mysqli_error($conn);
 }
}
?>


<div class="col-lg-8 mx-auto" id="addTrain">
    <form action="index.php?module=train2" class="form-control px-5 py-3" id="train" method="POST"
        enctype="multipart/form-data">
        <h6 class="text-center fw-bold my-3">เพิ่มรายงานการอบรม หลักสูตรที่ผ่านการรับรองจากคุรุพัฒนา/สพฐ./สสวท.</h6>
        <div class="mb-3">
            <label for="tname" class="form-label">ชื่อการอบรม/ประชุม/สัมนา : </label><span style="color:red">*</span>
            <input type="text" class="form-control" name="tname" id="tname" required>
        </div>
        <div class="mb-3">
            <label for="tby" class="form-label">จัดโดย: </label><span style="color:red">*</span>
            <input type="text" class="form-control" name="tby" id="tby" required>
        </div>
        <div class="mb-3">
            <label for="cate" class="form-label">ระดับ: </label><span style="color:red">*</span>
            <select name="cate" id="cate" class="form-control" required>
                <option></option>
                <option value="นานาชาติ">นานาชาติ</option>
                <option value="ประเทศ">ประเทศ</option>
                <option value="ภาค">ภาค</option>
                <option value="จังหวัด">จังหวัด</option>
                <option value="โรงเรียน">โรงเรียน</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="ttype" class="form-label">ประเภท: </label><span style="color:red">*</span>
            <select class="form-control" name="ttype" id="ttype" required>
                <option value="Onsite">Onsite</option>
                <option value="Online">Online</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tcode" class="form-label">รหัสหลักสูตร: </label><span style="color:red">*</span>
            <input type="number" class="form-control" name="tcode" id="tcode" required>
        </div>
        <div class="mb-3">
            <label for="thour" class="form-label">ชั่วโมงอบรม: </label><span style="color:red">*</span>
            <input type="number" class="form-control" name="thour" id="thour" required>
        </div>
        <div class="mb-3">
            <label for="tyear" class="form-label">ปีการศึกษา: </label><span style="color:red">*</span>
            <input type="number" class="form-control" name="tyear" id="tyear" required>
        </div>
        <div class="mb-3">
            <label for="tdatest" class="form-label">วันที่เริ่ม การอบรม/ประชุม/สัมนา : </label><span
                style="color:red">*</span>
            <input type="text" class="form-control" name="tdatest" id="tdatest" autocomplete="เลือกวันที่" required>
        </div>
        <div class="mb-3">
            <label for="tdateen" class="form-label">วันที่สิ้นสุด การอบรม/ประชุม/สัมนา : </label><span
                style="color:red">*</span>
            <input type="text" class="form-control" name="tdateen" id="tdateen" autocomplete="เลือกวันที่" required>
        </div>
        <div class="mb-3">
            <label for="tdoc" class="form-label">เอกสาร/หลักฐาน <span class="text-muted">เลือกได้เฉพาะไฟล์รูป และ ไฟล์
                    PDF เท่านั้น</span></label><span style="color:red">*</span>
            <input type="file" class="form-control" name="tdoc" id="tdoc" accept="image/png,image/jpeg,application/pdf"
                required>
        </div>
        <div class="text-center">
            <button type="reset" class="btn btn-danger text-white">ล้างข้อมูล</button>
            <button type="submit" class="btn btn-primary w-50">บันทึก</button>
        </div>
    </form>
</div>

<div class="text-end">
    <button type="button" class="btn btn-success btn-sm" id="add"><i class="fa fa-plus"></i> เพิ่มรายงาน</button>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded text-center">
    <h6 class="p-3 fw-bold">รายงานการอบรม หลักสูตรที่ผ่านการรับรองจากคุรุพัฒนา/สพฐ./สสวท.</h6>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `$dbtable`  WHERE `tid` = $tid ORDER BY `tDateSt` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 ?>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>#</th>
                <th>หลักสูตร</th>
                <th>เวลา(ชม.)</th>
                <th>ปกศ.</th>
                <th>ช่วงเวลา</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php
$i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='../index.php?module=train&type=train2&id=" . $data["id"] . "' target='_blank'>" . $data["tName"] . "</a></td>";
  echo "<td>" . $data["tHour"] . "</td>";
  echo "<td>" . $data["tYear"] . "</td>";
  echo "<td class='fit'>" . renderDate($data["tDateSt"]) . "<br /> - <br />" . renderDate($data["tDateEn"]) . "</td>";
  echo "<td class='fit'><a href='#' class='delt' data-id='" . $data["id"] . "'><i class='fa fa-trash text-danger'></i><a/></td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>
