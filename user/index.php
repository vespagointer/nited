<?php
ob_start();
session_start();
if ($_SESSION["logined"] != true || ($_SESSION["ss_status"] != "user" && $_SESSION["ss_status"] != "admin")) {@header("location:../login.php");}
$module = @$_GET["module"];
define("KRITSADAPONG", true);
require_once "../conn.php";
$sql    = "SELECT `id`,`prefix`,`name`,`surname` FROM `tb_user` WHERE `id` != '$adminID'";
$result = mysqli_query($conn, $sql);
$i      = 0;
while ($data = mysqli_fetch_array($result)) {
 $person["id"][$i]      = $data["id"];
 $person["prefix"][$i]  = $data["prefix"];
 $person["name"][$i]    = $data["name"];
 $person["surname"][$i] = $data["surname"];
 $snName[$data["id"]]   = $data["name"];
 $snSName[$data["id"]]  = $data["surname"];
 $i++;
}
$arrno = count($person['name']);

$sn = "";
for ($i = 0; $i < $arrno; $i++) {
 $sn = $sn . "<option value=\"" . $person["id"][$i] . "\">ศน." . $person["name"][$i] . "</option>";
}
?>
<!doctype html>
<html lang="th">

<head>
    <title>ระบบสมาชิก</title>
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
        color: #198754;
        text-decoration: none;
    }

    a:hover {
        color: #FF4057;
        text-decoration: none;
        font-weight: bold;
    }

    .form-control {
        font-size: 0.75rem !important;
    }
    </style>
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar" class="bg-primary text-white">
            <div class="sidebar-header">
                <a href="index.php">
                    <h6><i class="fas fa-users"></i> ระบบสมาชิก</h3>
                </a>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="#subMenu2" aria-controls="subMenu2" data-bs-toggle="collapse" aria-expanded="true"
                        class="dropdown-toggle">
                        <i class="fas fa-book"></i> หนังสือราชการ
                    </a>
                    <ul class="collapse list-unstyled" id="subMenu2">
                        <li><a href="index.php?module=book"><i class="fas fa-folder-open"></i> รายการหนังสือเข้า</a>
                        </li>
                        <li><a href="index.php?module=addbook"><i class="fas fa-file-alt"></i> เพิ่มหนังสือเข้า</a></li>
                        <li><a href="index.php?module=newbook"><i class="fas fa-folder-open"></i> รายการหนังสือออก</a>
                        </li>
                        <li><a href="index.php?module=addnewbook"><i class="fas fa-file-alt"></i> เพิ่มหนังสือออก</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#subMenu3" aria-controls="subMenu3" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <i class="fas fa-briefcase"></i> โครงการ
                    </a>
                    <ul class="collapse list-unstyled" id="subMenu3">
                        <li><a href="index.php?module=project"><i class="fas fa-archive"></i> รายการโครงการ</a></li>
                        <li><a href="index.php?module=addproject"><i class="fas fa-file-signature"></i> เพิ่มโครงการ</a>
                        </li>

                </li>
            </ul>
            </li>
            <li>
                <a href="#subMenu4" aria-controls="subMenu3" data-bs-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle">
                    <i class="fas fa-tools"></i> เครื่องมือ
                </a>
                <ul class="collapse list-unstyled" id="subMenu4">
                    <li><a href="index.php?module=shorturl"><i class="fas fa-link"></i> สร้าง Short URLs</a></li>
                    <li><a href="index.php?module=qrcode"><i class="fas fa-qrcode"></i> สร้าง QR Code</a></li>
                    <li><a href="index.php?module=ckschool"><i class="fas fa-school"></i> Check School V.1</a></li>
                    <li><a href="index.php?module=ckschoolv2"><i class="fas fa-school"></i> Check School V.2</a></li>

                </ul>
            </li>
            <?php if ($_SESSION["ss_status"] == "admin") {?>
            <li><a href="../admin/"><i class="fas fa-server"></i> Admin Control Panel</a></li>
            <?php }?>
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a></li>
            </ul>
            <ul class="list-unstyled components">
                <li><a href="../index.php"><i class="fas fa-undo"></i> กลับหน้าหลัก</a></li>
            </ul>
        </nav>
        <div id="content" class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-fluid">
                    <button type="button" id="sidebarToggler" class="btn btn-white btn-sm shadow-none">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="text-end">
                        <img src="../img/profile.png" height="32px" /> <a href="index.php?module=profile">
                            <?php
echo $_SESSION["ss_name"] . " ";
echo $_SESSION["ss_surname"];
?>
                        </a>
                    </div>
                </div>
            </nav>
            <div class="row col-lg-4 offset-lg-4 alert" id="report">
            </div>
            <div id="page">
                <?php
if (empty($module)) {
 include_once "main.php";
} else if (file_exists($module . ".php")) {
 include_once $module . ".php";
} else {
 include_once "404.php";
}
?>
            </div>
            <footer>
                <!-- Copyright -->
                <div class="text-center p-4 text-black-50">
                    พัฒนาเว็บไซต์โดย
                    <a class="text-reset fw-bold" href="<?=__FFF___;?>">กฤษฎาพงษ์ สุตะ</a>
                </div>
                <!-- Copyright -->
            </footer>
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

    $(document).on('click', '.delbtn', function(e) {
        return confirm("ต้องการลบข้อมูล?");
    })

    $(document).on('change', '#what', function(e) {
        var swhat = $(this).val();
        var input1 = '<input type="text" class="form-control-sm" name="key" required>\n';
        var input2 =
            "<input type=\"text\" class=\"form-control-sm\" name=\"key\" id=\"sKey\" autocomplete=\"เลือกวันที่\" required>\n";
        var input3 = '<select class="form-control-sm" name="key" required>\n' + '<?=$sn;?>' + '\n</select>';
        var data = "";
        //console.log(swhat);
        if (swhat == 'bookno' || swhat == 'gotno' || swhat == 'bookname' || swhat == 'bookfrom' || swhat ==
            'bookto') {
            data = input1;
        } else if (swhat == 'bookdate' || swhat == 'gotdate') {
            data = input2;
        } else if (swhat == 'person') {
            data = input3;
        }
        $('#sinput').empty().html(data);
        $('#sKey').datepicker({
            format: "dd/mm/yyyy",
            maxViewMode: 2,
            language: "th",
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
            todayHighlight: true
        });
    })

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

    $('#addAtt').click(function(event) {
        var attForm =
            '<input type="file" class="form-control" name="att[]" id="att"><input type="text" class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">';
        $("#attFile").append(attForm);
    });
    </script>
    <?php
if (file_exists("js/" . $module . ".js")) {
 echo "<script src='js/$module.js'></script>";
}
?>
</body>

</html>