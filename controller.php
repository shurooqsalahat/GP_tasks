<?php
include("model.php");
include("connect_DB.php");
session_start();

$src = $_REQUEST["src"];
unset($_SESSION['Message']);
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
                header('Location: signUp.php');
                exit;
            }
            elseif (isDoctor($email)){
                $row= retrieveDoctorBYEmail($email);
                if($row['email'] ==$email and $row['password']==$encpass) {
                    $_SESSION['email'] = $email;
                    $_SESSION['id']= $row['id'];
                    $_SESSION['first']= $row['first'];
                    $_SESSION['last'] =$row['last'];
                    $_SESSION['phone'] =$row['phone'];
                }
                else{
                    $_SESSION['Message'] = "incorrect password";
                    header('Location: signIn.php');
                }

            }
            elseif (isStudent($email)) {
                $row = retrieveStudentBYEmail($email);
                if ($row['email'] == $email and $row['password'] == $encpass) {
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['first'] = $row['first'];
                    $_SESSION['last'] = $row['last'];
                    $_SESSION['phone'] = $row['phone'];
                } else {
                    $_SESSION['Message'] = "incorrect password";
                    header('Location: signIn.php');
                }
            }

            elseif (isSupervisor($email)) {
                $row = retrieveSupercisorBYEmail($email);
                if ($row['email'] == $email and $row['password'] == $encpass) {
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['first'] = $row['first'];
                    $_SESSION['last'] = $row['last'];
                    $_SESSION['phone'] = $row['phone'];
                } else {
                    $_SESSION['Message'] = "incorrect password";
                    header('Location: signIn.php');
                }
            }
        }

    } else if ($src == "signup") {

        /*	if(isset($_SESSION['itgemail'])){
                 header('Location: index.php');
                 exit;
            } */

        //       if ($_REQUEST['type'] == 'user') {


        if ($_REQUEST['password'] != $_REQUEST['conpassword']) {
            $_SESSION['Message'] = "notmatch";
            $_SESSION['email'] = $_REQUEST['email'];
            $_SESSION['fname'] = $_REQUEST['fname'];
            $_SESSION['lname'] = $_REQUEST['lname'];
            $_SESSION['phone'] = $_REQUEST['phone'];
            $_SESSION['donationDate'] = $_REQUEST['donationDate'];
            $_SESSION['longitude'] = $_REQUEST['longitude'];
            $_SESSION['latitude'] = $_REQUEST['latitude'];


            header('Location: signUp.php');
            exit;
        }
        if (strlen(trim($_REQUEST['password'])) < 8 || is_numeric($_REQUEST['password'])) {
            $_SESSION['Message'] = "shortpass";
            $_SESSION['email'] = $_REQUEST['email'];
            $_SESSION['fname'] = $_REQUEST['fname'];
            $_SESSION['lname'] = $_REQUEST['lname'];
            $_SESSION['address'] = $_REQUEST['address'];
            $_SESSION['phone'] = $_REQUEST['phone'];
            $_SESSION['donationDate'] = $_REQUEST['donationDate'];
            $_SESSION['longitude'] = $_REQUEST['longitude'];
            $_SESSION['latitude'] = $_REQUEST['latitude'];
            header('Location: signUp.php');
            exit;
        } else if (!is_numeric($_REQUEST['phone']) && strlen(trim($_REQUEST['phone'])) != 0) {

            header('Location: signUp.php');
            exit;
        } else if ($_REQUEST['phone'] < 0) {
            $_SESSION['email'] = $_REQUEST['email'];
            $_SESSION['fname'] = $_REQUEST['fname'];
            $_SESSION['lname'] = $_REQUEST['lname'];
            $_SESSION['address'] = $_REQUEST['address'];
            $_SESSION['phone'] = $_REQUEST['phone'];
            $_SESSION['donationDate'] = $_REQUEST['donationDate'];
            $_SESSION['longitude'] = $_REQUEST['longitude'];
            $_SESSION['latitude'] = $_REQUEST['latitude'];
            header('Location: signUp.php');
            exit;

        } else {
            if (strlen(trim($_REQUEST['fname'])) == 0 || strlen(trim($_REQUEST['lname'])) == 0 || strlen(trim($_REQUEST['password'])) == 0 || strlen(trim($_REQUEST['email'])) == 0) {
                $_SESSION['Message'] = "datarequired";
                header('Location: signUp.php');
                exit;

            } else {
                if (isUserExist($_REQUEST['email'])) {
                    $_SESSION['Message'] = "exist";
                    $_SESSION['email'] = $_REQUEST['email'];
                    $_SESSION['fname'] = $_REQUEST['fname'];
                    $_SESSION['lname'] = $_REQUEST['lname'];
                    $_SESSION['address'] = $_REQUEST['address'];
                    $_SESSION['phone'] = $_REQUEST['phone'];
                    $_SESSION['donationDate'] = $_REQUEST['donationDate'];
                    $_SESSION['longitude'] = $_REQUEST['longitude'];
                    $_SESSION['latitude'] = $_REQUEST['latitude'];
                    header('Location: signUp.php');
                    exit;

                } else {
                    if (isCenpitalExist($_REQUEST['email'])) {
                        $_SESSION['Message'] = "exist";
                        $_SESSION['email'] = $_REQUEST['email'];
                        $_SESSION['fname'] = $_REQUEST['fname'];
                        $_SESSION['lname'] = $_REQUEST['lname'];
                        $_SESSION['address'] = $_REQUEST['address'];
                        $_SESSION['phone'] = $_REQUEST['phone'];
                        $_SESSION['donationDate'] = $_REQUEST['donationDate'];
                        $_SESSION['longitude'] = $_REQUEST['longitude'];
                        $_SESSION['latitude'] = $_REQUEST['latitude'];
                        header('Location: signUp.php');
                        exit;
                    } else {
                        $pass = $_REQUEST['password'];
                        //	$seed = generateRandomString(30);
                        addUser($_REQUEST['email'], $_REQUEST['fname'], $_REQUEST['lname'], $pass, $_REQUEST['city'], $_REQUEST['phone'],
                            $_REQUEST['blodType'], $_REQUEST['sex'], $_REQUEST['latitude'], $_REQUEST['longitude'], $_REQUEST['donationDate'], 0, 0);
                        /*     $to = "$_REQUEST[email]";
                             $subject = "Confirmation Email";
                             include('email_message.php');
                             $message = generate_email($to, $seed);
                             $status = sendmail($to, $subject, $message, $to);
                             if ($status)
                                 $_SESSION['Message'] = "pass";
                             else
                                 $_SESSION['Message'] = "Error occurred while sending activation email, Please try to  <a id='activate' href='account_activation.php' onClick='clear_messages();' style='color:#009'>Activate your Account</a>";
                              */
                        header('Location: about_us.php');
                        exit;

                    }
                }
            }
        }
    }

}

