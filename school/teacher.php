<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
$id = $_SESSION["ss_id"];
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
$sql = "SELECT * FROM `tb_dep`";
$result = mysqli_query($conn, $sql);
$opt = "";
while ($data = mysqli_fetch_assoc($result)) {
 $scdep[$data["id"]] = $data["name"];
 $opt .= "<option value='" . $data["id"] . "'>" . $data["name"] . "</option>";
}
$opt = "<select class='form-control-sm' name='key' required>" . $opt . "</select>";
if (isset($_POST["key"])) {
 extract($_POST);
 if ($what == "name") {
  $sql = "SELECT * FROM `tb_teacher` WHERE `name` LIKE '%$key%' AND `sc_id`=$id";
 }
 if ($what == "dep") {
  $sql = "SELECT * FROM `tb_teacher` WHERE `dep` = '$key' AND `sc_id`=$id";
 }
 $allPage = 1;
} else {
 $resultx = mysqli_query($conn, "SELECT COUNT(*) FROM `tb_teacher` WHERE `sc_id`=$id");
 $cnt = mysqli_fetch_array($resultx)[0];
 $allPage = ceil($cnt / $showNum);
 $sql = "SELECT * FROM `tb_teacher` WHERE `sc_id`=$id ORDER BY `id` $sort LIMIT $st,$showNum";
}

$result = mysqli_query($conn, $sql);
if (!isset($cnt)) {$cnt = mysqli_num_rows($result);}
if ($sort != "ASC") {
 $nost = $cnt - $st;
} else {
 $nost = $st + 1;
}
?>
<div class=" alert alert-success text-center my-3 fs-6 fw-bold">
    ข้อมูลครู
</div>
<div class="row my-2">
    <div class="col-8 text-start">
        <form action="index.php?module=teacher" method="post">
            <div class="d-flex align-items-start  ">
                <div class="me-1 align-middle"><span class="align-middle fs-6 fw-bold">
                        ค้นหาจาก </span></div>
                <div>

                    <select class="form-control-sm me-1" name="what" id="what">
                        <option value="name">ชื่อ - สกุล</option>
                        <option value="dep">กลุ่มสาระฯ</option>
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
        <a class="btn btn-primary btn-sm text-white" href="index.php?module=manteacher&do=add" role="button"><i
                class="fas fa-plus-circle"></i>
            เพิ่มครู</a>
    </div>
</div>
<?php
if (isset($_POST["key"])) {
 ?>
<div class="row text-start mb-2">
    <span class="fw-bold text-danger" style="font-size:0.85rem">
        ค้นหา พบ <?=$cnt;?> รายการ
        <span style="font-size:0.85rem">
            ( <a href='index.php?module=teacher&page=1'>รีเซ็ต</a> )
        </span>
    </span>
</div>
<?php
}
?>
<table class="table table-striped table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th class="text-center"># <a href='index.php?module=teacher&sort=<?=$resort;?>&page=<?=$page;?>'><i
                        class="fas fa-sort"></i></a></th>
            <th class="text-center">ชื่อ - สกุล</th>
            <th class="text-center">รหัส ปปช.</th>
            <th class="text-center">เบอร์โทร</th>
            <th class="text-center">อีเมล์</th>
            <th class="text-center">กลุ่มสาระฯ</th>
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
            <td class="editable" data-id="<?=$id;?>" data-parm="name"><?=$name;?></td>
            <td class="editable" data-id="<?=$id;?>" data-parm="cid"><?=$cid;?></td>
            <td class="editable" data-id="<?=$id;?>" data-parm="tel"><?=$tel;?></td>
            <td class="editable" data-id="<?=$id;?>" data-parm="email"><?=$email;?></td>
            <td class="editable" data-id="<?=$id;?>" data-parm="dep"><?=$scdep[$dep];?></td>
            <td class="text-center">
                |<a href="../index.php?module=profile&id=<?=$id;?>" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="ดูโปรไฟล์" target="_blank">
                    <i class="fas fa-user"></i>
                </a>
                | <span data-bs-toggle="modal" data-bs-target="#cPass" data-id="<?=$id;?>"><a href="#"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="เปลี่ยนรหัสผ่าน">
                        <i class="fas fa-key" style="color:#ad9400;"></i></i></a></span>
                | <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="ย้ายออก" class="movebtn"
                    data-id="<?=$id;?>">
                    <i class="fas fa-sign-out-alt text-danger"></i></a>
                |
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
        <a class="btn btn-primary btn-sm text-white" href="index.php?module=manteacher&do=add" role="button"><i
                class="fas fa-plus-circle"></i>
            เพิ่มครู</a>
    </div>
</div>

<nav aria-label="..">
    <ul class="pagination justify-content-center">
        <?php
if ($page > 1) {
 $prev = $page - 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=teacher&sort=$sort&page=1'>|&#60;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=teacher&sort=$sort&page=$prev'>&#60;</a></li>";
}
for ($i = 1; $i <= $allPage; $i++) {
 if ($i == $page) {
  $active = "active";
  $cur = "aria-current=\"page\"";
 } else {
  $active = "";
  $cur = "";
 }
 echo "<li class='page-item $active' $cur ><a class='page-link' href='index.php?module=teacher&sort=$sort&page=$i'>$i</a></li>";
}
if ($page < $allPage) {
 $next = $page + 1;
 echo "<li class='page-item'><a class='page-link' href='index.php?module=teacher&sort=$sort&page=$next'>&#62;</a></li>";
 echo "<li class='page-item'><a class='page-link' href='index.php?module=teacher&sort=$sort&page=$allPage'>&#62;|</a></li>";
}
?>
    </ul>
</nav>

<input type="hidden" id="in2" value="<?=$opt;?>">


<!-- Modal -->
<div class="modal fade" id="cPass" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">เปลี่ยนรหัสผ่าน</h6>
            </div>
            <div class="modal-body">
                <label for="pwd" class="form-label">กรอกรหัสผ่านใหม่</label>
                <input type="text" name="pwd" id="pwd" class="form-control" required>
                <input type="hidden" name="tid" id="tid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="savepwd">บันทึก</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="xEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">แก้ไขข้อมูล</h6>
            </div>
            <div class="modal-body">
                <input type="text" name="tmpData" id="tmpData" class="form-control" required>
                <select name="tmpSel" id="tmpSel" class="form-control" required>
                    <?php
foreach ($scdep as $key => $val) {
 echo "<option value=\"$key\">$val</option>";
}
?>
                </select>
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="parm" id="parm">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="save">บันทึก</button>
            </div>
        </div>
    </div>
</div>
