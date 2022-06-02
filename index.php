<?php
//@header("location:https://nited.spmnan.go.th/");

session_start();
/*
if ($_SESSION["logined"] == true) {
@header("location:../user/");
} else {
@header("location:../login.php");
}
 */
@$module = $_GET["module"];
define("KRITSADAPONG", true);
require_once "conn.php";
$sql = "SELECT `id`,`prefix`,`name`,`surname` FROM `tb_user` WHERE `id` != '$adminID'";
$result = mysqli_query($conn, $sql);
$n = 0;
while ($data = mysqli_fetch_array($result)) {
    $_SESSION["snID"][$n] = $data["id"];
    $_SESSION["snName"][$data["id"]] = $data["name"];
    $_SESSION["snSName"][$data["id"]] = $data["surname"];
    $n++;
}
mysqli_free_result($result);

$arrno = count($_SESSION["snID"]);

for ($i = 0; $i < $arrno; $i++) {
    @$sn = $sn . "<option value=\"" . $_SESSION["snID"][$i] . "\">ศน." . $_SESSION["snName"][$_SESSION["snID"][$i]] . "</option>";
}
?>
<!DOCTYPE html>
<html lang="th">


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description"
            content="กลุ่มนิเทศ ติดตามและประเมินผลการจัดการศึกษา สำนักงานเขตพื้นที่การศึกษามัธยมศึกษาน่าน">
        <meta name="keywords" content="นิเทศ, สพม, น่าน, มัธยม, สำนักงานเขตพื้นที่การศึกษา,มัธยมศึกษา">
        <meta name="author" content="กฤษฎาพงษ์ สุตะ">

        <title>SPM.NAN Big Data</title>

        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <!--[if lt IE 8]>
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    <![endif]-->

        <link href="css/theme.css" rel="stylesheet">
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="DataTables/datatables.min.css">
        <?php
    if ($module == "gallery") {
        echo '<link rel="stylesheet" href="css/lightbox.css">';
    }
    ?>
    </head>

    <body>


        <?php
    include_once "navbar.php";
    ?>


        <div class="container">
            <?php
        if (empty($module) || $module == "login" || $module == "takelogin") {
            include_once "main.php";
            $module = "main";
        } else if (file_exists($module . ".php")) {
            include_once $module . ".php";
        } else {
            include_once "404.php";
        }

        ?>
            <footer>
                <!-- Copyright -->
                <div class="text-end my-4 text-black-50">
                    <a href="https://lin.ee/KSCpNCH" target="_blank"><img
                            src="https://scdn.line-apps.com/n/line_add_friends/btn/th.png" alt="เพิ่มเพื่อน" height="36"
                            border="0"><br />
                        ติดต่อ/สอบถาม Line Official<br /></a>
                    พัฒนาเว็บไซต์โดย
                    <a class="text-reset fw-bold" href="<?= __FFF___; ?>">กฤษฎาพงษ์ สุตะ</a>
                </div>
                <!-- Copyright -->
            </footer>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/all.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script src="locales/bootstrap-datepicker.th.min.js"></script>
        <script src="js/bootstrap-datepicker-BE.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
        <script src="DataTables/datatables.min.js"></script>
        <script>
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
        $(document).on('change', '#what', function(e) {
            var swhat = $(this).val();
            var input1 = '<input type="text" class="form-control-sm" name="key" required>\n';
            var input2 =
                "<input type=\"text\" class=\"form-control-sm\" name=\"key\" id=\"sKey\" autocomplete=\"เลือกวันที่\" required>\n";
            var input3 = '<select class="form-control-sm" name="key" required>\n' + '<?= $sn; ?>' +
                '\n</select>';
            var data = "";
            //console.log(swhat);
            if (swhat == 'bookno' || swhat == 'gotno' || swhat == 'bookname' || swhat == 'bookfrom') {
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
        </script>
        <?php
    if (@$wysiwyg == true) {
        echo "<script src=\"js/ckeditor.js\"></script>\n";
    }
    if (file_exists("js/" . $module . ".js")) {
        echo "<script src='js/$module.js'></script>";
    }
    if ($module == "gallery") {
        echo '<script src="js/lightbox.js"></script>';
    }

    ?>
    </body>

</html>

<?php
//echo ($requestVars->_name == '') ? $redText : '';
//$var_is_greater_than_two = ($var > 2 ? true : false);
//@mysqli_free_result($resule);
@mysqli_close($conn);
?>
