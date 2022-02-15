$(function () {
	if ($("#imgProfile").attr("src") == "") {
		$("#imgProfile").attr("src", "../images/profile.png");
	}
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
			$("#msg").html(response); // display error response from the server
		},
	});
});
