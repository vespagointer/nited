<?php
$id = $_SESSION["ss_id"];
$imgPro = "../pictures/profile/" . $id . ".jpg";
if (!file_exists($imgPro)) {
 $imgPro = "";
}
?>
<div class="text-center">
    <img src="<?=$imgPro;?>" class="img-thumbnail rounded" style="height:200px;" id="imgProfile">
</div>


<div class="modal fs-6" tabindex="-1" id="upimg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="p-2 fw-bold">อัพโหลดรูปภาพ</div>
            <div class="modal-body text-center"><input type="file" name="image" id="image" class="visually-hidden"
                    accept="image/jpeg" /><button type="button" class="btn btn-primary btn-sm w-50 mb-3"
                    id="btnbrows">เลือกรูป</button>
                <img id="imgview" style="max-width: 80%" class="img-thumbnail rounded mb-3" />
                <div class="modal-footer"><button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">ยกเลิก</button><button type="button" class="btn btn-primary"
                        id="addImage">บันทึก</button></div>
            </div>
        </div>
    </div>
</div>
