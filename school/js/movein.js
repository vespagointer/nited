$(document).on("click", ".movebtn", function (e) {
	//console.log($(this).parent().parent().get( 0 ).tagName);
	var tid = $(this).data("id");
	var ttr = $(this).parent().parent();
	//alert(tid);
	if (confirm("ต้องการรับย้ายครูเข้าโรงเรียน?") == true) {
		$.get("teacherdb.php", { do: "in", id: tid }).done(function (data) {
			if (data == "OK") {
				ttr.hide();
				//console.log(ttr.get(0).tagName);
			} else {
				alert("ย้ายออกไม่ได้กรุณาลองอีกครั้ง");
			}
		});
	}
});
