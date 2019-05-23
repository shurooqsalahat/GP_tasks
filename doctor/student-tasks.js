

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
    $(document).on('click', '.delete_btn', function(){
        console.log('in delete');
        var id=$(this).data("id3");
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"live_delete_task.php",
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


