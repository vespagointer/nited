
$(document).ready(function () {
    $('#studentaward').DataTable({
        pageLength: 25,
        language: {
            url: "../../js/th.json",
        },
    });


    $('#regaward').hide();
    $('#addaward').click(function () {
        $('#regaward').removeClass('d-none');
        $('#regaward').toggle();
    });

    $("#adate").datepicker({
        format: "dd/mm/yyyy",
        maxViewMode: 2,
        language: "th",
        daysOfWeekHighlighted: "0,6",
        autoclose: true,
        todayHighlight: true,
    });
});

$(document).on("click", ".del", function (e) {
    var aid = $(this).data("id");
    var ttr = $(this).parent().parent();
    //alert(tid);
    if (confirm("ต้องการลบรางวัล?") == true) {
        $.get("studentawardDEL.php", { do: "del", id: aid }).done(function (data) {
            if (data == "OK") {
                ttr.hide();
                //console.log(ttr.get(0).tagName);
            } else {
                alert("ลบไม่ได้กรุณาลองอีกครั้ง");
            }
        });
    }
});