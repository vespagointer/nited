<?php
$id=$_SESSION["ss_id"];

if(isset($_POST) && $id==@$_POST["fid"]){
    extract($_POST);
    $sql = "UPDATE `tb_school` SET ".
    "`director` = '$director',".
    "`ditel` = '$ditel',".
    "`subdi1` = '$subdi1',".
    "`subditel1` = '$subditel1',".
    "`subdi2` = '$subdi2',".
    "`subditel2` = '$subditel2',".
    "`subdi3` = '$subdi3',".
    "`subditel3` = '$subditel3',".
    "`subdi4` = '$subdi4',".
    "`subditel4` = '$subditel4',".
    "`teacher` = '$teacher',".
    "`student` = '$student'".
    "WHERE `id`='$fid'";
    mysqli_query($conn, $sql);
    echo mysqli_error($conn);
}

$sql="SELECT * FROM `tb_school` WHERE `id`=$id";
$result=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($result);
extract($data);

?>

<form action="index.php?module=editschool" method="POST" id="upschool" novalidate class="needs-validation">
    <div class="col-md-8 offset-md-2">
        <div class=" alert alert-success text-center my-3 fs-6 fw-bold">
            แก้ไขข้อมูลพื้นฐาน
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="row" class="fit">ชื่อโรงเรียน</th>
                    <td><?= $name;?></td>
                </tr>
                <tr>
                    <th scope="row" class="fit">รหัส 10 หลัก</th>
                    <td><?= $id10;?></td>
                </tr>
                <tr>
                    <th scope="row" class="fit">รหัส 8 หลัก</th>
                    <td><?= $id8;?></td>
                </tr>
                <tr>
                    <th scope="row" class="fit">รหัส 6 หลัก</th>
                    <td><?= $id6;?></td>
                </tr>
                <tr>
                    <th scope="row" class="fit">ผู้อำนวยการ</th>
                    <td><input type="text" class="form-control" value="<?= $director;?>" name="director" id="director">
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="fit">โทรศัพท์</th>
                    <td><input type="tel" class="form-control" value="<?= $ditel;?>" name="ditel" id="ditel"
                            pattern="[0]{1}[0-9]{9}"></td>
                </tr>
                <tr>
                    <th scope="row" class="fit">รองผู้อำนวยการ</th>
                    <td><input type="text" class="form-control" value="<?= $subdi1;?>" name="subdi1" id="subdi1"></td>
                </tr>
                <tr>
                    <th scope="row" class="fit">โทรศัพท์</th>
                    <td><input type="tel" class="form-control" value="<?= $subditel1;?>" name="subditel1" id="subditel1"
                            pattern="[0]{1}[0-9]{9}">
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="fit">รองผู้อำนวยการ</th>
                    <td><input type="text" class="form-control" value="<?= $subdi2;?>" name="subdi2" id="subdi2"></td>
                </tr>
                <tr>
                    <th scope="row" class="fit">โทรศัพท์</th>
                    <td><input type="tel" class="form-control" value="<?= $subditel2;?>" name="subditel2" id="subditel2"
                            pattern="[0]{1}[0-9]{9}">
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="fit">รองผู้อำนวยการ</th>
                    <td><input type="text" class="form-control" value="<?= $subdi3;?>" name="subdi3" id="subdi3"></td>
                </tr>
                <tr>
                    <th scope="row" class="fit">โทรศัพท์</th>
                    <td><input type="tel" class="form-control" value="<?= $subditel3;?>" name="subditel3" id="subditel3"
                            pattern="[0]{1}[0-9]{9}">
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="fit">รองผู้อำนวยการ</th>
                    <td><input type="text" class="form-control" value="<?= $subdi4;?>" name="subdi4" id="subdi4"></td>
                </tr>
                <tr>
                    <th scope="row" class="fit">โทรศัพท์</th>
                    <td><input type="tel" class="form-control" value="<?= $subditel4;?>" name="subditel4" id="subditel4"
                            pattern="[0]{1}[0-9]{9}">
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="fit">จำนวนครู</th>
                    <td><input type="number" class="form-control" value="<?= $teacher;?>" name="teacher" id="teacher">
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="fit">จำนวนนักเรียน</th>
                    <td><input type="number" class="form-control" value="<?= $student;?>" name="student" id="student">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <input type="hidden" name="fid" value="<?= $id;?>">
            <button type="submit" class="btn btn-primary w-50"><i class="fas fa-save"></i><br />บันทึก</button>
        </div>
    </div>
</form>