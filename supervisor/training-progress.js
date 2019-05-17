var selectedItem = function () {
    var selected = document.getElementById('search-type');
    if (selected.value == 'student_name'|| selected.value == 'task_name') {
        $('#NAME').show();
        $('#ID').hide();
        if(selected.value == 'student_name'){
            $('#assign-new-task-btn').show() ;
            $('#assign-new-student-btn').hide() ;
            $('#assign-tasks-table').show() ;
            $('#assign-students-table').hide() ;

        }
        else{
            $('#assign-new-task-btn').hide() ;
            $('#assign-new-student-btn').show() ;
            $('#assign-students-table').show() ;
            $('#assign-tasks-table').hide() ;
        }

    }
    else if (selected.value == 'student_id' || selected.value == 'task_id') {
        $('#ID').show();
        $('#NAME').hide();
        if(selected.value == 'student_id'){
            $('#assign-new-task-btn').show() ;
            $('#assign-new-student-btn').hide() ;
            $('#assign-tasks-table').show() ;
            $('#assign-students-table').hide() ;
        }
        else{
            $('#assign-new-task-btn').hide() ;
            $('#assign-new-student-btn').show() ;
            $('#assign-students-table').show() ;
            $('#assign-tasks-table').hide() ;

        }

    }
}