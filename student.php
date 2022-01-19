<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}

if (!isset($_GET["id"])) {
 exit();
}

$id = (int) $_GET["id"];
$sql = "SELECT * FROM `onetm3` WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
 exit();
}
$data = mysqli_fetch_assoc($result);
?>
<style>
.onet>tbody>tr>td {
    width: 1%;
    white-space: nowrap;
    padding-left: 1rem;
}

</style>
<div class="bg-white col-lg-10 mx-auto my-3 rounded text-center">
    <h5 class="p-3 fw-bold"><?=$data["stName"] . " " . $data["stLname"];?></h5>
</div>
<div class="col-md-6 mx-auto">
    <table class="table table-striped onet">
        <tbody>
            <tr>
                <td>รหัสสนามสอบ</td>
                <td><?=$data["tId"];?></td>
            </tr>
            <tr>
                <td>ชื่อสนามสอบ</td>
                <td><?=$data["tName"];?></td>
            </tr>
            <tr>
                <td>ห้องสอบ</td>
                <td>ห้อง <?=$data["rName"];?> อาคาร <?=$data["bName"];?> ชั้น <?=$data["cName"];?></td>
            </tr>
            <tr>
                <td>เลขที่นั่งสอบ</td>
                <td><?=$data["tNum"];?></td>
            </tr>
        </tbody>
    </table>
</div>
