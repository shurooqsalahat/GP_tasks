<?php
include('../model.php');
session_start();

echo '<table id="students_table" class="table-users" cellspacing="0" width="100%">' .
    '<tr>' . '<th>Task ID</th>' .
    '<th>Task Name</th>' .
    '<th>Task Weigt</th>' .
    '<th>Estimation Time</th>' .
    '<th>Description </th>'.
    '<th>evaluation </th>'.
    '<th>delivery on </th>'.


    '</th>' .
    '</th>' .
    '</tr>' .

    '<tbody>';
$result = getStudentTasks($_SESSION['std_id']);
$nor = $result->num_rows;
if ($nor<= 0){
    return;
}
$count =1;
for ($i = 0; $i < $nor; $i++) {
    $row = $result->fetch_array();
     $PATH="../".$row[5];

    echo ' <tr onclick="update_submit(this)">'.
        '<td>'.$row[0].'</td>'.
        '<td><a download="tasks" href="'.$PATH.'">'.$row[1].'</a></td>'.
        '<td>'. $row[2].'</td>'.
        '<td>'.$row[4].'</td>'.
         '<td>'.$row[3].'</td>'.
        '<td>'.$row[3].'</td>'.
        '<td>'.$row[3].'</td>'.

            '</tr>';
}

?>
</tbody>
</table>



