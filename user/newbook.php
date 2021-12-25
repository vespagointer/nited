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
 if ($what == "bookno" || $what == "bookname" || $what == "bookto") {
  $sql = "SELECT * FROM `tb_newbook` WHERE `$what` LIKE '%$key%' ORDER BY `id` $sort";
 } else if ($what == "bookdate" || $what == "person") {
  $sql = "SELECT * FROM `tb_newbook` WHERE `$what`='$key' ORDER BY `id` $sort";
 }
 $allPage = 1;
} else {
 $result  = mysqli_query($conn, "SELECT COUNT(*) FROM `tb_newbook`");
 $cnt     = mysqli_fetch_array($result)[0];
 $allPage = ceil($cnt / $showNum);

 $sql = "SELECT * FROM `tb_newbook` ORDER BY `id` $sort LIMIT $st,$showNum";

}

$result = mysqli_query($conn, $sql);
if (!isset($cnt)) {$cnt = mysqli_num_rows($result);}

?>
<div class="text-center" style="padding:20px 0 10px;">
    <h4>หนังสือออกงานนิเทศฯ</h4>
</div>
<div class="row my-2">
    <div class="col-8 text-start">
        <form action="index.php?module=newbook" method="post">
            <div class="d-flex align-items-start  ">
                <div class="me-1 align-middle"><span class="align-middle fs-6 fw-bold">
                        ค้นหาจาก </span></div>
                <div>

                    <select class="form-control-sm me-1" name="what" id="what">
                        <option value="bookno">เลขหนังสือ</option>
                        <option value="bookdate">ลงวันที่</option>
                        <option value="bookname">ชื่อหนังสือ</option>
                        <option value="bookto">ส่งถึง</option>
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
    <div class="col-4 text-end">
        <a class="btn btn-primary btn-sm text-white" href="index.php?module=addnewbook" role="button"><i
                class="fas fa-plus-circle"></i>
            เพิ่มหนังสือใหม่</a>
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
                    href='index.php?module=newbook&sort=<?=$resort;?>&page=<?=$page;?>'><i class="fas fa-sort"></i></a>
            </th>
            <th scope="col" style="width:10%;" class="text-center">เลขหนังสือ</th>
            <th scope="col" style="width:10%;" class="text-center">ลงวันที่</th>
            <th scope="col" style="width:35%;" class="text-center">ชื่อหนังสือ</th>
            <th scope="col" style="width:20%;" class="text-center">ส่งถึง</th>
            <th scope="col" style="width:10%;" class="text-center">ผู้รับผิดชอบ</th>
            <th scope="col" style="width:15%;" class="text-center">จัดการ</th>
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
            <td><a href="index.php?module=newbookdetail&id=<?=$id;?>"><?=html_entity_decode($bookname);?></a></td>
            <td><?=html_entity_decode($bookto);?></td>
            <td>ศน.<?=$snName[$person];?></td>
            <td class="text-center">| <a href="index.php?module=editnewbook&id=<?=$id;?>" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="แก้ไข"><i class="fas fa-user-edit text-success"></i></a> | <a
                    href="del.php?mode=newbook&id=<?=$id;?>" data-bs-toggle="tooltip" data-bs-placement="top" title="ลบ"
                    class="delbtn"><i class="fas fa-trash text-danger"></i></a> |</td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="my-2 text-end">
    <a class="btn btn-primary btn-sm text-white" href="index.php?module=addnewbook" role="button"><i
            class="fas fa-plus-circle"></i>
        เพิ่มหนังสือใหม่</a>
</div>
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
if ($page > 1) {
 $prev = $page - 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=newbook&sort=$sort&page=1'>|&#60;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=newbook&sort=$sort&page=$prev'>&#60;</a></li>";
}
for ($i = 1; $i <= $allPage; $i++) {
 echo "<li class='page-item'><a class='page-link' href='index.php?module=newbook&sort=$sort&page=$i'>$i</a></li>";
}
if ($page < $allPage) {
 $next = $page + 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=newbook&sort=$sort&page=$next'>&#62;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=newbook&sort=$sort&page=$allPage'>&#62;|</a></li>";
}
?>
        </ul>
    </nav>
</div>