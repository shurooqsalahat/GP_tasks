$(document).ready(function(){
    $('#MybtnModal').click(function(){
        $('#add_student_modal').modal('show')
    });

});



function form_submit() {
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $('#email').val();
    var doctorName=$('#doctor').val();
    var vaidate = false;

    $(".error").remove();

    if (first_name.length < 1) {
        $('#first_name').after('<div class="error">This field is required</div>');
        vaidate =true;
    }
    if (last_name.length < 1) {
        $('#last_name').after('<div class="error">This field is required</div>');
        vaidate =true;
    }
    if (doctorName== -1) {
        $('#doctor').after('<div class="error">This field is required</div>');
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

    if (!vaidate){
        document.getElementById("add_student_form").submit();
    }

}