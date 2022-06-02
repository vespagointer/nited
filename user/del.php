<?php
@session_start();
if ($_SESSION["logined"] != true) {
    @header("location:../login.php");
}

if (isset($_GET["mode"])) {
    define("KRITSADAPONG", true);
    require_once "../conn.php";
    //extract($_POST, EXTR_PREFIX_SAME, "b");
    $mode = $_GET["mode"];
    $id   = $_GET["id"];
    if ($mode == "book") {
        $sql = "DELETE FROM `tb_book` WHERE `id`='$id'";
        mysqli_query($conn, $sql);

        $sql2    = "SELECT * FROM `tb_file` WHERE `cate`='book' AND `bookid`='$id'";
        $result2 = mysqli_query($conn, $sql2);
        while ($data2 = mysqli_fetch_array($result2)) {
            $file = "../files/" . $data2["year"] . "/" . $data2["filename"];
            //echo $file;
            @unlink($file);
            $fid  = $data2["id"];
            $sql3 = "DELETE FROM `tb_file` WHERE`id`='$fid'";
            mysqli_query($conn, $sql3);
        }
        @header("location:index.php?module=book");
    } else if ($mode == "newbook") {
        $sql = "DELETE FROM `tb_newbook` WHERE `id`='$id'";
        mysqli_query($conn, $sql);

        $sql2    = "SELECT * FROM `tb_file` WHERE `cate`='newbook' AND `bookid`='$id'";
        $result2 = mysqli_query($conn, $sql2);
        while ($data2 = mysqli_fetch_array($result2)) {
            $file = "../files/" . $data2["year"] . "/" . $data2["filename"];
            //echo $file;
            @unlink($file);
            $fid  = $data2["id"];
            $sql3 = "DELETE FROM `tb_file` WHERE`id`='$fid'";
            mysqli_query($conn, $sql3);
        }
        @header("location:index.php?module=newbook");
    } else if ($mode == "project") {
        $sql = "DELETE FROM `tb_project` WHERE `id`='$id'";
        mysqli_query($conn, $sql);

        $sql2    = "SELECT * FROM `tb_file` WHERE `cate`='project' AND `bookid`='$id'";
        $result2 = mysqli_query($conn, $sql2);
        while ($data2 = mysqli_fetch_array($result2)) {
            $file = "../files/" . $data2["year"] . "/" . $data2["filename"];
            //echo $file;
            @unlink($file);
            $fid  = $data2["id"];
            $sql3 = "DELETE FROM `tb_file` WHERE`id`='$fid'";
            mysqli_query($conn, $sql3);
        }
        @header("location:index.php?module=project");
    } else if ($mode == "doc") {


        $sql2    = "SELECT * FROM `tb_document` WHERE `id`='$id'";
        $result2 = mysqli_query($conn, $sql2);
        $data2 = mysqli_fetch_array($result2);
        $file = "doc/" . $data2["files"];
        //echo $file;
        @unlink($file);

        $sql = "DELETE FROM `tb_document` WHERE `id`='$id'";
        mysqli_query($conn, $sql);

        @header("location:index.php?module=doc");
    }
}
