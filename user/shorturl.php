<?php
$url = "http://spmnan.ga/";
?>
<div class="d-flex justify-content-center">
    <h3>สร้าง Short URLs</h3>
</div>

<form id="getURL" action="geturl.php" method="POST">
    <div class="row mb-3">
        <div class="col">
            <label for="lurl" class="form-label">Link URL : </label>
            <input type="url" class="form-control" id="lurl" name="lurl"
                placeholder="ตัวอย่าง : https://docs.google.com/forms/d/e/1FAIpQLSdiLj66UDjACgfypA" required
                data-bs-toggle="tooltip" data-bs-placement="top" title="วาง Link ที่นี่ครับ">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="lname" class="form-label">ชื่อ Link : </label>
            <input type="text" class="form-control" id="lname" name="lname"
                placeholder="ตัวอย่าง : Google Drive เก็บรูป" maxlength="250" required data-bs-toggle="tooltip"
                data-bs-placement="top" title="ใส่ชื่อเพื่อง่ายต่อการค้นหา" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="gurl" class="form-label">Google Sheet Link : <br />
                <span class="text-muted">
                    * ตั้งสิทธิ์ให้ คนที่มีลิ๊งค์สามารถอ่านได้<br />
                    * ตั้งชื่อโรงเรียนเป็นหัวขอแรก (คอลัมน์ที่ 2 ใน Google Sheet)<br />
                    * ชื่อโรงเรียนไม่มีคำว่าโรงเรียน <a href="../schoollist.php" target="_blank">รายชื่อโรงเรียน</a>
                </span>

            </label>
            <input type="url" class="form-control" id="gurl" name="gurl"
                placeholder="ตัวอย่าง : https://docs.google.com/spreadsheets/d/1mvfn2sHlqtZr46Yh48gTXg3se8Gz7_4WaORpaycTdik/edit#gid=542621304"
                maxlength="250" data-bs-toggle="tooltip" data-bs-placement="top"
                title="กรอกเพื่อใช้ระบบ ตรวจสอบโรงเรียน">
        </div>
    </div>
    <div>
        <label for="school" class="form-label">โรงเรียนที่ต้องกรอกข้อมูล</label>
        <select multiple class="chosen-select form-control" name="school[]" id="school"
            data-placeholder="เลือกโรงเรียนที่ต้องกรอกข้อมูล" data-bs-toggle="tooltip" data-bs-placement="top"
            title="ต้องกรอก ถ้าต้องการใช้ระบบตรวจสอบโรงเรียน">
            <?php

$sql = "SELECT `name` FROM `tb_school`";
$result = mysqli_query($conn, $sql);
while ($school = mysqli_fetch_assoc($result)) {
 echo "<option value='" . $school["name"] . "'>" . $school["name"] . "</option>";
}
?>
        </select>

    </div>
    <div class="form-check form-check-inline">
        <input type="checkbox" class="form-check-input" name="" id="ckAll" value="checkedValue">
        <label class="form-check-label" for="">
            เลือกทั้งหมด
        </label>
    </div>
    <div class="row  mb-3">
        <div class="col">
            <label for="wurl" class="form-label">Web URL : </label>
            <input type="url" class="form-control" value="<?=$url;?>" id="wurl" readonly disabled>
        </div>
        <div class="col">
            <label for="ssurl" class="form-label">Custom Short Link : </label>
            <input type="text" class="form-control" placeholder="option" id="ssurl" name="ssurl"
                data-bs-toggle="tooltip" data-bs-placement="top" title="ใช้ a-z, A-Z, 0-9, _ หรือ ไม่ต้องกรอกก็ได้ครับ"
                pattern="[a-zA-Z0-9][a-zA-Z0-9_]+">
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <input class="btn btn-danger text-white" type="submit" value="สร้าง Short URL">
    </div>

</form>
<br />
<div class="text-center">
    <img id="qrcode" src="#" width="200" style="display:none" />
</div>
<div class="row mb-3">
    <div class="col">
        <label for="lurl" class="form-label">Short URL Link: </label>
        <input type="url" class="form-control" id="surl" placeholder="คลิ๊ก! สร้าง Short URL" disabled>
    </div>
</div>

<div class="d-flex justify-content-center">
    <button onclick="CopyLink()" class="btn btn-success" disabled id="CopyB">Copy Short URL Link</button>
</div>
<br />
<div class="row mb-3 mx-2" id="tbLinks">
    <?php
include_once "ltable.php";
?>
</div>