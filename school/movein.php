<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:login.php");}
define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";
$sc_id = $_SESSION["ss_id"];

$sql = "SELECT * FROM `tb_dep`";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
 $scdep[$data["id"]] = $data["name"];
}

$sql = "SELECT * FROM `tb_teacher` WHERE `sc_id`=0";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 ?>
<table class="table table-striped table-bordered bg-light">
    <thead class="thead-inverse">
        <tr>
            <th class="text-center"># <a href='index.php?module=teacher&sort=<?=$resort;?>&page=<?=$page;?>'><i
                        class="fas fa-sort"></i></a></th>
            <th class="text-center">ชื่อ - สกุล</th>
            <th class="text-center">เบอร์โทร</th>
            <th class="text-center">อีเมล์</th>
            <th class="text-center">กลุ่มสาระฯ</th>
            <th class="text-center">จัดการ</th>
        </tr>
    </thead>
    <tbody>

        <?php
$i = 1;
 while ($data = mysqli_fetch_assoc($result)) {
  @extract($data);
  ?>
        <tr>
            <td scope="row" class="text-center"><?=$i;?></td>
            <td><a href="../index.php?module=profile&id=<?=$id;?>" target="_blank"><?=$name;?></a></td>
            <td><?=$tel;?></td>
            <td><?=$email;?></td>
            <td><?=$scdep[$dep];?></td>
            <td class="text-center">
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="รับย้าย" class="movebtn"
                    data-id="<?=$id;?>">
                    <i class="fas fa-plus text-primary"></i></a>
            </td>
        </tr>
        <?php
$i++;
 }?>
    </tbody>
</table>
<?php

} else {
 echo "<div class='col-8 mx-auto text-center p-5 bg-light rounded text-primary fs-3 fw-bold'>ขณะนี้ไม่มีครูให้รับย้าย</div>";
}
?>
