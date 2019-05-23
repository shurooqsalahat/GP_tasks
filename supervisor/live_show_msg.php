<?php
include "../model.php";
include "../connect_DB.php";
$type =$_POST['type'];
$id =$_POST['id'];

if ($type=='inbox'){
    $sql1 = "UPDATE inbox SET is_read=1 WHERE id=".$id;
    $result = $db->query($sql1);
}
$row =retrieveInboxByID($id);
$sender = "Unkonwn";
if (isDoctor($row['from'])){
   $rec = retrieveDoctorBYEmail($row['from']) ;
   $sender = "Doctor: ".$rec['first']." ". $rec['last'];
}
if (isStudent($row['from'])){
    $rec = retrieveStudentBYEmail($row['from']) ;
    $sender = "Student: ".$rec['first']." ". $rec['last'];

}
if (isSupervisor($row['from'])){
    $rec = retrieveSupercisorBYEmail($row['from']) ;
    $sender = "Supervisor: ".$rec['first']." ". $rec['last'];

}

echo ' <div class="form-line row">
                                    <div class="col-sm-12">
                                        <div class="message-title" id="msg-title">'. $row['subject'].'
                                        </div>
                                    </div>
                                </div>'.

    '<div class="header" id="msg-header">
                                    <img class="avatar" src="https://bootdey.com/img/Content/avatar/avatar7.png">

                                    <div class="from">
                                        <span id="sender-name">'.$sender.' </span>
                                        <span id="sender-email">'. $row['from'].' </span>
                                    </div>

                                </div>
                                <div class="content">
                                    <p id="msg-content">'.$row['content'].'</p>
                                </div>';

