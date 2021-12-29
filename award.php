<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
require_once "db.php";
$id = $_GET["id"];
$sql = "SELECT * FROM `tb_scaward` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
extract($data);
$school = LinkSchool($conn, $sc_id);
if ($id == 0) {
 $school = "ตัวอย่างพิทยาคม";
 $name = "นิเทศก์ดีเด่น";
 $description = "ได้รับรางวัลนิเทศก์ภายในดีเด่นเหรียญทองระดับประเทศ";
 $adate = "16/01/2565";
 $afrom = "สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน";
}
?>
<div class="row col-lg-8 offset-lg-2 mt-3">
    <div class="text-center py-2">
        <h6 class="mb-2">รางวัลที่ได้รับ</h6>

    </div>
    <table class="table table-striped">
        <tbody>
            <tr>
                <td class="col-3">โรงเรียน</td>
                <td class="col-9"><?=$school;?></td>
            </tr>
            <tr>
                <td class="col-3">รางวัล</td>
                <td class="col-9"><?=$name;?></td>
            </tr>
            <tr>
                <td class="col-3">รายละเอียด</td>
                <td class="col-9"><?=$description;?></td>
            </tr>
            <tr>
                <td class="col-3">ได้รับเมื่อ</td>
                <td class="col-9"><?=$adate;?></td>
            </tr>
            <tr>
                <td class="col-3">ได้รับจากหน่วย</td>
                <td class="col-9"><?=$afrom;?></td>
            </tr>
            <tr>
                <td class="col-3">เอกสาร/หลักฐาน</td>
                <td class="col-9">
                    <?php
$sql = "SELECT * FROM `tb_scafile`WHERE `aid`='$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 while ($data = mysqli_fetch_array($result)) {
  extract($data);
  echo "<a href='scafiles/$year/$filename' target='_blank'>$name</a>&nbsp;";
 }
} else {
 if ($id == 0) {
  echo "<a href='example/cer.jpg' target='_blank'>เกียรติบัตร</a><br/><a href='#'>ประกาศ</a>";
 } else {
  echo "ไม่มีเอกสาร";
 }
}
?>
                </td>
            </tr>
        </tbody>
    </table>