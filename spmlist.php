<?php

require_once "db.php";

$sql = "SELECT `id`,`sc_id`,`name`,`pos`,`dep` FROM `tb_teacher` WHERE `sc_id`=99";

$result = mysqli_query($conn, $sql);

?>

<div class="row mt-md-3">
    <div class="text-center mb-2">
        <h3>บุคลากร สำนักงานเขตพื้นที่การศึกษามัธยมศึกษาน่าน</h3>
    </div>
    <table class="display nowrap mb-2" id="spmnan" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th>ตำแหน่ง</th>
                <th>กลุ่มงาน</th>
            </tr>
        </thead>
        <tbody>
            <?php
$i = 1;
while ($data = mysqli_fetch_assoc($result)):
 extract($data);
 ?>
            <tr>
                <td><?=$i;?></td>
                <td><a href="index.php?module=profile&id=<?=$id;?>"><?=$name;?></a></td>
                <td><?=$pos;?></td>
                <td><?=getSpmDep($conn, $id);?></td>
            </tr>
            <?php $i++;endwhile?>
        </tbody>
    </table>
</div>
