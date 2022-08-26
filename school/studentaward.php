<?php
if (!defined("KRITSADAPONG")) {
    @header("location:404.php");
    @die("Access Denied!");
}

$id = $_SESSION["ss_id"];
?>
<div class="row">
    <div class="col-12 col-md-10 mx-auto bg-white rounded">
        <div class="h3 text-center fw-bold my-4 text-primary border border-success border-1 rounded py-4 alert-success">
            ผลงาน/รางวัล ของนักเรียน
        </div>
        <div id="regaward" class="row d-none mb-3">
            <div class="col-md-10 col-12 p-4 border border-1 border-danger rounded mx-auto">
                <form action="studentawardDB.php" id="addBook" enctype="multipart/form-data" method="POST">

                    <div class="row mb-3">
                        <div class="col-12 col-md-4 text-center text-md-end pe-4">
                            <label for="name" class="col-form-label">
                                ชื่อรางวัล <span style="color:red">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-4 text-center text-md-end pe-4">
                            <label for="rank" class="col-form-label">
                                ระดับการแข่งขัน <span style="color:red">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-6">
                            <select name="rank" id="rank" class="form-select form-control" required>
                                <option value="" selected hidden>เลือกระดับการแข่งขัน</option>
                                <option value="โรงเรียน">โรงเรียน</option>
                                <option value="อำเภอ">อำเภอ</option>
                                <option value="สหวิทยาเขต">สหวิทยาเขต</option>
                                <option value="จังหวัด">จังหวัด</option>
                                <option value="เขตพื้นที่มัธยมศึกษา">เขตพื้นที่มัธยมศึกษา</option>
                                <option value="ภูมิภาค">ภูมิภาค</option>
                                <option value="ประเทศ">ประเทศ</option>
                                <option value="นานาชาติ">นานาชาติ</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-4 text-center text-md-end pe-4">
                            <label for="student" class="col-form-label">
                                รายชื่อนักเรียน <span style="color:red">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-6">
                            <textarea name="student" id="student" cols="30" rows="5" class="form-control" required></textarea>
                            <div class="text-sm text-danger mt-1">หากมีนักเรียนมากกว่า 1 คน ให้คั่นด้วยเครื่องหมาย "," (Comma)</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-4 text-center text-md-end pe-4">
                            <label for="year" class="col-form-label">
                                ปีการศึกษา <span style="color:red">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="number" name="year" id="year" class="form-control" required min="2560" max="2599" require>
                            <div class="text-sm text-danger mt-1">เช่น 2565</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-4 text-center text-md-end pe-4">
                            <label for="organize" class="col-form-label">
                                หน่วยงานที่มอบ <span style="color:red">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" name="organize" id="organize" class="form-control" required>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-12 col-md-4 text-center text-md-end pe-4">
                            <label for="adate" class="col-form-label">
                                วันที่ได้รับรางวัล <span style="color:red">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" name="adate" id="adate" class="form-control" required autocomplete="วันที่ได้รับรางวัล" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-4 text-center text-md-end pe-4">
                            <label for="adate" class="col-form-label">
                                แนบเอกสาร/หลักฐาน 1
                            </label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="file" class="form-control" name="att[]" id="att" accept="image/*,*.pdf">
                            <input type="text" class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-4 text-center text-md-end pe-4">
                            <label for="adate" class="col-form-label">
                                แนบเอกสาร/หลักฐาน 2
                            </label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="file" class="form-control" name="att[]" id="att" accept="image/*,*.pdf">
                            <input type="text" class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">
                        </div>
                    </div>

                    <div class="col-4 mx-auto row">
                        <button type="submit" class="btn btn-primary" name="submit">บันทึก</button>
                    </div>

                </form>
            </div>
        </div>
        <script>
        </script>
        <div><button class="btn btn-primary float-end" id="addaward">เพิ่มผลงานนักเรียน</button></div>
        <div class="clearfix "></div>
        <div class="mt-3">
            <table class="table" id="studentaward">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อรางวัล</th>
                        <th>ระดับ</th>
                        <th>รายชื่อนักเรียน</th>
                        <th>ปีการศึกษา</th>
                        <th>หน่วยงานที่มอบ</th>
                        <th>วันที่ได้รับรางวัล</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$sql = "SELECT * FROM `tb_studentaward` WHERE `sc_id`=$id ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
$nost = mysqli_num_rows($result);
while ($data = @mysqli_fetch_assoc($result)) {
    @extract($data);
    ?>
                    <tr>
                        <td><?=$nost;?></td>
                        <td><a href="../index.php?module=stdawdshow&id=<?=$id;?>" target="_blank"><?=$name;?></a></td>
                        <td><?=$rank;?></td>
                        <td>
                            <?php
$arr = explode(',', $student);
    foreach ($arr as $val) {
        echo $val . "<br>";
    }
    ?>
                        </td>
                        <td><?=$year;?></td>
                        <td><?=$organize;?></td>
                        <td><?=$adate;?></td>
                        <td class="text-center">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="ลบ" class="del" data-id="<?=$id;?>">
                                <i class="fas fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                    <?php
$nost--;
}
?>
                </tbody>
            </table>
        </div>

        <div class="clearfix mb-3"></div>
    </div>

</div>