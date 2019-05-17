<?php
include("../model.php");// connect to db
session_start();

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>website Name</title>
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
    <script src="training-progress.js"></script>


    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
          rel="stylesheet">
    <!-- Font special for pages-->
    <?php include "../header.php" ?>
    <link href="training-progress.css" rel="stylesheet" media="all">
</head>

<header id="header">
</header>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <?php include "sidebar.php" ?>
    </div>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <?php

            if (isset($_SESSION['Message'])) {
                if ($_SESSION['Message'] == 'This user is already doctor' ||
                    $_SESSION['Message'] == 'This user is already supervisor' ||
                    $_SESSION['Message'] == 'This Student is already exist') {
                    $msg = "<div class=\"alert alert-danger\">
            <a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>OOPS!</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
                } else if ($_SESSION['Message'] == 'Student Added successfully') {
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
            <div class="form-group">
                <label for="sel1">Search (select one):</label>
                <select class="form-control" id="search-type" onchange="selectedItem()">
                    <option value="">select</option>
                    <option value="student_name">Student Name</option>
                    <option value="student_id">Student Id</option>
                    <option value="task_name">Task Name</option>
                    <option value="task_id">Task id</option>
                </select>
            </div>
            <div class="form-group" id="NAME">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" id="usr">
            </div>
            <div class="form-group"  id="ID" style="display: none">
                <label for="usr">ID:</label>
                <input type="text" class="form-control" id="usr">
            </div>
            <div style="float: right">
                <button class="button" style="vertical-align:middle"><span>Search</span></button>
                <button class="button" style="vertical-align:middle;display: none" id="assign-new-task-btn" ><span>Assign new task</span></button>
                <button class="button" style="vertical-align:middle;display: none" id="assign-new-student-btn"><span>Assign new student</span></button>

            </div>

            </div>
            <hr>
            <div class="search">
                <table class="table-fill" id="assign-tasks-table" style="float: left;display: none">
                    <thead>
                    <tr>
                        <th class="text-left">Task ID</th>
                        <th class="text-left">Task Name</th>
                        <th class="text-left">Score</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    <tr>
                        <td class="text-left">2</td>
                        <td class="text-left">ts</td>
                        <td class="text-left">5</td>

                    </tr>
                    <tr>
                        <td class="text-left">3</td>
                        <td class="text-left">t3s</td>
                        <td class="text-left">33</td>

                    </tr>
                    </tbody>
                </table>
                <table class="table-fill" id="assign-students-table" style="float: left;display: none">
                    <thead>
                    <tr>
                        <th class="text-left">Student ID</th>
                        <th class="text-left">Student Name</th>
                        <th class="text-left">Score</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    <tr>
                        <td class="text-left">2</td>
                        <td class="text-left">ts</td>
                        <td class="text-left">5</td>

                    </tr>
                    <tr>
                        <td class="text-left">3</td>
                        <td class="text-left">t3s</td>
                        <td class="text-left">33</td>

                    </tr>
                    </tbody>
                </table>
             <div style="margin-left: 560px">
                 <div class="checkbox">
                     <label><input type="checkbox" value="">Option 1</label>
                 </div>
                 <div class="checkbox">
                     <label><input type="checkbox" value="">Option 2</label>
                 </div>
                 <div class="checkbox disabled">
                     <label><input type="checkbox" value="" disabled>Option 3</label>
                 </div>
             </div>
            </div>



        </div>

    </div>

</div>

</body>
