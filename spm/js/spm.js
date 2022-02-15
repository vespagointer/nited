$(document).ready(function () {
	$("#spmtable").DataTable({
		order: [[0, "asc"]],
		pageLength: 25,
		buttons: [
			"searchBuilder",
			"copy",
			"excel",
			{
				extend: "csv",
				charset: "UTF-8",
				fieldSeparator: ",",
				bom: true,
			},
			"print",
		],
		language: {
			url: "js/th.json",
		},
		dom: "Bfrtlpi",
	});

	$("#teacher").DataTable({
		order: [[4, "asc"]],
		pageLength: 50,
		buttons: [
			"searchBuilder",
			"copy",
			"excel",
			{
				extend: "csv",
				charset: "UTF-8",
				fieldSeparator: ",",
				bom: true,
			},
			"print",
		],
		language: {
			url: "js/th.json",
		},
		dom: "Bfrtlpi",
	});

	if (status == "admin") {
		for (let i = 2; i < 7; i++) {
			$("#spmtable tr td:nth-child(" + i + ")").addClass("editable");
		}
	}
});

const inp1 = '<input type="text" name="tmpData" id="tmpData" class="form-control" required />';
var id = 0;
var parm = "";
var text = "";
$(document).on("dblclick", ".editable", function () {
	text = $(this).text().trim();
	id = $(this).data("id");
	parm = $(this).data("parm");
	$(this).addClass("editing");
	$("#inp").empty().html(inp1);
	$("#tmpData").val(text);
	//$("#id").val(id);
	//$("#parm").val(parm);
	$("#xEdit").modal("toggle");
	$("#tmpData").removeClass("is-invalid");
	$("#tmpData").removeClass("is-valid");
});

$(document).on("change keyup", "#tmpData", function (e) {
	//console.log($(this).parent().parent().get( 0 ).tagName);
	var tmp = $("#tmpData").val();
	if (tmp == "") {
		$("#tmpData").removeClass("is-valid").addClass("is-invalid");
	} else {
		$("#tmpData").removeClass("is-invalid").addClass("is-valid");
	}
});

$(document).on("click", "#cancel", function (e) {
	$(".editing").removeClass("editing");
});

$(document).on("click", "#save", function (e) {
	var xtmpData = $("#tmpData").val().trim();
	var fData = new FormData();
	fData.append("tmpData", xtmpData);
	fData.append("id", parseInt(id));
	fData.append("parm", parm);
	fData.append("mode", "teacher");

	if (xtmpData == "") {
		$("#tmpData").addClass("is-invalid");
	} else {
		var post = $.ajax({
			type: "POST",
			url: "updateDB.php",
			processData: false,
			contentType: false,
			data: fData,
		});
		post.done(function (data) {
			//console.log(data);
			if (data == "OK") {
				$("#xEdit").modal("toggle");
				$(".editing").text(xtmpData).removeClass("editing");
			} else {
				alert("แก้ไขไม่ได้กรุณาลองอีกครั้ง");
			}
		});
	}
});

$("#cPass").on("show.bs.modal", function (event) {
	var id = $(event.relatedTarget).attr("data-id");
	//alert($(event.relatedTarget).attr("data-id"));
	$("#tid").val(id);
	$("#pwd").val("");
	$("#pwd").removeClass("is-invalid");
	$("#pwd").removeClass("is-valid");
});

$(document).on("click", "#savepwd", function (e) {
	//console.log($(this).parent().parent().get( 0 ).tagName);
	var tid = $("#tid").val();
	var pwd = $("#pwd").val();

	var fData = new FormData();
	fData.append("tmpData", pwd);
	fData.append("id", parseInt(tid));
	fData.append("parm", "pwd");
	fData.append("mode", "teacher");

	if (pwd == "") {
		$("#pwd").addClass("is-invalid");
	} else {
		var post = $.ajax({
			type: "POST",
			url: "updateDB.php",
			processData: false,
			contentType: false,
			data: fData,
		});
		post.done(function (data) {
			//console.log(data);
			if (data == "OK") {
				alert("เปลี่ยนรหัสผ่านแล้ว");
				$("#cPass").modal("toggle");
				$(".editing").removeClass("editing");
			} else {
				alert("เปลี่ยนรหัสผ่านไม่ได้กรุณาลองอีกครั้ง");
			}
		});
	}
});

$(document).on("change keyup", "#pwd", function (e) {
	//console.log($(this).parent().parent().get( 0 ).tagName);
	var pwd = $("#pwd").val();
	if (pwd == "") {
		$("#pwd").removeClass("is-valid").addClass("is-invalid");
	} else {
		$("#pwd").removeClass("is-invalid").addClass("is-valid");
	}
});

$(document).on("click", ".delt", function (e) {
	//console.log($(this).parent().parent().get( 0 ).tagName);
	var tid = $(this).data("id");
	var ttr = $(this).parent().parent();
	//alert(tid);
	if (confirm("ต้องการลบ?") == true) {
		$.get("updateDB.php", { do: "delt", id: tid }).done(function (data) {
			if (data == "OK") {
				ttr.hide();
				//console.log(ttr.get(0).tagName);
			} else {
				alert("ลบออกไม่ได้กรุณาลองอีกครั้ง");
			}
		});
	}
});

$(document).on("click", "#update", function (e) {
	e.preventDefault();
	$.get("../updatestat.php").done(function (data) {
		if (data == "done") {
			alert("อัพเดทข้อมูลเรียบร้อยแล้ว");
		} else {
			alert("อัพเดทข้อมูลไม่ได้\nกรุณาแจ้งครูเอฟ");
		}
	});
});
