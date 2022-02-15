<?php
$sql = "SELECT `id`,`name` FROM `tb_school`";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_row($result)) {
 $school[$data[0]] = $data[1];
}
require_once "db.php";

$scc = [
 "C.B.T.C.",
 "C.A.T.C.",
 "C.W.B.",
 "S.B.T.C.",
 "S.A.T.C.",
 "S.W.B.",
 "S.S.B.T.C.",
 "S.S.A.T.C.",
 "S.S.W.B.",
 "R.B.T.C.",
 "R.A.T.C.",
 "R.W.B.",
 "A.L.T.C.",
 "A.L.T.",
 "L.T.C.",
 "L.T.",
 "none",
];
$sccCnt = [];

if (isset($_GET["scid"]) && (int) $_GET["scid"] != 0) {
 $scid = (int) $_GET["scid"];
 $sql = "SELECT `id`,`sc_id`,`name`,`scout`FROM `tb_teacher` WHERE `sc_id`=$scid";
 for ($i = 0; $i <= 16; $i++) {
  $sql2 = "SELECT count(`id`) FROM `tb_teacher` WHERE `sc_id`=$scid AND `scout` = '$scc[$i]'";
  $result2 = mysqli_query($conn, $sql2);
  $sccCnt[$i] = mysqli_fetch_row($result2)[0];
 }
 $sql2 = "SELECT count(`id`) FROM `tb_teacher` WHERE `sc_id`=$scid AND `scout`!=''";
 $result2 = mysqli_query($conn, $sql2);
 $NotNull = mysqli_fetch_row($result2)[0];

 $sql2 = "SELECT count(`id`) FROM `tb_teacher` WHERE `sc_id`=$scid AND `scout` =''";
 $result2 = mysqli_query($conn, $sql2);
 $Null = mysqli_fetch_row($result2)[0];

} else {
 $sql = "SELECT `id`,`sc_id`,`name`,`scout`FROM `tb_teacher` WHERE `sc_id`!=99 AND `sc_id`!=0";
 for ($i = 0; $i <= 16; $i++) {
  $sql2 = "SELECT count(`id`) FROM `tb_teacher` WHERE `sc_id`!=99 AND `sc_id`!=0 AND `scout` = '$scc[$i]'";
  $result2 = mysqli_query($conn, $sql2);
  $sccCnt[$i] = mysqli_fetch_row($result2)[0];
 }

 $sql2 = "SELECT count(`id`) FROM `tb_teacher` WHERE `sc_id`!=99 AND `sc_id`!=0 AND `scout`!=''";
 $result2 = mysqli_query($conn, $sql2);
 $NotNull = mysqli_fetch_row($result2)[0];

 $sql2 = "SELECT count(`id`) FROM `tb_teacher` WHERE `sc_id`!=99 AND `sc_id`!=0 AND `scout` =''";
 $result2 = mysqli_query($conn, $sql2);
 $Null = mysqli_fetch_row($result2)[0];

}
$result = mysqli_query($conn, $sql);
$allscc = mysqli_num_rows($result);
?>
<style>
#scout tr td:nth-child(3),
#scout tr th:nth-child(3),
#scout tr th:nth-child(4) {
    width: 1%;
    white-space: nowrap;
}

tr td:nth-child(3),
tr td:nth-child(4) {
    text-align: center;
}

#scReport tr th:first-child,
#scReport tr td:nth-child(3) {
    width: 1%;
    white-space: nowrap;
}

</style>

<div class="row mt-md-3">
    <div class="text-center mb-2">
        <h3>รายชื่อบุคลากร สังกัด สพม.น่าน</h3>
        <?php
if (isset($scid)) {
 echo "<h5 class='mb-3'>โรงเรียน" . getschool($conn, "name", $scid) . "</h5>";
}
?>
    </div>
    <table class="display mb-2 table-striped" id="scout" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">โรงเรียน</th>
                <th class="text-center">ชื่อ - สกุล</th>
                <th class="text-center">วุฒิทางลูกเสือ</th>
                <th class="text-center">เอกสารวุฒิทางลูกเสือ</th>
            </tr>
        </thead>
        <tbody>
            <?php

while ($data = mysqli_fetch_assoc($result)):
 extract($data);
 ?>
            <tr>
                <td><?=$school[$sc_id];?></td>
                <td><a href="index.php?module=profile&id=<?=$id;?>"><?=$name;?></a></td>
                <td> <?php
 if ($scout == "none") {
  echo "ไม่มีวุฒิทางลูกเสือ";
 } else {
  echo $scout;
 }
 ?></td>
                <td>
                    <?php
 $sql2 = "SELECT * FROM `tb_scout`WHERE `tid`='$id'";
 $result2 = mysqli_query($conn, $sql2);
 if (mysqli_num_rows($result2) > 0) {
  while ($data2 = mysqli_fetch_array($result2)) {
   extract($data2);
   echo "<a href='scout/$year/$filename' target='_blank'><i class='fas fa-file-alt'></i></a> <wbr>";
  }
 }
 ?>
                </td>
            </tr>
            <?php endwhile?>
        </tbody>
    </table>
</div>
<div class="col-8 mx-auto mt-5" id="scReport">
    <table class="table table-striped">
        <tr>
            <th class='text-center'>วุฒิทางลูกเสือ</th>
            <th class='text-center'>ร้อยละ</th>
            <th class='text-center'>จำนวน</th>
        </tr>
        <?php
for ($i = 0; $i <= 15; $i++) {
 echo "<tr>";
 echo "<th>" . $scc[$i] . "</th>";
 $width = sprintf("%.2f", $sccCnt[$i] * 100 / $allscc);
 ?>
        <td data-bs-toggle="tooltip" data-bs-placement="top" title="<?=$width;?> %">
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar"
                    style="width: <?=$width;?>%;font-size:0.5rem;background-color:var(--bs-orange)"
                    aria-valuenow="<?=$width;?>" aria-valuemin="0" aria-valuemax="100">
                    <?=$width;?> %</div>
            </div>
        </td>
        <?php
echo "<td class='text-center'>" . $sccCnt[$i] . " คน </td>";
 echo "</tr>";
}

echo "<tr>";
echo "<th>ไม่มีวุฒิทางลูกเสือ</th>";
$width = sprintf("%.2f", $sccCnt[16] * 100 / $allscc);
?>
        <td data-bs-toggle="tooltip" data-bs-placement="top" title="<?=$width;?> %">
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar"
                    style="width: <?=$width;?>%;font-size:0.5rem;background-color:var(--bs-orange)"
                    aria-valuenow="<?=$width;?>" aria-valuemin="0" aria-valuemax="100">
                    <?=$width;?> %</div>
            </div>
        </td>
        <?php
echo "<td class='text-center'>" . $sccCnt[$i] . " คน </td>";
echo "</tr>";
?>
        <tr>
            <th>ชื่อวุฒิไม่ถูกต้อง</th>
            <?php
$ex = $NotNull - array_sum($sccCnt);
$width = sprintf("%.2f", $ex * 100 / $allscc);
?>
            <td data-bs-toggle="tooltip" data-bs-placement="top" title="<?=$width;?> %">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped" role="progressbar"
                        style="width: <?=$width;?>%;font-size:0.5rem;background-color:var(--bs-orange)"
                        aria-valuenow="<?=$width;?>" aria-valuemin="0" aria-valuemax="100">
                        <?=$width;?> %</div>
                </div>
            </td>
            <td class='text-center'><?=$ex;?> คน </td>
        </tr>
        <tr>
            <th>ไม่มีข้อมูล</th>
            <?php
$width = sprintf("%.2f", $Null * 100 / $allscc);
?>
            <td data-bs-toggle="tooltip" data-bs-placement="top" title="<?=$width;?> %">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped" role="progressbar"
                        style="width: <?=$width;?>%;font-size:0.5rem;background-color:var(--bs-orange)"
                        aria-valuenow="<?=$width;?>" aria-valuemin="0" aria-valuemax="100">
                        <?=$width;?> %</div>
                </div>
            </td>
            <td class='text-center'><?=$Null;?> คน </td>
        </tr>
        <tr>
            <th>รวม</th>
            <th colspan="2" class='text-center' data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?=$allscc;?> คน"><?=$allscc;?> คน</th>
        </tr>
    </table>
</div>
