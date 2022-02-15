<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
include_once "db.php";
$type = $_GET["type"];
$id = (int) $_GET["id"];
$dbTable = sprintf("tb_%s", $type);
$ss_id = (int) @$_SESSION["ss_id"];
$sql = "SELECT * FROM `$dbTable` WHERE `id` = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) <= 0) {
 exit();
}

$data = mysqli_fetch_assoc($result);
extract($data);
?>
<style>
.taward>tbody>tr>td:first-child {
    width: 1%;
    white-space: nowrap;
    padding-left: 0.5rem;
}

</style>
<div class="bg-white col-lg-10 mx-auto my-3 rounded text-center">
    <h6 class="p-3 fw-bold"><?=$tName;?></h6>
</div>
<div class="col-md-8 mx-auto">
    <table class="table table-primary table-striped  taward">
        <tbody>
            <tr>
                <td>ชื่อ - สกุล :</td>
                <td class="nonEdit"><?=LinkTeacher($conn, $tid);?></td>
            </tr>
            <tr>
                <td>หลักสูตร :</td>
                <td data-parm="tName" data-type="text"><?=$tName;?></td>
            </tr>
            <tr>
                <td>ผู้จัด :</td>
                <td data-parm="tBy" data-type="text"><?=$tBy;?></td>
            </tr>
            <tr>
                <td>ระดับ :</td>
                <td data-parm="cate" data-type="select2"><?=$cate;?></td>
            </tr>
            <tr>
                <td>ประเภท :</td>
                <td data-parm="tType" data-type="select"><?=$tType;?></td>
            </tr>
            <?php if ($type == "train2"): ?>
            <tr>
                <td>รหัสหลักสูตร :</td>
                <td data-parm="tCode" data-type="number"><?=$tCode;?></td>
            </tr>
            <tr>
                <td>ชั่วโมงอบรม :</td>
                <td data-parm="tHour" data-type="number"><?=$tHour;?></td>
            </tr>
            <tr>
                <td>ปีการศึกษา :</td>
                <td data-parm="tYear" data-type="number"><?=$tYear;?></td>
            </tr>
            <?php endif?>
            <tr>
                <td>วันที่เริ่ม :</td>
                <td data-parm="tDateSt" data-type="date"><?=renderDate($tDateSt);?></td>
            </tr>
            <tr>
                <td>วันที่สิ้นสุด :</td>
                <td data-parm="tDateEn" data-type="date"><?=renderDate($tDateEn);?></td>
            </tr>
            <tr>
                <td>เอกสาร/หลักฐาน : </td>
                <td data-parm="tDoc" data-type="file">
                    <a href='<?=$tDoc;?>' target='_blank'><i class='fas fa-file-contract'></i></a>
                </td>
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
                <form id="xform">
                    <span id="inp"></span>
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="parm" id="parm">
                    <input type="hidden" name="dtype" id="dtype">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="save">บันทึก</button>
            </div>
        </div>
    </div>
</div>



<script>
<?php if ($tid == $ss_id and $_SESSION["ss_status"] == "teacher"): ?>
const ss_id = <?=$ss_id;?>;
const xid = <?=$id;?>;
<?php else: ?>
const ss_id = 0;
const xid = 0;
<?php endif?>
const xmode = '<?=$type;?>';
</script>
