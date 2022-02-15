<?php

if ($_SESSION["logined"] != true) {@header("location:../login.php");}
define("KRITSADAPONG", true);
require_once "../conn.php";
$tid = $_SESSION["ss_id"];
//echo $BookNo . "<br />";
if (isset($_FILES)) {
 extract(@$_POST);

 $year = date('Y') + 543;
 $folder = "../redcross/" . $year;
 if (!@is_dir($folder)) {
  $oldmask = umask(0);
  mkdir($folder, 0777);
  umask($oldmask);
  fopen($folder . "/index.html", "w");
 }

//echo $bid;
 $name = (date('Y') + 543) . date("mdHis");
 foreach (@$_FILES["att"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["att"]["tmp_name"][$key];
   $filename = basename($_FILES["att"]["name"][$key]);
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (strtoupper($ext) == "PHP") {exit();}

   $newname = $name . "_" . $key . "." . $ext;

   $filename = $attName[$key];
   if (empty($filename)) {
    $filename = "เอกสาร";
   }
   //echo $newname . "<br />";
   if (move_uploaded_file($tmp_name, "$folder/$newname")) {
    $sql = "INSERT INTO `tb_redcross` VALUES (NULL,'$tid','$year','$newname','$filename')";
    mysqli_query($conn, $sql);
   }
  }
 }
}
?>
<div>
    <form action="index.php?module=redcross" id="addBook" enctype="multipart/form-data" method="POST">
        <div class="mb-1 col-md-8 mx-auto" id="attFile">
            <label for="att" class="form-label fw-bold">เพิ่มเอกสารทางยุวกาชาด</label>
            <input type="file" class="form-control" name="att[]" id="att"><input type="text" class="form-control mb-2"
                name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
        </div>
        <div class="mb-3 text-end">
            <button type="button" class="btn btn-secondary btn-block" id="addAtt">เพิ่มช่อง</button>
        </div>
        <div class="mb-3 text-center">
            <input type="hidden" name="mode" value="xxx">
            <input type="hidden" name="bid" value="<?=$bookID;?>">
            <input type="hidden" name="b" value="book">
            <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
        </div>
    </form>
</div>
<div class="col-md-8 mx-auto">
    <?php
$sql = "SELECT * FROM `tb_redcross`WHERE `tid`='$tid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo '<ul class="list-group">';
 $i = 1;
 while ($data = mysqli_fetch_array($result)) {
  extract($data);
  echo "<li class=\"list-group-item\">";
  echo "<a href='../scout/$year/$filename' target='_blank'>$i. $name</a>&nbsp;";
  echo "<a href='delfile.php?mode=redcross&fid=$id' style='color:red' class='delbtn' data-bs-toggle='tooltip' data-bs-placement='top' title='ลบ'><i class='fas fa-times'></i></a>";
  echo "</li>";
  $i++;
 }
 echo "</ul>";
}
?>
</div>
