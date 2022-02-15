$(document).on("dblclick", ".editable", function () {
	var text = $(this).text();
	var id = $(this).data("id");
	var parm = $(this).data("parm");
	$(this).addClass("editing");
	$("#tmpData").val(text);
	$("#id").val(id);
	$("#parm").val(parm);
	$("#xEdit").modal("toggle");
	$("#tmpData").removeClass("is-invalid");
	$("#tmpData").removeClass("is-valid");
});

$(document).on("click", "#save", function (e) {
	var xtmpData = $("#tmpData").val();
	var xid = $("#id").val();
	var xparm = $("#parm").val();

	if (xtmpData == "") {
		$("#tmpData").addClass("is-invalid");
	} else {
		$.post("update.php", {
			id: xid,
			tmpData: xtmpData,
			parm: xparm,
			mode: "school",
		}).done(function (data) {
			if (data == "OK") {
				//alert("บันทึกการแก้ไขแล้ว");
				$("#xEdit").modal("toggle");
				$(".editing").text(xtmpData).removeClass("editing");
			} else {
				alert("แก้ไขไม่ได้กรุณาลองอีกครั้ง");
			}
		});
	}
});

$(document).on("change keyup", "#tmpData", function (e) {
	//console.log($(this).parent().parent().get( 0 ).tagName);
	var pwd = $("#tmpData").val();
	if (pwd == "") {
		$("#tmpData").removeClass("is-valid").addClass("is-invalid");
	} else {
		$("#tmpData").removeClass("is-invalid").addClass("is-valid");
	}
});

$(document).on("click", "#cancel", function (e) {
	$(".editing").removeClass("editing");
});

$(document).ready(function () {
	$(".toast").toast("show");
});

$(document).on("dblclick", "#imgProfile", function () {
	///alert("Hello");
	$("#upimg").modal("toggle");
});

$(document).on("click", "#btnbrows", function () {
	$("#image").trigger("click");
});

$(document).on("change", "#image", function () {
	$("#imgview").show();
	var file = this.files[0];
	var reader = new FileReader();
	reader.onloadend = function () {
		imagebase64 = reader.result;
		$("#imgview").attr("src", imagebase64);
	};
	reader.readAsDataURL(file);
	if (file.size > 3000000) {
		alert("ขนาดของไฟล์ต้องไม่เกิน 3 MB");
		$(this).val("");
		$("#imgview").attr("src", "");
		$("#addImage").prop("disabled", true);
	} else {
		$("#addImage").prop("disabled", false);
	}
});

$(document).on("click", "#addImage", function () {
	var file_data = $("#image").prop("files")[0];
	var form_data = new FormData();
	form_data.append("img", file_data);

	$.ajax({
		url: "upload.php", // point to server-side controller method
		//dataType: "text", // what to expect back from the server
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "post",
		success: function (response) {
			if (response == "FAIL") {
				alert("ไม่สามารถบันทึกรูปได้ กรุณาลองอีกครั้ง");
			} else {
				$("#imgProfile").attr("src", response + "?" + new Date().getTime());
				$("#upimg").modal("toggle");
			}
		},
		error: function (response) {
			console.log(response); // display error response from the server
		},
	});
});
