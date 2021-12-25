<?php
$id=$_SESSION["ss_id"];
$sql="SELECT * FROM `tb_school` WHERE `id`=$id";
$result=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($result);
extract($data);

?>

<div class="col-md-8 offset-md-2">
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
                <td><?= $director;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?= $ditel;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td><?= $subdi1;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?= $subditel1;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td><?= $subdi2;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?= $subditel2;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td><?= $subdi3;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?= $subditel3;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">รองผู้อำนวยการ</th>
                <td><?= $subdi4;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">โทรศัพท์</th>
                <td><?= $subditel4;?></td>
            </tr>
            <tr>
                <th scope="row" class="fit">จำนวนครู</th>
                <td></td>
            </tr>
            <tr>
                <th scope="row" class="fit">จำนวนนักเรียน</th>
                <td></td>
            </tr>
        </tbody>
    </table>

</div>