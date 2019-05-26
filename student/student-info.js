$(document).ready(function() {
    $('#first_name').attr('disabled', 'disabled');
    $('#last_name').attr('disabled', 'disabled');
    $('#phone').attr('disabled', 'disabled');
    $('#email').attr('disabled', 'disabled');
    $('#save-changes-btn').attr('disabled',true);

});

var updateField = function (field) {
    var changes=false;
    if(field == 'first_name'){
            $('#first_name').removeAttr('disabled');
            $('#first-name-btn').css('display', 'none');
        changes=true;
    }
    if(field == 'last_name'){
        $('#last_name').removeAttr('disabled');
        $('#last-name-btn').css('display', 'none');
        changes=true;
    }
    if(field == 'phone'){
        $('#phone').removeAttr('disabled');
        $('#phone-btn').css('display', 'none');
        changes=true;
    }
    if(field == 'email'){
        $('#email').removeAttr('disabled');
        $('#email-btn').css('display', 'none');
        changes=true;
    }
    if(changes){
        $('#save-changes-btn').removeAttr('disabled');
    }
};
$(document).on('click', '.get-doc-btn', function(){
    var id =$(this).data("id");
    window.location.href = "doctor-information.php?doc_id="+id;

});

$(document).on('click', '.get-sup-btn', function(){
    var id =$(this).data("id2");
    window.location.href = "supervisor-information.php?sup_id="+id;

});