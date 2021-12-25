$("#SchoolName").on('change keyup paste', function() {
    var text = $("#SchoolName").val();
    var lines = text.split("\n");
    var count = lines.length;
    $("#nCount").empty().html("ข้อมูลจำนวน " + count + " บรรทัด");
});

$("#ckschool").submit(function(event) {

    // Stop form from submitting normally
    event.preventDefault();

    // Get some values from elements on the page:
    var $form = $(this),
        term1 = $form.find('textarea#SchoolName').val(),
        term2 = $form.find("input[name='nOrder']:checked").val(),
        url = $form.attr("action");

    // Send the data using post
    var posting = $.post(url, {
        school: term1,
        nOrder: term2
    });

    // Put the results in a div
    posting.done(function(data) {
        $("#scmiss").empty().html(data);

    });
});