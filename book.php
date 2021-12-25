<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
$showNum = 20;
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
 if ($what == "bookno" || $what == "gotno" || $what == "bookname" || $what == "bookfrom") {
  $sql = "SELECT * FROM `tb_book` WHERE `$what` LIKE '%$key%' ORDER BY `id` $sort";
 } else if ($what == "bookdate" || $what == "gotdate" || $what == "person") {
  $sql = "SELECT * FROM `tb_book` WHERE `$what`='$key' ORDER BY `id` $sort";
 }
 $allPage = 1;
} else {
 $resultx = mysqli_query($conn, "SELECT COUNT(*) FROM `tb_book`");
 $cnt     = mysqli_fetch_array($resultx)[0];
 $allPage = ceil($cnt / $showNum);
 $sql     = "SELECT * FROM `tb_book` ORDER BY `id` $sort LIMIT $st,$showNum";
}

$result = mysqli_query($conn, $sql);
if (!isset($cnt)) {$cnt = mysqli_num_rows($result);}
?>

<div class="text-center" style="padding:20px 0 10px;">
    <h4>หนังสือเข้างานนิเทศฯ</h4>
</div>
<div class="row my-2">
    <div class="col-8 text-start">
        <form action="index.php?module=book" method="post">
            <div class="d-flex align-items-start  ">
                <div class="me-1 align-middle"><span class="align-middle fs-6 fw-bold">
                        ค้นหาจาก </span></div>
                <div>

                    <select class="form-control-sm me-1" name="what" id="what">
                        <option value="bookno">เลขหนังสือ</option>
                        <option value="bookdate">ลงวันที่</option>
                        <option value="gotno">เลขรับหนังสือ</option>
                        <option value="gotdate">วันที่รับ</option>
                        <option value="bookname">ชื่อหนังสือ</option>
                        <option value="bookfrom">หน่วยงานต้นเรื่อง</option>
                        <option value="person">ผู้รับผิดชอบ</option>
                    </select>
                </div>
                <div id="sinput" class="me-1">
                    <input type="text" class="form-control-sm" name="key" required>
                </div>
                <div id="sinput">
                    <button type="submit" class="btn btn-danger btn-sm text-white">ค้นหา</button>

                </div>
            </div>
        </form>
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
            <th scope="col" style="width:5%;" class="text-center">id <a
                    href='index.php?module=book&sort=<?=$resort;?>&page=<?=$page;?>'><i class="fas fa-sort"></i></a>
            </th>
            <th scope="col" style="width:15%;" class="text-center">เลขหนังสือ</th>
            <th scope="col" style="width:10%;" class="text-center">ลงวันที่</a>
            </th>
            <th scope="col" style="width:10%;" class="text-center">เลขรับ</a>
            </th>
            <th scope="col" style="width:10%;" class="text-center">รับวันที่</a>
            </th>
            <th scope="col" style="width:30%;" class="text-center">ชื่อหนังสือ</th>
            <th scope="col" style="width:10%;" class="text-center">ผู้ส่ง</th>
            <th scope="col" style="width:10%;" class="text-center">ผู้รับผิดชอบ</th>
        </tr>
    </thead>
    <tbody>
        <?php

while ($data = mysqli_fetch_array($result)) {
 extract($data);
 ?>
        <tr>
            <th scope="row" class="text-center"><?=$id;?></th>
            <td><?=html_entity_decode($bookno);?></td>
            <td><?=$bookdate;?></td>
            <td><?=html_entity_decode($gotno);?></td>
            <td><?=$gotdate;?></td>
            <td><a href="user/index.php?module=bookdetail&id=<?=$id;?>"><?=html_entity_decode($bookname);?></a></td>
            <td><?=html_entity_decode($bookfrom);?></td>
            <td>ศน.<?=$_SESSION["snName"][$person];?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
if ($page > 1) {
 $prev = $page - 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=book&sort=$sort&page=1'>|&#60;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=book&sort=$sort&page=$prev'>&#60;</a></li>";
}
for ($i = 1; $i <= $allPage; $i++) {
 echo "<li class='page-item'><a class='page-link' href='index.php?module=book&sort=$sort&page=$i'>$i</a></li>";
}
if ($page < $allPage) {
 $next = $page + 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=book&sort=$sort&page=$next'>&#62;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=book&sort=$sort&page=$allPage'>&#62;|</a></li>";
}
?>
        </ul>
    </nav>
</div>