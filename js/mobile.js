$(document).on('change click', '#key1', function(e) {
    var skey1 = $(this).val();
    $('#key2').empty().load("mdb.php?key1="+skey1);
    $('#key3').empty();
    $('#tel').empty();
});

$(document).on('change click', '#key2', function(e) {
    var skey2 = $(this).val();
    $('#key3').empty().load("mdb.php?key2="+skey2);
    $('#tel').empty();
});

$(document).on('change click', '#key3', function(e) {
    var skey3 = $(this).val();
    $('#tel').empty().load("mdb.php?key3="+skey3);
});


$(document).on('click', '#search', function(e) {
    var skey = $('#key').val();
    $('#tellist').empty().load("mdb.php?key="+skey);
});

$(document).on('click', '#key', function(e) {
    $('#tellist').empty();
});

