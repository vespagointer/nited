<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}
if ($_SESSION["ss_status"] != "spm") {@header("location:../index.php");}
?>
<style>
.form-control {
    font-size: 0.8rem !important;
}

</style>
<div class="col-8 mx-auto mt-5">
    <h6 class="text-center fw-bold">ค้นหาครูตามความสามารถ</h6>
    <form action="index.php?module=find" method="post" class="col-8 mx-auto">
        <div class="mb-3">
            <label for="table" class="form-label fs-6">ค้นหาจาก :</label>
            <select class="form-control" name="table" id="table">
                <option value="train1">การอบรม/ประชุม</option>
                <option value="train2">การพัฒนาตนเอง</option>
                <option value="taward_self">รางวัลด้านพัฒนาตนเอง</option>
                <option value="taward_student">รางวัลด้านพัฒนานักเรียน</option>
                <option value="taward_school">รางวัลด้านพัฒนาโรงเรียน</option>
                <option value="degree">วุฒิการศึกษา(วิชาเอก)</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="key" class="form-label fs-6">Key word :</label>
            <input type="text" class="form-control" name="key" id="key">
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary w-50">
                <i class="fas fa-search"></i><br />
                ค้นหา
            </button>
        </div>
    </form>


    <?php
if (isset($_POST["key"])) {
 $table = $_POST["table"];
 $key = $_POST["key"];

 if ($table == "degree") {
  $sql = "SELECT `id`,`name`,`bd`,`bdname`,`md`,`mdname`,`dd`,`ddname` FROM `tb_teacher` WHERE `bdname` LIKE '%$key%' OR `mdname` LIKE '%$key%' OR `ddname` LIKE '%$key%'";
  $result = mysqli_query($conn, $sql);
  echo "<h6 class=\"my-3\">ค้นหาพบ " . mysqli_num_rows($result) . " ข้อมูล</h6>";
  echo '<table class="table table-striped"><tbody>';
  while ($data = mysqli_fetch_assoc($result)) {
   extract($data);
   echo "<tr>";
   echo "<td style=\"white-space: nowrap;\"><a href=\"../index.php?module=profile&id=$id\" target=\"_blank\">$name</a></td><td>$bd : $bdname</td><td>$md : $mdname</td><td>$dd : $ddname</td>";
   echo "<tr>";
  }
  echo "</tbody></table>";

 } else {
  $table = "tb_" . $table;

  $mode = explode("_", $table);

  $type = $mode[count($mode) - 1];
  if ($mode[1] == "taward") {
   $link = "../index.php?module=taward&atype=$type&id=";
   $parm = "aname";
  } else {
   $link = "../index.php?module=train&type=$type&id=";
   $parm = "tName";
  }

  $sql = "SELECT `id`,`tid`,`$parm` FROM `$table` WHERE `$parm` LIKE '%$key%'";
  $result = mysqli_query($conn, $sql);
  echo "<h6 class=\"my-3\">ค้นหาพบ " . mysqli_num_rows($result) . " ข้อมูล</h6>";
  echo '<table class="table table-striped"><tbody>';
  while ($data = mysqli_fetch_row($result)) {
   echo "<tr>";
   echo "<td><a href=\"$link$data[0]\" target=\"_blank\">" . $data[2] . "</a></td><td style=\"white-space: nowrap;\"><a href=\"../index.php?module=profile&id=$data[1]\" target=\"_blank\">" . getteacher($conn, "name", $data[1]) . "</a></td>";
   echo "<tr>";
  }
  echo "</tbody></table>";
 }
}
?>
</div>
