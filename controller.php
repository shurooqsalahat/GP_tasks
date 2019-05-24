<?php
include("model.php");
include("connect_DB.php");
session_start();

$src = $_REQUEST["src"];
unset($_SESSION['Message']);
//echo $src;

if (isset($src)) {
    if ($src == "signin") {
        $email = $_REQUEST["email"];
        $upass = $_REQUEST["password"];
        $encpass = sha1($upass);
        echo $upass;
        echo "</br>";
        echo $encpass;
        if (isset($email) and isset($upass)) {
            //User doesn't exit
            if (!isUserExist($email)) {
                $_SESSION['email'] = $email;
                $_SESSION['Message'] = "This user not Exist Signup please";
                //echo $_SESSION['Message'];
                header('Location: signUp.php');
                exit;
            } elseif (isDoctor($email)) {
                $row = retrieveDoctorBYEmail($email);
                if ($row['email'] == $email and $row['password'] == $encpass) {
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['first'] = $row['first'];
                    $_SESSION['last'] = $row['last'];
                    $_SESSION['phone'] = $row['phone'];
                    echo $_SESSION['first'];
                    $_SESSION['auth'] = $email;
                    header('Location: doctor/doctor-information.php');
                    exit;

                } else {
                    $_SESSION['Message'] = "incorrect password";
                    header('Location: login.php');
                    exit;
                }

            } elseif (isStudent($email)) {
                $row = retrieveStudentBYEmail($email);
                if ($row['email'] == $email and $row['password'] == $encpass) {
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['first'] = $row['first'];
                    $_SESSION['last'] = $row['last'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['doctor_id'] = $row['doctor_id'];
                    $_SESSION['supervisor_id'] = $row['supervisor_id'];
                    $_SESSION['auth'] = $email;
                    header('Location: student/student-information.php');
                    exit;
                } else {
                    $_SESSION['Message'] = "incorrect password";

                    header('Location: login.php');
                    exit;
                }
            } elseif (isSupervisor($email)) {
                $row = retrieveSupercisorBYEmail($email);
                echo "isSupervisor";
                if ($row['email'] == $email and $row['password'] == $encpass) {
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['first'] = $row['first'];
                    $_SESSION['last'] = $row['last'];
                    $_SESSION['phone'] = $row['phone'];
                    echo $_SESSION['first'];
                    $_SESSION['auth'] = $email;
                    header('Location: supervisor/supervisor-information.php');
                    exit;
                } else {
                    $_SESSION['Message'] = "incorrect password";
                    echo $_SESSION['Message'];
                    header('Location: login.php');
                    exit;
                }
            }
        }

    } else if ($src == "signup") {
        //empty cells
        if (strlen(trim($_REQUEST['first'])) == 0 || strlen(trim($_REQUEST['last'])) == 0 ||
            strlen(trim($_REQUEST['password'])) == 0 || strlen(trim($_REQUEST['email'])) == 0) {
            $_SESSION['Message'] = "This Data is Required";
            //echo $_SESSION['Message'];
            header('Location: signup.php');
            exit;
        }
        //no match password
        if ($_REQUEST['password'] != $_REQUEST['re_pass']) {
            $_SESSION['Message'] = "Password not match";
            echo $_SESSION['Message'];
            header('Location: signup.php');
            exit;
        }

        //password <8
        if (strlen(trim($_REQUEST['password'])) < 8) {
            $_SESSION['Message'] = "Password Must be 8 digits or more";
            echo $_SESSION['Message'];
            header('Location: signup.php');
            exit;
        } else if ($_REQUEST['phone'] < 0 || !is_numeric($_REQUEST['phone'])) {
            $_SESSION['email'] = $_REQUEST['email'];
            $_SESSION['first'] = $_REQUEST['first'];
            $_SESSION['last'] = $_REQUEST['last'];
            $_SESSION['Message'] = "Check phone structure";
            echo $_SESSION['Message'];
            header('Location: signup.php');
            exit;

        } else {
            echo sha1($_REQUEST['password']);
            addSupervisor($_REQUEST['phone'], $_REQUEST['first'], $_REQUEST['last'], $_REQUEST['email'],
                $_REQUEST['password']);
            $_SESSION['Message'] = 'Success Operation, Congrats!';
            header('Location: login.php');

        }
    } else if ($src == 'addStudent') {
        $email = $_REQUEST['email'];

        if (isSupervisor($email)) {
            $_SESSION['Message'] = "This user is already supervisor";
            echo $_SESSION['Message'];
            header('Location: supervisor/add-student.php');
            exit;
        }
        if (isDoctor($email)) {
            $_SESSION['Message'] = "This user is already doctor";
            echo $_SESSION['Message'];
            header('Location: supervisor/add-student.php');
            exit;
        }
        if (isUserExist($email)) {
            $_SESSION['Message'] = "This Student is already exist";
            echo $_SESSION['Message'];
            header('Location: supervisor/add-student.php');
            exit;
        } else {

            addStudent($_REQUEST['phone'], $_REQUEST['first'], $_REQUEST['last'], $_REQUEST['email']
                , '123456', $_REQUEST['doctor'], $_SESSION['id']);
            $_SESSION['Message'] = "Student Added successfully";
            header('Location: supervisor/add-student.php');
            exit;
        }

    } else if ($src == "update_supervisor_information") {
        echo "welcome in update";
        $flag_update = false;
        if (isset($_REQUEST['first'])) {
            $first = $_REQUEST['first'];
            $sql = "UPDATE supervisors SET first='" . $first . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            echo $sql;
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['first'] = $first;
            }
        }

        if (isset($_REQUEST['last'])) {
            $last = $_REQUEST['last'];
            $sql = "UPDATE supervisors SET last='" . $last . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            echo $sql;
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['last'] = $last;
            }
        }

        if (isset($_REQUEST['email'])) {
            $email = $_REQUEST['email'];
            $sql = "UPDATE supervisors SET email='" . $email . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            echo $sql;
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['email'] = $email;
            }
        }

        if (isset($_REQUEST['phone'])) {
            $phone = $_REQUEST['phone'];
            $sql = "UPDATE supervisors SET phone='" . $phone . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            echo $sql;
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['phone'] = $phone;
            }
        }

        if ($flag_update) {
            $_SESSION['Message'] = 'Your information updated';
            header('Location: supervisor/supervisor-information.php');
            exit;
        } else {
            $_SESSION['Message'] = 'Something error, Please try later';
            header('Location: supervisor/supervisor-information.php');
            exit;
        }


    }

    if ($src == 'logout') {
        session_destroy();
        header('Location: login.php');
        exit;
    }

    if ($src == 'addDoctor') {
        $email = $_REQUEST['email'];

        if (isSupervisor($email)) {
            $_SESSION['Message'] = "This user is already supervisor";
            echo $_SESSION['Message'];
            header('Location: supervisor/add-doctor.php');
            exit;
        }
        if (isStudent($email)) {
            $_SESSION['Message'] = "This user is already students";
            echo $_SESSION['Message'];
            header('Location: supervisor/add-doctor.php');
            exit;
        }
        if (isUserExist($email)) {
            $_SESSION['Message'] = "This doctor is already exist";
            echo $_SESSION['Message'];
            header('Location: supervisor/add-doctor.php');
            exit;
        } else {

            addDoctor($_REQUEST['phone'], $_REQUEST['first'], $_REQUEST['last'], $_REQUEST['email']
                , '123456');
            $_SESSION['Message'] = "Doctor Added successfully";
            header('Location: supervisor/add-doctor.php');
            exit;
        }
    }
    if ($src == 'update_student_') {
        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $doctor = $_POST['doctor'];
        $id = $_POST['id'];
        $update_flag = false;
        $original = retrieveSudentsByID($id);
        if ($original['email'] != $email && isUserExist($email)) {
            $_SESSION['Message'] = 'This email is used';
            header('Location: supervisor/add-student.php');
            exit;
        }
        if ($first != $original['first']) {
            $sql1 = "UPDATE students SET first='" . $first . "' WHERE id=" . $id;
            $result = $db->query($sql1);
            $update_flag = true;
        }
        if ($last != $original['last']) {
            $sql2 = "UPDATE students SET last='" . $last . "' WHERE id=" . $id;
            $result = $db->query($sql2);
            $update_flag = true;
        }
        if ($email != $original['email']) {
            $sql3 = "UPDATE students SET email='" . $email . "' WHERE id=" . $id;
            $result = $db->query($sql3);
            $update_flag = true;
        }
        if ($phone != $original['phone']) {
            $sql4 = "UPDATE students SET phone='" . $phone . "' WHERE id=" . $id;
            $result = $db->query($sql4);
            $update_flag = true;
        }
        if ($doctor != $original['doctor_id']) {
            $sql5 = "UPDATE students SET doctor_id='" . $doctor . "' WHERE id=" . $id;
            $result = $db->query($sql5);
            $update_flag = true;
        }
        if ($update_flag) {
            $_SESSION['Message'] = 'Student updated successfully';
            header('Location: supervisor/add-student.php');
            exit;
        }
        header('Location: supervisor/add-student.php');
        exit;

    }


    if ($src == 'update_doctor_') {
        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];
        $update_flag = false;


        $original = retrieveDoctorsByID($id);
        if ($original['email'] != $email && isUserExist($email)) {
            $_SESSION['Message'] = 'This email is used';

            header('Location: supervisor/add-doctor.php');
            exit;
        }
        if ($first != $original['first']) {
            $sql1 = "UPDATE doctors SET first='" . $first . "' WHERE id=" . $id;
            $result = $db->query($sql1);
            $update_flag = true;
        }
        if ($last != $original['last']) {
            $sql2 = "UPDATE doctors SET last='" . $last . "' WHERE id=" . $id;
            $result = $db->query($sql2);
            $update_flag = true;
        }
        if ($email != $original['email']) {
            $sql3 = "UPDATE doctors SET email='" . $email . "' WHERE id=" . $id;
            $result = $db->query($sql3);
            $update_flag = true;
        }
        if ($phone != $original['phone']) {
            $sql4 = "UPDATE doctors SET phone='" . $phone . "' WHERE id=" . $id;
            $result = $db->query($sql4);
            $update_flag = true;
        }
        if ($update_flag) {
            $_SESSION['Message'] = 'Doctor updated successfully';
            header('Location: supervisor/add-doctor.php');
            exit;
        }
        header('Location: supervisor/add-doctor.php');
        exit;
    }

    if ($src == 'addTasks') {


        $task_name = $_POST['task_name'];
        $weight = $_POST['weight'];
        $description = $_POST['description'];
        $estimation_time = $_POST['estimation_time'];

        if (isTaskExist($task_name)) {
            $_SESSION['Message'] = 'This Task is already exist';
            header('Location: supervisor/add-task.php');
            exit;

        }

        $errors = array();
        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        $new_name = $_REQUEST['task_name'];

        $file_ext = strtolower(end(explode('.', $file_name)));

        $extensions = array("txt");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a TXT.";
            $_SESSION['Message'] = 'extension not allowed, please choose a TXT.';
            header('Location: supervisor/add-task.php');
            exit;
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
            $_SESSION['Message'] = 'File size must be less than 2 MB';
            header('Location: supervisor/add-task.php');
            exit;
        }

        if (empty($errors) == true) {
            echo $_SESSION['id'];
            move_uploaded_file($file_tmp, "Tasks_files/" . $new_name . "." . $file_ext);
            addTask($task_name, $weight, $description, $estimation_time,
                "Tasks_files/" . $new_name . "." . $file_ext, $_SESSION['id']);

            if (isset($_REQUEST['assignees1'])) {
                echo "in";
                foreach ($_REQUEST['assignees1'] as $student) {
                    $rstudent = retrieveSudentsByID($student);
                    addStudentTask($student, $rstudent['first'] . " " . $rstudent['last'], $task_name,
                        $rstudent['doctor_id'], 0, 0, " ", " ");

                }

            }

            $_SESSION['Message'] = 'Task added and assigned successfully';
            header('Location: supervisor/add-task.php');
            exit;

        } else {
            $_SESSION['Message'] = 'Something error, try again later';
            header('Location: supervisor/add-task.php');
            exit;
        }
    }

    if ($src == 'assign_tasks') {
        if (isset($_REQUEST['tasks'])) {

            foreach ($_REQUEST['tasks'] as $task)
                foreach ($_REQUEST['students'] as $student) {
                    $rstudent = retrieveSudentsByID($student);
                    $rtasks = getTaskByName($task);
                    if (isTaskAssigne($student, $task)) {
                        $_SESSION['Message'] = "This Task already assignee to selected students";
                        header('Location: supervisor/training-progress.php');
                        exit;
                    }
                    addStudentTask($student, $rstudent['first'] . " " . $rstudent['last'], $task,
                        $rstudent['doctor_id'], 0, 0, " ", " ");
                    $_SESSION['Message'] = "Tasks assigned Successfully";
                    header('Location: supervisor/training-progress.php');
                    exit;

                }
        }

    }

    if ($src == 'evaluate_task') {
        $student_id = $_REQUEST['student_id'];
        echo $student_id;
        $task_id = $_REQUEST['task_id'];

        $row = getTaskByID($task_id);
        $t_name = $row['task_name'];
        $update_flag = false;

        if (!isTaskAssigne($student_id, $row['task_name'])) {
            $_SESSION['Message'] = "This Task not assigned to this student";
            header('Location: supervisor/training-progress.php');
            exit;
        } else {

            if (isset($_REQUEST['score'])) {
                $score = $_REQUEST['score'];
                $sql3 = "UPDATE student_task SET evaluation=" . $score . " WHERE task_name='" . $t_name . "' and 
                 student_id=" . $student_id;
                echo $sql3;
                $result = $db->query($sql3);
                $update_flag = true;


            }
            if (isset($_REQUEST['feed_back'])) {
                $feed_back = $_REQUEST['feed_back'];
                $sql3 = "UPDATE student_task SET feed_back='" . $feed_back . "' WHERE task_name='" . $t_name . "' and 
                 student_id=" . $student_id;

                $result = $db->query($sql3);
                $update_flag = true;
            }
            if ($update_flag) {
                $_SESSION['Message'] = "Data updated";
                header('Location: supervisor/training-progress.php');
                exit;
            }

        }


    }
    if ($src == 'send_message') {
        echo "welcome";
        $subject = $_REQUEST['message_subject'];
        echo $subject . '<br>';

        $content = $_REQUEST['body'];
        echo $content . '<br>';
        foreach ($_REQUEST['students'] as $student) {
            $rstudent = retrieveSudentsByID($student);
            sendMails($_SESSION['email'], $rstudent['email'], $subject, $content);
            $_SESSION['Message'] == 'Message sent successfully';
            header('Location: supervisor/inbox.php');
            exit;

        }

    }

    elseif ($src=="student_send_message"){
        echo "welcome";
        $subject = $_REQUEST['message_subject'];
        echo $subject . '<br>';

        $content = $_REQUEST['body'];
        echo $content . '<br>';
        foreach ($_REQUEST['receivers'] as $rec) {
            if ($rec=='supervisor'){
                $sup =retrieveSupervisorByID($_SESSION['supervisor_id']);
                sendMails($_SESSION['email'], $sup['email'], $subject, $content);
                continue;
            }
            $rstudent = retrieveSudentsByID($rec);
            sendMails($_SESSION['email'], $rstudent['email'], $subject, $content);

        }
        header('Location: student/inbox.php');
        exit;
    }

    elseif ($src=="doctor_send_message"){
        echo "welcome";
        $subject = $_REQUEST['message_subject'];
        echo $subject . '<br>';
        $to = $_REQUEST['receiver'];
        $content = $_REQUEST['body'];
        echo $content . '<br>';


            sendMails($_SESSION['email'], $to, $subject, $content);


        //header('Location: student/inbox.php');
        exit;
    }
    else if ($src == "update_student_information") {
        echo "welcome in update";
        $flag_update = false;
        if (isset($_REQUEST['first'])) {
            $first = $_REQUEST['first'];
            $sql = "UPDATE students SET first='" . $first . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['first'] = $first;
            }
        }

        if (isset($_REQUEST['last'])) {
            $last = $_REQUEST['last'];
            $sql = "UPDATE students SET last='" . $last . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['last'] = $last;
            }
        }

        if (isset($_REQUEST['email'])) {
            $email = $_REQUEST['email'];
            $sql = "UPDATE students SET email='" . $email . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['email'] = $email;
            }
        }

        if (isset($_REQUEST['phone'])) {
            $phone = $_REQUEST['phone'];
            $sql = "UPDATE students SET phone='" . $phone . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['phone'] = $phone;
            }
        }

        if ($flag_update) {
            $_SESSION['Message'] = 'Your information updated';
            header('Location: student/student-information.php');
            exit;
        } else {
            $_SESSION['Message'] = 'Something error, Please try later';
            header('Location: student/student-information.php');
            exit;
        }


    }

    else if ($src == "update_doctor_information") {
        echo "welcome in update";
        $flag_update = false;
        if (isset($_REQUEST['first'])) {
            $first = $_REQUEST['first'];
            $sql = "UPDATE doctors SET first='" . $first . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['first'] = $first;
            }
        }

        if (isset($_REQUEST['last'])) {
            $last = $_REQUEST['last'];
            $sql = "UPDATE doctors SET last='" . $last . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['last'] = $last;
            }
        }

        if (isset($_REQUEST['email'])) {
            $email = $_REQUEST['email'];
            $sql = "UPDATE doctors SET email='" . $email . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['email'] = $email;
            }
        }

        if (isset($_REQUEST['phone'])) {
            $phone = $_REQUEST['phone'];
            $sql = "UPDATE doctors SET phone='" . $phone . "' WHERE id=" . $_SESSION['id'];
            include('connect_DB.php');
            $result = $db->query($sql);
            if ($result) {
                $flag_update = true;
                $_SESSION['phone'] = $phone;
            }
        }

        if ($flag_update) {
            $_SESSION['Message'] = 'Your information updated';
            header('Location: doctor/doctor-information.php');
            exit;
        } else {
            $_SESSION['Message'] = 'Something error, Please try later';
            header('Location: doctor/doctor-information.php');
            exit;
        }


    }
}



