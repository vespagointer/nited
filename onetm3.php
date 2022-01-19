 <?php
if (!defined("KRITSADAPONG")) {
 //die("Access Denied!");
 @header("location:404.php");
 @die("Access Denied!");
}

if (isset($_POST["okey"])) {
 extract($_POST);
 if ($owhat == "name") {
  $sql = "SELECT `id`,`stName`,`stLname` FROM `onetm3` WHERE `stName` LIKE '%$okey%' OR `stLname` LIKE '%$okey%'";
 } else {
  $sql = "SELECT `id`,`stName`,`stLname` FROM `onetm3` WHERE `$owhat` LIKE '%$okey%'";
 }
 $result = mysqli_query($conn, $sql);
}
?>
 <div class="bg-white col-lg-10 mx-auto my-3 rounded text-center">
     <h5 class="p-3 fw-bold">ค้นหาที่นั่งสอบ O-Net ม.3</h5>
 </div>
 <div class="col-md-8 mx-auto text-start">
     <form action="index.php?module=onetm3" method="post">
         <div class=" d-lg-flex text-center">
             <div class="me-1 align-middle mb-2"><span class="align-middle fs-6 fw-bold">
                     ค้นหาจาก </span></div>
             <div>

                 <select class="form-control-sm me-lg-1 mb-2" name="owhat" id="owhat">
                     <option value="cId">รหัสประชาชน</option>
                     <option value="stId">รหัสนักเรียน</option>
                     <option value="name">ชื่อ - สกุล</option>
                 </select>
             </div>
             <div id="sinput" class="me-lg-1 mb-2">
                 <input type="text" class="form-control-sm" name="okey" required>
             </div>
             <div id="sinput">
                 <button type="submit" class="btn btn-danger btn-sm text-white">ค้นหา</button>

             </div>
         </div>
     </form>
 </div>
 <div class="my-3 col-10 col-md-8 mx-auto">
     <?php
echo "ค้นหาพบ " . (int) @mysqli_num_rows($result) . " รายการ";

if (mysqli_num_rows($result) > 0) {
 echo "<ul>";
 while ($data = mysqli_fetch_row($result)) {
  echo "<li><a href='index.php?module=student&id=$data[0]' taaget='_balnk'>$data[1] $data[2]</a></li>\n";
 }
 echo "</ul>";
}
?>
 </div>
