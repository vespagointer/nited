<?php
session_start();
if ($_SESSION["ss_status"] != "admin") {@header("location:../user/");}
$module = @$_GET["module"];
define("KRITSADAPONG", true);
?>
<!doctype html>
<html lang="th">

<head>
    <title>Admin Control Panel</title>
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
        padding-left: 10px;
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
    </style>
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar" class="bg-primary text-white">
            <div class="sidebar-header">
                <a href="index.php">
                    <h6><i class="fas fa-server"></i> Admin Control Panel</h3>
                </a>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="#subMenu1" aria-controls="subMenu1" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <i class="fas fa-users-cog"></i> ผู้ใช้งาน
                    </a>
                    <ul class="collapse list-unstyled" id="subMenu1">
                        <li><a href="index.php?module=listuser"><i class="fas fa-user-friends"></i> รายชื่อผู้ใช้งาน</a>
                        </li>
                        <li><a href="index.php?module=adduser"><i class="fas fa-user-plus"></i> เพิ่มผู้ใช้งาน</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#subMenu4" aria-controls="subMenu4" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <i class="fab fa-whmcs"></i> จัดการเว็บ
                    </a>
                    <ul class="collapse list-unstyled" id="subMenu4">
                        <li><a href="index.php?module="><i class="fas fa-comment-dots"></i> จัดการประกาศหน้าเว็บ</a>
                        </li>
                        <li><a href="index.php?module="><i class="fas fa-list-ul"></i> จัดการเมนู</a></li>
                        <li><a href="index.php?module="><i class="fas fa-file-code"></i> จัดการหน้าเว็บ</a></li>
                        <li><a href="index.php?module="><i class="fas fa-file-import"></i> เพิ่มหน้าเว็บ</a></li>
                    </ul>
                </li>

                <li><a href="../user/"><i class="fas fa-users"></i> ระบบสมาชิก</a></li>
            </ul>
        </nav>
        <div id="content" class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-fluid">
                    <button type="button" id="sidebarToggler" class="btn btn-white btn-sm shadow-none">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
            <div class="row col-lg-4 offset-lg-4 alert" id="report">
            </div>
            <div id="page">
                <?php
if (empty($module)) {
 echo "Admin";
} else if (file_exists($module . ".php")) {
 include_once $module . ".php";
} else {
 include_once "404.php";
}
?>
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
    <script>
    $(document).ready(function() {

        $('#report').hide(); //addClass('alert-success'); //removeClass

        $('#sidebarToggler').on('click', function() {
            $('#sidebar').toggleClass('active');
        });

        $('[data-bs-toggle="tooltip"]').tooltip();

    });

    $("#myForm").submit(function(event) {
        event.preventDefault();
        var info = $(this).serialize();
        var url = $(this).attr("action");
        $.post(url, info)
            .done(function(data) {
                if (data == "OK") {
                    $("#report").empty().html("บันทึกข้อมูลแล้ว");
                    $("#report").removeClass('alert-danger').addClass('alert-success');
                    $("#myForm").get(0).reset();
                } else if (data == "FAIL") {
                    $("#report").empty().html("บันทึกไม่ได้<br />ลองใหม่อีกครั้ง");
                    $("#report").removeClass('alert-success').addClass('alert-danger');
                } else {
                    $("#report").empty().html(data);
                    $("#report").removeClass('alert-success').addClass('alert-danger');
                }
                $("#report").show();
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
            })
            .fail(function() {
                //alert("error");
            })
            .always(function() {
                //alert("finished");
            });
    });
    $(document).on("click",'#ptext',function(e){
        if($('#upass').attr("type") == "password"){
            $('#upass').attr("type","text");
        }else{
            $('#upass').attr("type","password");
        }
    });

    $(document).on('click', '.delbtn', function(e) {
        return confirm("ต้องการลบข้อมูล?");
    })
    </script>
</body>

</html>