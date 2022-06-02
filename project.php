<?php
if (!defined("KRITSADAPONG")) {
 @header("location:404.php");
 @die("Access Denied!");
}
$showNum = 25;
$page    = @$_GET["page"];
if (empty($page)) {$page = 1;}
$st   = ($page - 1) * $showNum;
$sort = @$_GET["sort"];
if ($sort != "ASC") {
 $sort   = "DESC";
 $resort = "ASC";
} else {
 $resort = "DESC";
}

if (isset($_POST["key"])) {
 extract($_POST);
 $sql     = "SELECT * FROM `tb_project` WHERE `pname` LIKE '%$key%' ORDER BY `id` $sort";
 $allPage = 1;
} else {
 $resultx = mysqli_query($conn, "SELECT COUNT(*) FROM `tb_project`");
 $cnt     = mysqli_fetch_array($resultx)[0];
 $allPage = ceil($cnt / $showNum);
 $sql     = "SELECT * FROM `tb_project` ORDER BY `id` $sort LIMIT $st,$showNum";
}
$result = mysqli_query($conn, $sql);
if (!isset($cnt)) {$cnt = mysqli_num_rows($result);}
if ($sort != "ASC") {
 $nost = $cnt - $st;
} else {
 $nost = $st + 1;
}
?>

<div class="text-center" style="padding:20px 0 10px;">
    <h4>โครงการงานนิเทศฯ</h4>
</div>
<div class="row my-2">
    <div class="col-8 text-start">
        <form action="index.php?module=project" method="post">
            <div class="d-flex align-items-start  ">
                <div class="me-1 align-middle"><span class="align-middle fs-6 fw-bold">
                        ค้นหาโครงการ </span></div>
                <div id="sinput" class="me-1">
                    <input type="text" class="form-control-sm" name="key" required>
                </div>
                <div id="sinput">
                    <button type="submit" class="btn btn-danger btn-sm text-white">ค้นหา</button>

                </div>
            </div>
        </form>
    </div>
    <div class="col-4 text-end">

    </div>
</div>
<?php
if (isset($_POST["key"])) {
 ?>
<div class="row text-start mb-2">
    <span class="fw-bold text-danger" style="font-size:0.85rem">ค้นหา พบ <?=$cnt;?> รายการ</span>
</div>
<?php
}
?>
<table class="table table-hover table-sm table-bordered">
    <thead>
        <tr class="table-success">
            <th scope="col" style="width:10%;" class="text-center"># <a
                    href='index.php?module=project&sort=<?=$resort;?>&page=<?=$page;?>'><i class="fas fa-sort"></i></a>
            </th>
            <th scope="col" style="width:70%;" class="text-center">ชื่อโครงการ</th>
            <th scope="col" style="width:20%;" class="text-center">ผู้รับผิดชอบ</th>
        </tr>
    </thead>
    <tbody>
        <?php

while ($data = mysqli_fetch_array($result)) {
 extract($data);
 ?>
        <tr>
            <th scope="row" class="text-center"><?=$nost;?></th>
            <td><a href="./index.php?module=projectdetail&id=<?=$id;?>"><?=html_entity_decode($pname);?></a></td>
            <td>ศน.<?=$_SESSION["snName"][$person];?></td>
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
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
if ($page > 1) {
 $prev = $page - 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=project&sort=$sort&page=1'>|&#60;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=project&sort=$sort&page=$prev'>&#60;</a></li>";
}
for ($i = 1; $i <= $allPage; $i++) {
 echo "<li class='page-item'><a class='page-link' href='index.php?module=project&sort=$sort&page=$i'>$i</a></li>";
}
if ($page < $allPage) {
 $next = $page + 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=project&sort=$sort&page=$next'>&#62;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=project&sort=$sort&page=$allPage'>&#62;|</a></li>";
}
?>
        </ul>
    </nav>
</div>
