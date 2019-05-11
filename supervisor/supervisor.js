$(document).ready(function(){
    $('#MybtnModal').click(function(){
        $('#add_student_modal').modal('show')
    });
    $('#update-modal-btn').click(function(){
        console.log("in update modal");
        $('#update_student_modal').modal('show')
    });

});

$(document).ready(function(){
    console.log('first')
    function fetch_data()
    {
        console.log('second')
        $.ajax({
            url:"live_select.php",
            method:"POST",
            success:function(data){
                console.log("shuroooq")
                $('#live_data').html(data);
            }
        });
    }

    fetch_data();
    $(document).on('click', '.delete_btn', function(){
        var id=$(this).data("id3");
        console.log(id);
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"live_delete.php",
                method:"POST",
                data:{id:id},
                dataType:"text",
                success:function(data){
                    alert(data);
                    fetch_data();
                }
            });
        }
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