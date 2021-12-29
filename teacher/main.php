<?php 
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}
$id=$_SESSION["ss_id"];

$sql = "SELECT * FROM `tb_dep`";
$result = mysqli_query($conn, $sql);
$opt = "";
while ($data = mysqli_fetch_assoc($result)) {
    $scdep[$data["id"]] = $data["name"];
    $opt .= "<option value='" . $data["id"] . "'>" . $data["name"] . "</option>";
}
$opt = "<select class='form-control-sm' name='key' required>" . $opt . "</select>";

$sql="SELECT * FROM `tb_teacher` WHERE `id`=$id";
$result =mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($result);
extract($data);
 ?>
 <div class="toast text-white bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body" style="font-size:0.5rem">
            Tips: ข้อความที่มี <i class="far fa-edit"></i> ต่อท้าย สามารถ ดับเบิ้ลคลิ๊กเพื่อแก้ไขข้อความได้
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto btn-sm" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>

  <div class="row my-3">
     <div class="offset-2 col-8">
         <table>
             <tbody>
                 <tr>
                     <td>
                         ชื่อ :
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="name">
					        <?=$name;  ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         โรงเรียน :
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="sc_id"><?=getschool($conn,"name",$sc_id);  ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         รหัสประจำตัวประชาชน :
                     </td>
                     <td><?=$cid; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         เลขที่ตำแหน่ง :
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="posno"><?=$posno; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         ตำแหน่ง :
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="pos"><?=$pos; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         รหัสผ่าน :
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="pwd"><?=$pwd; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         อีเมล์ :
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="email"><?= $email; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         หมายเลขโทรศัพท์ :
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="tel"><?= $tel; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         กลุ่มสาระ
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="dep"><?= getdep($conn,$dep); ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         วุฒิ ปริญญาตรี
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="bd"><?= $bd;?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         วิชาเอก ปริญญาตรี
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="bdname"><?= $bdname ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         วุฒิ ปริญญาโท
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="md"><?= $md;?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         วิชาเอก ปริญญาโท
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="mdname"><?= $mdname ?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         วุฒิ ปริญญาเอก
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="dd"><?= $dd;?>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         วิชาเอก ปริญญาเอก
                     </td>
                     <td class="editable" data-id="<?=$id;?>" data-parm="ddname"><?= $ddname ?>
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