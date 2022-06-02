<?php

if (@$_SESSION["ss_status"] != "spm") {
 exit("ACCESS DENINED!");
}
$sql = "SELECT * FROM `tb_teacher` WHERE `sc_id`=99";
$result = mysqli_query($conn, $sql);
?>
<div class="mx-1 my-3">
    <table id="spmtable" class="table table-striped table-bordered table-sm display my-2">
        <thead class="table-dark">
            <tr>
                <th class=" text-center">#</th>
                <th class="text-center">ชื่อ - สกุล</th>
                <th class="text-center">อีเมล์</th>
                <th class="text-center">เบอร์โทร</th>
                <th class="text-center">ตำแหน่ง</th>
                <th class="text-center">กลุ่มงาน</th>
                <th class="text-center">จัดการ</th>
            </tr>
        </thead>
        <tbody>


            <?php
$i = 1;
while ($data = mysqli_fetch_assoc($result)) {
 extract($data);
 ?>
            <tr>
                <td class=" text-center"><?=$i;?></td>
                <td data-parm="name" data-id="<?=$id;?>"><?=$name;?></td>
                <td data-parm="email" data-id="<?=$id;?>"><?=$email;?></td>
                <td data-parm="tel" data-id="<?=$id;?>"><?=$tel;?></td>
                <td data-parm="pos" data-id="<?=$id;?>"><?=$pos;?></td>
                <td data-parm="spmdep" data-id="<?=$id;?>"><?=getSpmDep($conn, $id);?></td>
                <td class="text-center">
                    | <a href="../index.php?module=profilespm&id=<?=$id;?>" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="ดูโปรไฟล์" target="_blank"><i class="fas fa-user"></i></a>
                    | <span data-bs-toggle="modal" data-bs-target="#cPass" data-id="<?=$id;?>"><a href="#"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="เปลี่ยนรหัสผ่าน">
                            <i class="fas fa-key" style="color:#ad9400;"></i></i></a></span>
                    | <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="ลบ" class="delt"
                        data-id="<?=$id;?>">
                        <i class="fas fa-trash text-danger"></i></a>
                    | </td>
            </tr>

            <?php
$i++;
}
?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="xEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">แก้ไขข้อมูล</h6>
            </div>
            <div class="modal-body">
                <form id="xform">
                    <span id="inp"></span>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="save">บันทึก</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="cPass" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">เปลี่ยนรหัสผ่าน</h6>
            </div>
            <div class="modal-body">
                <label for="pwd" class="form-label">กรอกรหัสผ่านใหม่</label>
                <input type="text" name="pwd" id="pwd" class="form-control" required>
                <input type="hidden" name="tid" id="tid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="savepwd">บันทึก</button>
            </div>
        </div>
    </div>
</div>








<?php if ($_SESSION["ss_status"] == "spm"): ?>
<script>
var status = "admin";
</script>
<?php endif;?>
