<?php
$id = $_SESSION["ss_id"];
$sql = "SELECT * FROM `tb_school` WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
extract($data);
$_SESSION["ss_id10"] = $id10;
?>
<div class="toast text-white bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body" style="font-size:0.8rem">
            Tips: ข้อความที่มี <i class="far fa-edit"></i> ต่อท้าย สามารถ ดับเบิ้ลคลิ๊กเพื่อแก้ไขข้อความได้
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto btn-sm" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>

<div class="col-md-8 offset-md-2">
    <div class=" alert alert-success text-center my-3 fs-6 fw-bold">
        โรงเรียน<?=$name;?>
    </div>
    <table class="table table-striped">
        <tbody>
            <tr>
                <th scope="row" class="fit">รหัส 10 หลัก</th>
                <td><?=$id10;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รหัส 8 หลัก</th>
                <td><?=$id8;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รหัส 6 หลัก</th>
                <td><?=$id6;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">ผู้อำนวยการ</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="director"><?=$director;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="ditel"><?=$ditel;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="subdi1"><?=$subdi1;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="subditel1"><?=$subditel1;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="subdi2"><?=$subdi2;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="subditel2"><?=$subditel2;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="subdi3"><?=$subdi3;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="subditel3"><?=$subditel3;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="subdi4"><?=$subdi4;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="subditel4"><?=$subditel4;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">จำนวนครู</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="teacher"><?=$teacher;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">จำนวนนักเรียน</th>
                <td class="editable" data-id="<?=$id;?>" data-parm="student"><?=$student;?></td>
            </tr>
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
                <input type="text" name="tmpData" id="tmpData" class="form-control" required>
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="parm" id="parm">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="save">บันทึก</button>
            </div>
        </div>
    </div>
</div>
