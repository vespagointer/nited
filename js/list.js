$(document).ready(function () {
	$("#scpr, #gallery, #scaward, #publish").DataTable({
		order: [[0, "desc"]],
		pageLength: 25,
		language: {
			url: "js/th.json",
		},
		dom: "lfrtip",
	});

	$("#taward,#train").DataTable({
		order: [[0, "desc"]],
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
});
