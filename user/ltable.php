<?php
@define("KRITSADAPONG", true);
require_once "../conn.php";
$url = "http://spmnan.ga/";

if (!isset($limit)) {
 $limit = 20;
}
$sql    = "SELECT * FROM `urls` ORDER BY `urls`.`url_id` DESC LIMIT $limit";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) >= 1) {
 ?>
<div class="mb-3 text-center fs-6 fw-bold">
    Short URL
</div>
<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr>

            <th scope="col" class="text-center" style="width:45%">ชื่อ Link</th>
            <th scope="col" class="text-center" style="width:25%">Short URL</th>
            <th scope="col" class="text-center" style="width:10%">Check School</th>
            <th scope="col" class="text-center" style="width:10%">QR Code</th>
            <th scope="col" class="text-center" style="width:10%">ลบ</th>
        </tr>
    </thead>
    <tbody>
        <?php
while ($data = mysqli_fetch_array($result)) {
  $url_id = $data["url_id"];
  $surl   = $data["surl"];
  $gurl   = $data["gurl"];
  ?>
        <tr>
            <td><?=htmlspecialchars_decode($data["name"]);?></td>
            <td><a href="<?=$url . $surl;?>" target="_blank"><?=$url . $surl;?></a></td>
            <td class="text-center">
                <?php
if (!empty($gurl)) {

   ?>
                <a href="index.php?module=ckschoolv3&id=<?=$url_id;?>" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="คลิ๊กเพื่อตรวจสอบการ กรอกข้อมูลของโรงเรียน"><i
                        class="fas fa-school text-success"></i></a>&nbsp;
                <a href="index.php?module=editschool&id=<?=$url_id;?>" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="แก้ไขโรงเรียน"><i class="fas fa-user-edit text-secondary"></i></a>
                <?php }?>
            </td>
            <td class="text-center"><a href="../qrcode/<?=$surl;?>.png" target="_blank" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="คลิ๊กเพื่อเปิด QR Code"><img src="../img/qr.png" /></a>
            </td>
            <td class="text-center">
                <a href="index.php?module=editshort&id=<?=$url_id;?>" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="แก้ไข">
                    <i class="fas fa-edit text-primary"></i>
                </a>
                <a href="delqr.php?id=<?=$url_id;?>" data-bs-toggle="tooltip" data-bs-placement="top" title="ลบ"
                    class="delbtn">
                    <i class="fas fa-trash text-danger"></i></a>


            </td>
        </tr>
        <?php }?>
    </tbody>
</table>
<?php }?>