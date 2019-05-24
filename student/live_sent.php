<?php
include "../connect_DB.php";
include "../model.php";
session_start();
$result =getSentMails($_SESSION['email']);

$nor = $result->num_rows;
if ($nor <=0){
    echo' <li><span class="label label-danger">No Messages</span> </li>';

}
else {
    for ($i = 0; $i < $nor; $i++) {
        $row = $result->fetch_array();
        if (isDoctor($row['to'])){
            $recv =retrieveDoctorBYEmail($row['to']);
            $rec= "Doctor: ".$recv['first']." ".$recv['last'];
        }
        elseif (isStudent($row['to'])){
            $recv =retrieveStudentBYEmail($row['to']);
            $rec= "Student: ".$recv['first']." ".$recv['last'];
        }

        elseif(isSupervisor($row['to'])){
            $recv =retrieveSupercisorBYEmail($row['to']);
            $rec= "Supervisor: ".$recv['first']." ".$recv['last'];
        }
        echo '<li>';
        if ($row['is_read']==0){
            echo '<span class="label label-danger">Unread</span>';
        }

        echo'<b>'.$row['subject'].'</b> <i>( '.$row['to'].' )</i>
                                        <span class="quickMenu"  > 
           <span  class="fas fa-envelope-open-text show-msg-sent " data-type="sent" data-id3="'.$row[0].'">'.
            '<i></i></span></span></li>';
    }

}

?>