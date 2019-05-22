var selectedItem = function (selected) {
    if (selected == 'student_name' || selected == 'task_name') {
        if (selected == 'student_name') {
            $('#assign-new-task-btn').show();
            $('#assign-new-student-btn').hide();
            $('#assign-tasks-table').show();
            $('#assign-students-table').hide();

        } else {
            $('#assign-new-task-btn').hide();
            $('#assign-new-student-btn').show();
            $('#assign-students-table').show();
            $('#assign-tasks-table').hide();
        }

    } else if (selected == 'student_id' || selected == 'task_id') {
        $('#ID').show();
        $('#NAME').hide();
        if (selected == 'student_id') {
            $('#assign-new-task-btn').show();
            $('#assign-new-student-btn').hide();
            $('#assign-tasks-table').show();
            $('#assign-students-table').hide();
        } else {
            $('#assign-new-task-btn').hide();
            $('#assign-new-student-btn').show();
            $('#assign-students-table').show();
            $('#assign-tasks-table').hide();

        }

    }
};

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

        if (search) {
            $("#assign-new-task-btn").show();
        }
        else {
            $("#assign-new-task-btn").hide();
        }

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
            $("#assign-new-task-btn").hide();
        }
        else{
            $("#assign-new-task-btn").show();
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
    $('#assign-new-task-btn').hide();
    var selected = document.getElementById('search-type');
    if (selected.value == 'student_name' || selected.value == 'task_name') {
        $('#NAME').show();
        $('#ID').hide();
        showDataName();

    } else if (selected.value == 'student_id' || selected.value == 'task_id') {
        $('#ID').show();
        $('#NAME').hide();
        //showDataID();

    }

};

var atLeastChooseOneTask = function () {
    var tasks = $('#assigned_tasks').val();
    var validate = false;
    if (tasks.length == 0) {
        $('#assigned_tasks').after('<div class="error">You have to chooose at least one task to assign it </div>');
        validate = true;
    }
    if (!validate) {
        document.getElementById("add_new_task_for_student_form").submit();
    }
};

var atLeastChooseOneStudent = function () {
    var students = $('#students_to_assign_task').val();
    var validate = false;
    if (students.length == 0) {
        $('#students_to_assign_task').after('<div class="error">You have to chooose at least one student to assign this task . </div>');
        validate = true;
    }
    if (!validate) {
        document.getElementById("add_new_task_for_student_form").submit();
    }
};

var showDataName=function () {
    /*    var value = $('#search_name').val();
        if(value !=''){
            $('#assign-new-task-btn').show();
        }
        else{
            $('#assign-new-task-btn').hide();
        }*/


    $("input").keyup(function () {
        console.log('ggg')
        if ($(this).val()) {
            $("#assign-new-task-btn").show();
        }
        else {
            $("#assign-new-task-btn").hide();
        }
    });
    $("#assign-new-task-btn").click(function () {
        $("#search_name").val('');
        $(this).hide();
    });
};

/*var showDataID = function () {
    var value = $('#search_id').val();
    if (value != '') {
        $('#assign-new-task-btn').show();
    } else {
        $('#assign-new-task-btn').hide();
    }

}*/

$("#search_id").keyup(function () {
    console.log('heee')
    if ($(this).val()) {
        $("#assign-new-task-btn").show();
    }
    else {
        $("#assign-new-task-btn").hide();
    }
});
$("#assign-new-task-btn").click(function () {
    $("#search_id").val('');
    $(this).hide();
});

var getData =function () {
    var row = $(event.target).closest('tr');
    var id = row.find('td:first').text();
    var task_name = row.find("td:eq(3)").text();
    var student_name = row.find("td:eq(1)").text();
    var task_id= row.find("td:eq(2)").text();
    console.log(task_id);

    $('input[id="task-name"]').val(task_name);
    $('input[id="student-name"]').val(student_name);
    $('input[id="student_id"]').val(id);
    $('input[id="id_task"]').val(task_id);



}