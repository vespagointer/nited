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
        <a class="navbar-brand" href="index.php"><i class="fas fa-chart-line" style="font-size:36px;"></i> <i
                class="bi bi-ui-checks"></i>&nbsp;สพม.น่าน</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'index') ? 'active' : ''; ?>" href="index.php">หน้าแรก</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'book') ? 'active' : ''; ?>"
                        href="index.php?module=book">หนังสือเข้า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'project') ? 'active' : ''; ?>"
                        href="index.php?module=project">โครงการ</a>
                </li>
-->
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'school') ? 'active' : ''; ?>"
                        href="index.php?module=school">รายชื่อโรงเรียน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page == 'mobile') ? 'active' : ''; ?>"
                        href="index.php?module=mobile">เบอร์โทร</a>
                </li>
                <!--
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        เครื่องมือ
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="ckschool.php">เช็คชื่อโรงเรียน</a></li>
                        <li><a class="dropdown-item" href="links.php">รวมลิ๊งค์</a></li>
                    </ul>

                </li>

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

                <?php if (@$_SESSION["logined"] == true) {?>
                <li class="nav-item"><a class="nav-link" href="logout.php">ออกจากระบบ</a></li>
                <?php } else {?>
                <li class="nav-item"><a class="nav-link" href="login.php">เข้าสู่ระบบ</a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>