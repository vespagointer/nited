<div class="row mt-3">
    <div class="col-md-4 mb-2">
        <a href="index.php?module=spm" type="button" class="btn btn-nan1 w-100">
            <i class="fas fa-user-circle fa-5x p-1"></i><br />
            บุคลากรใน สพม.น่าน<br />
            <div class="fs-2">
                <?php
$sql = "SELECT COUNT(`id`) FROM `tb_teacher` WHERE `sc_id`=99";
$result = mysqli_query($conn, $sql);
echo mysqli_fetch_row($result)[0];
?>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-2">
        <a href="index.php?module=teacher" type="button" class="btn btn-nan2 w-100">
            <i class="fas fa-chalkboard-teacher fa-5x p-1"></i><br />
            บุคลากร ในสังกัด สพม.น่าน<br />
            <div class="fs-2">
                <?php
$sql = "SELECT COUNT(`id`) FROM `tb_teacher` WHERE `sc_id`!=99";
$result = mysqli_query($conn, $sql);
echo mysqli_fetch_row($result)[0];
?>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-2">
        <a href="#" type="button" class="btn btn-nan3 w-100" id="update">
            <i class="fas fa-sync fa-5x p-1"></i><br />
            อัพเดทสถิติ ของโรงเรียน
            <div class="fs-2">....</div>
        </a>

    </div>
    <!--
    <div class="col-md-3 mb-2">
        <a href="#" type="button" class="btn btn-nan4 w-100" disabled>Hello</a>
    </div>
-->
</div>
