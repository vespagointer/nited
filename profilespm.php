<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
$tid = $_GET["id"];
include_once "db.php";

$imgPro = "pictures/profile/" . $tid . ".jpg";
if (!file_exists($imgPro)) {
 $imgPro = "images/profile.png";
}

$sql = "SELECT * FROM `tb_dep`";
$result = mysqli_query($conn, $sql);
$opt = "";
while ($data = mysqli_fetch_assoc($result)) {
 $scdep[$data["id"]] = $data["name"];
 $opt .= "<option value='" . $data["id"] . "'>" . $data["name"] . "</option>";
}
$opt = "<select class='form-control-sm' name='key' required>" . $opt . "</select>";

$sql = "SELECT * FROM `tb_teacher` WHERE `id`=$tid";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
extract($data);
?>
<div class="bg-primary col-lg-9 mx-auto my-3 rounded text-center p-3">
    <h5 class=" fw-bold text-white">ข้อมูลส่วนตัว</h5>
</div>
<div class="text-center my-3">
    <img src="<?=$imgPro;?>" class="img-thumbnail rounded" style="height:300px;" id="imgProfile">
</div>
<div class="row my-3 ">
    <div class="offset-lg-2 col-lg-8 bg-white p-3 rounded">
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <td>
                        ชื่อ :
                    </td>
                    <td>
                        <?=$name;?>
                    </td>
                </tr>
                <?php if(@$_SESSION["ss_status"] == "spm" || @$_SESSION["ss_status"] == "admin" ){ ?>
                <tr>
                    <td>
                        วันเกิด :
                    </td>
                    <td><?=renderDate3($bdate);?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td>
                        ตำแหน่ง :
                    </td>
                    <td><?=$pos;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        กลุ่มงาน :
                    </td>
                    <td><?=getSpmDep($conn, $tid);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        อีเมล์ :
                    </td>
                    <td><?=$email;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        หมายเลขโทรศัพท์ :
                    </td>
                    <td><?=$tel;?>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td>
                        วุฒิ ปริญญาตรี :
                    </td>
                    <td><?=$bd;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วิชาเอก ปริญญาตรี :
                    </td>
                    <td><?=$bdname?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วุฒิ ปริญญาโท :
                    </td>
                    <td><?=$md;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วิชาเอก ปริญญาโท :
                    </td>
                    <td><?=$mdname?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วุฒิ ปริญญาเอก :
                    </td>
                    <td><?=$dd;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วิชาเอก ปริญญาเอก :
                    </td>
                    <td><?=$ddname?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="col-lg-10 mx-auto my-3 rounded text-center alert-success">
    <h6 class="py-2 fw-bold"><a href="index.php?module=list&mode=taward&tid=<?=$tid;?>"
            target="_blank">รางวัลด้านการพัฒนาตนเอง</a>
    </h6>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_taward_self`  WHERE `tid` = $tid ORDER BY `adate` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped table-bordered'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='../index.php?module=taward&atype=self&id=" . $data["id"] . "' target='_blank'>" . $data["aname"] . "</a></td>";
  echo "<td class='fit'>" . renderDate($data["adate"]) . "</td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>

<div class="col-lg-10 mx-auto my-3 rounded text-center alert-success">
    <h6 class="py-2 fw-bold"><a href="index.php?module=list&mode=taward&tid=<?=$tid;?>"
            target="_blank">รางวัลด้านการพัฒนานักเรียน</a></h6>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_taward_student`  WHERE `tid` = $tid ORDER BY `adate` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped table-bordered'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='../index.php?module=taward&atype=student&id=" . $data["id"] . "' target='_blank'>" . $data["aname"] . "</a></td>";
  echo "<td class='fit'>" . renderDate($data["adate"]) . "</td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>

<div class="col-lg-10 mx-auto my-3 rounded text-center alert-success">
    <h6 class="py-2 fw-bold"><a href="index.php?module=list&mode=taward&tid=<?=$tid;?>"
            target="_blank">รางวัลด้านการพัฒนาโรงเรียน</a></h6>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_taward_school`  WHERE `tid` = $tid ORDER BY `adate` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped table-bordered'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='../index.php?module=taward&atype=school&id=" . $data["id"] . "' target='_blank'>" . $data["aname"] . "</a></td>";
  echo "<td class='fit'>" . renderDate($data["adate"]) . "</td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>

<div class="col-lg-10 mx-auto my-3 rounded text-center alert-success">
    <h6 class="py-2 fw-bold"><a href="index.php?module=list&mode=train1&tid=<?=$tid;?>"
            target="_blank">รายงานการอบรม/ประชุม/สัมนา</a></h6>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_train1`  WHERE `tid` = $tid ORDER BY `tDateEn` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped table-bordered'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='../index.php?module=train&type=train1&id=" . $data["id"] . "' target='_blank'>" . $data["tName"] . "</a></td>";
  echo "<td class='fit'>" . renderDate($data["tDateEn"]) . "</td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>

<div class="col-lg-10 mx-auto my-3 rounded text-center alert-success">
    <h6 class="py-2 fw-bold"><a href="index.php?module=list&mode=train2&tid=<?=$tid;?>" target="_blank">รายงานการอบรม
            หลักสูตรที่ผ่านการรับรองจากคุรุพัฒนา/สพฐ./สสวท.</a></h6>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_train2`  WHERE `tid` = $tid ORDER BY `tDateEn` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped table-bordered'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='../index.php?module=train&type=train2&id=" . $data["id"] . "' target='_blank'>" . $data["tName"] . "</a></td>";
  echo "<td class='fit'>" . renderDate($data["tDateEn"]) . "</td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>


<div class="col-lg-10 mx-auto my-3 rounded text-center alert-success">
    <h6 class="py-2 fw-bold"><a href="index.php?module=list&mode=publish&tid=<?=$tid;?>"
            target="_blank">เผยแพร่สื่อ/นวัตกรรม/งานวิจัย/แผนการสอน</a></h6>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_tpublish`  WHERE `tid` = $tid ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped table-bordered'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='" . $data["link"] . "' target='_blank'>" . $data["name"] . "</a></td>";
  echo "<td class='fit'>" . renderDate2($data["date"]) . "</td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
</div>
