<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
?>
<div class="row col-lg-6 offset-lg-3">
    <div class="text-center pt-2">
        <h6>เพิ่มผู้ใช้งาน</h6>
    </div>
    <div class="row mx-auto">
        <form action="insertDB.php" id="myForm">
            <div class="mb-3">
                <label for="uname" class="form-label">Username</label>
                <input type="text" class="form-control" name="uname" id="uname" required>
            </div>
            <div class="mb-3">
                <label for="upass" class="form-label">Password</label>
                <input type="password" class="form-control" name="upass" id="upass" required>
            </div>
            <div class="mb-3">
                <label for="prefix" class="form-label">คำนำหน้าชื่อ</label>
                <input type="text" class="form-control" name="prefix" id="prefix" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="surname" id="surname" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                <input type="tel" class="form-control" name="tel" id="tel">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล์</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
                <label for="LineToken" class="form-label">Line Token</label>
                <input type="text" class="form-control" name="LineToken" id="LineToken">
            </div>
            <div class="mb-3 text-center">
                <input type="hidden" name="mode" value="adduser">
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>
</div>