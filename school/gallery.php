<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}

$sc_id = $_SESSION["ss_id"];
$showNum = 20;
$page = @$_GET["page"];
if (empty($page)) {$page = 1;}
$st = ($page - 1) * $showNum;
$sort = @$_GET["sort"];
if ($sort != "ASC") {
 $sort = "DESC";
 $resort = "ASC";
} else {
 $resort = "DESC";
}

$resultx = mysqli_query($conn, "SELECT COUNT(*) FROM `tb_gallery` WHERE `sc_id`=$sc_id");
$cnt = mysqli_fetch_array($resultx)[0];
$allPage = ceil($cnt / $showNum);
$sql = "SELECT * FROM `tb_gallery` WHERE `sc_id`=$sc_id ORDER BY `id` $sort LIMIT $st,$showNum";

$result = mysqli_query($conn, $sql);
if (!isset($cnt)) {$cnt = mysqli_num_rows($result);}
if ($sort != "ASC") {
 $nost = $cnt - $st;
} else {
 $nost = $st + 1;
}
?>
<div class=" alert alert-success text-center my-3 fs-6 fw-bold">
    ภาพกิจกรรมของโรงเรียน
</div>
<div class="row my-2">
    <div class="col-8 text-start">
    </div>
    <div class="col-4 text-end">
        <a class="btn btn-primary btn-sm text-white" href="index.php?module=addgallery" role="button"><i
                class="fas fa-plus-circle"></i>
            สร้างอัลบัม</a>
    </div>
</div>
<table class="table table-striped table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th class="text-center"># <a href='index.php?module=gallery&sort=<?=$resort;?>&page=<?=$page;?>'><i
                        class="fas fa-sort"></i></a></th>
            <th class="text-center">ชื่อกิจกรรม</th>
            <th class="text-center">วันที่</th>
            <th class="text-center">จัดการ</th>
        </tr>
    </thead>
    <tbody>
        <?php
while ($data = @mysqli_fetch_assoc($result)) {
 @extract($data);
 ?>
        <tr>
            <td scope="row" class="text-center"><?=$nost;?></td>
            <td><a href="../index.php?module=gallery&id=<?=$id;?>" target="_blank"><?=$name;?></a></td>
            <td><?=$date;?></td>
            <td class="text-center">
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="ลบ" class="delg"
                    data-id="<?=$id;?>">
                    <i class="fas fa-trash text-danger"></i></a>
            </td>
        </tr>
        <?php
if ($sort != "ASC") {
  $nost--;
 } else {
  $nost++;
 }
}?>
    </tbody>
</table>

<div class="row my-2">
    <div class="col-8 text-start">
    </div>
    <div class="col-4 text-end">
        <a class="btn btn-primary btn-sm text-white" href="index.php?module=addgallery" role="button"><i
                class="fas fa-plus-circle"></i>
            สร้างอัลบัม</a>
    </div>
</div>

<nav aria-label="..">
    <ul class="pagination justify-content-center">
        <?php
if ($page > 1) {
 $prev = $page - 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=gallery&sort=$sort&page=1'>|&#60;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=gallery&sort=$sort&page=$prev'>&#60;</a></li>";
}
for ($i = 1; $i <= $allPage; $i++) {
 if ($i == $page) {
  $active = "active";
  $cur = "aria-current=\"page\"";
 } else {
  $active = "";
  $cur = "";
 }
 echo "<li class='page-item $active' $cur ><a class='page-link' href='index.php?module=gallery&sort=$sort&page=$i'>$i</a></li>";
}
if ($page < $allPage) {
 $next = $page + 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=gallery&sort=$sort&page=$next'>&#62;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=gallery&sort=$sort&page=$allPage'>&#62;|</a></li>";
}
?>
    </ul>
</nav>