<?php
include('../model.php');
session_start();

echo '<table id="students_table" class="table-users" cellspacing="0" width="100%">' .

    '<th>Task Name</th>' .
    '<th>Task Weigt</th>' .
    '<th>Estimation Time</th>' .
    '<th>Description </th>'.
    '<th>evaluation </th>'.
    '<th>Received Date </th>'.
    '<th>Sent Date </th>'.
    '<th>Feed Back </th>'.
    //'<th>Solution Link </th>'.

    '<th style="text-align:center;width:100px;" >' .

    '</th>' .
    '</th>' .
    '</tr>' .

    '<tbody>';
$result = getStudentTasks($_SESSION['id']);
$nor = $result->num_rows;
if ($nor<= 0){
    return;
}
$count =1;
for ($i = 0; $i < $nor; $i++) {
    $row = $result->fetch_array();
    $task =getTaskByName($row['task_name']);
    $PATH="../".$task[5];

    echo ' <tr >'.
        '<td hidden>'.$row['id'].'</td>'.
        '<td><a download="tasks" href="'.$PATH.'">'.$task['task_name'].'</a></td>'.
        '<td>'. $task['weight'].'</td>'.
        '<td>'.$task['estimation_time'].'</td>'.
         '<td>'.$task['description'].'</td>'.
        '<td>'.$row['evaluation'].'</td>'.
        '<td>'.$row['student_recived'].'</td>'.
        '<td>'.$row['student_sent'].'</td>'.
        '<td>'.$row['feed_back'].'</td>'.
      //  '<td>'.$row['solution_link'].'</td>'.
         '<td>'.
            '<button style="margin-right: 6px; border-radius: 15px;" data-toggle="modal" data-target="#solution_modal" type="button"
             class="btn btn-primary btn-sm dt-edit update_btn" id="update-modal-btn" data-id="'.$row[0].'">'.
                '<span class="glyphicon glyphicon-pencil " aria-hidden="true" >upload task solution</span>'.
            '</button>'.
        '</td>'.
            '</tr>';
}

?>
</tbody>
</table>



