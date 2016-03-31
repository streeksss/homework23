
jQuery(document).ready(function($) {
    $("#sendletter").submit(function () {
        var author = $('#author').val();
        var email = $('#email').val();
        var message = $('#message').val();
        var data = {
            'action': 'sendletter',
            'nonce': ajax_object.nonce,
            'author': author,
            'email': email,
            'message': message
        };


        jQuery.post(ajax_object.ajax_url, data, function (response) {
            alert('Got this from the server: ' + response);
            $('#author').val('');
            $('#email').val('');
            $('#message').val('');
        });
    });
});
