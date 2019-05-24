<?php
include "../model.php";
include "../connect_DB.php";
session_start();

if (isset($_POST['search_name'])){
    $name = $_POST['search_name'];
}
$row =null;
if(isset($_POST['search_id'])){
    $id= $_POST['search_id'];
}

if (isset($_POST['select'])) {
    $select = $_POST['select'];

    if ($select == 'student_name') {
        $result = getTrainingLikeStudentName($_SESSION['id'],$name);

        $nor = $result->num_rows;
        if ($nor <= 0) {

            return;
        }

        for ($i = 0; $i < $nor; $i++) {
            $row = $result->fetch_array();
            $student =retrieveSudentsByID($row['student_id']);
            $doctor =retrieveDoctorsByID($row['doctor_id']);
            $task = getTaskByName($row['task_name']);
            if ($row['is_delivered']==0){
                $status = "In Progress";
            }
            else{
                $status ="Resolved";

            }
            echo '<tr> <td class="text-left">'.$row['student_id'].'</td>'
                .'<td class="text-left">'.$student['first']." ". $student['last'].'</td>'
                .'<td class="text-left">'.$task['id'].'</td>'
                .'<td class="text-left">'.$row['task_name'].'</td>'
                .'<td class="text-left">'.$row['student_recived'].'</td>'
                .'<td class="text-left">'.$row['student_sent'].'</td>'
                .'<td class="text-left">'.$status.'</td>'
                .'<td class="text-left"><a href="'.$row['solution_link'].'">'.$row['solution_link'].'</a></td>'
                .'<td class="text-left">'.$row['evaluation'].'</td>'


                .'<td>
            <div class="btn-group btn-group-xs">
       <button type="button" class="btn" data-toggle="modal" data-target="#add_score_modal" style="padding: 4px 8px;margin-bottom: 3px;margin-bottom: 4px;" onclick="getData()"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
          <button type="button" class="btn delete_btn" id="test_delete"  style="padding:4px;" data-id3="'.$row[0].'">'.'<span class="fa fa-trash delete-btn" >Delete Task Assignee</span></button>

            </div>
            </td></tr>';


        }

    }

    if ($select == 'student_id') {
        if($id ==null){
            return;
        }
        if (! is_numeric($id)){
           return;
        }

        $row = getTrainingByStudentId($_SESSION['id'],$id);
        if ($row == null){
            return;
        }
        $student =retrieveSudentsByID($row['student_id']);
        $doctor =retrieveDoctorsByID($row['doctor_id']);
        $task = getTaskByName($row['task_name']);
        echo $row[2];
        if ($row['is_delivered']==0){
            $status = "In Progress";
        }
        else{
            $status ="Resolved";

        }

        echo '<tr> <td class="text-left">'.$row['student_id'].'</td>'
            .'<td class="text-left">'.$student['first']." ". $student['last'].'</td>'
            .'<td class="text-left">'.$task['id'].'</td>'
            .'<td class="text-left">'.$row['task_name'].'</td>'
            .'<td class="text-left">'.$row['student_recived'].'</td>'
            .'<td class="text-left">'.$row['student_sent'].'</td>'
            .'<td class="text-left">'.$status.'</td>'
            .'<td class="text-left"><a href="'.$row['solution_link'].'">'.$row['solution_link'].'</a></td>'
            .'<td class="text-left">'.$row['evaluation'].'</td>'


            .'<td>
            <div class="btn-group btn-group-xs">
           <button type="button" class="btn" data-toggle="modal" data-target="#add_score_modal" style="padding: 4px 8px;margin-bottom: 3px;margin-bottom: 4px;" onclick="getData()"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
          <button type="button" class="btn delete_btn" id="test_delete"  style="padding:4px;" data-id3="'.$row[0].'">'.'<span class="fa fa-trash delete-btn" >Delete Task Assignee</span></button>

            </div>
            </td></tr>';

    }

    if ($select == 'task_name') {

        $result = getTrainingLikeTaskName($_SESSION['id'],$name);

        $nor = $result->num_rows;
        if ($nor <= 0) {

            return;
        }

        for ($i = 0; $i < $nor; $i++) {
            $row = $result->fetch_array();
            $student =retrieveSudentsByID($row['student_id']);
            $doctor =retrieveDoctorsByID($row['doctor_id']);
            $task = getTaskByName($row['task_name']);
            echo $row[2];
            if ($row['is_delivered']==0){
                $status = "In Progress";
            }
            else{
                $status ="Resolved";

            }
            echo '<tr> <td class="text-left">'.$row['student_id'].'</td>'
                .'<td class="text-left">'.$student['first']." ". $student['last'].'</td>'
                .'<td class="text-left">'.$task['id'].'</td>'
                .'<td class="text-left">'.$row['task_name'].'</td>'
                .'<td class="text-left">'.$row['student_recived'].'</td>'
                .'<td class="text-left">'.$row['student_sent'].'</td>'
                .'<td class="text-left">'.$status.'</td>'
                .'<td class="text-left"><a href="'.$row['solution_link'].'">'.$row['solution_link'].'</a></td>'
                .'<td class="text-left">'.$row['evaluation'].'</td>'


                .'<td>
            <div class="btn-group btn-group-xs">
        <button type="button" class="btn" data-toggle="modal" data-target="#add_score_modal" style="padding: 4px 8px;margin-bottom: 3px;margin-bottom: 4px;" onclick="getData()"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
          <button type="button" class="btn delete_btn" id="test_delete"  style="padding:4px;" data-id3="'.$row[0].'">'.'<span class="fa fa-trash delete-btn" >Delete Task Assignee</span></button>

            </div>
            </td></tr>';


        }
    }


    if ($select == 'task_id') {
        if($id ==null){
            return;
        }
        if (! is_numeric($id)){
            return;
        }
             $task =getTaskByID($id);
            $row = getTrainingByTaskName($_SESSION['id'],$task['task_name']);
            if ($row == null){
                return;
            }
            $student =retrieveSudentsByID($row['student_id']);
            $doctor =retrieveDoctorsByID($row['doctor_id']);
            $task = getTaskByName($row['task_name']);
            echo $row[2];
        if ($row['is_delivered']==0){
            $status = "In Progress";
        }
        else{
            $status ="Resolved";

        }

        echo '<tr> <td class="text-left">'.$row['student_id'].'</td>'

            .'<td class="text-left">'.$student['first']." ". $student['last'].'</td>'
            .'<td class="text-left">'.$task['id'].'</td>'
            .'<td class="text-left">'.$row['task_name'].'</td>'
            .'<td class="text-left">'.$row['student_recived'].'</td>'
            .'<td class="text-left">'.$row['student_sent'].'</td>'
            .'<td class="text-left">'.$status.'</td>'
            .'<td class="text-left"><a href="'.$row['solution_link'].'"></a>'.$row['solution_link'].'</td>'
            .'<td class="text-left">'.$row['evaluation'].'</td>'


            .'<td>
            <div class="btn-group btn-group-xs">
          <button type="button" class="btn" data-toggle="modal" data-target="#add_score_modal" style="padding: 4px 8px;margin-bottom: 3px;margin-bottom: 4px;" onclick="getData()"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
          <button type="button" class="btn delete_btn" id="test_delete"  style="padding:4px;" data-id3="'.$row[0].'">'.'<span class="fa fa-trash delete-btn" >Delete Task Assignee</span></button>

            </div>
            </td></tr>';

        }


}