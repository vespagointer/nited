$(document).ready(function () {
	//console.log(parseInt(ss_id));
	if (parseInt(ss_id) > 0) {
		$("tr td:nth-child(2):not(.nonEdit)").addClass("editable");
	}
});
const inp1 = '<input type="text" name="tmpData" id="tmpData" class="form-control" required />';
const inp2 = '<input type="number" name="tmpData" id="tmpData" class="form-control" required />';
const inp3 =
	'<select class="form-control" name="tmpData" id="tmpData" required><option value="Onsite">Onsite</option><option value="Online">Online</option></select>';
const inp4 =
	'<input type="text" name="tmpData" id="tmpData" class="form-control" autocomplete="เลือกวันที่" required />';
const inp5 =
	'<input type="file" class="form-control" name="tmpData" id="tmpData" accept="image/png,image/jpeg,application/pdf" required>';
const inp6 =
	'<select class="form-control" name="tmpData" id="tmpData" required>' +
	'<option value="นานาชาติ">นานาชาติ</option>' +
	'<option value="ประเทศ">ประเทศ</option>' +
	'<option value="ภาค">ภาค</option>' +
	'<option value="จังหวัด">จังหวัด</option>' +
	'<option value="โรงเรียน">โรงเรียน</option>' +
	"</select>";
$(document).on("dblclick", ".editable", function () {
	var text = $(this).text().trim();
	var id = parseInt(xid); //$(this).data("id");
	var parm = $(this).data("parm");
	var dtype = $(this).data("type");
	$(this).addClass("editing");

	if (dtype == "text") {
		$("#inp").empty().html(inp1);
	} else if (dtype == "number") {
		$("#inp").empty().html(inp2);
	} else if (dtype == "select") {
		$("#inp").empty().html(inp3);
	} else if (dtype == "select2") {
		$("#inp").empty().html(inp6);
	} else if (dtype == "date") {
		$("#inp").empty().html(inp4);
		text = reDate(text);
		$("#tmpData").val(text);
		$("#tmpData").datepicker({
			format: "yyyy-mm-dd",
			maxViewMode: 2,
			language: "th",
			daysOfWeekHighlighted: "0,6",
			autoclose: true,
			todayHighlight: true,
		});
	} else if (dtype == "file") {
		$("#inp").empty().html(inp5);
	}

	$("#tmpData").val(text);
	$("#id").val(id);
	$("#parm").val(parm);
	$("#dtype").val(dtype);
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
	var dtype = $("#dtype").val();
	var xtmpData = $("#tmpData").val().trim();
	var xid = $("#id").val();
	var fd = new FormData($("#xform")[0]);
	fd.append("tid", parseInt(ss_id));
	fd.append("mode", xmode);
	if (xtmpData == "") {
		$("#tmpData").addClass("is-invalid");
	} else {
		$.ajax({
			type: "POST",
			url: "update.php",
			processData: false,
			data: fd,
			contentType: false,
		}).done(function (data) {
			//console.log(data);
			if (data == "OK") {
				//alert("บันทึกการแก้ไขแล้ว");
				var xtmpData = $("#tmpData").val().trim();
				$("#xEdit").modal("toggle");
				if (dtype == "date") {
					xtmpData = renderDate(xtmpData);
					$(".editing").text(xtmpData).removeClass("editing");
				} else if (dtype == "file") {
					$.get("file.php", { type: xmode, id: xid }).done(function (data) {
						$(".editing").html(data).removeClass("editing");
					});
				} else {
					$(".editing").text(xtmpData).removeClass("editing");
				}
			} else {
				alert("แก้ไขไม่ได้กรุณาลองอีกครั้ง");
			}
		});
	}
});

/*
$(document).on("click", "#savexxx", function(e) {
    var xid = $("#id").val();
    var xparm = $("#parm").val();
    var dtype = $("#dtype").val();
    var xtmpData = $("#tmpData").val().trim();

    if (xtmpData == "") {
        $("#tmpData").addClass("is-invalid");
    } else {
        $.post("update.php", {
            id: xid,
            tid: parseInt(ss_id),
            tmpData: xtmpData,
            parm: xparm,
            mode: xmode,
        }).done(function(data) {
            if (data == "OK") {
                //alert("บันทึกการแก้ไขแล้ว");
                $("#xEdit").modal("toggle");
                if (dtype == "date") {
                    xtmpData = renderDate(xtmpData);
                }
                $(".editing").text(xtmpData).removeClass("editing");
            } else {
                alert("แก้ไขไม่ได้กรุณาลองอีกครั้ง");
            }
        });
    }
});
*/
function reDate(cDate) {
	const mm = [];
	mm["มกราคม"] = "01";
	mm["กุมภาพันธ์"] = "02";
	mm["มีนาคม"] = "03";
	mm["เมษายน"] = "04";
	mm["พฤษภาคม"] = "05";
	mm["มิถุนายน"] = "06";
	mm["กรกฎาคม"] = "07";
	mm["สิงหาคม"] = "08";
	mm["กันยายน"] = "09";
	mm["ตุลาคม"] = "10";
	mm["พฤศจิกายน"] = "11";
	mm["ธันวาคม"] = "12";

	var rDate = cDate.split(" ");
	if (parseInt(rDate[0]) < 10) {
		rDate[0] = "0" + rDate[0];
	}
	var reDate = rDate[2] + "-" + mm[rDate[1]] + "-" + rDate[0];
	return reDate;
}

function renderDate(cDate) {
	const mm = [];
	mm["01"] = "มกราคม";
	mm["02"] = "กุมภาพันธ์";
	mm["03"] = "มีนาคม";
	mm["04"] = "เมษายน";
	mm["05"] = "พฤษภาคม";
	mm["06"] = "มิถุนายน";
	mm["07"] = "กรกฎาคม";
	mm["08"] = "สิงหาคม";
	mm["09"] = "กันยายน";
	mm["10"] = "ตุลาคม";
	mm["11"] = "พฤศจิกายน";
	mm["12"] = "ธันวาคม";
	var rDate = cDate.split("-");
	var reDate = parseInt(rDate[2]) + " " + mm[rDate[1]] + " " + rDate[0];
	console.log(reDate);
	return reDate;
}
