<?php
session_start();
if ($_SESSION["logined"] != true) {@header("location:../login.php");}
if ($_SESSION["ss_status"] != "spm") {@header("location:../index.php");}
define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";
if (isset($_GET["module"])) {
 $module = $_GET["module"];
} else {
 $module = "main";
}

?>
<!DOCTYPE html>
<html lang="th">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>สพม.น่าน</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="../DataTables/datatables.min.css">
        <link rel="stylesheet" href="css/spm.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Admin System</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">หน้าแรก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">หน้าเว็บหลัก</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">รายชื่อ</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=school">รายชื่อโรงเรียน</a></li>
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=teacherlist">รายชื่อครู</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">เครื่องมือ</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=mobile">ค้นหาเบอร์โทร</a></li>
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=onetm3">ที่นั่งสอบ O-Net ม.3</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">รายงาน</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=list&mode=scpr">ข่าวประชาสัมพันธ์จากโรงเรียน</a></li>
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=list&mode=gallery">ภาพกิจกรรมของโรงเรียน</a></li>
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=list&mode=scaward">รางวัลที่โรงเรียนได้รับ</a></li>
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=list&mode=taward">รางวัลที่ครูได้รับ</a></li>
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=list&mode=train1">การอบรม/ประชุม/สัมนา</a></li>
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=list&mode=train2">การพัฒนาตนเอง</a></li>
                                <li><a class="dropdown-item" style="font-size:0.75rem;"
                                        href="index.php?module=list&mode=publish">เผยแพร่ผลงาน</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="../logout.php">ออกจากระบบ</a></li>
                    </ul>

                    <div class="d-flex text-light">
                        <?php echo $_SESSION["ss_name"]; ?>
                    </div>
                </div>
            </div>
        </nav>



        <div class="container-fluid">
            <?php
include_once $module . ".php";
?>
        </div>

        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/all.js"></script>
        <script src="../DataTables/datatables.min.js"></script>
        <script src="js/spm.js"></script>
    </body>

</html>
