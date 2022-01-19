<div class="row mt-5 col-md-10 mx-auto">
    <div class="text-center">
        <img src="#" id="newQr" style="display:none" class="img-thumbnail" />
    </div>
    <div class="text-md-start text-center fw-bold my-2">
        กรอกข้อมูลที่จะสร้าง QR Code
    </div>
    <form action="genqr.php" method="post" name="qrcode" id="qrcode">
        <div class="mb-2">
            <input type="text" name="InputData" id="InputData" class="form-control">
        </div>
        <div class="mb-2 text-center">
            <button type="submit" class="btn btn-primary btn-inline-block btn-lg">สร้าง QR
                Code</button>
        </div>
    </form>
</div>
