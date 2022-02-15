<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}
?>

<div class="col-lg-8 offset-lg-2">
    <div class=" alert alert-success text-center my-3 fs-6 fw-bold">
        ดาวน์โหลดเอกสาร
    </div>
    <?
$sc_id = $_SESSION["ss_id"];
$sql = "SELECT `link`,`name` FROM `tb_links` WHERE `sc_id` = $sc_id OR `sc_id` = 0";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 echo "<ol class='mt-3'>";
 while ($data = mysqli_fetch_row($result)) {
  echo "<li><a href='" . $data[0] . "' target='_blank'>" . $data[1] . "</a></li>";
 }
 echo "</ol>";
}
?>
</div>