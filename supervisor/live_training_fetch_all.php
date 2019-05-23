<?php
include "../connect_DB.php";
include "../model.php";

$result = getAllTaskStudent();
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

    echo '<tr> <td class="text-left">'.$row[1].'</td>'
            .'<td class="text-left">'.$student['first']." ". $student['last'].'</td>'
            .'<td class="text-left">'.$task['id'].'</td>'
            .'<td class="text-left">'.$row['task_name'].'</td>'
            .'<td class="text-left">'.$row['student_recived'].'</td>'
            .'<td class="text-left">'.$row['student_sent'].'</td>'
            .'<td class="text-left">'.$status.'</td>'
            .'<td class="text-left"><a href="'.$row['solution_link'].'">'.$row['solution_link'].'</a></td>'
            .'<td class="text-left">'.$row['evaluation'].'</td>'


            .'<td>
           
            <button type="button" class="btn"   data-toggle="modal" data-target="#add_score_modal"  style="padding: 14px;margin-bottom: 6px" onclick="getData()"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
          <button type="button" class="btn delete_btn" id="test_delete"  style="padding:14px 10px;" data-id3="'.$row[0].'">'.'<span class="fa fa-trash delete-btn" >Delete Task Assignee</span></button>

          
            </td></tr>';


}