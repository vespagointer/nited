$(".chosen-select").chosen();
$("#ckAll").click(function (e) {
    if ($(this).is(":checked")) {
        $('#school option').prop('selected', true).trigger("chosen:updated");;
    } else {
        $('#school option').prop('selected', false).trigger("chosen:updated");;
    }
});

$("#weblist").dataTable({
    order: [[0, "desc"]],
    pageLength: 25,
    language: {
        url: "../js/th.json",
    },
});

$(document).on("click", ".del", function (e) {
    var aid = $(this).data("id");
    var ttr = $(this).parent().parent();
    e.preventDefault();
    if (confirm("ต้องการลบกลุ่ม?") == true) {
        $.get("del.php", { mode: 'group', id: aid }).done(function (data) {
            //console.log(data);
            if (data == "OK") {
                ttr.hide();
                //console.log(ttr.get(0).tagName);
            } else {
                alert("ลบไม่ได้กรุณาลองอีกครั้ง");
            }
        });
    }
});