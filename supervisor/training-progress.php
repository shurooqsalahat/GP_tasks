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
                if ($_SESSION['Message'] == 'This Task already assignee to selected students' ||
                    $_SESSION['Message'] == 'This Task not assigned to this student' ||
                    $_SESSION['Message'] == 'This Student is already exist') {
                    $msg = "<div class=\"alert alert-danger\">
            <a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>OOPS!</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
                } else if ($_SESSION['Message'] == 'Tasks assigned Successfully' ||
                    $_SESSION['Message']=='Data updated') {
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
            <form id="search_form">
                <div class="form-group">
                    <label for="search-type">Search (select one):</label>
                    <select class="form-control" id="search-type" onchange="changeLabel()"
                    <option value="">select</option>
                    <option value="student_name">Student Name</option>
                    <option value="student_id">Student Id</option>
                    <option value="task_name">Task Name</option>
                    <option value="task_id">Task id</option>
                    </select>
                </div>
                <div class="form-group" id="NAME">
                    <label for="search_name">Name:</label>
                    <input type="text" class="form-control" id="search_name" onchange="showDataName()">
                </div>
                <div class="form-group" id="ID" style="display: none">
                    <label for="search_id">ID:</label>
                    <input type="text" class="form-control" id="search_id" onchange="showDataID()">
                </div>
                <div style="float: right">
                    <button type="button" class="button" style="vertical-align:middle;" id="assign-new-task-btn"
                            data-toggle="modal" data-target="#assign_new_task_modal"><span>ASSIGN</span></button>

                </div>
            </form>
            <br>
            <hr>
            <div class="search">
                <table class="table-fill">
                    <thead>
                    <tr>
                        <th class="text-left">Student ID</th>
                        <th class="text-left">Student Name</th>
                        <th class="text-left">Task ID</th>
                        <th class="text-left">Task Name</th>
                        <th class="text-left">Student Received</th>
                        <th class="text-left">Student Sent</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Solution Link</th>
                        <th class="text-left">evaluation</th>
                        <th class="text-left"> action</th>


                    </tr>
                    </thead>
                    <tbody class="table-hover" id="live_data_progress">

                    </tbody>
                </table>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="assign_new_task_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Assign new Task</h4>
                        </div>
                        <div class="modal-body">
                            <form id="add_new_task_for_student_form" action="../controller.php" method="REQUEST">
                                <input name="src" value="assign_tasks" hidden>
                                <h4 style="color: #5d7efe">Choose task/s you want to assign to  students:</h4>
                                <div class="form-line row">

                                    <div class="col-sm-6">
                                        <select name="tasks[]" id="assigned_tasks" multiple="multiple" style="width: 100%">
                                            <?php
                                            $result = getSupervisorTasks($_SESSION['id']);
                                            $nor = $result->num_rows;
                                            for ($i = 0; $i < $nor; $i++) {

                                                $row = $result->fetch_array();
                                                echo " <option value= '$row[1]'>" . $row['task_name'] . "</option>";
                                            }
                                            ?>

                                        </select>

                                    </div>

                                    <div class="col-sm-6">
                                        <select name="students[]" id="students_to_assign_task" multiple="multiple" style="width: 100%">
                                            <?php
                                            $result = getSupervisorStudents($_SESSION['id']);
                                            $nor = $result->num_rows;
                                            for ($i = 0; $i < $nor; $i++) {
                                                $row = $result->fetch_array();
                                                echo " <option value= '$row[0]''>" . $row[2] . " " . $row[3] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="atLeastChooseOneStudent()">Assign
                            </button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="add_score_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Task Evaluation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller.php" method="REQUEST" id="task_eval">
                                <div class="form-group">
                                    <input type="text" name="src" value="evaluate_task" hidden>
                                    <input type="text" name="student_id" id ="student_id"  hidden>
                                    <input type="text" name="task_id" id ="id_task"  hidden>


                                    <label for="recipient-name" class="col-form-label">Task Name:</label>
                                    <input type="text" class="form-control" id="task-name" disabled>


                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Student Name:</label>
                                    <input type="text" class="form-control" id="student-name" name="student_name" disabled>

                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Task Score:</label>
                                    <input type="number" class="form-control" id="task-score" name="score">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Feedback:</label>
                                    <textarea class="form-control" id="task-feedback" name="feed_back"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <input  type="button" class="btn btn-primary" value="Submit" onclick="validate_task_eval_form()">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</body>
