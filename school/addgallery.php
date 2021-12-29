<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:login.php");}
define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";
$sc_id = $_SESSION["ss_id"];
require_once "../simpleimage.php";
$base = "../gallery";
$y = date('Y') + 543;
$m = date('m');

$folder = $base . DIRECTORY_SEPARATOR . $y . DIRECTORY_SEPARATOR . $m;
if (!@is_dir($base)) {
 $oldmask = umask(0);
 mkdir($base, 0777);
 umask($oldmask);
 fopen($base . DIRECTORY_SEPARATOR . "index.html", "w");
}
$sub = $base . DIRECTORY_SEPARATOR . $y;
if (!@is_dir($sub)) {
 $oldmask = umask(0);
 mkdir($sub, 0777);
 umask($oldmask);
 fopen($sub . DIRECTORY_SEPARATOR . "index.html", "w");
}

if (!@is_dir($folder)) {
 $oldmask = umask(0);
 mkdir($folder, 0777);
 umask($oldmask);
 fopen($folder . DIRECTORY_SEPARATOR . "index.html", "w");
}

if (isset($_FILES["upload"])) {
 $i = 1;
 $x = $folder . DIRECTORY_SEPARATOR . time();
 if (!@is_dir($x)) {
  $oldmask = umask(0);
  mkdir($x, 0777);
  umask($oldmask);
  fopen($x . DIRECTORY_SEPARATOR . "index.html", "w");
 }

 foreach ($_FILES["upload"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
   $tmp_name = $_FILES["upload"]["tmp_name"][$key];
   $name = sprintf($x . DIRECTORY_SEPARATOR . "%02d.jpg", $i);
   $image = new SimpleImage($tmp_name);
   $image->maxarea(1024);
   $image->save($name);
   $i++;
  }
 }
 $f01 = $x . DIRECTORY_SEPARATOR . "01.jpg";
 if (file_exists($f01)) {
  $today = date("Y-m-d H:i:s");
  $name = $_POST["gname"];
  $x = substr($x . "/", 3);
  $sql = "INSERT INTO `tb_gallery` VALUES(NULL,'$sc_id','$name','$x','$today')";
  if (mysqli_query($conn, $sql)) {
   $gid = mysqli_insert_id($conn);
   copy($f01, $base . DIRECTORY_SEPARATOR . $gid . ".jpg");
  }
 }
}
?>


<div id="review" class="g-3 row my-3 justify-content-center">
    <div class="w-50 h-25 p-3 text-center" style="background-color:#ccc;">
        <h6>กรุณาเลือกไฟล์รูปภาพ</h6>
        <ul class="text-start">
            <li>รูปแรก จะถูกใช้เป็น ปกอัลบัม และ สไลด์ในหน้าแรกของเว็บ (Tip:เปลี่ยนชื่อไฟล์ให้ขึ้นก่อนไฟล์อื่น)</li>
            <li>ไฟล์รูปภาพประเภท JPEG (.jpg, .jpeg) เท่านั้น</li>
            <li>จำนวนไม่เกิน 12 ภาพ</li>
            <li>ควรจะเป้นภาพแนวนอนเพื่อความสวยงาม</li>

        </ul>
    </div>
</div>

<div class="col-10 offset-1 text-center">
    <form action="index.php?module=addgallery" method="POST" id="gallery" enctype='multipart/form-data'>
        <div class="mb-3">
            <label for="gname" class="form-label">ชื่อกิจกรรม</label>
            <input type="text" class="form-control" name="gname" id="gname" required>
        </div>
        <input name="upload[]" type="file" multiple="multiple" accept=".jpg, .jpeg" class="form-control" id="hinput" />
        <button type="button" class="btn btn-secondary w-50  p-3 mb-3 text-white" id="chose">
            <i class="fas fa-images fa-3x"></i></br>เลือกรูป</button>
        <button type="submit" class="btn btn-success w-100 p-3"><i
                class="fas fa-layer-group fa-3x"></i><br />สร้างอัลบัมกิจกรรม</button>
    </form>
</div>

<button type="button" class="btn btn-primary|secondary|success|danger|warning|info|light|dark|link"></button>