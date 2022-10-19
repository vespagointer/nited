<?php
if (empty($_GET["id"])) {
?>
    <div class="alert alert-danger alert-dismissible fade show my-5" role="alert">
        <strong>ไม่พบหน้านี้</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    exit;
}

$sql = "SELECT `id`,`name` FROM `tb_school` WHERE `id`!=99";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
    $school[$data["id"]] = $data["name"];
}

$id = $_GET["id"];
$sql    = "SELECT * FROM `tb_group` WHERE `id`='$id '";
$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_array($result);
?>
<div class="container mt-5 p-4 pt-5 ps-5 shadow rounded bg-white">
    <div class="h5 fw-bold mb-3 text-primary" style="padding-left:50px;"><?= $data["name"]; ?></div>
    <div class="fw-bold mb-3 h6" style="padding-left:50px;">ประกอบด้วย</div>
    <ul style="padding-left:50px;">
        <?php
        $sql = "SELECT `sc_id` FROM `tb_groupschool` WHERE `g_id`=$id";
        $result = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<li> โรงเรียน" . $school[$data["sc_id"]] . "</li>";
        }
        ?>
    </ul>
</div>