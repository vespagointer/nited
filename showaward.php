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

?>
<div class="row col-lg-8 offset-lg-2 mt-3">
    <div class="text-center py-2">
        <h6 class="mb-2">รางวัลที่ได้รับ</h6>

    </div>
    <table class="table table-striped">
        <tbody>
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
$i = 0;
if (mysqli_num_rows($result) > 0) {
 while ($data = mysqli_fetch_array($result)) {
  extract($data);
  echo "<a href='scafiles/$year/$filename' target='_blank'>$name</a>&nbsp;";
  $y[$i] = $year;
  $f[$i] = $filename;
  $i++;
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

    <?php
if (isset($f[0])) {
 if (strtolower(substr($f[0], -3)) == "pdf") {
  echo '<embed src="scafiles/' . $y[0] . '/' . $f[0] . '" type="application/pdf"   height="640px" width="100%">';
 } else {
  echo '<img src="scafiles/' . $y[0] . '/' . $f[0] . '" width="100%" class="img-thumbnail rounded">';
 }
}

if (isset($f[1])) {
 if (strtolower(substr($f[1], -3)) == "pdf") {
  echo '<embed src="scafiles/' . $y[1] . '/' . $f[1] . '" type="application/pdf"   height="640px" width="100%">';
 } else {
  echo '<img src="scafiles/' . $y[1] . '/' . $f[1] . '" width="100%" class="img-thumbnail rounded">';
 }
}
?>
</div>
