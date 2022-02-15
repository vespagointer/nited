$(document).on("click", ".delg", function (e) {
	//console.log($(this).parent().parent().get( 0 ).tagName);
	var gid = $(this).data("id");
	var ttr = $(this).parent().parent();
	//alert(tid);
	if (confirm("ต้องการลบภาพกิจกรรม?") == true) {
		$.get("del.php", {
			m: "gallery",
			id: gid,
		}).done(function (data) {
			// alert(data);
			if (data == "OK") {
				ttr.hide();
				//console.log(ttr.get(0).tagName);
			} else {
				alert("ลบไม่ได้กรุณาลองอีกครั้ง");
			}
		});
	}
});
