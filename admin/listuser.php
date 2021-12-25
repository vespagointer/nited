<?php
if (!defined("KRITSADAPONG")) {
//die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
//define("KRITSADAPONG", true);
require_once "../conn.php";
?>

<div class="text-center" style="padding:20px 0 10px;">
    <h4>รายชื่อศึกษานิเทศ</h4>
</div>

<table class="table table-hover table-sm table-bordered">
    <thead>
        <tr class="table-dark text-white">
            <th scope="col" style="width:5%;" class="text-center">#</a>
            </th>
            <th scope="col" style="width:10%;" class="text-center">ชื่อ - สกุล</th>
            <th scope="col" style="width:10%;" class="text-center">จัดการ</th>
        </tr>
    </thead>
    <tbody>
        <?php
$sql    = "SELECT `id`,`prefix`,`name`,`surname` FROM `tb_user` WHERE `id` != '$adminID'";
$result = mysqli_query($conn, $sql);
$i      = 1;
//echo mysqli_num_rows($result);
while ($data = mysqli_fetch_array($result)) {
 ?>
        <tr>
            <th scope="row" class="text-center"><?=$i;?></th>
            <td><?=$data["prefix"] . $data["name"] . " " . $data["surname"];?></td>
            <td class="text-center">
                | <a href="index.php?module=edituser&id=<?=$data["id"];?>" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="แก้ไข <?=$data["name"];?>"><i
                        class="fas fa-user-edit text-success"></i></a> | <a href="deluser.php?id=<?=$data["id"];?>"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="ลบ <?=$data["name"];?>"
                    id="delete<?=$data["id"];?>" class="delbtn"><i
                        class="fas fa-trash text-danger"></i></a>
                |
            </td>
        </tr>
        <?php $i++;}?>
    </tbody>
</table>

<div id="confirm" class="modal">
    <div class="modal-body">
        Are you sure?
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
    </div>
</div>

<div class="modal fade" id="ConFirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>