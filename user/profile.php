<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}

$uid = $_SESSION["ss_id"];

if (isset($_POST["prefix"])) {
 extract($_POST);
 $sql = "UPDATE `tb_user`SET `prefix`='$prefix', `name`='$name',`surname`='$surname',`tel`='$tel',`email`='$email',`token`='$token' WHERE `id`='$uid'";
 mysqli_query($conn, $sql);
 $_SESSION["ss_name"]    = $name;
 $_SESSION["ss_surname"] = $surname;
}

$sql    = "SELECT * FROM `tb_user` WHERE `id`='$uid '";
$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_array($result);
extract($data);
?>
<div class="row col-lg-6 offset-lg-3">
    <div class="row mx-auto">
        <form action="index.php?module=profile" id="profile" method="POST">
            <div class="mb-3">
                <label for="prefix" class="form-label">คำนำหน้าชื่อ</label>
                <input type="text" class="form-control" name="prefix" id="prefix" value="<?=$prefix;?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="name" id="name" value="<?=$name;?>" required>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="surname" id="surname" value="<?=$surname;?>" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                <input type="tel" class="form-control" name="tel" id="tel" value="<?=$tel;?>">
            </div>
            <div class=" mb-3">
                <label for="email" class="form-label">อีเมล์</label>
                <input type="email" class="form-control" name="email" id="email" value="<?=$email;?>">
            </div>
            <div class=" mb-3">
                <label for="token" class="form-label">Line Token</label>
                <input type="text" class="form-control" name="token" id="token" value="<?=$token;?>">
            </div>
            <div class="mb-3 text-center">
                <input type="hidden" name="mode" value="edituser">
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>
</div>