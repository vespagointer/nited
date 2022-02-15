$("#addAtt").click(function (event) {
	var attForm =
		'<input type="file" class="form-control" name="att[]" id="att"><input type="text" class="form-control mb-2" name="attName[]" id="attName" placeholder="ชื่อเอกสาร" maxlength="250">';
	$("#attFile").append(attForm);
});

$(document).on("click", ".delbtn", function (e) {
	return confirm("ต้องการลบข้อมูล?");
});
