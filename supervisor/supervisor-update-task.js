$(document).ready(function(){
    $('#MybtnModal').click(function(){
        $('#add_task_modal').modal('show')
    });

});


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

    $(document).on('click', '.update_btn', function(){

        var id=$(this).data("id");

        update_submit();
        $('#update_task_modal').click(function(){
            console.log('innnnn');
            var form= $('#update_task_form_modal').serialize()
            $.ajax({
                url:"live_update_task.php",
                method:"POST",
                data:{id:id, form:form},
                dataType:"text",
                success:function(data){
                    console.log("in sucsses");
                    alert(data);
                    fetch_data();
                }
            });
        });

    });

});
function form_submit() {
    var task_name = $('#task_name').val();
    var weight = $('#weight').val();
    var estimation_time = $('#estimation_time').val();
    var fileToUpload=$('#fileToUpload').val();
    var requiredFeilds=[];

    var vaidate = false;

   // $("#errorMsg").remove();

    if (weight == "") {
        requiredFeilds.push('Task Weigt')
        vaidate =true;
    }

    if (task_name.length < 1) {
        requiredFeilds.push('Task Name')
        vaidate =true;
    }

    if (estimation_time == "") {
        requiredFeilds.push('Task estimation time')
        vaidate =true;
    }
    if (fileToUpload == "") {
        requiredFeilds.push('task file')
        vaidate =true;
    }


    if (!vaidate){
        document.getElementById("add_task_form").submit();
    }
    else{
        var errorString = "";
        for(var i =0 ;i <requiredFeilds.length;i++){
            errorString += i+1;
            errorString += "-";
            errorString += requiredFeilds[i];
            errorString += "  ";
        }
        errorString+="Required,check feilds before submit";
        $('#errorMsg').text(errorString)
    }

}
function update_submit(){
    var row = $(event.target).closest('tr');
    var id = row.find('td:first').text();
    var task_name = row.find("td:eq(1)").text();
    var weight = row.find("td:eq(2)").text();
    var estimation_time = row.find("td:eq(3)").text();
    var file = row.find("td:eq(4)").text();

    $('input[id="u_task_name"]').val(task_name);
    $('input[id="u_weight"]').val(weight);
    $('input[id="u_estimation_time"]').val(estimation_time);
    $('input[id="u_fileToUpload"]').val(file);


}


function validate_update_form() {
    console.log('gg')
    var task_name = $('#task_name').val();
    var weight = $('#weight').val();
    var estimation_time = $('#estimation_time').val();
    var fileToUpload=$('#fileToUpload').val();
    var requiredFeilds=[];

    var vaidate = false;

    // $("#errorMsg").remove();

    if (weight == "") {
        requiredFeilds.push('Task Weigt')
        vaidate =true;
    }

    if (task_name.length < 1) {
        requiredFeilds.push('Task Name')
        vaidate =true;
    }

    if (estimation_time == "") {
        requiredFeilds.push('Task estimation time')
        vaidate =true;
    }
    if (fileToUpload == "") {
        requiredFeilds.push('task file')
        vaidate =true;
    }


    if (!vaidate){
        document.getElementById("add_task_form").submit();
    }
    else{
        var errorString = "";
        for(var i =0 ;i <requiredFeilds.length;i++){
            errorString += i+1;
            errorString += "-";
            errorString += requiredFeilds[i];
            errorString += "  ";
        }
        errorString+="Required,check feilds before submit";
        $('#updateError').text(errorString)
    }


}

