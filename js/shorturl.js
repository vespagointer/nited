$("#getURL").submit(function (event) {
	// Stop form from submitting normally
	event.preventDefault();
	// Get some values from elements on the page:
	var $form = $(this),
		term1 = $form.find("input[name='lurl']").val(),
		term2 = $form.find("input[name='ssurl']").val(),
		term3 = $form.find("input[name='lname']").val(),
		url = $form.attr("action");

	// Send the data using post
	var posting = $.post(url, {
		lurl: term1,
		ssurl: term2,
		name: term3,
	});

	// Put the results in a div
	posting.done(function (data) {
		//var content = $(data); //.find("#content");
		//$("#result").empty().append(content);
		//alert("Data Loaded: " + data);
		var webUrl = "https://spmnan.ga/";
		if (data.trim() == "false") {
			$("#surl").val("");
			alert("กรุณาลองใหม่อีกครั้ง");
		} else if (data.trim() == "dup") {
			$("#surl").val("");
			alert("Custom Short Link : " + term2 + " ถูกใช้ไปแล้ว\nกรุณาเปลี่ยน");
		} else {
			$("#surl").val(webUrl + data);
			$("#surl").prop("disabled", false);
			$("#CopyB").prop("disabled", false);
			$("#qrcode").attr("src", "qrcode/" + data + ".png");
			$("#qrcode").show();
			//$("#tbLinks").empty().load("ltable.php");
		}
	});
});

function CopyLink() {
	/* Get the text field */
	var copyText = document.getElementById("surl");

	/* Select the text field */
	copyText.select();
	copyText.setSelectionRange(0, 99999); /* For mobile devices */

	/* Copy the text inside the text field */
	navigator.clipboard.writeText(copyText.value);

	/* Alert the copied text */
	alert("Copy Short URL Link แล้ว!");
}
