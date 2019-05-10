$(document).ready(function(){
    $('#MybtnModal').click(function(){
        $('#add_student_modal').modal('show')
    });
    $('#update-modal-btn').click(function(){
        $('#update_student_modal').modal('show')
    });
});



function form_submit() {
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $('#email').val();
    var doctorName=$('#doctor').val();
    var phoneNumber = $('#phone').val();
    var vaidate = false;

    $(".error").remove();

    if (first_name.length < 1) {
        $('#u_first_name').after('<div class="error">This field is required</div>');
        vaidate =true;
    }
    if (last_name.length < 1) {
        $('#u_last_name').after('<div class="error">This field is required</div>');
        vaidate =true;
    }
    if (doctorName== 0) {
        $('#u_doctor').after('<div class="error">This field is required</div>');
        vaidate =true;

    }
     if (email.length < 1) {
        $('#email').after('<div class="error">This field is required</div>');
    } else {

         var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var validEmail = regEx.test(email);
        if (!validEmail) {
            $('#email').after('<div class="error">Enter a valid email</div>');
        }
    }
    if (phoneNumber.length < 1) {
        
        $('#u_phone').after('<div class="error">This field is required</div>');
    }
    else {

        var regex = /^\+(?:[0-9] ?){6,14}[0-9]$/;
        var validPhone = regex.test(phoneNumber);
        if (!validPhone) {
            $('#phone').after('<div class="error">Enter a valid phone number</div>');
        }
    }

    if (!vaidate){
        document.getElementById("add_student_form").submit();
    }

}
function update_submit() {
    var first_name = $('#u_first_name').val();
    console.log(first_name)
    var last_name = $('#u_last_name').val();
    var email = $('#u_email').val();
    var doctorName=$('#u_doctor').val();
    var phoneNumber = $('#u_phone').val();
    var vaidate = false;

    $(".error").remove();

    if (first_name.length < 1) {
        $('#u_first_name').after('<div class="error">This field is required</div>');
        vaidate =true;
    }
    if (last_name.length < 1) {
        $('#u_last_name').after('<div class="error">This field is required</div>');
        vaidate =true;
    }
    if (doctorName== 0) {
        $('#u_doctor').after('<div class="error">This field is required</div>');
        vaidate =true;

    }
    if (email.length < 1) {
        $('#email').after('<div class="error">This field is required</div>');
    } else {

        var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var validEmail = regEx.test(email);
        if (!validEmail) {
            $('#email').after('<div class="error">Enter a valid email</div>');
        }
    }
    if (phoneNumber.length < 1) {

        $('#u_phone').after('<div class="error">This field is required</div>');
    }
    else {

        var regex = /^\+(?:[0-9] ?){6,14}[0-9]$/;
        var validPhone = regex.test(phoneNumber);
        if (!validPhone) {
            $('#phone').after('<div class="error">Enter a valid phone number</div>');
        }
    }

    if (!vaidate){
        document.getElementById("update_student_modal").submit();
    }

}