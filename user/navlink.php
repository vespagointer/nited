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
    $sql    = "SELECT * FROM `tb_navlink` ORDER BY `id` DESC";
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
            รายการลิงก์
        </div>
        <table class="table" id="navlink">
            <thead>
                <tr>
                    <th scope="col" class='text-center text-nowrap' style='width:1%'>เรียงลำดับ</th>
                    <th scope="col" class="text-center">ชื่อลิงก์</th>
                    <th scope="col" class="text-center">ลิงก์</th>
                    <th scope="col" class="text-center text-nowrap" style="width:1%">การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = $cnt;
                while ($data = mysqli_fetch_array($result)) {
                    extract($data);
                    echo "<tr>";
                    echo "<td class='text-center text-nowrap' style='width:1%'>$sort</td>";
                    echo "<td>";
                    echo "<a href='../index.php?module=page&id=$link' target='_blank'>$name</a>";
                    echo "</td>";
                    echo "<td>index.php?module=page&id=$link</td>";
                    echo "<td class='text-center text-nowrap' style='width:1%'>";
                    echo "<a href='index.php?module=navlink&do=edit&id=$id' class='btn btn-primary btn-sm link me-2'><i class='fas fa-pencil-alt'></i></a>";
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
            เพิ่มลิงก์
        </div>
        <form action="index.php?module=navlink&do=store" method="post">
            <?php if (isset($_GET["error"])) { ?>
                <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                    <strong>ไม่สามารถบันทึกได้ กรุณาลองอีกครั้ง</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">ชื่อลิงก์ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="name" id="name" maxlength="250" required>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label fw-bold">ลิงก์ <span style="color:red">*</span></label>
                <select name="link" id="link" class="form-select" required>
                    <option value="" hidden>เลือกหน้าเว็บ</option>
                    <?php
                    $sql    = "SELECT `id`,`name` FROM `tb_pages` ORDER BY `id` DESC";
                    $result = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($result)) {
                        extract($data);
                    ?>
                        <option value="<?= $id; ?>"><?= $name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="sort" class="form-label fw-bold">ลำดับ <span style="color:red">*</span></label>
                <input type="number" class="form-control" name="sort" id="sort" step="1" value="1" required>
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
    $sql    = "SELECT * FROM `tb_navlink` WHERE `id`='$id '";
    $result = mysqli_query($conn, $sql);
    $data   = mysqli_fetch_array($result);
    extract($data);
    ?>
    <div class="row col-10 mx-auto">
        <div class="col fw-bold fs-4 mb-3 mt-3">
            แก้ไขลิงก์
        </div>
        <form action="index.php?module=navlink&do=update&id=<?= $id; ?>" method="post">
            <?php if (isset($_GET["error"])) { ?>
                <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                    <strong>ไม่สามารถบันทึกได้ กรุณาลองอีกครั้ง</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">ชื่อลิงก์ <span style="color:red">*</span></label>
                <input type="text" class="form-control" name="name" id="name" maxlength="250" value="<?= $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label fw-bold">ลิงก์ <span style="color:red">*</span></label>
                <select name="link" id="link" class="form-select" required>
                    <option value="" hidden>เลือกหน้าเว็บ</option>
                    <?php
                    $sql    = "SELECT `id`,`name` FROM `tb_pages` ORDER BY `id` DESC";
                    $result = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($result)) {
                        extract($data);
                    ?>
                        <option value="<?= $id; ?>" <?php if ($link == $id) echo "selected"; ?>><?= $name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="sort" class="form-label fw-bold">ลำดับ <span style="color:red">*</span></label>
                <input type="number" class="form-control" name="sort" id="sort" step="1" value="<?= $sort; ?>" required>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save me-2"></i>บันทึก</button>
            </div>
        </form>
    </div>

    <?php
} else if ($do == "store") {
    extract($_POST);
    $sql = "INSERT INTO `tb_navlink` VALUES (NULL,'$name','$link','$sort')";
    if (mysqli_query($conn, $sql)) {
        @header("Location:index.php?module=navlink&do=list");
    } else {
        @header("Location:index.php?module=navlink&do=create&error=ture");
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
    $sql = "UPDATE `tb_navlink` SET `name`='$name',`link`='$link',`sort`='$sort' WHERE `id`='$id'";

    if (mysqli_query($conn, $sql)) {
        @header("Location:index.php?module=navlink&do=list");
    } else {
        @header("Location:index.php?module=navlink&do=edit&id=$id&error=ture");
    }
} else {
    //
}
