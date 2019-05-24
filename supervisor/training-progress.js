
$(document).ready(function () {

    $('#search_id').on('input', function (e) {
        console.log('in search id');
        var search = $('#search_id').val();
        if (search==''){
            $.ajax({
                type: 'POST',
                url: 'live_training_fetch_all.php',
                dataType: "text",
                success: function (data) {
                    $('#live_data_progress').html(data);
                }
            });
        }
        var select = $('#search-type').val();



        //alert('Select field value has changed to' + $('#search_id').val());

        $.ajax({
            type: 'POST',
            url: 'live_training_progress.php',
            data: {search_id: search, select: select},
            dataType: "text",
            success: function (data) {
                //alert(data)
                $('#live_data_progress').html(data);
            }
        });
    });
});


$(document).ready(function () {
    $(document).on('click', '.delete_btn', function(){
        console.log('in delete');
        var id=$(this).data("id3");
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"live_delete_training_progress.php",
                method:"POST",
                data:{id:id},
                dataType:"text",
                success:function(data){
                    alert(data);
                    $.ajax({
                        type: 'POST',
                        url: 'live_training_fetch_all.php',
                        dataType: "text",
                        success: function (data) {
                            $('#live_data_progress').html(data);
                        }
                    });

                }
            });
        }

    });

    $.ajax({
        type: 'POST',
        url: 'live_training_fetch_all.php',
        dataType: "text",
        success: function (data) {
            $('#live_data_progress').html(data);
        }
    });

    $('#search_name').on('input', function (e) {
        //console.log('in search name');

        var search = $('#search_name').val();
        if (search==''){
            $.ajax({
                type: 'POST',
                url: 'live_training_fetch_all.php',
                dataType: "text",
                success: function (data) {
                    $('#live_data_progress').html(data);
                }
            });

        }


        var select = $('#search-type').val();
        $.ajax({
            type: 'POST',
            url: 'live_training_progress.php',
            data: {search_name: search, select: select},
            dataType: "text",
            success: function (data) {
                //alert(data);
                $('#live_data_progress').html(data);
            }
        });
    });
});


// var delete_bt = function () {
//
//     console.log('in delete');
//     var id =$('#test_delete').data('id3');
//     console.log(id);
//     if (confirm("Are you sure you want to delete this?")) {
//         $.ajax({
//             url: "live_delete_training_progress.php",
//             method: "POST",
//             data: {id: id},
//             dataType: "text",
//             success: function (data) {
//                 alert(data);
//
//             }
//         });
//     }
//
//
// }

var changeLabel = function () {

    var selected = document.getElementById('search-type');
    if (selected.value == 'student_name' || selected.value == 'task_name') {
        $('#NAME').show();
        $('#ID').hide();


    } else if (selected.value == 'student_id' || selected.value == 'task_id') {
        $('#ID').show();
        $('#NAME').hide();
        //showDataID();

    }

};



var atLeastChooseOneStudent = function () {
    var students = $('#students_to_assign_task').val();
    var tasks = $('#assigned_tasks').val();
    var validate = false;
    $(".error").remove();
    if (students.length == 0 ) {
        $('#students_to_assign_task').after('<div class="error">You have to chooose at least one student to assign this task . </div>');
        validate = true;
    }
    if (tasks.length == 0) {
        $('#assigned_tasks').after('<div class="error">You have to chooose at least one task to assign it </div>');
        validate = true;
    }
    if (!validate) {
        document.getElementById("add_new_task_for_student_form").submit();
    }
};



/*var showDataID = function () {
    var value = $('#search_id').val();
    if (value != '') {
        $('#assign-new-task-btn').show();
    } else {
        $('#assign-new-task-btn').hide();
    }

}*/





var getData =function () {
    var row = $(event.target).closest('tr');
    var id = row.find('td:first').text();
    var task_name = row.find("td:eq(3)").text();
    var student_name = row.find("td:eq(1)").text();
    var task_id= row.find("td:eq(2)").text();
    var evaluation=row.find("td:eq(8)").text();
   console.log(evaluation)
    $('input[id="task-name"]').val(task_name);
    $('input[id="student-name"]').val(student_name);
    $('input[id="student_id"]').val(id);
    $('input[id="id_task"]').val(task_id);
    if(evaluation){
        $('input[id="task-score"]').val(evaluation);
    }

};
var validate_task_eval_form =function () {
    console.log('fff')
    var score = $('#task-score').val();

    var vaidate = false;


    $(".error").remove();

    if (!score) {
        $('#task-score').after('<div class="error" style="color:red">This field is required</div>');
        vaidate =true;
    }



    if (!vaidate){
        document.getElementById("task_eval").submit();
    }
}