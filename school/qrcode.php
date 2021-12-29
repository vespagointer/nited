<div class="row mx-3">
    <div class="text-center">
        <img src="#" id="newQr" style="display:none" />
    </div>
    <div class="text-md-start text-center fw-bold mb-2">
        กรอกข้อมูลที่จะสร้าง QR Code
    </div>
    <form class="row" action="genqr.php" method="post" name="qrcode" id="qrcode">
        <div class="col-md-9 mb-2">
            <input type="text" name="InputData" id="InputData" class="form-control">
        </div>
        <div class="col-md-3 d-grid d-block mb-2">
            <button type="submit" class="btn btn-primary btn-inline-block btn-sm">สร้าง QR
                Code</button>
        </div>
    </form>
</div>