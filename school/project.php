<?php
$scid=$_SESSION["ss_id"];
$sql="SELECT * FROM `tb_project`";
$result=mysqli_query($conn,$sql);
$i=0;
while ($row = mysqli_fetch_assoc($result)) {
    $pID[$i]=$row['id'];
    $pName[$row["id"]] = $row["pname"];
    $i++;
   }

   $sql="SELECT `pid` FROM `tb_uproject` WHERE `scid`=$scid";
   $result=mysqli_query($conn,$sql);
   //$scpid=[];
   $i=0;
   if(mysqli_num_rows($result)>0){
       while($data=mysqli_fetch_assoc($result)){
           $scpid[$i]=$data["pid"];
           $i++;
       }
   }
   if(!isset($scpid))$scpid=[];
    $pID=array_diff($pID,$scpid);
    @$pID=array_values($pID);
   ?>

<div class="col-md-8 offset-md-2">
    <div id="projectlist">

        <?php
include_once("projectlist.php");

?>

    </div>

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    โครงการ สพม.น่าน
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="my-3">
                        <label for="project" class="form-label fw-bold">เลือกโครงการที่โรงเรียนเข้าร่วม <span
                                style="color:red">*</span></label>
                        <select class="form-control" name="project" id="project" data-placeholder="">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tname" class="form-label">ครูผู้รับผิดชอบโครงการ <span class="text-muted"
                                style="font-size:0.5rem">(ไม่บังคับให้กรอก)</span></label>
                        <input type="text" class="form-control" name="tname" id="tname">
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">เบอร์โทรผู้รับผิดชอบโครงการ <span class="text-muted"
                                style="font-size:0.5rem">(ไม่บังคับให้กรอก)</span></label>
                        <input type="tel" class="form-control" name="tel" id="tel" pattern="[0]{1}[0-9]{9}">
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm w-auto" id="add">เพิ่มโครงการ</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    โครงการอื่นๆ
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="my-3">
                        <label for="project2" class="form-label fw-bold">ชื่อโครงการ <span
                                style="color:red">*</span></label>
                        <input type="text" class="form-control" name="project2" id="project2"
                            data-placeholder="ชื่อโครงการ" required>
                    </div>
                    <div class="mb-3">
                        <label for="ptype" class="form-label">ประเภทของโครงการ <span class="text-muted"
                                style="font-size:0.5rem">(ไม่บังคับให้กรอก)</span></label>
                        <select class="form-control" name="ptype" id="ptype">
                            <option value="1">โครงการของโรงเรียน</option>
                            <option value="2">โครงการของหน่วยงานอื่น</option>
                        </select>
                    </div>
                    <div class="mb-3" id="other">
                        <label for="funder" class="form-label">ชื่อหน่วยงานเจ้าของโครงการ</label>
                        <input type="text" class="form-control" name="funder" id="funder">
                    </div>
                    <div class="mb-3">
                        <label for="tname2" class="form-label">ครูผู้รับผิดชอบโครงการ <span class="text-muted"
                                style="font-size:0.5rem">(ไม่บังคับให้กรอก)</span></label>
                        <input type="text" class="form-control" name="tname2" id="tname2">
                    </div>
                    <div class="mb-3">
                        <label for="tel2" class="form-label">เบอร์โทรผู้รับผิดชอบโครงการ <span class="text-muted"
                                style="font-size:0.5rem">(ไม่บังคับให้กรอก)</span></label>
                        <input type="tel" class="form-control" name="tel2" id="tel2" pattern="[0]{1}[0-9]{9}">
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm w-auto" id="add2">เพิ่มโครงการ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var pID = <?php echo json_encode($pID); ?>;

var pName = <?php echo json_encode($pName, JSON_UNESCAPED_UNICODE); ?>;

var term3 = "<?php echo $_SESSION["ss_name"]; ?>";
</script>