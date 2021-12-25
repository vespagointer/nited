<?php
@session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}

if (isset($_POST["BookNo"])) {
 define("KRITSADAPONG", true);
 require_once "../conn.php";
 extract($_POST, EXTR_PREFIX_SAME, "b");
 $sql = "UPDATE `tb_book` SET `bookno` = '$BookNo',`bookdate` ='$BookDate', `gotno` ='$GotNo', `gotdate` ='$GotDate', `bookname` ='$BookName',  `bookfrom` ='$BookFrom',  `person`='$person' WHERE `id`='$id'";
 mysqli_query($conn, $sql);
 @header("location:index.php?module=bookdetail&id=$id");
}

if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
$id = $_GET["id"];

$sql    = "SELECT * FROM `tb_book` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_array($result);
extract($data, EXTR_PREFIX_SAME, "b");

?>
<div class="row col-lg-6 offset-lg-3">
    <div class="text-center pt-2">
        <h6>แก้ไขหนังสือเข้า</h6>
    </div>
    <div class="row mx-auto">
        <form action="editbook.php" id="addBook" method="POST">
            <div class="mb-3">
                <label for="BookNo" class="form-label">เลขที่หนังสือ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="BookNo" id="BookNo" maxlength="50" value="<?=$bookno;?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="BookDate" class="form-label">ลงวันที่ <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="BookDate" name="BookDate" autocomplete="เลือกวันที่"
                    value="<?=$bookdate;?>" required>
            </div>
            <div class="mb-3">
                <label for="GotNo" class="form-label">เลขรับหนังสือ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="GotNo" id="GotNo" maxlength="50" value="<?=$gotno;?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="GotDate" class="form-label">วันที่รับหนังสือ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="GotDate" id="GotDate" autocomplete="เลือกวันที่"
                    value="<?=$gotdate;?>" required>
            </div>
            <div class="mb-3">
                <label for="BookName" class="form-label">เรื่อง <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="BookName" id="BookName" maxlength="250"
                    value="<?=$bookname;?>" required>
            </div>
            <div class="mb-3">
                <label for="BookFrom" class="form-label">หน่วยงานต้นเรื่อง <span style="color:red">*</span></label>
                <input type="tel" class="form-control" name="BookFrom" id="BookFrom" maxlength="200"
                    value="<?=$bookfrom;?>" required>
            </div>
            <div class="mb-3">
                <label for="person" class="form-label">ผู้รับผิดชอบ <span style="color:red">*</span></label>
                <select class="form-control" name="person" id="person" required>
                    <option></option>
                    <?php
$no = sizeof($person["id"]);
for ($i = 0; $i < $no; $i++) {
 if ($b_person == $person["id"][$i]) {
  $sl = "selected";
 } else {
  $sl = "";
 }
 echo "<option value=\"" . $person["id"][$i] . "\" $sl>ศน." . $person["name"][$i] . "</option>\n";
}
?>
                </select>
            </div>
            <div class="mb-3 text-center">
                <input type="hidden" name="id" value="<?=$id;?>">
                <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
            </div>
        </form>
    </div>
</div>