<?php
include("../model.php");// connect to db
session_start();
if(!isset($_SESSION['email']) ){ //if login in session is not set
    header("Location: ../404.php");
}
if (!isSupervisor($_SESSION['email'])){
    header("Location: ../404.php");

}
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file:: for slider -->
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <!-- Superslide css file-->
    <link rel="stylesheet" href="../css/superslides.css">
    <!-- Slick slider css file :: for previous and next-->
    <link href="../css/slick.css" rel="stylesheet">
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet prefetch'
          href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>
    <!-- smooth animate css file -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- Main structure css file -->
    <link href="../style.css" rel="stylesheet">
    <!-- for validation-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file:: for slider -->
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <!-- Superslide css file-->
    <link rel="stylesheet" href="../css/superslides.css">
    <!-- Slick slider css file :: for previous and next-->
    <link href="../css/slick.css" rel="stylesheet">
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet prefetch'
          href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>
    <!-- smooth animate css file -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- Main structure css file -->
    <link href="../style.css" rel="stylesheet">

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>
    <script src="supervisor-update-doctor.js"></script>
    <link href="add-doctor.css" rel="stylesheet">
    <?php include "../header.php"?>


</head>

<header id="header">
</header>
<body>
<div class="modal fade" id="add_student_modal"  style="z-index: 2000">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Doctor</h4>
            </div>
            <div class="modal-body">
                    <div class="form-line row">
                        <div class="col-sm-12">
                            fill the form with doctor info :
                        </div>
                    </div>
                        <form id="add_student_form" action="../controller.php" method="REQUEST"  >
                            <div class="form-line row">
                                <div class="col-sm-12">
                                    <label for="first_name">First Name:</label>
                                    <input name="src" value="addDoctor" type="hidden"/>
                                    <input type="text" id="first_name" name="first"></input>
                                </div>
                            </div>
                            <div class="form-line row">
                                <div class="col-sm-12">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" id="last_name" name="last"></input>
                                </div>
                            </div>
                            <div class="form-line row">
                                <div class="col-sm-12">
                                    <label for="email">Email:</label>
                                    <input type="text" id="email" name="email"></input>
                                </div>
                            </div>

                            <div class="form-line row">
                                <div class="col-sm-12">
                                    <label for="phone">Phone:</label>
                                    <input type="tel" id="phone" name="phone"></input>
                                </div>
                            </div>

                        </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" name="submit" id="submit" onclick="form_submit()">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <?php include "sidebar.php"?>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <?php

            if (isset($_SESSION['Message'])) {
                if ($_SESSION['Message'] == 'This user is already supervisor' ||
                    $_SESSION['Message'] == 'This user is already students' ||
                    $_SESSION['Message'] == 'This doctor is already exist' ||
                     $_SESSION['Message']=='This email is used') {
                    $msg = "<div class=\"alert alert-danger\">
            <a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>OOPS!</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
                }
                else if ($_SESSION['Message'] == 'Doctor Added successfully' ||
                          $_SESSION['Message']=='Doctor updated successfully') {
                    $msg = "<div class=\"alert alert-success\">
            <a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>Good</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";

                }
            }

            unset($_SESSION['Message']);

              ?>

            <div class="form-line row">
                <?php if (isset($msg))
                    echo $msg; ?>
            </div>
            <div id="live_data">
            </div>

            <div class="form-line row">
                <div class="col-sm-12 text-right">
                    <button type="button" id="MybtnModal" class="btn btn-primary">Add New Doctor</button>
                </div>
            </div>
            <!-- .modal -->
            <div class="modal fade" id="update_student_modal"  style="z-index: 2000">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Doctor Information</h4>
                        </div>
                        <div class="modal-body">
                            <form id="update_student_form_modal" method="post" action="../controller.php">
                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <label for="first_name">First Name:</label>
                                        <input name="src" value="update_doctor_" type="hidden"/>
                                        <input type="text" id="u_id" name="id" hidden>
                                        <input type="text" id="u_first_name" name="first">
                                    </div>
                                </div>
                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" id="u_last_name" name="last">
                                    </div>
                                </div>
                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <label for="email">Email:</label>
                                        <input type="text" id="u_email" name="email">
                                    </div>
                                </div>

                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <label for="phone">Phone:</label>
                                        <input type="tel" id="u_phone" name="phone">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" name="submit" id="submit_update_modal" onclick="validate_update_form()" >Update</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- /#page-content-wrapper -->
</div>

</body>
