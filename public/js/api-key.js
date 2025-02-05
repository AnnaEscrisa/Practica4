$(function () {
    var user_id = $('#user-id').html();

    if (user_id == '') {
        $('#generar').hide()
    } else {
        $.ajax({
            url: 'api/key?id=' + user_id,
            type: 'GET',
            success: function (response) {
                
                showResponse(response);
            },
        });
    }

    function generateKey() {
        $.ajax({
            url: 'api/key?id=' + user_id,
            type: 'POST',
            success: function (response) {
                showResponse(response);
            },
        });
    }

    function showResponse(response) {
        $('#clau').show();
        var { data } = JSON.parse(response);
        var { apikey, expiracio } = data;
        expiracio = (new Date(expiracio)).toLocaleDateString('ca-ES', { year: "numeric", month: "long", day: "numeric" });
        $('#user-key').html(apikey);
        $('#caducitat').html(expiracio);
    }

    $('#generar').click(function () {
        generateKey();
    });
});