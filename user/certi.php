<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}
require_once "../conn.php";

$sql = "SELECT * FROM `tb_certi`";
$result = mysqli_query($conn, $sql);

?>
<div class="row col-lg-8 mx-auto">
    <div class="text-center pt-2">
        <h3 class="text-primary mb-5 fw-bold">รายการเกียรติบัตร</h3>
    </div>
    <div class="row mx-auto">
        <?php
while ($data = mysqli_fetch_assoc($result)) {
 extract($data);
 $descript = (empty($descript) ? "ไม่มีรายละเอียด" : $descript);
 echo "<a href=\"$link\" class=\"mypop list-group-item list-group-item-action\" data-bs-toggle=\"popover\" data-bs-placement=\"top\" data-bs-content=\"$descript\" target=\"_blank\">&DDotrahd; $name</a>";
}

?>
