$("#adate").datepicker({
    format: "yyyy-mm-dd",
    maxViewMode: 2,
    language: "th",
    daysOfWeekHighlighted: "0,6",
    autoclose: true,
    todayHighlight: true,
});

$(document).ready(function() {
    $("#addAward").hide();
});

$("#add").click(function() {
    $("#addAward").toggle("slow");
    $("html, body").animate({
            scrollTop: 0,
        },
        "slow"
    );
});

$(document).on("click", ".dela", function(e) {
    //console.log($(this).parent().parent().get( 0 ).tagName);
    var aid = $(this).data("id");
    var ado = $(this).data("type");
    var ttr = $(this).parent().parent();
    e.preventDefault();
    if (confirm("ต้องการลบรางวัล?") == true) {
        $.get("del.php", { do: ado, id: aid }).done(function(data) {
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