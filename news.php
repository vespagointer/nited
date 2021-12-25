<?php
$id = $_GET["id"];
include_once "conn.php";
include_once "db.php";
$wysiwyg = true;
$sql = "SELECT * FROM `tb_scpr` WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
extract($data);
?>
<div class="col-12">
    <h5 class="mt-4 mb-3 fw-bold"><?=$name;?></h5>
    <div class="col-12 mx-1 ck-content mb-3">
        <?=$content;?>
    </div>
    <div style="clear:both">
        <span class="fw-bold">เผยแพร่ข่าวโดย : </span> <a
            href="index.php?module=school&id=<?=$id;?>"><?=getschool($conn, "name", $data["sc_id"]);?></a> (<?=$date;?>)
    </div>
</div>