<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
$sc_id = $_SESSION["ss_id"];
$aid = $_GET["id"];
$sql = "SELECT * FROM `tb_scaward` WHERE `id`='$aid' AND `sc_id`='$sc_id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
extract($data);
?>
<div class="row col-lg-8 offset-lg-2">
    <div class="text-center py-2">
        <h6 class="mb-2">รางวัลที่ได้รับ</h6>

    </div>
    <dl class="row">
        <dt class="col-3">รางวัล</dt>
        <dd class="col-9 editable" data-id="<?=$id;?>" data-parm="name"><?=$name;?></dd>
        <dt class="col-3">รายละเอียด</dt>
        <dd class="col-9 editable" data-id="<?=$id;?>" data-parm="description"><?=$description;?></dd>
        <dt class="col-3">ได้รับเมื่อ</dt>
        <dd class="col-9 editable" data-id="<?=$id;?>" data-parm="adate"><?=$adate;?></dd>
        <dt class="col-3">ได้รับจากหน่วย</dt>
        <dd class="col-9 editable" data-id="<?=$id;?>" data-parm="afrom"><?=$afrom;?></dd>
        <dt class="col-3">เอกสาร/หลักฐาน</dt>
        <dd class="col-9">
            <?php
//$scid = $id;
$sql = "SELECT * FROM `tb_scafile`WHERE `aid`='$aid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 while ($data = mysqli_fetch_array($result)) {
  extract($data);
  echo "<a href='../scafiles/$year/$filename' target='_blank'>$name</a>&nbsp;";
  echo "<a href='delfile.php?mode=award&fid=$id&aid=$aid' style='color:red' class='delbtn' data-bs-toggle='tooltip' data-bs-placement='top' title='ลบ'><i class='fas fa-times'></i></a><br />";
 }
} else {
 echo "ไม่มีเอกสาร";
}
?>
        </dd>
    </dl>


    <form action="awardDB.php" id="addBook" enctype="multipart/form-data" method="POST">
        <div class="mb-1" id="attFile">
            <label for="att" class="form-label">เพิ่มเอกสาร</label>
            <input type="file" class="form-control" name="att[]" id="att"><input type="text" class="form-control mb-2"
                name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
            <input type="file" class="form-control" name="att[]" id="att"><input type="text" class="form-control mb-2"
                name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
        </div>
        <!--         <div class="mb-3 text-end">
            <button type="button" class="btn btn-secondary btn-block" id="addAtt">เพิ่มช่อง</button>
        </div> -->
        <div class="mb-3 text-center">
            <input type="hidden" name="mode" value="xxx">
            <input type="hidden" name="aid" value="<?=$aid;?>">
            <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
        </div>
    </form>

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