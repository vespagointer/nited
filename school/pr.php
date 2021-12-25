<?php
@session_start();
include_once "../conn.php";
include_once "../db.php";
$wysiwyg = true;
$sc_id = $_SESSION["ss_id"];
$today = date("Y-m-d H:i:s");

if (isset($_POST["name"])) {
 $name = mysqli_real_escape_string($conn, $_POST["name"]);
 $content = mysqli_real_escape_string($conn, $_POST["prcontent"]);
 $sql = "INSERT INTO `tb_scpr` VALUES (NULL,'$sc_id','$name','$content','$today' )";
 inc_stat($conn, $sc_id, "pr");
 if (isset($_POST["id"])) {
  $id = @$_POST["id"];
  $sql2 = "SELECT * FROM `tb_scpr` WHERE `id`=$id AND `sc_id`=$sc_id";
  $result = mysqli_query($conn, $sql2);
  if (mysqli_num_rows($result) > 0) {
   $sql = "UPDATE `tb_scpr` SET `name`='$name', `content`='$content' WHERE `id`=$id";
   dec_stat($conn, $sc_id, "pr");
  }
 }
 mysqli_query($conn, $sql);
}
$name = "";
$content = "";

if (isset($_GET["id"])) {
 $id = $_GET["id"];
 $sql = "SELECT * FROM `tb_scpr` WHERE `id`=$id AND `sc_id`=$sc_id";
 $result = mysqli_query($conn, $sql);
 $data = mysqli_fetch_assoc($result);
 $name = $data["name"];
 $content = $data["content"];
}
?>
<div class="px-2">
    <div>
        <h3 class="text-secondary text-center mb-3"><i class="fas fa-bullhorn"></i> ข่าวประชาสัมพันธ์</h3>
    </div>
    <div id="prForm">
        <form action="index.php?module=pr" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">หัวข้อข่าวประชาสัมธ์</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?=$name;?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="prcontent" class="form-label">เนื้อหาข่าว</label>
                <textarea class="form-control" name="prcontent" id="prcontent" rows="20"><?=$content;?></textarea>
            </div>
            <?php if (isset($id)): ?>
            <input type="hidden" name="id" value="<?=$id;?>">
            <?php endif?>
            <div class="text-center"><button type="submit" class="btn btn-primary btn-lg">เผยแพร่</button></div>
        </form>
    </div>

    <div class="row my-2">
        <div class="col-8 text-start">

        </div>
        <div class="col-4 text-end">
            <button type="button" class="btn btn-primary btn-sm" id="add">เพิ่มช่าวประชาสัมพันธ์</button>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-inverse">
            <tr>
                <th class="text-center">#</a></th>
                <th class="text-center">เรื่อง</th>
                <th class="text-center">เผยแพร่เมื่อ</th>
                <th class="text-center">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
$sql = "SELECT * FROM `tb_scpr` WHERE `sc_id`=$sc_id ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
$nost = mysqli_num_rows($result);
while ($data = @mysqli_fetch_assoc($result)) {
 @extract($data);
 ?>
            <tr>
                <td scope="row" class="text-center"><?=$nost;?></td>
                <td><a href="../index.php?module=news&id=<?=$id;?>" target="_blank"><?=$name;?></a></td>
                <td><?=$date;?></td>
                <td class="text-center">
                    | <a href="index.php?module=pr&mode=edit&id=<?=$id;?>" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="แก้ไข"><i class="fas fa-user-edit text-success"></i></a>
                    |
                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="ลบ" class="delpr"
                        data-id="<?=$id;?>">
                        <i class="fas fa-trash text-danger"></i></a> |
                </td>
            </tr>
            <?php

 $nost--;

}?>
        </tbody>
    </table>
</div>