<?php
$url = "https://spmnan.ga/";
?>
<div class="d-flex justify-content-center mt-3">
    <h4>สร้าง Short URLs</h4>
</div>
<div class="col-md-8 mx-auto">
    <form id="getURL" action="geturl.php" method="POST">
        <div class="row mb-3">
            <div class="col">
                <label for="lurl" class="form-label">Link URL : <span class="text-danger">*</span></label>
                <input type="url" class="form-control" id="lurl" name="lurl"
                    placeholder="ตัวอย่าง : https://docs.google.com/forms/d/e/1FAIpQLSdiLj66UDjACgfypA" required
                    data-bs-toggle="tooltip" data-bs-placement="top" title="วาง Link ที่นี่ครับ">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="lname" class="form-label">ชื่อ Link : <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="lname" name="lname"
                    placeholder="ตัวอย่าง : Google Drive เก็บรูป" maxlength="250" required data-bs-toggle="tooltip"
                    data-bs-placement="top" title="ใส่ชื่อเพื่อง่ายต่อการค้นหา" required>
            </div>
        </div>
        <div class="row  mb-3">
            <div class="col">
                <label for="ssurl" class="form-label">Custom Short Link : <span
                        class="text-muted">(ไม่กรอกก็ได้ครับ)</span></label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend"><?=$url;?></span>
                    <input type="text" class="form-control" placeholder="option" id="ssurl" name="ssurl"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        title="ใช้ a-z, A-Z, 0-9, _ - หรือ ไม่ต้องกรอกก็ได้ครับ" pattern="[a-zA-Z0-9][a-zA-Z0-9_-]+">
                </div>
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
</div>
