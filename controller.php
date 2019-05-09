<?php
include("model.php");
include("connect_DB.php");
session_start();

$src = $_REQUEST["src"];
unset($_SESSION['Message']);
//if (isset($_SESSION['email'])) {
////            header('Location: index.php');
////            exit;
////        }
if (isset($src)) {
    if ($src == "signin") {

        $email = $_REQUEST["email"];

        $upass = $_REQUEST["pass"];
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
                //header('Location: signUp.php');
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
                    echo $_SESSION['first'];
                } else {
                    $_SESSION['Message'] = "incorrect password";
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
                } else {
                    $_SESSION['Message'] = "incorrect password";
                    echo $_SESSION['Message'];
                    //header('Location: signIn.php');
                }
            }
        }

    } else if ($src == "signup") {

        //echo "welcome in signup";
        //empty cells
        if (strlen(trim($_REQUEST['first'])) == 0 || strlen(trim($_REQUEST['last'])) == 0 ||\
                strlen(trim($_REQUEST['password'])) == 0 || strlen(trim($_REQUEST['email'])) == 0) {
            $_SESSION['Message'] = "datarequired";
            echo $_SESSION['Message'];
            //header('Location: signup.php');
            exit;
        }
        //no match password
        if ($_REQUEST['password'] != $_REQUEST['re_pass']) {
            $_SESSION['Message'] = "nomatch";
            echo $_SESSION['Message'];
            //header('Location: signup.php');
            exit;
        }

        //password <8
        if (strlen(trim($_REQUEST['password'])) < 8) {
            $_SESSION['Message'] = "shortpass";
            echo $_SESSION['Message'];
            //header('Location: signup.php');
            exit;
        }
        else if ($_REQUEST['phone'] < 0 || !is_numeric($_REQUEST['phone'])) {
            $_SESSION['email'] = $_REQUEST['email'];
            $_SESSION['first'] = $_REQUEST['first'];
            $_SESSION['last'] = $_REQUEST['last'];
            $_SESSION['Message']="checkphone";
            echo $_SESSION['Message'];
            //header('Location: signup.php');
            exit;

        } else {
                addSupervisor($_REQUEST['phone'],$_REQUEST['first'],$_REQUEST['last'],$_REQUEST['email'],sha1($_REQUEST['password']));
                $_SESSION['Message']= 'Success Operation, Congrats!';
                //header('Location: signin.php');

            }
    }
}



