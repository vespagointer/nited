<?php

if (@$_SESSION["ss_status"] != "spm") {
 exit("ACCESS DENINED!");
}

$sql = "SELECT `id`,`name` FROM `tb_school`";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_row($result)) {
 $school[$data[0]] = $data[1];
}

$sql = "SELECT `id`,`name` FROM `tb_dep`";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_row($result)) {
 $depname[$data[0]] = $data[1];
}

$sql = "SELECT * FROM `tb_teacher` WHERE `sc_id`!=99";
$result = mysqli_query($conn, $sql);
?>
<div class="mx-1 my-3">
    <table id="teacher" class="table table-striped table-bordered table-sm display my-2">
        <thead class="table-dark">
            <tr>
                <th class="text-center">ชื่อ - สกุล</th>
                <th class="text-center">อีเมล์</th>
                <th class="text-center">เบอร์โทร</th>
                <th class="text-center">ตำแหน่ง</th>
                <th class="text-center">โรงเรียน</th>
                <th class="text-center">กลุ่มสาระฯ</th>
            </tr>
        </thead>
        <tbody>


            <?php

while ($data = mysqli_fetch_assoc($result)) {
 extract($data);
 ?>
            <tr>
                <td><a href="../index.php?module=profile&id=<?=$id;?>" target="_blank"><?=$name;?></a></td>
                <td><?=$email;?></td>
                <td><?=$tel;?></td>
                <td><?=$pos;?></td>
                <td><?=$school[$sc_id];?></td>
                <td><?=$depname[$dep];?></td>
            </tr>

            <?php

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
