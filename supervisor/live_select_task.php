<?php
include('../model.php');

echo '<table id="students_table" class="table-users" cellspacing="0" width="100%">' .
    '<tr>' . '<th>Task ID</th>' .
    '<th>Task Name</th>' .
    '<th>Task Weigt</th>' .
    '<th>Estimation Time</th>' .
    '<th>File</th>' .
    '<th style="text-align:center;width:100px;" >' .

    '</th>' .
    '</th>' .
    '</tr>' .

    '<tbody>';
$result = getAllStudents();
$nor = $result->num_rows;
if ($nor<= 0){
    return;
}
$count =1;
for ($i = 0; $i < $nor; $i++) {
    $row = $result->fetch_array();

    echo ' <tr onclick="update_submit(this)">'.
        '<td>'.$row[0].'</td>'.
        '<td>'.$row['2'].'</td>'.
        '<td>'. $row[3].'</td>'.
        '<td>'.$row[4].'</td>'.
         '<td>'.$row[1].'</td>'.
         '<td>'.
            '<button style="margin-right: 6px;border-radius: 15px;" data-toggle="modal" data-target="#update_task_modal" type="button" class="btn btn-primary btn-sm dt-edit update_btn" id="update-modal-btn" data-id="'.$row[0].'">'.
                '<span class="glyphicon glyphicon-pencil " aria-hidden="true" ></span>'.
            '</button>'.
            '<button type="button" class="btn btn-danger btn-sm dt-delete delete_btn" atyle="border-radius: 15px;"data-id3="'.$row[0].'">'.
                '<span class="glyphicon glyphicon-remove " aria-hidden="true" ></span>'.
             '</button>'.
        '</td>'.
            '</tr>';
}
?>
</tbody>
</table>



