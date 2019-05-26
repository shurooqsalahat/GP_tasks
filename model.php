<?php

function isUserExist($email)
{
    include("connect_DB.php");// connect to db
    //echo "";
    if (isDoctor($email) || isSupervisor($email) || isStudent($email)) {
        return true;
    } else {
        return false;
    }
}


function isDoctor($email)
{
    include("connect_DB.php");// connect to db

    $query = "SELECT `email` FROM doctors WHERE email='$email'";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {
        return false;

    } else {

        return true;
    }

}

function isStudent($email)
{
    include("connect_DB.php");// connect to db

    $query = "SELECT `email` FROM students WHERE email='$email'";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {
        return false;

    } else {

        return true;
    }

}

function isSupervisor($email)
{
    include("connect_DB.php");// connect to db

    $query = "SELECT `email` FROM supervisors WHERE email='$email'";
    $result = $db->query($query);

    $nor = $result->num_rows;
    if ($nor == 0) {
        return false;

    } else {

        return true;
    }

}

function addStudent($phone, $first, $last, $email, $pass, $doctor_id, $supervisor_id)
{
    include 'connect_DB.php';
    if (isUserExist($email)) {

        return false;
    }
    $shpass = sha1($pass);
    $sql = "INSERT INTO `students`( `phone`, `first`, `last`, `email`, `password`, `doctor_id`, `supervisor_id`) 
VALUES ('$phone','$first','$last','$email','$shpass','$doctor_id','$supervisor_id')";
    if (mysqli_query($db, $sql)) {
        echo "Record inserted successfully";
        return true;
    } else {
        echo "Error inserted record: " . mysqli_error($db);
        return false;
    }
}

//addStudent(5888, 'yara', 'barhoush', 'yara@gmail.com', '123456789', 2, 2);

function deleteStudentBeEmail($email)
{
    include 'connect_DB.php';
    if (!isStudent($email)) {
        echo "undefined student, you cannot delete it";
        return false;
    }
    $sql = " DELETE FROM students WHERE email='$email'";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}


function deleteStudentBeId($id)
{
    include 'connect_DB.php';

    $sql = " DELETE FROM students WHERE id= $id";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}

function deleteTaskBeId($id)
{
    include 'connect_DB.php';

    $sql = " DELETE FROM tasks WHERE id= $id";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}

//deleteStudentBeId(2);
function retrieveStudentBYEmail($email)
{
    include 'connect_DB.php';
    if (!isStudent($email)) {
        echo "undefined student, you cannot delete it";
        return false;
    }
    $sql = "SELECT * FROM students where email ='$email'";
    $result = $db->query($sql);
    $row = $result->fetch_array();
    return $row;
}

//retrieveStudentBYEmail('shurooq@gmail.com');

function retrieveSudentsByID($id)
{
    include 'connect_DB.php';
    $query = "SELECT *  FROM students WHERE id=$id";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {
        return false;

    } else {

        $sql = "SELECT * FROM students where id =$id";
        $result = $db->query($sql);
        $row = $result->fetch_array();
        return $row;
    }

}

//retrieveSudentsByID(100);

function addDoctor($phone, $first, $last, $email, $pass)
{
    include 'connect_DB.php';
    if (isUserExist($email)) {

        return false;
    }
    $shpass = sha1($pass);
    $sql = "INSERT INTO `doctors`( `phone`, `first`, `last`, `email`, `password`) 
VALUES ('$phone','$first','$last','$email','$shpass')";
    if (mysqli_query($db, $sql)) {
        echo "Record inserted successfully";
        return true;
    } else {
        echo "Error inserted record: " . mysqli_error($db);
        return false;
    }
}

//addDoctor(2578, 'Samer', 'Arandi', "samer@gmail.com",123456789);

function deleteDoctor($email)
{
    include 'connect_DB.php';
    if (!isDoctor($email)) {
        echo "undefined Doctor, you cannot delete it";
        return false;
    }
    $sql = " DELETE FROM doctors WHERE email='$email'";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}

//deleteDoctor('ashraf@gmail.com');
function deleteDoctorById($id)
{
    include 'connect_DB.php';
    $sql = " DELETE FROM doctors WHERE id= $id";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}

function retrieveDoctorBYEmail($email)
{
    include 'connect_DB.php';
    if (!isDoctor($email)) {
        echo "undefined Doctor, you cannot delete it";
        return false;
    }
    $sql = "SELECT * FROM doctors where email ='$email'";
    $result = $db->query($sql);
    $row = $result->fetch_array();

    return $row;
}

//retrieveDoctorBYEmail('ashraf.@gmail.com');

function retrieveDoctorsByID($id)
{
    include 'connect_DB.php';
    $query = "SELECT `id` FROM doctors WHERE id=$id";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {

        return false;

    } else {

        $sql = "SELECT * FROM doctors where id =$id";
        $result = $db->query($sql);
        $row = $result->fetch_array();
        return $row;
    }

}

function addSupervisor($phone, $first, $last, $email, $pass)
{
    include 'connect_DB.php';
    if (isUserExist($email)) {

        return false;
    }
    $shpass = sha1($pass);

    $sql = "INSERT INTO `supervisors`( `phone`, `first`, `last`, `email`, `password`) 
VALUES ('$phone','$first','$last','$email','$shpass')";
    if (mysqli_query($db, $sql)) {
        echo "Record inserted successfully";
        return true;
    } else {
        echo "Error inserted record: " . mysqli_error($db);
        return false;
    }
}

//addSupervisor(2578, 'Shurooq', 'Salahat', "shurdoo77qsalahat@gmail.com",123456789);

function deleteSupervisor($email)
{
    include 'connect_DB.php';
    if (!isSupervisor($email)) {
        echo "undefined supervisor, you cannot delete it";
        return false;
    }
    $sql = " DELETE FROM supervisors WHERE email='$email'";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}

//deleteSupervisor('ashraf@gmail.com');

function retrieveSupercisorBYEmail($email)
{
    include 'connect_DB.php';
    if (!isSupervisor($email)) {
        echo "undefined supervisor, you cannot delete it";
        return false;
    }
    $sql = "SELECT * FROM supervisors where email ='$email'";
    $result = $db->query($sql);
    $row = $result->fetch_array();

    return $row;
}

//retrieveSupervisorBYEmail('shurooqsalahat@gmail.com');

function retrieveSupervisorByID($id)
{
    include 'connect_DB.php';
    $query = "SELECT `id` FROM supervisors WHERE id=$id";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {

        return false;

    } else {

        $sql = "SELECT * FROM supervisors where id =$id";
        $result = $db->query($sql);
        $row = $result->fetch_array();
        return $row;
    }


}

function getAllDoctors()
{
    include("connect_DB.php");// connect to db
    $qstr = "SELECT * FROM `doctors` ";
    $result = $db->query($qstr);
    return $result;

}

function getAllStudents()
{
    include("connect_DB.php");// connect to db
    $qstr = "SELECT * FROM `students` ";
    $result = $db->query($qstr);
    return $result;
}

function getSupervisorStudents($id)
{
    include("connect_DB.php");// connect to db
    $qstr = "SELECT * FROM `students` WHERE supervisor_id=$id";
    $result = $db->query($qstr);
    return $result;
}

function getStudentTasks($id)
{
    include("connect_DB.php");// connect to db
    $qstr = "SELECT * FROM `student_task` WHERE student_id=$id";
    $result = $db->query($qstr);
    return $result;
}

function getDoctorStudents($id)
{
    include("connect_DB.php");// connect to db
    $qstr = "SELECT * FROM `students` WHERE doctor_id=$id";
    $result = $db->query($qstr);
    return $result;
}

function getSupervisorTasks($id)
{
    include("connect_DB.php");// connect to db
    $qstr = "SELECT * FROM `tasks` WHERE supervisor_id=$id";
    $result = $db->query($qstr);
    return $result;
}

function isTaskExist($task_name)
{
    include("connect_DB.php");// connect to db
    $query = "SELECT `task_name` FROM tasks WHERE task_name='$task_name'";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {
        return false;

    } else {

        return true;
    }

}

function getTaskByName($name)
{
    include 'connect_DB.php';
     //echo $name;
    $sql = "SELECT * FROM tasks where task_name ='$name'";
    //echo $sql;
    $result = $db->query($sql);
    $row = $result->fetch_array();
    //echo $row['id'];
    return $row;
}

//getTaskByName('waleed Tasks');
function addTask($name, $weight, $description, $estimation_time, $task_file, $supervisor_id)
{
    include 'connect_DB.php';


    $sql = "INSERT INTO `tasks`( `task_name`, `weight`, `description`, `estimation_time`, `task_file`, `supervisor_id`) 
VALUES ('$name',$weight ,'$description',$estimation_time,'$task_file', $supervisor_id)";
    if (mysqli_query($db, $sql)) {
        echo "Record inserted successfully";
        return true;
    } else {
        echo "Error inserted record: " . mysqli_error($db);
        return false;
    }
}


function getTrainingLikeTaskName($supervisor_id,$name)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task WHERE supervisor_id=".$supervisor_id." AND task_name LIKE '%$name%'";
    // echo $qstr;
    $result = $db->query($qstr);
    return $result;

}

function getTrainingLikeStudentName($supervisor_id,$name)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task WHERE supervisor_id=".$supervisor_id." AND student_name LIKE '%$name%'";
    // echo $qstr;
    $result = $db->query($qstr);
    return $result;

}

function getTaskByID($id)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM tasks WHERE id=$id";
    // echo $qstr;
    $result = $db->query($qstr);
    $row = $result->fetch_array();
    //echo $row[1];
    return $row;

}

function getTrainingByTaskName($supervisor_id,$name)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task WHERE supervisor_id=".$supervisor_id." AND  task_name ='$name'";
    //echo $qstr;
    $result = $db->query($qstr);
    return $result;

}

function getTrainingByStudentId($supervisor_id,$id)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task WHERE supervisor_id=".$supervisor_id." AND  student_id=$id";
    $result = $db->query($qstr);

    return $result;

}

//getTrainingByTaskName('Task_2');
function getAllTaskStudent($id)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task where supervisor_id=".$id;
    $result = $db->query($qstr);
    return $result;

}


function isTaskAssigne( $student_id,$task_name)
{

    include("connect_DB.php");// connect to db

    $query = "SELECT * FROM student_task WHERE task_name='$task_name' AND student_id =$student_id";

    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {

        return false;

    } else {


        return true;
    }


}
isTaskAssigne(22, 'waleed Tasks');

function addStudentTask($supervisor_id,$student_id, $student_name, $task_name, $doctor_id, $is_delivered, $evaluation,
                         $feed_back, $solution_link)
{
    include 'connect_DB.php';
    if (isTaskAssigne($student_id, $task_name)) {

        return false;
    }
    //$date=date("Y-m-d",strtotime($date))
    $sql = "INSERT INTO `student_task`(`supervisor_id` ,`student_id`, `student_name`, `task_name`, `doctor_id`, `is_delivered`, 
    `evaluation`, `student_sent`, `student_recived`, `feed_back`, `solution_link`) 
    VALUES ($supervisor_id,'$student_id','$student_name','$task_name','$doctor_id',$is_delivered,$evaluation,'0-0-0',
    now(),'$feed_back', '$solution_link' )";
    if (mysqli_query($db, $sql)) {
        echo "Record inserted successfully";
        return true;
    } else {
        echo "Error inserted record: " . mysqli_error($db);
        return false;
    }
}
function deleteTrainingByStudentID($student_id){
    include 'connect_DB.php';

    $sql = " DELETE FROM student_task WHERE student_id=".$student_id;
    if (mysqli_query($db, $sql)) {
        return true;
    } else {
        return false;
    }
}


function deleteTrainingByStudentTaskName($task_name){
    include 'connect_DB.php';

    $sql = "DELETE FROM student_task WHERE task_name='".$task_name."'";
    if (mysqli_query($db, $sql)) {
        return true;
    } else {
        return false;
    }
}

function deleteTrainingByID($id){
    include 'connect_DB.php';
    $sql = "DELETE FROM student_task WHERE id=".$id;
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "Cannot delete this Record";
        return false;
    }
}

function getSentMails($email){
    include 'connect_DB.php';
    $sql = "SELECT * FROM `inbox` where `from` ='$email'";
    $result = $db->query($sql);
    return $result;

}

function getReceivedMails($email){
    include 'connect_DB.php';
    $sql = "SELECT * FROM `inbox` where `to` ='$email'";
    $result = $db->query($sql);
    return $result;

}

function sendMails($from, $to, $subject,$content){
    include "connect_DB.php";
    $sql = "INSERT INTO `inbox`(`from`, `to`, `content`, `subject`, `date`) VALUES 
('$from','$to','$content','$subject',now())";
    if (mysqli_query($db, $sql)) {
        echo "Record inserted successfully";
        return true;
    } else {
        echo "Error inserted record: " . mysqli_error($db);
        return false;
    }
}

function retrieveInboxByID($id)
{
    include 'connect_DB.php';
    $query = "SELECT *  FROM inbox WHERE id=$id";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {
        return false;

    } else {

        $sql = "SELECT * FROM inbox where id =$id";
        $result = $db->query($sql);
        $row = $result->fetch_array();
        return $row;
    }

}
retrieveInboxByID(3);

