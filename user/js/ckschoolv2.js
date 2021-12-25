$("#ckschool").submit(function(event) {

    // Stop form from submitting normally
    event.preventDefault();

    var schooln = [];

    $('input[id="SchoolName"]:checked').each(function() {
        schooln.push(this.value);
    });
    // Get some values from elements on the page:
    var $form = $(this),
        term1 = $form.find("input[name='v']").val(),
        term2 = $form.find("input[name='nOrder']:checked").val(),
        url = $form.attr("action");

    // Send the data using post
    var posting = $.post(url, {
        school: schooln,
        nOrder: term2,
        v: term1
    });

    // Put the results in a div
    posting.done(function(data) {
        $("#scmiss").empty().html(data);

    });
});