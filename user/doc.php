<?php
if (!defined("KRITSADAPONG")) {
    @header("location:404.php");
    @die("Access Denied!");
}
$showNum = 20;
$page    = @$_GET["page"];
if (empty($page)) {
    $page = 1;
}
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
    $sql     = "SELECT * FROM `tb_document` WHERE `name` LIKE '%$key%' ORDER BY `number` $sort";
    $allPage = 1;
} else {
    $resultx = mysqli_query($conn, "SELECT COUNT(*) FROM `tb_document");
    $cnt     = mysqli_fetch_array($resultx)[0];
    $allPage = ceil($cnt / $showNum);
    $sql     = "SELECT * FROM `tb_document` ORDER BY `number` $sort LIMIT $st,$showNum";
}
$result = mysqli_query($conn, $sql);
if (!isset($cnt)) {
    $cnt = mysqli_num_rows($result);
}
if ($sort != "ASC") {
    $nost = $cnt - $st;
} else {
    $nost = $st + 1;
}
?>

<div class="text-center" style="padding:20px 0 10px;">
    <h4 class="fw-bold">เอกสารงานนิเทศฯ</h4>
</div>
<div class="row my-3">
    <div class="col-8 text-start">
        <form action="index.php?module=doc" method="post">
            <div class="d-flex align-items-start  ">
                <div class="me-1 align-middle"><span class="align-middle fs-6 fw-bold">
                        ค้นหาเอกสาร </span></div>
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
    <span class="fw-bold text-danger" style="font-size:0.85rem">ค้นหา พบ <?= $cnt; ?> รายการ</span>
</div>
<?php
}
?>
<table class="table table-hover table-sm table-bordered">
    <thead>
        <tr class="table-success">
            <th scope="col" style="width:10%;" class="text-center">หมายเลขเอกสาร <a
                    href='index.php?module=doc&sort=<?= $resort; ?>&page=<?= $page; ?>'><i class="fas fa-sort"></i></a>
            </th>
            <th scope="col" style="width:30%;" class="text-center">ชื่อเอกสาร</th>
            <th scope="col" style="width:10%;" class="text-center">ไฟล์</th>
            <th scope="col" style="width:10%;" class="text-center">ลบ</th>
        </tr>
    </thead>
    <tbody>
        <?php

        while ($data = mysqli_fetch_array($result)) {
            extract($data);
        ?>
        <tr>
            <th scope="row" class="text-center"><?= $number ?></th>
            <td><?= html_entity_decode($name); ?></td>
            <td class="text-center">
                <?php if (!empty($files)) : ?>
                <a href="doc/<?= $files; ?>" target="_blank"><i class="fas fa-file-alt"></i>
                    <?php endif ?>
                </a>
            </td>
            <td class="text-center"><a href="del.php?mode=doc&id=<?= $id; ?>" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="ลบ" class="delbtn"><i class="fas fa-trash text-danger"></i></a></td>
        </tr>
        <?php
            if ($sort != "ASC") {
                $nost--;
            } else {
                $nost++;
            }
        } ?>
    </tbody>
</table>

<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            if ($page > 1) {
                $prev = $page - 1;
                echo "<li class='page-item'><a class='page-link' href='index.php?module=doc&sort=$sort&page=1'>|&#60;</a></li>";
                echo "<li class='page-item'><a class='page-link' href='index.php?module=doc&sort=$sort&page=$prev'>&#60;</a></li>";
            }
            for ($i = 1; $i <= $allPage; $i++) {
                echo "<li class='page-item'><a class='page-link' href='index.php?module=doc&sort=$sort&page=$i'>$i</a></li>";
            }
            if ($page < $allPage) {
                $next = $page + 1;
                echo "<li class='page-item'><a class='page-link' href='index.php?module=doc&sort=$sort&page=$next'>&#62;</a></li>";
                echo "<li class='page-item'><a class='page-link' href='index.php?module=doc&sort=$sort&page=$allPage'>&#62;|</a></li>";
            }
            ?>
        </ul>
    </nav>
</div>

<div class="my-3 col-md-8 col-lg-6 mx-auto fs-6">
    <div class="text-center fs-5 fw-bold py-2 alert-info mb-3">เพิ่มเอกสารใหม่</div>
    <form action="index.php?module=adddoc" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="number" class="form-label">หมายเลขเอกสาร</label>
            <input type="number" class="form-control fs-6" name="number" id="number" placeholder="หมายเลขเอกสาร"
                required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">ชื่อเอกสาร</label>
            <input type="text" class="form-control fs-6" name="name" id="name" placeholder="ชื่อเอกสาร" required>
        </div>
        <div class="mb-3">
            <label for="files" class="form-label">ไฟล์เอกสาร</label>
            <input type="file" class="form-control" name="files" id="files" placeholder="ไฟล์เอกสาร"
                accept="application/msword, application/pdf, .docx" required>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary text-end px-5" name="submit">
                <i class="fas fa-plus-circle"></i>
                บันทึก</button>
        </div>
    </form>
</div>
