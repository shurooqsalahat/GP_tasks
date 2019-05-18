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
                    <input type="text" class="form-control" id="search_name">
                </div>
                <div class="form-group"  id="ID" style="display: none">
                    <label for="search_id">ID:</label>
                    <input type="text" class="form-control"  id="search_id">
                </div>
                <div style="float: right">
                    <button type="button" class="button" id="search-btn" onclick="validate_search_btn()"><span>Search</span></button>
                    <button type="button" class="button" style="vertical-align:middle;display: none" id="assign-new-task-btn" data-toggle="modal" data-target="#assign_new_task_modal"><span>Assign new task</span></button>
                    <button type="button" class="button" style="vertical-align:middle;display: none" id="assign-new-student-btn" data-toggle="modal" data-target="#assign_new_student_modal"><span>Assign new student</span></button>
                </div>
            </form>
<br>
            <hr>
            <div class="search">
                <table class="table-fill" id="assign-tasks-table" style="float: left;display: none">
                    <thead>
                    <tr>

                        <th class="text-left">Task ID</th>
                        <th class="text-left">Task Name</th>
                        <th class="text-left">Time</th>
                        <th class="text-left">Delivered</th>
                        <th class="text-left">Evaluation</th>
                        <th class="text-left">Delivered On</th>
                        <th class="text-left">Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    <tr>
                        <td class="text-left">2</td>
                        <td class="text-left">ts</td>
                        <td class="text-left">5</td>
                        <td class="text-left">2 mar</td>
                        <td class="text-left">5</td>
                        <td class="text-left">3 mar</td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <button type="button" class="btn" data-id='2'  data-toggle="modal" data-target="#add_score_modal"  style="padding: 10px;"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
                            </div>
                        </td>


                    </tr>
                    <tr>
                        <td class="text-left">2</td>
                        <td class="text-left">task2</td>
                        <td class="text-left">5</td>
                        <td class="text-left">2 mar</td>
                        <td class="text-left">5</td>
                        <td class="text-left">3 mar</td>
                        <td>
                            <div class="btn-group btn-group-xs" ng-show="row == $index">
                                <button type="button" class="btn" data-id='2'  data-toggle="modal" data-target="#add_score_modal"  style="padding: 10px;"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
                            </div>
                        </td>

                    </tr>
                    </tbody>
                </table>
                <table class="table-fill" id="assign-students-table" style="float: left;display: none">
                    <thead>
                    <tr>

                        <th class="text-left">Student ID</th>
                        <th class="text-left">Student Name</th>
                        <th class="text-left">Time</th>
                        <th class="text-left">Delivered</th>
                        <th class="text-left">Evaluation</th>
                        <th class="text-left">Delivered On</th>
                        <th class="text-left">Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    <tr>
                        <td class="text-left">2</td>
                        <td class="text-left">ts</td>
                        <td class="text-left">5</td>
                        <td class="text-left">2 mar</td>
                        <td class="text-left">5</td>
                        <td class="text-left">3 mar</td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <button type="button" class="btn" data-id='2'  data-toggle="modal" data-target="#add_score_modal"  style="padding: 10px;"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
                            </div>
                        </td>


                    </tr>
                    <tr>
                        <td class="text-left">2</td>
                        <td class="text-left">task2</td>
                        <td class="text-left">5</td>
                        <td class="text-left">2 mar</td>
                        <td class="text-left">5</td>
                        <td class="text-left">3 mar</td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <button type="button" class="btn" data-id='2'  data-toggle="modal" data-target="#add_score_modal"  style="padding: 10px;"><span class="glyphicon glyphicon-star">Add Task Score</span></button>
                            </div>
                        </td>

                    </tr>
                    </tbody>
                </table>

            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="assign_new_task_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Assign new Task</h4>
                        </div>
                        <div class="modal-body">
                            <form id="add_new_task_for_student_form" action="../controller.php" method="REQUEST" method="post" >
                                <h4 style="color: #5d7efe">Choose task/s you want to assign to this student:</h4>
                                <div class="input-group">
                                    <select name="assignees" id="assigned_tasks" multiple style="width: 300px">
                                        <option value="volvo">task1</option>
                                        <option value="saab">task2</option>
                                        <option value="opel">task2</option>
                                        <option value="audi">task3</option>
                                    </select>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="atLeastChooseOneTask()">Assign</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="assign_new_student_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add New Student</h4>
                        </div>
                        <div class="modal-body">
                            <form id="add_new_student_for_task_form" action="../controller.php" method="REQUEST" method="post" >
                                <h4 style="color: #5d7efe">Choose student/s to assign this task for him/them:</h4>
                                <div class="input-group">
                                    <select name="assignees" id="students_to_assign_task" multiple style="width: 300px">
                                        <option value="volvo">yara</option>
                                        <option value="saab">shurooq</option>
                                        <option value="opel">fatima</option>
                                    </select>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="atLeastChooseOneStudent()">Add</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade" id="add_score_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Task Evaluation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Task Name:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Student Name:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Task Score:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Feedback:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</body>
