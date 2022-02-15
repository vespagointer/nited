<?php

$campus_name = [
 1 => "เวียงปอ",
 2 => "เวียงภูเพียง",
 3 => "วรนคร",
 4 => "ศิลาทอง",
];
$campus = [
 1 => "2,4,7,16,17,18,22,23",
 2 => "1,3,5,6,24,27,28,30",
 3 => "8,10,19,20,21,25,29",
 4 => "9,11,12,13,14,15,26",
];
if (isset($_GET["cp"])) {
 $cp = $_GET["cp"];
 $inCampus = $campus[$cp];
 ?>

<div class="visually-hidden">
    <?php include_once "updatestat.php";?>
</div>
<div class="mx-auto col-lg-10 row my-3">
    <div class="fs-3 fw-bold text-center mb-4 text-primary">สหวิทยาเขต<?=$campus_name[$cp];?></div>
    <div class="col-4 text-center">

        <div class="card text-white fs-5" style="background-color: #0d6efd;">
            <div class="card-body">
                จำนวนบุคลากร<br />
                <?php
$sql = "SELECT COUNT(`id`) FROM `tb_teacher` WHERE `sc_id` in ($inCampus)";
 $result = mysqli_query($conn, $sql);
 $cnt = mysqli_fetch_row($result)[0];
 echo number_format($cnt, 0, '.', ',');
 ?>
                คน</div>
        </div>
    </div>
    <div class="col-4 text-center">
        <div class="card text-white fs-5" style="background-color:#6610f2;">
            <div class="card-body">
                จำนวนผู้รายงาน
                <br />
                <?php
$sql = "SELECT * FROM `tb_statistics` WHERE `name`='all'";
 $result = mysqli_query($conn, $sql);
 $all = mysqli_fetch_row($result);
 array_shift($all);
 array_shift($all);
 $key = explode(',', $inCampus);
 $sum = 0;
 foreach ($key as $index) {
  $sum = $sum + $all[$index];
 }
//$up = array_sum($all);
 echo $sum;
 ?>
                คน
            </div>
        </div>
    </div>
    <div class="col-4 text-center">
        <div class="card text-white fs-5" style="background-color:#d63384;">
            <div class="card-body">
                ร้อยละผู้รายงาน<br />
                <?php
$per_all = sprintf("%.2f", ($sum * 100) / $cnt);
 echo $per_all . " %";
 ?>
            </div>
        </div>
    </div>






</div>

<table class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">โรงเรียน</th>
            <th class="text-center">จำนวนบุคลากร</th>
            <th class="text-center">จำนวนผู้รายงาน</th>
            <th class="text-center">รายงานข้อมูล</th>
            <th class="text-center">โครงการ</th>
            <th class="text-center">รางวัล</th>
            <th class="text-center">ข่าว</th>
            <th class="text-center">ภาพกิจกรรม</th>
        </tr>
    </thead>
    <tbody>

        <?php
include_once "db.php";
 $i = 0;
 foreach ($key as $id) {
  $i++;
  $per = getstat($conn, "perupdate", $id);
  if ($per < 25) {
   $cl = "--bs-red";
  } else if ($per >= 25 && $per < 50) {
   $cl = "--bs-orange";
  } else if ($per >= 50 && $per < 75) {
   $cl = "--bs-blue";
  } else if ($per >= 75) {
   $cl = "--bs-green";
  }
  ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=LinkSchool2($conn, $id)?></td>
            <td class="text-center">
                <a href="index.php?module=teacherlist&scid=<?=$id;?>" target="_blank">
                    <?=getstat($conn, "teacher", $id);?>
                </a>
            </td>
            <td class="text-center"><?=getstat($conn, "all", $id);?></td>
            <td class="text-center col-3" data-bs-toggle="tooltip" data-bs-placement="top" title="<?=$per;?> %">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped" role="progressbar"
                        style="width: <?=$per;?>%;font-size:0.5rem;background-color:var(<?=$cl;?>)"
                        aria-valuenow="<?=$per;?>" aria-valuemin="0" aria-valuemax="100">
                        <?=$per;?>%</div>
                </div>
            </td>
            <td class="text-center"><?=getstat($conn, "project", $id);?></td>
            <td class="text-center"><?=getstat($conn, "award", $id);?></td>
            <td class="text-center"><?=getstat($conn, "pr", $id);?></td>
            <td class="text-center"><?=getstat($conn, "gallery", $id);?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="text-muted text-center">*หมายเหตุ : ข้อมูลอัพเดททุกๆ ชั่วโมง</div>
<div class="text-muted text-center">*หมายเหตุ<sup>2</sup> : บุคลากรที่อยู่ในกลุ่มสาระ อื่นๆ
    จะไม่ถูกนำมาคิดร้อยละความก้าวหน้า</div>
<?php } else {
 $sql = "SELECT * FROM `tb_statistics` WHERE `name`='all'";
 $result = mysqli_query($conn, $sql);
 $all = mysqli_fetch_row($result);
 array_shift($all);
 array_shift($all);

 foreach ($campus as $key => $value) {
  $sql = "SELECT COUNT(`id`) FROM `tb_teacher` WHERE `sc_id` in ($value)";
  $result = mysqli_query($conn, $sql);
  $cnt[$key] = mysqli_fetch_row($result)[0];

  $list = explode(',', $value);
  $sum[$key] = 0;
  foreach ($list as $index) {
   $sum[$key] = $sum[$key] + $all[$index];
  }
  $tmpPer[$key] = sprintf("%.2f", ($sum[$key] * 100) / $cnt[$key]);
  //$per[$key] = $tmpPer;

 }

 $campusname = json_encode($campus_name, JSON_UNESCAPED_UNICODE);
 $percent = "[" . $tmpPer[1] . "," . $tmpPer[2] . "," . $tmpPer[3] . "," . $tmpPer[4] . "]";

 ?>
<div class="mb-5 row">
    <h6 class="text-center mt-4 mb-2 fw-bold text-primary">ข้อมูลสหวิทยาเขต</h6>
    <div class="col-md-6">
        <h6 class="text-center mt-4 mb-2 fw-bold text-primary">จำนวนครูรายสหวิทยาเขต</h6>
        <div style="height:400px"><canvas id="PerChart"></canvas></div>
    </div>
    <div class="col-md-6">
        <h6 class="text-center mt-4 mb-2 fw-bold text-primary">ร้อยละของครูที่กรอกข้อมูลรายสหวิทยาเขต</h6>
        <div style="height:400px"><canvas id="PerChart2"></canvas></div>
    </div>
    <div class="mt-5 row mx-auto">
        <div class="col-md-3 mb-2">
            <a class="btn btn-dark w-100" href="index.php?module=campus&cp=1"><i
                    class="fas fa-chalkboard-teacher fa-2x"></i><br />ข้อมูลสหวิทยาเขต<br />เวียงปอ</a>

        </div>
        <div class="col-md-3 mb-2">
            <a class="btn btn-dark w-100" href="index.php?module=campus&cp=2"><i
                    class="fas fa-chalkboard-teacher fa-2x"></i><br />ข้อมูลสหวิทยาเขต<br />เวียงภูเพียง</a>

        </div>
        <div class="col-md-3 mb-2"><a class="btn btn-dark w-100" href="index.php?module=campus&cp=3"><i
                    class="fas fa-chalkboard-teacher fa-2x"></i><br />ข้อมูลสหวิทยาเขต<br />วรนคร</a>
        </div>
        <div class="col-md-3 mb-2"><a class="btn btn-dark w-100" href="index.php?module=campus&cp=4"><i
                    class="fas fa-chalkboard-teacher fa-2x"></i><br />ข้อมูลสหวิทยาเขต<br />ศิลาทอง</a>
        </div>
    </div>


    <div class="mt-2 row mx-auto">
        <div class="col-md-3 mb-2">
            <a class="btn btn-warning w-100 text-white" href="index.php?module=scout2&cp=1"><i
                    class="fab fa-accusoft fa-2x"></i><br />ลูกเสือสหวิทยาเขต<br />เวียงปอ</a>

        </div>
        <div class="col-md-3 mb-2">
            <a class="btn btn-warning w-100 text-white" href="index.php?module=scout2&cp=2"><i
                    class="fab fa-accusoft fa-2x"></i><br />ลูกเสือสหวิทยาเขต<br />เวียงภูเพียง</a>

        </div>
        <div class="col-md-3 mb-2"><a class="btn btn-warning w-100 text-white" href="index.php?module=scout2&cp=3"><i
                    class="fab fa-accusoft fa-2x"></i><br />ลูกเสือสหวิทยาเขต<br />วรนคร</a>
        </div>
        <div class="col-md-3 mb-2"><a class="btn btn-warning w-100 text-white" href="index.php?module=scout2&cp=4"><i
                    class="fab fa-accusoft fa-2x"></i><br />ลูกเสือสหวิทยาเขต<br />ศิลาทอง</a>
        </div>
    </div>
</div>
<script>
var campusname =
    <?php echo "['" . $campus_name[1] . "','" . $campus_name[2] . "','" . $campus_name[3] . "','" . $campus_name[4] . "']"; ?>;

var percent = <?php echo "[" . $tmpPer[1] . "," . $tmpPer[2] . "," . $tmpPer[3] . "," . $tmpPer[4] . "]"; ?>;

var cnt = <?php echo "[" . $cnt[1] . "," . $cnt[2] . "," . $cnt[3] . "," . $cnt[4] . "]"; ?>;
</script>



<?php }?>
