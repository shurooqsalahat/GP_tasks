<?php
include('../model.php');
session_start();

echo '<table id="students_table" class="table-users" cellspacing="0" width="100%">' .
  '<tr>' . '<th>Student ID</th>' .
    '<th>First Name</th>' .
    '<th>Last Name</th>' .
    '<th>Supervisor Name</th>' .
    '<th>Email</th>' .
    '<th>Phone</th>' .

    '<th style="text-align:center;width:100px;" >' .

    '</th>' .
    '</th>' .
    '</tr>' .
    '</thead>' .
    '<tbody>';
$result = getDoctorStudents($_SESSION['id']);
$nor = $result->num_rows;
if ($nor<= 0){
    return;
}
$count =1;
for ($i = 0; $i < $nor; $i++) {
    $row = $result->fetch_array();
    $sup =retrieveSupervisorByID($row['supervisor_id']);
    echo ' <tr onclick="update_submit(this)">'.
        '<td>'.$row[0].'</td>'.
        '<td>'.$row['2'].'</td>'.
        '<td>'. $row[3].'</td>'.
        '<td> <a class="get-sup-data" data-id="'.$sup['id'].'">'. $sup['first']." ".$sup['last'].'</a></td>'.
        '<td>'.$row[4].'</td>'.
         '<td>'.$row[1].'</td>'.
         '<td>'.

            '<button type="button" style="border-radius: 15px;" class="btn btn-danger btn-sm dt-delete get-btn" onclick="redirectTo(\'student-tasks.php\')" data-id3="'.$row[0].'">'.
                '<i class="fa fa-info-circle">&nbsp;See all student tasks</i>'.
             '</button>'.
        '</td>'.
            '</tr>';
}
?>
</tbody>
</table>



