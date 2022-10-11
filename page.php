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
$id = $_GET["id"];
$sql    = "SELECT * FROM `tb_pages` WHERE `id`='$id '";
$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_array($result);
?>
<div class="container mt-5 p-4 pt-5 shadow rounded bg-white">
    <?php echo $data["content"]; ?>
</div>