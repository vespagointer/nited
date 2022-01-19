<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}

$folder = "../taward";

//$folder = $base . DIRECTORY_SEPARATOR . $y . DIRECTORY_SEPARATOR . $m;

$tid = $_SESSION["ss_id"];
if (isset($_POST["aname"])) {
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

 $dbtable = "tb_taward_" . $aType;

 $field = "`tid`, `aname`, `afrom`,`cate`, `adate`";
 $aname = mysqli_real_escape_string($conn, $aname);
 $afrom = mysqli_real_escape_string($conn, $afrom);
 $data = "$tid,'$aname','$afrom','$cate','$adate'";
 $sql = "INSERT INTO `$dbtable` ($field) VALUES ($data)";
 if (mysqli_query($conn, $sql)) {
  $id = mysqli_insert_id($conn);
  if ($_FILES["adoc1"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["adoc1"]["tmp_name"];
   $filename = basename($_FILES["adoc1"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "_1." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `$dbtable` SET `adoc1` = '$newname' WHERE `id` = $id";
    mysqli_query($conn, $sql);
   }
  }
  if ($_FILES["adoc2"]["error"] == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["adoc2"]["tmp_name"];
   $filename = basename($_FILES["adoc2"]["name"]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}
   $newname = $folder . DIRECTORY_SEPARATOR . time() . "_2." . $ext;
   if (move_uploaded_file($tmp_name, "$newname")) {
    $newname = str_replace("\\", "/", $newname);
    $sql = "UPDATE `$dbtable` SET `adoc2` = '$newname' WHERE `id` = $id";
    mysqli_query($conn, $sql);
   }
  }

 } else {
  echo mysqli_error($conn);
 }
}
?>


<div class="col-lg-8 mx-auto" id="addAward">
    <form action="index.php?module=award" class="form-control px-5 py-3" id="taward" method="POST"
        enctype="multipart/form-data">
        <h3 class="text-center fw-bold my-3">เพิ่มรางวัลที่ได้รับ</h3>
        <div class="mb-3">
            <label for="aname" class="form-label">ชื่อรางวัลที่ได้รับ : </label><span style="color:red">*</span>
            <input type="text" class="form-control" name="aname" id="aname" required>
        </div>
        <div class="mb-3">
            <label for="afrom" class="form-label">ได้รับรางวัลจาก: </label><span style="color:red">*</span>
            <input type="text" class="form-control" name="afrom" id="afrom" required>
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
            <label for="adate" class="form-label">วันที่ได้รับ: </label><span style="color:red">*</span>
            <input type="text" class="form-control" name="adate" id="adate" autocomplete="เลือกวันที่" required>
        </div>
        <div class="mb-3">
            <label for="aType" class="form-label">ประเภทของผลงาน: </label>
            <select class="form-control" name="aType" id="aType">
                <option value="self">รางวัลด้านการพัฒนาตนเอง</option>
                <option value="student">รางวัลด้านการพัฒนานักเรียน</option>
                <option value="school">รางวัลด้านการพัฒนาโรงเรียน</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="adoc1" class="form-label">เอกสาร/หลักฐาน <span class="text-muted">เลือกได้เฉพาะไฟล์รูป และ ไฟล์
                    PDF เท่านั้น</span></label><span style="color:red">*</span>
            <input type="file" class="form-control" name="adoc1" id="adoc1"
                accept="image/png,image/jpeg,application/pdf" required>
        </div>
        <div class="mb-3">
            <label for="adoc2" class="form-label">เอกสาร/หลักฐาน <span class="text-muted">เลือกได้เฉพาะไฟล์รูป และ ไฟล์
                    PDF เท่านั้น</span></label>
            <input type="file" class="form-control" name="adoc2" id="adoc2"
                accept="image/png,image/jpeg,application/pdf">
        </div>
        <div class="text-center">
            <button type="reset" class="btn btn-danger text-white">ล้างข้อมูล</button>
            <button type="submit" class="btn btn-primary w-50">บันทึก</button>
        </div>
    </form>
</div>

<div class="text-end">
    <button type="button" class="btn btn-success btn-sm" id="add"><i class="fa fa-plus"></i> เพิ่มรางวัล</button>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded text-center">
    <h5 class="p-3 fw-bold">รางวัลด้านการพัฒนาตนเอง</h5>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_taward_self`  WHERE `tid` = $tid ORDER BY `adate` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='../index.php?module=taward&atype=self&id=" . $data["id"] . "' target='_blank'>" . $data["aname"] . "</a></td>";
  echo "<td class='fit'>" . renderDate($data["adate"]) . "</td>";
  echo "<td class='fit'><a href='#' class='dela' data-type='self' data-id='" . $data["id"] . "'><i class='fa fa-trash text-danger'></i><a/></td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>

<div class="bg-white col-lg-10 mx-auto my-3 rounded text-center">
    <h5 class="p-3 fw-bold">รางวัลด้านการพัฒนานักเรียน</h5>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_taward_student`  WHERE `tid` = $tid ORDER BY `adate` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='../index.php?module=taward&atype=student&id=" . $data["id"] . "' target='_blank'>" . $data["aname"] . "</a></td>";
  echo "<td class='fit'>" . renderDate($data["adate"]) . "</td>";
  echo "<td class='fit'><a href='#' class='dela' data-type='student' data-id='" . $data["id"] . "'><i class='fa fa-trash text-danger'></i><a/></td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>

<div class="bg-white col-lg-10 mx-auto my-3 rounded text-center">
    <h5 class="p-3 fw-bold">รางวัลด้านการพัฒนาโรงเรียน</h5>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_taward_school`  WHERE `tid` = $tid ORDER BY `adate` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='../index.php?module=taward&atype=school&id=" . $data["id"] . "' target='_blank'>" . $data["aname"] . "</a></td>";
  echo "<td class='fit'>" . renderDate($data["adate"]) . "</td>";
  echo "<td class='fit'><a href='#' class='dela' data-type='school' data-id='" . $data["id"] . "'><i class='fa fa-trash text-danger'></i><a/></td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>
