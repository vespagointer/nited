<?php
if (!defined("KRITSADAPONG")) {
    //die("Access Denied!");
    @header("location:404.php");
    @die("Access Denied!");
}

$id     = $_GET["id"];
$sql    = "SELECT * FROM `tb_project` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_array($result);
extract($data);
?>
<div class="row col-lg-8 offset-lg-2">
    <div class="text-center py-2">
        <h6 class="mb-2">โครงการ</h6>
    </div>
    <dl class="row">
        <dt class="col-3">id โครงการ</dt>
        <dd class="col-9"><?= $id; ?></dd>
        <dt class="col-3">ชื่อโครงการ</dt>
        <dd class="col-9"><?= html_entity_decode($pname); ?></dd>
        <dt class="col-3">ผู้รับผิดชอบ</dt>
        <dd class="col-9">ศน.<?= $_SESSION["snName"][$person]; ?></dd>
        <dt class="col-3">โรงเรียนที่เข้าร่วมโครงการ</dt>
        <dd class="col-9">
            <?php
            $sql    = "SELECT `scname` FROM `tb_uproject` WHERE `pid`=$id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo $i . ". " . $row["scname"] . "<br/>";
                    $i++;
                }
                echo "</ol>";
            } else {
                echo "ไม่มีโรงเรียนเข้าร่วม";
            }
            ?>
        </dd>
</div>
