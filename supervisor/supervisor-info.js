$(document).ready(function() {
    $('#first_name').attr('disabled', 'disabled');
    $('#last_name').attr('disabled', 'disabled');
    $('#phone').attr('disabled', 'disabled');
    $('#email').attr('disabled', 'disabled');

});

var updateField = function (field) {
    if(field == 'first_name'){
            $('#first_name').removeAttr('disabled');
    }
    if(field == 'last_name'){
        $('#last_name').removeAttr('disabled');
    }
    if(field == 'phone'){
        $('#phone').removeAttr('disabled');
    }
    if(field == 'email'){
        $('#email').removeAttr('disabled');
    }
};
var cancel = function () {
    $('#first_name').attr('disabled', 'disabled');
    $('#last_name').attr('disabled', 'disabled');
    $('#phone').attr('disabled', 'disabled');
    $('#email').attr('disabled', 'disabled');
};