<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}

$tid = $_SESSION["ss_id"];
if (@isset($_POST["link"])) {
 extract($_POST);
 $urlDate = date("Y-m-d");
 $field = "`tid`, `name`, `link`,`date`";
 $data = "$tid,'$name','$link','$urlDate'";
 $sql = "INSERT INTO `tb_tpublish` ($field) VALUES ($data)";
 mysqli_query($conn, $sql);
}

if (@$_GET["mode"] == "del") {
 $id = $_GET["id"];
 $sql = "DELETE FROM `tb_tpublish` WHERE `id`='$id' AND `tid`='$tid'";
 mysqli_query($conn, $sql);
}
?>
<div class="col-lg-8 mx-auto" id="addPublish">
    <form action="index.php?module=publish" class="form-control px-5 py-3" id="train" method="POST"
        enctype="multipart/form-data">
        <h6 class="text-center fw-bold my-3">เผยแพร่ผลงาน</h6>
        <div class="text-center mb-3">สามรถเผยแพร่ งานวิจัย/นวัตกรรม/สื่อการสอน/แผนการสอน/สื่อมัลติมีเดีย ฯลฯ</div>
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อผลงาน : </label><span style="color:red">*</span>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">ลิงก์ผลงาน : </label><span style="color:red">*</span>
            <input type="url" class="form-control" name="link" id="link" placeholder="https://example.com"
                pattern="http(s?)(:\/\/)([wW][wW][wW].)?([a-zA-z0-9\-_]+\.)?([a-zA-z]+)\.([a-zA-z]{2,3})([\.][a-zA-z]{2,3})?([?\/].*)?"
                required>
            <div class="py-1 form-text">* สามารถใส่ลิงก์ google drive, google page, เว็บไซต์ของท่าน, youtube ฯลฯ<br />
                * ลิงก์ ต้องขึ้นต้นด้วย http:// หรือ https:// เท่านั้น!</div>
        </div>
        <div class="text-center">
            <button type="reset" class="btn btn-danger text-white">ล้างข้อมูล</button>
            <button type="submit" class="btn btn-primary w-50">บันทึก</button>
        </div>
    </form>
</div>
<div class="bg-white col-lg-10 mx-auto my-3 rounded">
    <?php
$sql = "SELECT * FROM `tb_tpublish`  WHERE `tid` = $tid ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<table class='table table-striped'><tbody>";
 $i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td class='fit'>$i</td>";
  echo "<td><a href='" . $data["link"] . "' target='_blank'>" . $data["name"] . "</a></td>";
  echo "<td class='fit'>" . renderDate2($data["date"]) . "</td>";
  echo "<td class='fit'><a href='index.php?module=publish&mode=del&id=" . $data["id"] . "'><i class='fa fa-trash text-danger'></i><a/></td>";
  echo "</tr>";
  $i++;
 }
 echo "</tbody></table>";
} else {
 echo "<div class='text-center p-3 '>ไม่มีข้อมูล</div>";
}
?>
