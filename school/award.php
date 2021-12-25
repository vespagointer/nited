<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}

$id = $_SESSION["ss_id"];
?>
<div class="row col-lg-6 offset-lg-3" id="addAward">
    <div class="text-center pt-2">
        <h6>เพิ่มรางวัลที่ได้รับ</h6>
    </div>
    <div class="row mx-auto">
        <form action="awardDB.php" id="addBook" enctype="multipart/form-data" method="POST" class="needs-validation"
            novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อรางวัล <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="name" id="name" maxlength="250" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">รายละเอียด</label>
                <textarea name="description" id="description" rows="5" class="form-control w-100"></textarea>
            </div>
            <div class="mb-3">
                <label for="adate" class="form-label">วันที่ได้รับรางวัล <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="adate" name="adate" autocomplete="เลือกวันที่" required>
            </div>
            <div class="mb-3">
                <label for="afrom" class="form-label">หน่วยงานที่มอบรางวัล <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="afrom" id="afrom" maxlength="250" required>
            </div>
            <div class="mb-1" id="attFile">
                <label for="att" class="form-label">แนบเอกสาร/หลักฐาน</label>
                <input type="file" class="form-control" name="att[]" id="att"><input type="text"
                    class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
                <input type="file" class="form-control" name="att[]" id="att"><input type="text"
                    class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
            </div>
            <!--             <div class="mb-3 text-end">
                <button type="button" class="btn btn-secondary btn-block btn-sm" id="addAtt">เพิ่มช่อง</button>
            </div> -->
            <div class="mb-3 text-center">
                <input type="hidden" name="mode" value="addaward">
                <button type="submit" class="btn btn-primary btn-block w-50">บันทึก</button>
            </div>
        </form>
    </div>
</div>
<div class=" alert alert-success text-center my-3 fs-6 fw-bold">
    รางวัลที่ได้รับ
</div>
<div class="row my-2">
    <div class="col-8 text-start">

    </div>
    <div class="col-4 text-end">
        <button type="button" class="btn btn-primary" id="add">เพิ่มรางวัล</button>
    </div>
</div>
<table class="table table-striped table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th class="text-center">#</a></th>
            <th class="text-center">รางวัล</th>
            <th class="text-center">วันที่ได้รับ</th>
            <th class="text-center">หน่วยงานที่มอบ</th>
            <th class="text-center">จัดการ</th>
        </tr>
    </thead>
    <tbody>
        <?php
$sql = "SELECT * FROM `tb_scaward` WHERE `sc_id`=$id ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
$nost = mysqli_num_rows($result);
while ($data = @mysqli_fetch_assoc($result)) {
 @extract($data);
 ?>
        <tr>
            <td scope="row" class="text-center"><?=$nost;?></td>
            <td><a href="index.php?module=awarddetail&id=<?=$id;?>"><?=$name;?></a></td>
            <td><?=$adate;?></td>
            <td><?=$afrom;?></td>
            <td class="text-center">
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="ลบ" class="dela"
                    data-id="<?=$id;?>">
                    <i class="fas fa-trash text-danger"></i></a>
            </td>
        </tr>
        <?php

 $nost--;

}?>
    </tbody>
</table>