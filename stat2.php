<?php
define("KRITSADAPONG", true);
require_once "conn.php";
require_once "db.php";

$sql = "SELECT * FROM `tb_statistics` WHERE `name`='perupdate'";
$result = mysqli_query($conn, $sql);
$per = mysqli_fetch_row($result);
array_shift($per);
array_shift($per);
$sql = "SELECT `name` FROM `tb_school` WHERE `id`!=99";
$result = mysqli_query($conn, $sql);
$name = mysqli_fetch_all($result, MYSQLI_ASSOC);
$name = array_column($name, "name");

$sPer = json_encode($per, JSON_UNESCAPED_UNICODE);
$sName = json_encode($name, JSON_UNESCAPED_UNICODE);

?>
<h5 class="text-center mt-4 mb-2 fw-bold text-primary">ร้อยละของครูที่กรอกข้อมูลรายโรงเรียน</h5>
<canvas id="PerChart"></canvas>

<script>
var sPer = <?=$sPer;?>;
var sName = ["ศ.ว.", "ศ.น.", "บส.ว", "น.อ.", "ม.ร.", "บ.ล.", "น.น.", "ปว.", "ศ.ศ.", "ม.ง.", "ม.ก.จ", "ท.พ.", "ส.ว.",
    "น.พ.", "ม.ว.", "ส.", "สธ.ร.", "ส.ท.พ.", "ท.ช.", "ช.ก.", "พ.พ.", "น.ม.", "ม.ล.", "ส.พ.ค.", "บ.ก.", "ต.ร.",
    "น.ค.", "ศ.น.น.", "ม.พ.", "น.ว."
];
</script>
