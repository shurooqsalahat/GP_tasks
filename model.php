<?php
function isUserExist($email)
{
    include("connect_DB.php");// connect to db
     echo "";
    if (isDoctor($email) || isSupervisor($email) || isStudent($email)) {
        return true;
    }
    else{
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
        echo "nooo";
        return false;

    } else {

        return true;
    }

}

function addStudent($phone, $first, $last, $email, $password, $doctor_id, $supervisor_id)
{
    include 'connect_DB.php';
    if (isUserExist($email)){
        echo "this user already exist";
        return false;
    }
    $shpass = sha1($password);
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

function deleteStudentBeEmail($email){
    include 'connect_DB.php';
    if (!isStudent($email)){
        echo "undefined student, you cannot delete it";
        return false;
    }
    $sql=" DELETE FROM students WHERE email='$email'";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}


function deleteStudentBeId($id){
    include 'connect_DB.php';
    echo ($id);
    $sql=" DELETE FROM students WHERE id= $id";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}
//deleteStudentBeId(2);
function retrieveStudentBYEmail($email){
    include 'connect_DB.php';
    if (!isStudent($email)){
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

function retrieveSudentsByID($id){
    include 'connect_DB.php';
    $query = "SELECT `id` FROM students WHERE id=$id";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {
        echo " This Id doesn't exist";
        return false;

    }
    else {

        $sql = "SELECT * FROM students where id =$id";
        $result = $db->query($sql);
        $row = $result->fetch_array();
        echo $row['first'];
        return $row;
    }

}
//retrieveSudentsByID(100);

function addDoctor($phone, $first, $last, $email, $password)
{
    include 'connect_DB.php';
    if (isUserExist($email)){
        echo "this user already exist";
        return false;
    }
    $shpass = sha1($password);
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
//addDoctor(2578, 'ashraf', 'armoush', "ashraf@gmail.com",123456789);

function deleteDoctor($email){
    include 'connect_DB.php';
    if (!isDoctor($email)){
        echo "undefined Doctor, you cannot delete it";
        return false;
    }
    $sql=" DELETE FROM doctors WHERE email='$email'";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}
//deleteDoctor('ashraf@gmail.com');

function retrieveDoctorBYEmail($email){
    include 'connect_DB.php';
    if (!isDoctor($email)){
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

function retrieveDoctorsByID($id){
    include 'connect_DB.php';
    $query = "SELECT `id` FROM doctors WHERE id=$id";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {
        echo " This Id doesn't exist";
        return false;

    }
    else {

        $sql = "SELECT * FROM doctors where id =$id";
        $result = $db->query($sql);
        $row = $result->fetch_array();
        return $row;
    }

}

function addSupervisor($phone, $first, $last, $email, $password)
{
    include 'connect_DB.php';
    if (isUserExist($email)){
        echo "this user already exist";
        return false;
    }
    $shpass = sha1($password);
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
//addSupervisor(2578, 'Isam', 'Salahat', "Isam@gmail.com",123456789);

function deleteSupervisor($email){
    include 'connect_DB.php';
    if (!isSupervisor($email)){
        echo "undefined supervisor, you cannot delete it";
        return false;
    }
    $sql=" DELETE FROM supervisors WHERE email='$email'";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
        return true;
    } else {
        echo "cannot delete the record: " . mysqli_error($db);
        return false;
    }

}
//deleteSupervisor('ashraf@gmail.com');

function retrieveSupercisorBYEmail($email){
    include 'connect_DB.php';
    if (!isSupervisor($email)){
        echo "undefined supervisor, you cannot delete it";
        return false;
    }
    $sql = "SELECT * FROM supervisors where email ='$email'";
    $result = $db->query($sql);
    $row = $result->fetch_array();
    echo $row['id'];
    return $row;
}
//retrieveSupervisorBYEmail('ashraf.@gmail.com');

function retrieveSupervisorByID($id){
    include 'connect_DB.php';
    $query = "SELECT `id` FROM supervisors WHERE id=$id";
    $result = $db->query($query);
    $nor = $result->num_rows;
    if ($nor == 0) {
        echo " This Id doesn't exist";
        return false;

    }
    else {

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
//    $nor = $result->num_rows;
//    for ($i = 0; $i < $nor; $i++) {
//        $row = $result->fetch_array();
//        echo $row[0] . $row[2] . $row[3];
//    }
}
function getAllStudents(){
    include("connect_DB.php");// connect to db
    $qstr = "SELECT * FROM `students` ";
    $result = $db->query($qstr);
    return $result;
}