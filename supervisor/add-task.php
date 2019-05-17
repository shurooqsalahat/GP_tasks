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
    <script src="supervisor-update-task.js"></script>
    <link href="add-task.css" rel="stylesheet">

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
          rel="stylesheet">
    <!-- Font special for pages-->
    <?php include "../header.php" ?>
    <link href="add_task_form.css" rel="stylesheet" media="all">
</head>

<header id="header">
</header>
<body>
<div class="modal fade" id="add_task_modal" style="z-index: 2000">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Task</h4>
            </div>
            <div class="modal-body">
                <form id="add_task_form" action="../controller.php" method="REQUEST" method="post">
                    <ul class="tab-list">
                        <li class="tab-list__item active">
                            <a class="tab-list__link" href="#tab1" data-toggle="tab">
                                <span class="step">1</span>
                                <span class="desc">Task Information</span>
                            </a>
                        </li>
                        <li class="tab-list__item">
                            <a class="tab-list__link" href="#tab2" data-toggle="tab">
                                <span class="step">2</span>
                                <span class="desc">Upload Task File</span>
                            </a>
                        </li>
                        <li class="tab-list__item">
                            <a class="tab-list__link" href="#tab3" data-toggle="tab">
                                <span class="step">3</span>
                                <span class="desc">Assign Task</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="input-group">
                                <input class="input--style-1" type="text" id="task_name" name="task_name"
                                       placeholder="Task Name here">

                            </div>
                            <br>
                            <div class="input-group">
                                <input class="input--style-1" type="number" id="weight" name="weight"
                                       placeholder="Task Weight in hours">
                            </div>
                            <br>
                            <div class="input-group">
                                <input class="input--style-1" type="number" id="estimation_time" name="estimation_time"
                                       placeholder="estimation time for task">
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h6>Select Task file to upload:</h6>
                            <div class="input-group">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                            <br>
                            <div class="input-group">
                                <input style="padding: 8px 10px;" type="submit" value="Upload File" name="submit">
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="input-group">
                            Assign this task to :
                            </div>
                            <div class="input-group">
                                <select name="assignees" multiple style="width: 300px">
                                    <option value="volvo">Volvo</option>
                                    <option value="saab">Saab</option>
                                    <option value="opel">Opel</option>
                                    <option value="audi">Audi</option>
                                </select>
                            </div>
                        </div>

                        <div style="display: inline-block">
                            <img src="../img/pjm-overview.png">
                        </div>
                    </div>

                </form>
                <div class="form-line row">
                    <div class="error col-sm-12" id="errorMsg">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" name="submit" id="submit" onclick="form_submit()">Add
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <?php include "sidebar.php" ?>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
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
            <div id="live_data">
            </div>

            <div class="form-line row">
                <div class="col-sm-12 text-right">
                    <button type="button" id="MybtnModal" class="btn btn-primary">Add New Task</button>
                </div>
            </div>
            <!-- .modal -->
            <div class="modal fade" id="update_task_modal" style="z-index: 2000">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update task requirement </h4>
                        </div>
                        <div class="modal-body">
                            <form id="update_task_form_modal" method="post">
                                <ul class="tab-list">
                                    <li class="tab-list__item active">
                                        <a class="tab-list__link" href="#tab1" data-toggle="tab">
                                            <span class="step">1</span>
                                            <span class="desc">Task Information</span>
                                        </a>
                                    </li>
                                    <li class="tab-list__item">
                                        <a class="tab-list__link" href="#tab2" data-toggle="tab">
                                            <span class="step">2</span>
                                            <span class="desc">Upload Task File</span>
                                        </a>
                                    </li>
                                    <li class="tab-list__item">
                                        <a class="tab-list__link" href="#tab3" data-toggle="tab">
                                            <span class="step">3</span>
                                            <span class="desc">Assign Task</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        <div class="input-group">
                                            <input class="input--style-1" type="text" id="u_task_name" name="task_name"
                                                   placeholder="Task Name here">

                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <input class="input--style-1" type="number" id="u_weight" name="weight"
                                                   placeholder="Task Weight in hours">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <input class="input--style-1" type="number" id="u_estimation_time"
                                                   name="estimation_time" placeholder="estimation time for task">
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <h6>Select Task file to upload:</h6>
                                        <div class="input-group">
                                            <input type="file" name="fileToUpload" id="u_fileToUpload">
                                        </div>
                                        <br>
                                        <div class="input-group">
                                            <input style="padding: 8px 10px;" type="submit" value="Upload File"
                                                   name="submit">
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <div class="input-group">
                                            Assign this task to :
                                        </div>
                                        <div class="input-group">
                                            <select name="assignees" multiple style="width: 300px">
                                                <option value="volvo">Volvo</option>
                                                <option value="saab">Saab</option>
                                                <option value="opel">Opel</option>
                                                <option value="audi">Audi</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div style="display: inline-block">
                                        <img src="../img/pjm-overview.png">
                                    </div>
                                </div>
                            </form>
                            <div class="form-line row">
                                <div class="error col-sm-12" id="updateError">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" name="submit" id="submit_update_modal"
                                    onclick="validate_update_form()">Update
                            </button>
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
