

$(".chosen-select").chosen();
$("#ckAll").click(function(e) {
    if ($(this).is(":checked")) {
        $('#school option').prop('selected', true).trigger("chosen:updated");;
    } else {
        $('#school option').prop('selected', false).trigger("chosen:updated");;
    }
});
$("#save").click(function(e) {
    var data = $('select#school').val();
    console.log(data);
});