<?php
include("../model.php");// connect to db
session_start();
if(!isset($_SESSION['email'])) { //if login in session is not set
    header("Location: ../404.php");

}

if(!isDoctor($_SESSION['email'])){
    header("Location: ../404.php");
}

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
    <!-- Bootstrap css file-->
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
    <script src="doctor-students.js"></script>
    <link href="doctor-students.css" rel="stylesheet">
    <?php include "../header.php"?>


</head>

<header id="header">
</header>
<body>

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
                if ($_SESSION['Message'] == 'This user is already doctor' ||
                    $_SESSION['Message'] == 'This user is already supervisor' ||
                    $_SESSION['Message'] == 'This Student is already exist' ||
                     $_SESSION['Message']=='This email is used') {
                    $msg = "<div class=\"alert alert-danger\">
            <a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>OOPS!</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
                }
                else if ($_SESSION['Message'] == 'Student Added successfully' ||
                    $_SESSION['Message']=='Student updated successfully'   ) {
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


            <!-- .modal -->

        </div>

    </div>

    <!-- /#page-content-wrapper -->
</div>

</body>
