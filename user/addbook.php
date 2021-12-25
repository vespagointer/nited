<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}
?>
<div class="row col-lg-6 offset-lg-3">
    <div class="text-center pt-2">
        <h6>เพิ่มหนังสือเข้า</h6>
    </div>
    <div class="row mx-auto">
        <form action="addBookDB.php" id="addBook" enctype="multipart/form-data" method="POST">
            <div class="mb-3">
                <label for="BookNo" class="form-label">เลขที่หนังสือ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="BookNo" id="BookNo" maxlength="50" required>
            </div>
            <div class="mb-3">
                <label for="BookDate" class="form-label">ลงวันที่ <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="BookDate" name="BookDate" autocomplete="เลือกวันที่"
                    required>
            </div>
            <div class="mb-3">
                <label for="GotNo" class="form-label">เลขรับหนังสือ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="GotNo" id="GotNo" maxlength="50" required>
            </div>
            <div class="mb-3">
                <label for="GotDate" class="form-label">วันที่รับหนังสือ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="GotDate" id="GotDate" autocomplete="เลือกวันที่" required>
            </div>
            <div class="mb-3">
                <label for="BookName" class="form-label">เรื่อง <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="BookName" id="BookName" maxlength="250" required>
            </div>
            <div class="mb-3">
                <label for="BookFrom" class="form-label">หน่วยงานต้นเรื่อง <span style="color:red">*</span></label>
                <input type="tel" class="form-control" name="BookFrom" id="BookFrom" maxlength="200" required>
            </div>
            <div class="mb-3">
                <label for="person" class="form-label">ผู้รับผิดชอบ <span style="color:red">*</span></label>
                <select class="form-control" name="person" id="person" required>
                    <option></option>
                    <?php
$no = sizeof($person["id"]);
for ($i = 0; $i < $no; $i++) {
 echo "<option value=\"" . $person["id"][$i] . "\">ศน." . $person["name"][$i] . "</option>\n";
}
?>
                </select>
            </div>
            <div class="mb-1" id="attFile">
                <label for="att" class="form-label">แนบเอกสาร</label>
                <input type="file" class="form-control" name="att[]" id="att"><input type="text"
                    class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
                <input type="file" class="form-control" name="att[]" id="att"><input type="text"
                    class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
            </div>
            <div class="mb-3 text-end">
                <button type="button" class="btn btn-secondary btn-block btn-sm" id="addAtt">เพิ่มช่อง</button>
            </div>
            <div class="mb-3 text-center">
                <input type="hidden" name="mode" value="addbook">
                <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
            </div>
        </form>
    </div>
</div>