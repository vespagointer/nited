<?php
$do = $_GET["do"];

if ($do == "add") { //add
 ?>
<div class="row col-lg-6 offset-lg-3">
    <div class="text-center pt-2">
        <h6>เพิ่มครู</h6>
    </div>
    <div class="row mx-auto">
        <form action="teacherdb.php" method="POST" id="myForm" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ - สกุล</label>
                <input type="text" class="form-control" name="name" id="name"
                    placeholder="ตัวอย่าง: นายรักการสอน มาเช้า" required>
            </div>
            <div class="mb-3">
                <label for="cid" class="form-label">รหัสประจำตัวประชาชน</label>
                <input type="text" class="form-control" name="cid" id="cid" placeholder="ตัวอย่าง: 1234567891012"
                    pattern="[1-9]{1}[0-9]{12}" required>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="pwd" id="pwd" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล์</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                <input type="tel" class="form-control" name="tel" id="tel" placeholder="ตัวอย่าง: 0819999999"
                    pattern="[0]{1}[0-9]{9}" required>
            </div>
            <div class="mb-3">
                <label for="pos" class="form-label">ตำแหน่ง</label>
                <input type="text" class="form-control" name="pos" id="pos" placeholder="ตัวอย่าง: ครูชำญาญการพิเศษ"
                    required>
            </div>
            <div class="mb-3">
                <label for="dep" class="form-label">กลุ่มสาระการเรียนรู้</label>
                <select name="dep" id="dep" class="form-control" required>
                    <option disabled selected></option>
                    <?php
$sql = "SELECT * FROM `tb_dep`";
 $result = mysqli_query($conn, $sql);
 while ($data = mysqli_fetch_assoc($result)) {
  echo "<option value='" . $data["id"] . "'>" . $data["name"] . "</option>";
 }

 ?>
                </select>
            </div>
            <div class="mb-3 text-center">
                <input type="hidden" name="mode" value="addteacher">
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>
</div>
<?php
} // end add

if ($do == "addteacher") { //add teacher
 if (isset($_POST)) {
  extract($_POST);
 }
 echo "รหัสประชาชนซ้ำ";
} // end add teacher
?>