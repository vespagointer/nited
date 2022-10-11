$("#navlink").dataTable({
    order: [[0, "asc"]],
    pageLength: 25,
    language: {
        url: "../js/th.json",
    },
});

$(document).on("click", ".del", function (e) {
    var aid = $(this).data("id");
    var ttr = $(this).parent().parent();
    e.preventDefault();
    if (confirm("ต้องการลบเมนู?") == true) {
        $.get("del.php", { mode: 'navlink', id: aid }).done(function (data) {
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