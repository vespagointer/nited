$("#tdatest, #tdateen").datepicker({
    format: "yyyy-mm-dd",
    maxViewMode: 2,
    language: "th",
    daysOfWeekHighlighted: "0,6",
    autoclose: true,
    todayHighlight: true,
});

$(document).ready(function() {
    $("#train").hide();
});

$("#add").click(function() {
    $("#train").toggle("slow");
    $("html, body").animate({
            scrollTop: 0,
        },
        "slow"
    );
});

$(document).on("click", ".delt", function(e) {
    //console.log($(this).parent().parent().get( 0 ).tagName);
    var tid = $(this).data("id");
    var ttr = $(this).parent().parent();
    e.preventDefault();
    //alert(tid);
    if (confirm("ต้องการลบรายงาน?") == true) {
        $.get("del.php", { do: "deltrain1", id: tid }).done(function(data) {
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