<div class="mt-5 text-center">
    <a href="index.php?module=sp&cc=1" class="btn btn-success me-5">รางวัลด้านการพัฒนาตนเอง</a><br><br>
    <a href="index.php?module=sp&cc=2" class="btn btn-info me-5">รางวัลด้านการพัฒนานักเรียน</a><br><br>
    <a href="index.php?module=sp&cc=3" class="btn btn-danger me-5">รางวัลด้านการพัฒนาโรงเรียน</a>
</div>

<?php
include_once "db.php";
$cc = $_GET["cc"];
if (!isset($cc)) {
 $cc = 1;
}

switch ($cc) {
 case "1":
  $table = "tb_taward_self";
  break;
 case "2":
  $table = "tb_taward_student";
  break;
 case "3":
  $table = "tb_taward_school";
  break;
}
//$table = "tb_" . $table;

$mode = explode("_", $table);

$type = $mode[count($mode) - 1];
$link = "index.php?module=taward&atype=$type&id=";

$sql = "SELECT `id`,`tid`,`aname`,`adate` FROM `$table` WHERE `cate` LIKE 'ประเทศ' ORDER BY `adate` DESC ";
$result = mysqli_query($conn, $sql);
echo "<h6 class=\"my-3\">ค้นหาพบ " . mysqli_num_rows($result) . " ข้อมูล</h6>";
echo '<table class="table table-striped"><tbody>';
while ($data = mysqli_fetch_row($result)) {
 echo "<tr>";
 echo "<td><a href=\"$link$data[0]\" target=\"_blank\">" . $data[2] . "</a></td><td style=\"white-space: nowrap;\"><a href=\"../index.php?module=profile&id=$data[1]\" target=\"_blank\">" . getteacher($conn, "name", $data[1]) . "</a></td>";
 echo "<td>" . renderDate($data[3]) . "</td>";
 echo "<tr>";
}
echo "</tbody></table>";
