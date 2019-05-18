$(document).ready(function(){
    $('#MybtnModal').click(function(){
        $('#add_student_modal').modal('show')
    });

});


$(document).ready(function(){
    function fetch_data()
    {
        $.ajax({
            url:"live_select.php",
            method:"POST",
            success:function(data){
                $('#live_data').html(data);
            }
        });
    }

    fetch_data();
    $(document).on('click', '.delete_btn', function(){
        console.log('in delete');
        var id=$(this).data("id3");
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

    // $(document).on('click', '.update_btn', function(){
    //     var id=$(this).data("id");
    //
    //     update_submit();
    //     $('#submit_update_modal').click(function(){
    //         console.log('innnnn');
    //         var form= $('#update_student_form_modal').serialize()
    //         $.ajax({
    //             url:"live_update.php",
    //             method:"POST",
    //             data:{id:id, form:form},
    //             dataType:"text",
    //             success:function(data){
    //                 console.log("in sucsses");
    //                 //alert(data);
    //                 fetch_data();
    //             }
    //         });
    //     });
    //
    // });

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
        $('#first_name').after('<div class="error">This field is required</div>');
        vaidate =true;
    }
    if (last_name.length < 1) {
        $('#last_name').after('<div class="error">This field is required</div>');
        vaidate =true;
    }
    if (doctorName== 0) {
        $('#doctor').after('<div class="error">This field is required</div>');
        vaidate =true;

    }
     if (email.length < 1) {
        $('#email').after('<div class="error">This field is required</div>');
         vaidate =true;
    } else {

         var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var validEmail = regEx.test(email);
        if (!validEmail) {
            $('#email').after('<div class="error">Enter a valid email</div>');
            vaidate =true;
        }
    }
    if (phoneNumber.length < 1) {
        
        $('#phone').after('<div class="error">This field is required</div>');
        vaidate =true;
    }


    if (!vaidate){
        document.getElementById("add_student_form").submit();
    }

}
function update_submit(){
    var row = $(event.target).closest('tr');
    var id = row.find('td:first').text();
    var first_name = row.find("td:eq(1)").text();
    var last_name = row.find("td:eq(2)").text();
    var email = row.find("td:eq(3)").text();
    var phone = row.find("td:eq(4)").text();
    var doctor= row.find("td:eq(5)").text();

    $('input[id="u_first_name"]').val(first_name);
    $('input[id="u_last_name"]').val(last_name);
    $('input[id="u_email"]').val(email);
    $('input[id="u_phone"]').val(phone);
    $('input[id="u_doctor"]').val(doctor);
    $('input[id="u_id"]').val(id);


    var optionTexts=[];
    $('#u_doctor option').each(function() {
        optionTexts.push({value :$(this).val(),text:$(this).text()});
    });

    var i;
    for (i = 0; i < optionTexts.length; i++) {
       if(optionTexts[i].text == doctor ){
           $("#u_doctor").val(optionTexts[i].value);
       }
    }


}


function validate_update_form() {
    var first_name = $('#u_first_name').val();
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
        $('#u_email').after('<div class="error">This field is required</div>');
        vaidate =true;
    } else {

        var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var validEmail = regEx.test(email);
        if (!validEmail) {
            $('#u_email').after('<div class="error">Enter a valid email</div>');
            vaidate =true;
        }
    }
    if (phoneNumber.length < 1) {

        $('#u_phone').after('<div class="error">This field is required</div>');
        vaidate =true;
    }


    if (!vaidate){
        document.getElementById("update_student_form_modal").submit();
    }

}

