var myFunction = function () {
    document.getElementById("myDropdown").classList.toggle("show");
}


// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("user-account-dropdown");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

$(document).ready(function(){
    $(".close").click(function(){
        if($(".alert-warning").is(":visible")){
            $(".alert-warning").hide();}
        else if((".alert-success").is(":visible")){
            $(".alert-success").hide();
        }
    });
});

$(document).ready(function() {

    $('#add_student_form').submit(function(e) {
        e.preventDefault();
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var doctorName=$('#doctor').val();

        var password = $('#password').val();

        $(".error").remove();

        if (first_name.length < 1) {
            $('#first_name').after('<div class="error">This field is required</div>');
        }
        if (last_name.length < 1) {
            $('#last_name').after('<div class="error">This field is required</div>');
        }
        if (doctorName== -1) {
            $('#doctor').after('<div class="error">This field is required</div>');
        }
        if (email.length < 1) {
            $('#email').after('<div class="error">This field is required</div>');
        } else {
            var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
            var validEmail = regEx.test(email);
            if (!validEmail) {
                $('#email').after('<div class="error">Enter a valid email</div>');
            }
        }
        if (password.length < 8) {
            $('#password').after('<div class="error">Password must be at least 8 characters long</div>');
        }
    });

});

var showDoctorDetails = function (doctorName) {
    if(doctorName && doctorName != -1){
        document.getElementById("doctorInformationTable").style.display = "block";
    }
    else{
        document.getElementById("doctorInformationTable").style.display = "none";
    }

};