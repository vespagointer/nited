<?php
session_start();
if(@$_SESSION["ss_status"]=="admin"){
    header("location:./admin");
}else if(@$_SESSION["ss_status"]=="user"){
    header("location:./user");
}else if(@$_SESSION["ss_status"]=="school"){
    header("location:./school");
}else if(@$_SESSION["ss_status"]=="teacher"){
    header("location:./teacher");
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

    <title>ระบบจัดการข้อมูล สพม.น่าน</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
    <!--[if lt IE 8]>
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    <![endif]-->

    <link href="css/theme.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container ">
        <div class="row">
            <div class="col-sx-10 offset-sx-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="card my-3" id="MyForm">

                    <form class="card-body cardbody-color p-lg-3" action="takelogin.php" id="TakeLogin">

                        <div class="text-center my-2  fw-bold">
                            <img src="../img/logo.png" class="img-fluid" width="120px">
                            <h6 class="text-center">ระบบจัดการข้อมูล</h6>
                            สำนักงานเขตพื้นที่การศึกษามัธยมศึกษาน่าน
                        </div>
                        <div id="msg" class="text-center alert alert-danger"></div>
                        <div class="mb-3">
                            <label for="Username" class="form-label">Username :</label>
                            <input type="text" class="form-control" id="Username" name="uname" placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password :</label>
                            <input type="password" class="form-control" id="password" name="upass" placeholder=""
                                required>
                        </div>
                        <div class="text-center"><button type="submit"
                                class="btn btn-dark px-5 mb-2 w-100">Login</button></div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <footer>
        <!-- Copyright -->
        <div class="text-center p-4 text-white-50">
            พัฒนาเว็บไซต์โดย
            <a class="text-reset fw-bold" href="<?=__FFF___;?>">กฤษฎาพงษ์ สุตะ</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.js"></script>

    <script>
    $(function() {
        //    $("#SchoolName").linedtextarea();
        $("#msg").hide();
    });
    // Attach a submit handler to the form

    $("#TakeLogin").submit(function(event) {
        var mymsg =
            '<div class="text-center alert alert-success mx-2 my-2"><b>เข้าสู่ระบบสำเร็จ!</b><br /><br /><a href="';
        var mymsg2 = '" class="btn btn-success btn-sm">ตกลง</a></div>';
        // Stop form from submitting normally
        event.preventDefault();

        // Get some values from elements on the page:
        var $form = $(this),
            term1 = $form.find("input[name='uname']").val(),
            term2 = $form.find("input[name='upass']").val(),
            url = $form.attr("action");

        // Send the data using post
        var posting = $.post(url, {
            uname: term1,
            upass: term2
        });

        // Put the results in a div
        posting.done(function(data) {

            if (data == "OK") {
                $("#MyForm").empty().html(mymsg + "./user/" + mymsg2);
                window.location.replace("./user/");
            } else if (data == "school") {
                $("#MyForm").empty().html(mymsg + "./school/" + mymsg2);
                window.location.replace("./school/");
            } else if (data == "teacher") {
                $("#MyForm").empty().html(mymsg + "./teacher/" + mymsg2);
                window.location.replace("./teacher/");
            } else {
                $("#msg").show();
                $("#msg").empty().html("ข้อมูลไม่ถูกต้อง<br />กรุณาลองอีกครั้ง");
            }

        });
    });
    </script>
</body>

</html>