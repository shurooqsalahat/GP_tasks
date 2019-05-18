var selectedItem = function (selected) {
    if (selected == 'student_name'|| selected == 'task_name') {
        if(selected == 'student_name'){
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

    else if (selected == 'student_id' || selected == 'task_id') {
        $('#ID').show();
        $('#NAME').hide();
        if(selected == 'student_id'){
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
};

var validate_search_btn = function () {
     var Type = $('#search-type').val();
     var name = $('#search_name').val();
     var id = $('#search_id').val();

     var vaidate = false;

     $(".error").remove();

     if (name.length < 1 && (Type =='student_name' ||Type=='task_name' )) {
         $('#search_name').after('<div class="error">This field is required</div>');
         vaidate =true;
     }
     if (id.length < 1 && (Type =='student_id' ||Type=='task_id' )) {
         $('#search_id').after('<div class="error">This field is required</div>');
         vaidate =true;
     }
     if (Type == '') {
         $('#search-type').after('<div class="error">This field is required</div>');
         vaidate =true;

     }


     if (!vaidate){
        // document.getElementById("search_form").submit();
         selectedItem(Type);
     }
 }

var changeLabel = function () {
    $('#assign-students-table').hide() ;
    $('#assign-tasks-table').hide() ;
    $('#assign-new-task-btn').hide() ;
    $('#assign-new-student-btn').hide() ;
    var selected = document.getElementById('search-type');
    if (selected.value == 'student_name'|| selected.value == 'task_name') {
        $('#NAME').show();
        $('#ID').hide();

    }
    else if (selected.value == 'student_id' || selected.value == 'task_id') {
        $('#ID').show();
        $('#NAME').hide();

    }
};

var atLeastChooseOneTask =function () {
    var tasks = $('#assigned_tasks').val();
    var validate=false;
    if(tasks.length == 0){
        $('#assigned_tasks').after('<div class="error">You have to chooose at least one task to assign it </div>');
        validate =true;
    }
    if (!validate){
        document.getElementById("add_new_task_for_student_form").submit();
    }
};

var atLeastChooseOneStudent =function () {
    var students = $('#students_to_assign_task').val();
    var validate=false;
    if(students.length == 0){
        $('#students_to_assign_task').after('<div class="error">You have to chooose at least one student to assign this task . </div>');
        validate =true;
    }
    if (!validate){
        document.getElementById("add_new_task_for_student_form").submit();
    }
};