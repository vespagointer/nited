<div class="visually-hidden">
    <?php include_once "updatestat.php";?>
</div>
<div class="mx-auto col-lg-10 row my-5">
    <div class="col-4 text-center">
        <div class="card text-white fs-3" style="background-color: #0d6efd;">
            <div class="card-body">
                จำนวนบุคลากร<br />
                <?php
$sql = "SELECT count(`id`) FROM `tb_teacher` WHERE `sc_id`!=99 AND `sc_id`!=0 ";
$result = mysqli_query($conn, $sql);
$total = mysqli_fetch_row($result)[0];
echo number_format($total, 0, '.', ',');
?>
                คน</div>
        </div>
    </div>
    <div class="col-4 text-center">
        <div class="card text-white fs-3" style="background-color:#6610f2;">
            <div class="card-body">
                จำนวนผู้รายงาน
                <br />
                <?php
$sql = "SELECT * FROM `tb_statistics` WHERE `name`='all'";
$result = mysqli_query($conn, $sql);
$all = mysqli_fetch_row($result);
array_shift($all);
array_shift($all);
$up = array_sum($all);
echo $up;
?>
                คน
            </div>
        </div>
    </div>
    <div class="col-4 text-center">
        <div class="card text-white fs-3" style="background-color:#d63384;">
            <div class="card-body">
                ร้อยละผู้รายงาน<br />
                <?php
$per_all = sprintf("%.2f", ($up * 100) / $total);
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
for ($id = 1; $id <= 30; $id++) {
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
            <td><?=$id;?></td>
            <td><?=LinkSchool2($conn, $id)?></td>
            <td class="text-center">
                <a href="index.php?module=teacherlist&scid=<?=$id;?>" target="_blank">
                    <?=getstat($conn, "teacher", $id);?>
                </a>
            </td>
            <td class="text-center"><?=getstat($conn, "all", $id);?></td>
            <td class="text-center col-3">
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
