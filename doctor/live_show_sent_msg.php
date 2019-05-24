<?php
include "../connect_DB.php";
include "../model.php";
session_start();
$id =$_POST['id'];

$row =retrieveInboxByID($id);
$sender = "Unkonwn";
if (isDoctor($row['to'])){
    $rec = retrieveDoctorBYEmail($row['to']) ;
    $sender = "Doctor: ".$rec['first']." ". $rec['last'];
}
if (isStudent($row['to'])){
    $rec = retrieveStudentBYEmail($row['to']) ;
    $sender = "Student: ".$rec['first']." ". $rec['last'];

}
if (isSupervisor($row['to'])){
    $rec = retrieveSupercisorBYEmail($row['to']) ;
    $sender = "Supervisor: ".$rec['first']." ". $rec['last'];

}


echo ' <div class="form-line row">
                                    <div class="col-sm-12">
                                        <div class="message-title" id="msg-title">'.$row['subject'].'
                                        </div>
                                    </div>
                                </div>'.

    '<div class="header" id="msg-header">
                                    <img class="avatar" src="https://bootdey.com/img/Content/avatar/avatar7.png">

                                    <div class="from">
                                        <span id="sender-name">'.$sender.'</span>
                                        <span id="sender-email">'. $row['to'].'</span>
                                    </div>

                                </div>
                                <div class="content">'.$row['content'].'
                                    <p id="msg-content">
                                    </p>
                                </div>';

