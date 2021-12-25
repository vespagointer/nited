<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}

$id     = $_GET["id"];
$sql    = "SELECT * FROM `tb_book` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_array($result);
extract($data);
?>
<div class="row col-lg-8 offset-lg-2">
    <div class="text-center py-2">
        <h6 class="mb-2">หนังสือเข้า</h6>
        <a href="index.php?module=editbook&id=<?=$id;?>" data-bs-toggle="tooltip" data-bs-placement="top" title="แก้ไข"
            class="btn btn-success btn-sm text-white">
            <i class="fas fa-user-edit"></i> แก้ไข</a>
        <a href="del.php?mode=book&id=<?=$id;?>" data-bs-toggle="tooltip" data-bs-placement="top" title="ลบ"
            class="btn btn-danger btn-sm text-white delbtn">
            <i class="fas fa-trash"></i> ลบ</a>
    </div>
    <dl class="row">
        <dt class="col-3">id หนังสือ</dt>
        <dd class="col-9"><?=$id;?></dd>
        <dt class="col-3">เลขหนังสือ</dt>
        <dd class="col-9"><?=html_entity_decode($bookno);?></dd>
        <dt class="col-3">ลงวันที่</dt>
        <dd class="col-9"><?=$bookdate;?></dd>
        <dt class="col-3">เลขรับ</dt>
        <dd class="col-9"><?=html_entity_decode($gotno);?></dd>
        <dt class="col-3">รับวันที่</dt>
        <dd class="col-9"><?=$gotdate;?></dd>
        <dt class="col-3">ชื่อหนังสือ</dt>
        <dd class="col-9"><?=html_entity_decode($bookname);?></dd>
        <dt class="col-3">ผู้ส่ง</dt>
        <dd class="col-9"><?=html_entity_decode($bookfrom);?></dd>
        <dt class="col-3">ผู้รับผิดชอบ</dt>
        <dd class="col-9">ศน.<?=$snName[$person];?></dd>
        <dt class="col-3">เอกสาร</dt>
        <dd class="col-9">
            <?php
$bookID = $id;
$sql    = "SELECT * FROM `tb_file`WHERE `cate`='book' AND `bookid`='$bookID'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 while ($data = mysqli_fetch_array($result)) {
  extract($data);
  echo "<a href='../files/$year/$filename' target='_blank'>$name</a>&nbsp;";
  echo "<a href='delfile.php?mode=book&fid=$id&id=$bookID' style='color:red' class='delbtn' data-bs-toggle='tooltip' data-bs-placement='top' title='ลบ'><i class='fas fa-times'></i></a><br />";
 }
} else {
 echo "ไม่มีเอกสาร";
}
?>
        </dd>
        <dt class="col-3">หนังสือออก</dt>
        <dd class="col-9">
            <?php
$sql    = "SELECT `id`,`bookname` FROM `tb_newbook`WHERE `bookid`='$bookID'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
 while ($data = mysqli_fetch_array($result)) {
  extract($data);
  echo "<a href='index.php?module=newbookdetail&id=$id' target='_blank'>$bookname</a><br />";
 }
} else {
 echo "ไม่มีหนังสือออก";
}
?>

            <br /><a href="index.php?module=addnewbook&id=<?=$bookID;?>" role="button"
                style="font-size:0.6rem;color:blue;font-weight:bold;">เพิ่มหนังสือออก</a>
        </dd>
    </dl>


    <form action="addBookDB.php" id="addBook" enctype="multipart/form-data" method="POST">
        <div class="mb-1" id="attFile">
            <label for="att" class="form-label">เพิ่มเอกสาร</label>
            <input type="file" class="form-control" name="att[]" id="att"><input type="text" class="form-control mb-2"
                name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
            <input type="file" class="form-control" name="att[]" id="att"><input type="text" class="form-control mb-2"
                name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
        </div>
        <div class="mb-3 text-end">
            <button type="button" class="btn btn-secondary btn-block" id="addAtt">เพิ่มช่อง</button>
        </div>
        <div class="mb-3 text-center">
            <input type="hidden" name="mode" value="xxx">
            <input type="hidden" name="bid" value="<?=$bookID;?>">
            <input type="hidden" name="b" value="book">
            <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
        </div>
    </form>

</div>