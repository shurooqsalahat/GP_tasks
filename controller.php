<?php
include("model.php");
include("connect_DB.php");
session_start();

$src = $_REQUEST["src"];
unset($_SESSION['Message']);


if (isset($src)) {
    if ($src == "signin") {

        // user already signin
        if (isset($_SESSION['auth'])) {
            if (isDoctor($_SESSION['auth'])){
                header('Location: supervisor/supervisor-information.php');
                exit;
            }
            if (isSupervisor($_SESSION['auth'])){

            }
            if (isStudent($_SESSION['auth'])){

            }

        }

        $email = $_REQUEST["email"];
        echo "welcome in signin";
        $upass = $_REQUEST["password"];
        $encpass = sha1($upass);
        echo "<br>";
        echo $encpass;
        echo "<br>";
        echo $upass;
        if (isset($email) and isset($upass)) {
            //User doesn't exit
            if (!isUserExist($email)) {
                $_SESSION['email'] = $email;
                $_SESSION['Message'] = "This user not Exist Signup please";
                echo $_SESSION['Message'];
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
                    $_SESSION['auth']= $email;

                } else {
                    $_SESSION['Message'] = "incorrect password";
                    //header('Location: signIn.php');
                }

            } elseif (isStudent($email)) {
                $row = retrieveStudentBYEmail($email);
                if ($row['email'] == $email and $row['password'] == $encpass) {
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['first'] = $row['first'];
                    $_SESSION['last'] = $row['last'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['auth']= $email;
                    echo $_SESSION['first'];
                } else {
                    $_SESSION['Message'] = "incorrect password";

                    //header('Location: signIn.php');
                }
            } elseif (isSupervisor($email)) {
                $row = retrieveSupercisorBYEmail($email);
                if ($row['email'] == $email and $row['password'] == $encpass) {
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['first'] = $row['first'];
                    $_SESSION['last'] = $row['last'];
                    $_SESSION['phone'] = $row['phone'];
                    echo $_SESSION['first'];
                    $_SESSION['auth']= $email;
                } else {
                    $_SESSION['Message'] = "incorrect password";
                    echo $_SESSION['Message'];
                    //header('Location: signIn.php');
                }
            }
        }

    } else if ($src == "signup") {
        // user already signin
        if (isset($_SESSION['auth'])) {
            if (isDoctor($_SESSION['auth'])){
                header('Location: supervisor/supervisor-information.php');
                exit;
            }
            if (isSupervisor($_SESSION['auth'])){

            }
            if (isStudent($_SESSION['auth'])){

            }

        }

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
            addSupervisor($_REQUEST['phone'], $_REQUEST['first'], $_REQUEST['last'], $_REQUEST['email'],
                sha1($_REQUEST['password']));
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

    }

    else if ($src == "update_supervisor") {
        echo "welcome in update";
    }

}



