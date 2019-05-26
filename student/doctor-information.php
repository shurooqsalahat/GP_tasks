<?php
include("../model.php");// connect to db
session_start();


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tasks Tracker</title>
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tasks Tracker</title>
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS
    ================================================== -->
    <!-- Bootstrap css file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file:: for slider -->
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <!-- Superslide css file-->
    <link rel="stylesheet" href="../css/superslides.css">
    <link rel="stylesheet" href="../style.css">
    <!-- Slick slider css file :: for previous and next-->
    <link href="../css/slick.css" rel="stylesheet">
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet prefetch'
          href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>
    <!-- smooth animate css file -->
    <link rel="stylesheet" href="../css/animate.css">

    <script src="doctor-info.js"></script>
    <link href="doctor-information.css" rel="stylesheet">
  <?php include "../header.php"?>



    <script>
          function cancel(first, last, email, phone){
              $('input[name="first"]').val(first);
              $('input[name="last"]').val(last);
              $('input[name="phone"]').val(phone);
              $('input[name="email"]').val(email);
              $('#first_name').attr('disabled', 'disabled');
              $('#last_name').attr('disabled', 'disabled');
              $('#phone').attr('disabled', 'disabled');
              $('#email').attr('disabled', 'disabled');
              $('#email-btn').css('display', 'unset');
              $('#phone-btn').css('display', 'unset');
              $('#last-name-btn').css('display', 'unset');
              $('#first-name-btn').css('display', 'unset');
              $('#save-changes-btn').attr('disabled', true);
        }
    </script>
</head>

<header id="header">
</header>


<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <?php include "sidebar.php"?>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div class="form-line row">
        <?php
        if (isset($_SESSION['Message'])) {
            if ($_SESSION['Message'] == 'Something error, Please try later') {

                $msg = "<div class=\"alert alert-danger\">
            <a class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>OOPS!</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
            } else {
                $msg  = "<div class=\"alert alert-success\">
            <a class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>Good</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
            }
        }
        unset($_SESSION['Message']);
        ?>

        <?php if (isset($msg ))
            echo $msg ; ?>

        <div class="col-md-4 py-5 text-white text-center" style="height: 464px;">
            <div class="card-body" style="margin-top: 62px;">
                <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:70%">
                <h2 class="py-3">Welcome </h2>
                <p>In this page you can see your Doctor information

                </p></div>
        </div>
        <div class="col-md-8 py-5 border" style="margin-top: 17px;">
                    <h4 class="pb-4" style="margin-top: 50px;margin-bottom: 34px;margin-left: 183px;">Your Doctor Information</h4>
                    <form action="../controller.php" method="REQUEST">
                        <div class="form-line row">
                            <div class=" col-md-2 col-xs-6">
                                First Name
                            </div>

                            <div class=" col-md-6 col-xs-2">
                                <input name="src" value="update_doctor_information" type="hidden"/>
                                <?php if(isset($_SESSION['first'])) echo $_SESSION['first']?>
                            </div>

                        </div>
                        <br>
                        <div class="form-line row">
                            <div class=" col-md-2">
                                Last Name
                            </div>

                            <div class=" col-md-6">
                                <?php if(isset($_SESSION['last'])) echo $_SESSION['last']?>
                            </div>

                        </div>
                        <br>
                        <div class="form-line row">
                            <div class=" col-md-2">
                                Phone No.
                            </div>

                            <div class=" col-md-6">
                                <?php if(isset($_SESSION['phone'])) echo $_SESSION['phone']?>
                            </div>

                        </div>
                        <br>
                        <div class="form-line row">
                            <div class=" col-md-2">
                                Email
                            </div>

                            <div class=" col-md-6">
                                <?php if(isset($_SESSION['email'])) echo $_SESSION['email']?>
                            </div>

                        </div>

                        <br>
                        <br>

                        <hr>

                    </form>


        </div>
    </div>

</div>

