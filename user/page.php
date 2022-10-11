<?php
@session_start();
if ($_SESSION["logined"] != true) {
    @header("location:../login.php");
}
define("KRITSADAPONG", true);
require_once "../conn.php";

//extract($_GET);

$do = $_GET["do"] ?? "list";
if ($do == "list") {
    $sql    = "SELECT `id`,`name` FROM `tb_pages` ORDER BY `id` DESC";
    $result = mysqli_query($conn, $sql);
    $cnt = mysqli_num_rows($result);
?>
    <style>
        a.link {
            color: #cccccc;
        }

        a.link:hover {
            color: #ffffff;
        }
    </style>
    <div class="row col-10 mx-auto">
        <div class="fw-bold fs-4 text-center mb-3 text-primary">
            รายการหน้าเว็บ
        </div>
        <table class="table" id="weblist">
            <thead>
                <tr>
                    <th scope="col" class="text-center text-nowrap" style="width:1%">#</th>
                    <th scope="col" class="text-center">ชื่อหน้าเว็บ</th>
                    <th scope="col" class="text-center text-nowrap" style="width:1%">การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = $cnt;
                while ($data = mysqli_fetch_array($result)) {
                    extract($data);
                    echo "<tr>";
                    echo "<td class='text-center text-nowrap' style='width:1%'>$i</td>";
                    echo "<td>";
                    echo "<a href='../index.php?module=page&id=$id' target='_blank'>";
                    echo $name;
                    echo "</a>";
                    echo "</td>";
                    echo "<td class='text-center text-nowrap' style='width:1%'>";
                    echo "<a href='index.php?module=page&do=edit&id=$id' class='btn btn-primary btn-sm link me-2'><i class='fas fa-pencil-alt'></i></a>";
                    echo "<a href='' data-id='$id' class='btn btn-danger btn-sm link del'><i class='fas fa-trash-alt'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                    $i--;
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
} else if ($do == "create") {
?>
    <div class="row col-10 mx-auto">
        <div class="col fw-bold fs-4 mb-3 mt-3">
            เพิ่มหน้าเว็บ
        </div>
        <form action="index.php?module=page&do=store" method="post">
            <?php if (isset($_GET["error"])) { ?>
                <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                    <strong>ไม่สามารถบันทึกได้ กรุณาลองอีกครั้ง</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">ชื่อหน้าเว็บ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="name" id="name" maxlength="250" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label fw-bold">หน้าเว็บ <span style="color:red">*</span></label>
                <textarea name="content" id="content"></textarea>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save me-2"></i>บันทึก</button>
            </div>
        </form>
    </div>
    <?php
} else if ($do == "edit") {

    if (empty($_GET["id"])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
            <strong>ไม่พบหน้านี้</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        exit;
    }
    $id = $_GET["id"];
    $sql    = "SELECT * FROM `tb_pages` WHERE `id`='$id '";
    $result = mysqli_query($conn, $sql);
    $data   = mysqli_fetch_array($result);
    extract($data);
    ?>
    <div class="row col-10 mx-auto">
        <div class="col fw-bold fs-4 mb-3 mt-3">
            แก้ไขหน้าเว็บ
        </div>
        <form action="index.php?module=page&do=update&id=<?= $id; ?>" method="post">
            <?php if (isset($_GET["error"])) { ?>
                <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                    <strong>ไม่สามารถบันทึกได้ กรุณาลองอีกครั้ง</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">ชื่อหน้าเว็บ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="name" id="name" maxlength="250" value="<?= $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label fw-bold">หน้าเว็บ <span style="color:red">*</span></label>
                <textarea name="content" id="content"><?= $content; ?></textarea>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save me-2"></i>บันทึก</button>
            </div>
        </form>
    </div>
    <?php
} else if ($do == "store") {
    extract($_POST);
    $sql = "INSERT INTO `tb_pages` VALUES (NULL,'$name','$content')";
    if (mysqli_query($conn, $sql)) {
        @header("Location:index.php?module=page&do=list");
    } else {
        @header("Location:index.php?module=page&do=create&error=ture");
    }
} else if ($do == "update") {
    if (empty($_GET["id"])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
            <strong>ไม่พบหน้านี้</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
        exit;
    }
    $id = $_GET["id"];
    extract($_POST);
    $sql = "UPDATE`tb_pages` SET `name`='$name',`content`='$content' WHERE `id`='$id'";
    if (mysqli_query($conn, $sql)) {
        @header("Location:index.php?module=page&do=list");
    } else {
        @header("Location:index.php?module=page&do=edit&id=$id&error=ture");
    }
} else {
    //
}
