<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}
$status = false;
if (isset($_POST["name"])) {
 require_once "../conn.php";
 extract($_POST);

 $sql = "INSERT INTO `tb_certi`(`id`,`name`,`descript`,`link`) VALUES (NULL,'$name','$description','$link')";
 $status = (mysqli_query($conn, $sql) ? true : false);
}
?>
<div class="row col-lg-6 mx-auto " id="addAward">
    <div class="text-center pt-2">
        <h3 class="text-primary mb-3 fw-bold">เพิ่มลิงก์เกียรติบัตร</h3>
    </div>
    <?php if ($status == true) {?>
    <div class="row col-lg-6 mx-auto alert text-center text-danger fw-bold fs-3" id="report">
        บันทึกแล้ว
    </div>
    <?php }?>
    <div class="row mx-auto">
        <form action="index.php?module=addcerti" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อเกียรติบัตร <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="name" id="name" maxlength="250" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">รายละเอียด</label>
                <input type="text" name="description" id="description" rows="5" class="form-control" maxlength="250">
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">ลิงก์เกียรติบัตร <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="link" name="link" required>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary btn-block w-50">บันทึก</button>
            </div>
        </form>
    </div>
</div>
