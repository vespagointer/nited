<?php
ob_start();
session_start();
if ($_SESSION["ss_status"] != "teacher") {@header("location:../login.php");}
$module = @$_GET["module"];
define("KRITSADAPONG", true);
require_once "../conn.php";
require_once "../db.php";
?>
<!doctype html>
<html lang="th">

    <head>
        <title>ระบบข้อมูลครู</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/all.css" rel="stylesheet">
        <!--[if lt IE 8]>
    <link href="../css/font-awesome-ie7.css" rel="stylesheet">
    <![endif]-->

        <link href="../css/theme.css" rel="stylesheet">
        <link href="../css/bootstrap-datepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/chosen.css">
        <style type="text/css">
        .wrapper {
            display: flex;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            transition: all 0.3s;

        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar a,
        a:hover,
        a:focus {
            color: inherit;
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px 20px 10px;
            background-color: #062540;
        }

        #sidebar ul.components {
            padding-bottom: 20px;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            font-weight: bold;
            border-bottom: 1px solid #11212E;
        }

        #sidebar ul li a:hover {
            color: #083358;
            background: #fff;
        }

        #sidebar ul li ul li a {
            padding-left: 20px;
            background: #5F778C;
            border-bottom: 1px solid #ccc;
        }


        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }

            #sidebar.active {
                margin-left: 0;
            }
        }

        a,
        a:visited {
            /* color: #198754; */
            text-decoration: none;
        }

        a:hover {
            /* color: #FF4057; */
            text-decoration: none;
            font-weight: bold;
        }

        .form-control {
            font-size: 0.75rem !important;
        }

        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
            padding-left: 20px;
            padding-right: 50px;
        }

        </style>

    </head>

    <body>

        <div class="wrapper">
            <nav id="sidebar" class="bg-primary text-white">
                <div class="sidebar-header">
                    <a href="index.php">
                        <h6><i class="fas fa-chalkboard-teacher"></i> ระบบข้อมูลครู</h6>
                    </a>
                </div>
                <ul class="list-unstyled components">
                    <li><a href="index.php?module=award">
                            <i class="fas fa-award"></i> รางวัลที่ได้รับ</a>
                    </li>
                    <li><a href="index.php?module=train1">
                            <i class="fas fa-chalkboard"></i> การอบรม/ประชุม/สัมนา ทั่วไป</a>
                    </li>
                    <li><a href="index.php?module=train2">
                            <i class="fab fa-leanpub"></i> การอบรมหลักสูตรพัฒนาตนเอง</a>
                    </li>

                    <li><a href="index.php?module=publish">
                            <i class="far fa-comment-dots"></i> เผยแพร่ผลงาน</a>
                    </li>
                    <li><a href="index.php?module=scout">
                            <i class="fas fa-campground"></i> เอกสารทางลูกเสือ</a>
                    </li>
                    <li><a href="index.php?module=redcross">
                            <i class="fas fa-hand-holding-medical"></i> เอกสารทางยุวกาชาด</a>
                    </li>
                    <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a></li>
                </ul>
                <ul class="list-unstyled components">
                    <li><a href="../index.php"><i class="fas fa-undo"></i> กลับหน้าหลัก</a></li>
                </ul>
            </nav>
            <div id="content" class="container-fluid" style="background-color:#E1E6EA;">
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#E1E6EA;">
                    <div class="container-fluid">
                        <button type="button" id="sidebarToggler" class="btn btn-white btn-sm shadow-none">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="text-end text-black-50 fw-bold">
                            <img style="vertical-align: top;" src="../img/profile.png" height="28px" />
                            <span style="vertical-align: middle;"><?php
echo $_SESSION["ss_name"];
?></span>
                        </div>
                    </div>
                </nav>
                <div>
                    <div class="row col-lg-4 offset-lg-4 alert text-center" id="report">
                    </div>
                    <div id="page">
                        <?php
if (empty($module)) {
 include_once "main.php";
 $module = "main";
} else if (file_exists($module . ".php")) {
 include_once $module . ".php";
} else {
 include_once "404.php";
}
?>
                    </div>
                    <footer>
                        <!-- Copyright -->
                        <div class="text-end my-4 text-black-50">
                            <a href="https://lin.ee/KSCpNCH" target="_blank"><img
                                    src="https://scdn.line-apps.com/n/line_add_friends/btn/th.png" alt="เพิ่มเพื่อน"
                                    height="36" border="0"><br />
                                ติดต่อ/สอบถาม Line Official<br /></a>
                            พัฒนาเว็บไซต์โดย
                            <a class="text-reset fw-bold" href="<?=__FFF___;?>">กฤษฎาพงษ์ สุตะ</a>
                        </div>
                        <!-- Copyright -->
                    </footer>
                </div>
            </div>
        </div>

        <!-- Bootstrap JavaScript Libraries -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/all.js"></script>
        <script src="../js/bootstrap-datepicker.min.js"></script>
        <script src="../locales/bootstrap-datepicker.th.min.js"></script>
        <script src="../js/bootstrap-datepicker-BE.js"></script>
        <script src="../js/chosen.jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#report').hide();
            $('#sidebarToggler').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
            $('[data-bs-toggle="tooltip"]').tooltip();

            $('#BookDate, #GotDate').datepicker({
                format: "dd/mm/yyyy",
                maxViewMode: 2,
                language: "th",
                daysOfWeekHighlighted: "0,6",
                autoclose: true,
                todayHighlight: true
            });



        });
        </script>







        <?php
if (@$wysiwyg == true) {
 echo "<script src=\"../js/ckeditor.js\"></script>\n";
}
if (file_exists("js/" . $module . ".js")) {
 echo "<script src='js/$module.js'></script>";
}
?>
    </body>

</html>
