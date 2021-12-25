        <div class="row pt-3">
            <div class="col-6">
                <form action="ckschooled.php" id="ckschool">
                    <div class="form-group">
                        <label for="SchoolName" class="pb-1"><b>ชื่อโรงเรียน ที่ต้องการตรวจสอบ</b></label>
                        <textarea class="form-control" id="SchoolName" name="school" rows="10"
                            style="font-size:0.75rem"></textarea>
                        <div id="nCount" class="my-2"></div>
                    </div>
                    <div class="form-group mt-1">
                        <label class="pe-3"><b>เลขลำดับ</b></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nOrder" id="inlineRadio1" value="1"
                                checked>
                            <label class="form-check-label" for="inlineRadio1">มี</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nOrder" id="inlineRadio2" value="0">
                            <label class="form-check-label" for="inlineRadio2">ไม่มี</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center my-3">
                        <button type="submit" class="btn btn-success pt-2">ตรวจสอบ</button>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <span><b>โรงเรียนที่ไม่มีรายชื่อ</b></span>
                <div id="scmiss" class="ps-2">
                </div>
            </div>
        </div>