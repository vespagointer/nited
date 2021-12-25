<?php

if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}

@$id    = trim($_GET['id']);
$sql    = "SELECT * FROM `urls` WHERE `url_id`=$id";
$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_array($result);
extract($data);

$path = explode("/", parse_url($gurl, PHP_URL_PATH));
$gid  = $path[3];
@$url = "https://docs.google.com/spreadsheets/d/" . $gid . "/export?exportFormat=csv";

$file_handle = @fopen($url, 'r') or die("เปิดไฟล์ไม่ได้!");
while (!feof($file_handle)) {
 $line_of_text[] = fgetcsv($file_handle);
}
fclose($file_handle);

$max = count($line_of_text);
//echo $max;
//var_dump($line_of_text[2][1]);
for ($i = 1; $i < $max; $i++) {
 $sc[$i - 1] = $line_of_text[$i][1];
}

function array_not_unique($a = array())
{
 return array_diff_key($a, array_unique($a));
}

$sc_list = array_map('trim', explode(',', $school));
?>
<div class="pt-3 mb-2 ms-2 alert alert-info">
    <b>Name :</b> <?=$name;?><br />
    <b>Full Url :</b> <a href="<?=$lurl;?>" target="_blank"><?=$lurl;?></a><br />
    <b>Short Url :</b> <a href="http://spmnan.ga/<?=$surl;?>" target="_blank">http://spmnan.ga/<?=$surl;?></a><br />
    <b>Sheet Url :</b> <a href="<?=$gurl;?>" target="_blank"><?=$gurl;?></a><br />
    <b><a href="index.php?module=editschool&id=<?=$url_id;?>">แก้ไขโรงเรียน คลิ๊ก!</a>
</div>
<div class="row mb-5">
    <div class="col-4 ps-3">
        <div class="alert alert-success"><b>โรงเรียนที่กรอกข้อมูลแล้ว</b></div>
        <?php
if ($max > 1) {
 $sced = array_unique($sc);
 $x    = 1;
 foreach ($sced as $val) {
  echo $x . ". " . $val . "<br />";
  $x++;
 }
}
?>
    </div>
    <div class="col-4 ps-1">
        <div class="alert alert-warning"><b>โรงเรียนที่กรอกข้อมูลซ้ำ</b></div>
        <?php
if ($max > 1) {
 $ss = array_unique(array_not_unique($sc));
//var_dump($ss);

 $sq = array_count_values($sc);
 if (count($ss) == 0) {
  echo "ไม่มีโรงเรียนใดกรอกข้อมูลซ้ำ";
 } else {
  $x = 1;
  foreach ($ss as $val) {
   echo $x . ". " . $val . " จำนวน " . $sq[$val] . " รอบ<br />";
   $x++;
  }
 }
}
?>
        <div class="alert alert-warning mt-3"><b>โรงเรียนไม่มีชื่อแต่กรอกข้อมูล</b></div>
        <?php
if ($max > 1) {
 $result = array_diff($sced, $sc_list);
 $i      = 1;
 foreach ($result as $value) {
  if (!empty($value)) {
   echo "$i. $value <br />\n";
   $i++;
  }
 }
}
?>
    </div>
    <div class="col-4 ps-1">
        <div class="alert alert-primary"><b>โรงเรียนที่ยังไม่กรอกข้อมูล</b></div>
        <div id="scmiss" class="ps-2">
            <?php

if (empty($sced)) {
 $sced = array();
}
$result = array_diff($sc_list, $sced);
if (count($result) == 0) {
 echo "กรอกข้อมูลครบทุกโรงเรียนแล้ว!";
}
$i = 1;
foreach ($result as $value) {
 if (!empty($value)) {
  echo "$i. $value <br />\n";
  $i++;
 }
}

?>
        </div>
    </div>
</div>