<?php
ob_start();
@session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}

if (isset($_POST["url_id"])) {
 //$url_id = $_POST["id"];
 extract($_POST);
 $sql = "UPDATE `urls` SET `name` = '$lname',`lurl` = '$lurl',`gurl` = '$gurl' WHERE `url_id`='$url_id'";
 mysqli_query($conn, $sql);
 header("location:index.php?module=ltable");
}

$url_id = $_GET["id"];
$sql    = "SELECT `name`,`lurl`,`gurl` FROM `urls` WHERE `url_id`='$url_id'";

$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_assoc($result);
extract($data);

?>

<div class="offset-3 col-6">
    <div class="mb-3 text-center fs-6 fw-bold">
        แก้ไข Short URL
    </div>
    <form action="index.php?module=editshort&id=<?=$url_id;?>" method="post">
        <div>
            <div class="row mb-3">
                <div class="col">
                    <label for="lurl" class="form-label">Link URL : </label>
                    <input type="url" class="form-control" id="lurl" name="lurl" required data-bs-toggle="tooltip"
                        data-bs-placement="top" title="วาง Link ที่นี่ครับ" value="<?=$lurl;?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="lname" class="form-label">ชื่อ Link : </label>
                    <input type="text" class="form-control" id="lname" name="lname" maxlength="250" required
                        data-bs-toggle="tooltip" data-bs-placement="top" title="ใส่ชื่อเพื่อง่ายต่อการค้นหา"
                        value="<?=$name;?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="gurl" class="form-label">Google Sheet Link : <br />
                        <span class="text-muted">
                            * ตั้งสิทธิ์ให้ คนที่มีลิ๊งค์สามารถอ่านได้<br />
                            * ตั้งชื่อโรงเรียนเป็นหัวขอแรก (คอลัมน์ที่ 2 ใน Google Sheet)<br />
                            * ชื่อโรงเรียนไม่มีคำว่าโรงเรียน <a href="../schoollist.php"
                                target="_blank">รายชื่อโรงเรียน</a>
                        </span>

                    </label>
                    <input type="url" class="form-control" id="gurl" name="gurl" maxlength="250"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="กรอกเพื่อใช้ระบบ ตรวจสอบโรงเรียน"
                        value="<?=$gurl;?>">
                </div>
            </div>
        </div>
        <div class="text-center">
            <input type="hidden" name="url_id" value="<?=$url_id;?>">
            <button type="submit" class="btn btn-dark">บันทึก</button>
        </div>
    </form>
</div>