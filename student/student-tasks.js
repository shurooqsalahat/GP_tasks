

$(document).ready(function(){
    function fetch_data()
    {
        $.ajax({
            url:"live_select_task.php",
            method:"POST",
            success:function(data){
                $('#live_data').html(data);
            }
        });
    }

    fetch_data();

    $(document).on('click', '.update_btn', function(){
        console.log("in update");
        $.ajax({
            url:"live_update_solution.php",
            method:"POST",
            success:function(data){
                //$('#live_data').html(data);
            }
        });

    });



});

var validate_solution_url_form= function () {
    var task_url = $('#solution-url').val();

    var vaidate = false;

    $("#error").text('');

    if (task_url.length < 1) {
        $('#solution-url').after('<div class="error">This field is required</div>');
        vaidate =true;
    }


    if (!vaidate){
        document.getElementById("solution_form").submit();
    }
}
var getTaskID=function () {
    var row = $(event.target).closest('tr');
    var id = row.find('td:first').text();
    console.log('',id)
    $('input[id="hidden_id"]').val(id);
}

