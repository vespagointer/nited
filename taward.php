<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
include_once "db.php";
$atype = $_GET["atype"];
$id = (int) $_GET["id"];
$ss_id = (int) @$_SESSION["ss_id"];
switch ($atype) {
 case "self":
  $dbTable = "tb_taward_self";
  $msg = "รางวัลด้านการพัฒนาตนเอง";
  break;
 case "school":$dbTable = "tb_taward_school";
  $msg = "รางวัลด้านการพัฒนาโรงเรียน";
  break;
 case "student":$dbTable = "tb_taward_student";
  $msg = "รางวัลด้านการพัฒนานักเรียน";
  break;
 default:exit();
}

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
    <h6 class="p-3 fw-bold" data-parm="aname" data-type="text"><?=$aname;?></h6>
</div>
<div class="col-md-8 mx-auto">
    <table class="table table-striped taward">
        <tbody>
            <tr>
                <td>ชื่อ - สกุล :</td>
                <td class="nonEdit"><?=LinkTeacher($conn, $tid);?></td>
            </tr>
            <tr>
                <td>ได้รับจาก :</td>
                <td data-parm="afrom" data-type="text"><?=$afrom;?></td>
            </tr>
            <tr>
                <td>ระดับ :</td>
                <td data-parm="cate" data-type="select"><?=$cate;?></td>
            </tr>
            <tr>
                <td>ได้รับเมื่อ :</td>
                <td data-parm="adate" data-type="date"><?=renderDate($adate);?></td>
            </tr>
            <tr>
                <td>ประเภท :</td>
                <td class="nonEdit"><?=$msg;?></td>
            </tr>
            <tr>
                <td>เอกสาร/หลักฐาน : </td>
                <td data-parm="adoc1" data-type="file">
                    <?php
if (!empty($adoc1)) {
 echo "<a href='$adoc1' target='_blank'><i class='fas fa-file-contract'></i></a>";
}?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td data-parm="adoc2" data-type="file">
                    <?php
if (!empty($adoc2)) {
 echo "<a href='$adoc2' target='_blank'><i class='fas fa-file-contract'></i></a>";
}
?>
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
const xmode = '<?=$atype;?>';
</script>
