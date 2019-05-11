<?php
include('../model.php');


echo '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">' .
    '<thead>' . '<tr>' . '<th>Student ID</th>' .
    '<th>Name</th>' .
    '<th>Email</th>' .
    '<th>Phone</th>' .
    '<th>Doctor</th>' .
    '<th style="text-align:center;width:100px;" >' .

    '</th>' .
    '</th>' .
    '</tr>' .
    '</thead>' .
    '<tbody>';
$result = getAllStudents();
$nor = $result->num_rows;
if ($nor<= 0){
    return;
}
$count =1;
for ($i = 0; $i < $nor; $i++) {
    $row = $result->fetch_array();
    $doc= retrieveDoctorsByID($row['doctor_id']);
    echo ' <tr>'.
        '<td>'.$row[0].'</td>'.
        '<td>'.$row['2'].' '. $row[3].'</td>'.
        '<td>'.$row[4].'</td>'.
         '<td>'.$row[1].'</td>'.
        '<td>'.$doc["first"].' '. $doc["last"].'</td>'.
         '<td>'.
            '<button  data-toggle="modal" data-target="#update_student_modal" type="button" class="btn btn-primary btn-xs dt-edit update_btn" id="update-modal-btn" data-id="'.$row[0].'">'.
                '<span class="glyphicon glyphicon-pencil" aria-hidden="true" data-id2="'.$row[0].'"></span>'.
            '</button>'.
            '<button type="button" class="btn btn-danger btn-xs dt-delete">'.
                '<span class="glyphicon glyphicon-remove delete_btn" aria-hidden="true" data-id3="'.$row[0].'"></span>'.
             '</button>'.
        '</td>'.
            '</tr>';
}
?>
</tbody>
</table>



