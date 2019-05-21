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
    $task = getTaskByName($row[2]);
    echo $row[2];

    echo '<tr> <td class="text-left">'.$row[1].'</td>'
            .'<td class="text-left">'.$student['first']." ". $student['last'].'</td>'
            .'<td class="text-left">'.$task['id'].'</td>'
            .'<td class="text-left">'.$row[2].'</td>'
            .'<td class="text-left">'.$row['student_recived'].'</td>'
            .'<td class="text-left">'.$row['student_sent'].'</td>'
            .'<td class="text-left">'.$row['is_delivered'].'</td>'
            .'<td class="text-left">'.$row['solution_link'].'</td>'
            .'<td class="text-left">'.$row['evaluation'].'</td>'


            .'<td>
            <div class="btn-group btn-group-xs">
            <button type="button" class="btn" data-id=\'2\'  data-toggle="modal" data-target="#add_score_modal"  style="padding: 10px;"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
            </div>
            </td></tr>';


}