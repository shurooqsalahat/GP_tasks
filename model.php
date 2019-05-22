<?php
function isUserExist($email)
{
    include("connect_DB.php");// connect to db
    echo "";
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
    echo $row['id'];
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
    echo $row['id'];
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
    //echo $row['id'];
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

    $sql = "SELECT * FROM tasks where task_name ='$name'";
    $result = $db->query($sql);
    $row = $result->fetch_array();

    return $row;
}

//getTaskByName('Task_1');
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


function getTrainingLikeTaskName($name)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task WHERE task_name LIKE '%$name%'";
    // echo $qstr;
    $result = $db->query($qstr);
    return $result;

}

function getTrainingLikeStudentName($name)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task WHERE student_name LIKE '%$name%'";
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

function getTrainingByTaskName($name)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task WHERE task_name ='$name'";
    //echo $qstr;
    $result = $db->query($qstr);
    $row = $result->fetch_array();
    //echo $row[1];
    return $row;

}

function getTrainingByStudentId($id)
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task WHERE student_id=$id";
    // echo $qstr;
    $result = $db->query($qstr);
    $row = $result->fetch_array();
    //echo $row[1];
    return $row;

}

//getTrainingByTaskName('Task_2');
function getAllTaskStudent()
{
    include 'connect_DB.php';
    $qstr = "SELECT * FROM student_task ";
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

function addStudentTask($student_id, $student_name, $task_name, $doctor_id, $is_delivered, $evaluation,
                         $feed_back, $solution_link)
{
    include 'connect_DB.php';
    if (isTaskAssigne($student_id, $task_name)) {

        return false;
    }
    //$date=date("Y-m-d",strtotime($date))
    $sql = "INSERT INTO `student_task`( `student_id`, `student_name`, `task_name`, `doctor_id`, `is_delivered`, 
    `evaluation`, `student_sent`, `student_recived`, `feed_back`, `solution_link`) 
    VALUES ('$student_id','$student_name','$task_name','$doctor_id',$is_delivered,$evaluation,'0-0-0',
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