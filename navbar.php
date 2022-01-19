<?php
//$page = basename($_SERVER['PHP_SELF'], ".php");
// returns: t1
$page = $module;
if (!isset($page)) {
 $page = "index";
}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><i class="fas fa-chart-line" style="font-size:32px;"></i> <i
                class="bi bi-ui-checks"></i>&nbsp;SPM.NAN BigData</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'index') ? 'active' : ''; ?>" href="index.php">หน้าแรก</a>
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
                        <li><a class="dropdown-item" style="font-size:0.75rem;" href="index.php?module=qrcode">
                                สร้าง QR Code</a></li>
                        <li><a class="dropdown-item" style="font-size:0.75rem;"
                                href="index.php?module=shorturl">ย่อลิงก์ (Short URL)</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">รายงาน</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" style="font-size:0.75rem;"
                                href="index.php?module=report">รายงานรวม</a></li>
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



                <!--
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        เอกสาร
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Download</a></li>
                        <li><a class="dropdown-item" href="#">Google Drive</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Log in</a></li>
                    </ul>

                </li>
-->
                <?php if (@$_SESSION["ss_status"] == "user" || @$_SESSION["ss_status"] == "admin") {?>
                <li class="nav-item"><a class="nav-link" href="./user/">ระบบงานนิเทศก์</a></li>
                <?php }?>

                <?php if (@$_SESSION["ss_status"] == "school" || @$_SESSION["ss_status"] == "admin") {?>
                <li class="nav-item"><a class="nav-link" href="./school/">ระบบข้อมูลโรงเรียน</a></li>
                <?php }?>

                <?php if (@$_SESSION["ss_status"] == "teacher" || @$_SESSION["ss_status"] == "admin") {?>
                <li class="nav-item"><a class="nav-link" href="./teacher/">ระบบข้อมูลครู</a></li>
                <?php }?>

                <?php if (@$_SESSION["ss_status"] == "spm" || @$_SESSION["ss_status"] == "admin") {?>
                <li class="nav-item"><a class="nav-link" href="./spm/">ระบบ สพม.น่าน</a></li>
                <?php }?>

                <?php if (@$_SESSION["logined"] == true) {?>
                <li class="nav-item"><a class="nav-link" href="logout.php">ออกจากระบบ</a></li>
                <?php } else {?>
                <li class="nav-item"><a class="nav-link" href="login.php">เข้าสู่ระบบ</a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
