<?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
$id = $_SESSION["ss_id"];

$imgPro = "../pictures/profile/" . $id . ".jpg";
if (!file_exists($imgPro)) {
 $imgPro = "../images/profile.png";
}

$sql = "SELECT * FROM `tb_dep`";
$result = mysqli_query($conn, $sql);
$opt = "";
while ($data = mysqli_fetch_assoc($result)) {
 $scdep[$data["id"]] = $data["name"];
 $opt .= "<option value='" . $data["id"] . "'>" . $data["name"] . "</option>";
}
$opt = "<select class='form-control-sm' name='key' required>" . $opt . "</select>";

$sql = "SELECT * FROM `tb_teacher` WHERE `id`=$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
extract($data);
?>
<div class="toast text-white bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body" style="font-size:0.7rem">
            Tips: ข้อความที่มี <i class="far fa-edit"></i> ต่อท้าย สามารถ ดับเบิ้ลคลิ๊กเพื่อแก้ไขข้อความได้
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto btn-sm" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>

<div class="bg-primary col-lg-9 mx-auto my-3 rounded text-center p-3">
    <h5 class=" fw-bold text-white">ข้อมูลส่วนตัว</h5>
</div>
<div class="text-center my-3">
    <img src="<?=$imgPro;?>" class="img-thumbnail rounded" style="height:200px;" id="imgProfile">
    <div class="text-center text-muted mt-1">ดับเบิ้ลคลิกที่รูป เพื่อเปลี่ยนรูป</div>
</div>
<div class="row my-3 ">
    <div class="offset-lg-2 col-lg-8 bg-white p-3 rounded">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>
                        ชื่อ :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="name">
                        <?=$name;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        โรงเรียน :
                    </td>
                    <td><?=getschool($conn, "name", $sc_id);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        รหัสประจำตัวประชาชน :
                    </td>
                    <td><?=$cid;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วันเกิด :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="bdate"><?=$bdate;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        เลขที่ตำแหน่ง :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="posno"><?=$posno;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        ตำแหน่ง :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="pos"><?=$pos;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        รหัสผ่าน :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="pwd"><?=$pwd;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        อีเมล์ :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="email"><?=$email;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        หมายเลขโทรศัพท์ :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="tel"><?=$tel;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        กลุ่มสาระฯ :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="dep"><?=getdep($conn, $dep);?>
                    </td>
                </tr>
                <tr>
                    <td>
                        เป็นครูโครงการทุน ส.ค.ว.ค. :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="psmt"><?=$psmt;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        ส.ค.ว.ค. รุ่นที่ :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="psmtno"><?=$psmtno;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วุฒิ ทางลูกเสือ :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="scout">
                        <?php
if ($scout == "none") {
 echo "ไม่มีวุฒิทางลูกเสือ";
} else {
 echo $scout;
}
?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วุฒิ ทางยุวกาชาด :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="redcross"><?=$redcross;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วุฒิ ปริญญาตรี :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="bd"><?=$bd;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วิชาเอก ปริญญาตรี :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="bdname"><?=$bdname?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วุฒิ ปริญญาโท :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="md"><?=$md;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วิชาเอก ปริญญาโท :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="mdname"><?=$mdname?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วุฒิ ปริญญาเอก :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="dd"><?=$dd;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วิชาเอก ปริญญาเอก :
                    </td>
                    <td class="editable" data-id="<?=$id;?>" data-parm="ddname"><?=$ddname?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="xEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">แก้ไขข้อมูล</h6>
            </div>
            <div class="modal-body">
                <input type="text" name="tmpData" id="tmpData" class="form-control" required>
                <select name="tmpSel" id="tmpSel" class="form-control" required>
                    <?php
foreach ($scdep as $key => $val) {
 echo "<option value=\"$key\">$val</option>";
}
?>
                </select>
                <select name="tmpScout" id="tmpScout" class="form-control" required>
                    <option value="C.B.T.C.">C.B.T.C. (ลูกเสือสำรอง)</option>
                    <option value="C.A.T.C.">C.A.T.C. (ลูกเสือสำรอง)</option>
                    <option value="C.W.B.">C.W.B. (ลูกเสือสำรอง)</option>
                    <option value="S.B.T.C.">S.B.T.C. (ลูกเสือสามัญ)</option>
                    <option value="S.A.T.C.">S.A.T.C. (ลูกเสือสามัญ)</option>
                    <option value="S.W.B.">S.W.B. (ลูกเสือสามัญ)</option>
                    <option value="S.S.B.T.C.">S.S.B.T.C. (ลูกเสือสามัญรุ่นใหญ่)</option>
                    <option value="S.S.A.T.C.">S.S.A.T.C. (ลูกเสือสามัญรุ่นใหญ่)</option>
                    <option value="S.S.W.B.">S.S.W.B. (ลูกเสือสามัญรุ่นใหญ่)</option>
                    <option value="R.B.T.C.">R.B.T.C. (ลูกเสือวิสามัญ)</option>
                    <option value="R.A.T.C.">R.A.T.C. (ลูกเสือวิสามัญ)</option>
                    <option value="R.W.B.">R.W.B. (ลูกเสือวิสามัญ)</option>
                    <option value="A.L.T.C.">A.L.T.C.</option>
                    <option value="A.L.T.">A.L.T.</option>
                    <option value="L.T.C.">L.T.C.</option>
                    <option value="L.T.">L.T.</option>
                    <option value="none">ไม่มีวุฒิทางลูกเสือ</option>
                </select>
                <input type="text" class="form-control" name="tmpDate" id="tmpDate" autocomplete="เลือกวันที่" required>
                <select name="tmpPsmt" id="tmpPsmt" class="form-control" required>
                    <option value="ส.ค.ว.ค.">ส.ค.ว.ค</option>
                    <option value="ส.ค.ว.ค.ระยะที่ 2">ส.ค.ว.ค. ระยะที่ 2</option>
                    <option value="ส.ค.ว.ค.ระยะที่ 3">ส.ค.ว.ค. ระยะที่ 3</option>
                    <option value="ส.ค.ว.ค.ระยะที่ 4">ส.ค.ว.ค. ระยะที่ 4</option>
                    <option value="">ไม่ได้รับทุน ส.ค.ว.ค.</option>
                </select>
                <select name="tmpPsmtNo" id="tmpPsmtNo" class="form-control" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>

                    <option value="">ไม่รู้รุ่น</option>
                </select>
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="parm" id="parm">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="save">บันทึก</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fs-6" tabindex="-1" id="upimg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="p-2 fw-bold">อัพโหลดรูปภาพ</div>
            <div class="modal-body text-center"><input type="file" name="image" id="image" class="visually-hidden"
                    accept="image/jpeg" /><button type="button" class="btn btn-primary btn-sm w-50 mb-3"
                    id="btnbrows">เลือกรูป</button><br />
                <img id="imgview" style="max-width: 80%" class="img-thumbnail rounded mb-3" />
                <div class="modal-footer"><button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">ยกเลิก</button><button type="button" class="btn btn-primary"
                        id="addImage">บันทึก</button></div>
            </div>
        </div>
    </div>
</div>
