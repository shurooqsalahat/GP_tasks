<?php
include("../model.php");// connect to db
session_start();
if(!isset($_SESSION['email'])) { //if login in session is not set
    header("Location: ../404.php");

}

if(!isDoctor($_SESSION['email'])){
    header("Location: ../404.php");
}
    if(isset($_REQUEST['std_id'])){
        $_SESSION['std_id'] =$_REQUEST['std_id'];
        $st =retrieveSudentsByID($_SESSION['std_id']);
        if ($_SESSION['id']!=$st['doctor_id'])
            header("Location: ../404.php");
    }
    else{
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
    <script src="student-tasks.js"></script>
    <link href="student-tasks.css" rel="stylesheet">

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
          rel="stylesheet">
    <!-- Font special for pages-->
    <?php include "../header.php" ?>
    <link href="add_task_form.css" rel="stylesheet" media="all">
</head>

<header id="header">
</header>
<body style="overflow-x: scroll!important;">

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
                if ($_SESSION['Message'] == 'extension not allowed, please choose a TXT.' ||
                    $_SESSION['Message'] == 'This Task is already exist' ||
                    $_SESSION['Message'] == 'File size must be less than 2 MB' ||
                    $_SESSION['Message']=='Something error, try again later') {
                    $msg = "<div class=\"alert alert-danger\">
            <a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>OOPS!</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
                } else if ($_SESSION['Message'] == 'Task added successfully') {
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
            <div >
               <?php
                echo '<table id="students_table" class="table-users" cellspacing="0" width="100%">' .
                    '<tr>' .
                        '<th>Task Name</th>' .
                        '<th>Task Weigt</th>' .
                        '<th>Estimation Time</th>' .
                        '<th>Description </th>'.
                        '<th>evaluation </th>'.
                        '<th>Student Received </th>'.
                        '<th>Student Sent </th>'.
                        '<th>Feed Back </th>'.
                        '<th>Solution Link </th>'.

                        '</tr>' .

                    '<tbody>';
                    $result = getStudentTasks($_SESSION['std_id']);
                    $nor = $result->num_rows;
                    if ($nor<= 0){
                    return;
                    }
                    $count =1;
                    for ($i = 0; $i < $nor; $i++) {
                    $row = $result->fetch_array();
                    $task =getTaskByName($row['task_name']);
                    $PATH="../".$task[5];

                    echo ' <tr onclick="update_submit(this)">'.
                        '<td><a download="tasks" href="'.$PATH.'">'.$task[1].'</a></td>'.
                        '<td>'. $task['weight'].'</td>'.
                        '<td>'.$task['estimation_time'].'</td>'.
                        '<td>'.$task['description'].'</td>'.
                        '<td>'.$row['evaluation'].'</td>'.
                        '<td>'.$row['student_recived'].'</td>'.
                        '<td>'.$row['student_sent'].'</td>'.
                        '<td>'.$row['feed_back'].'</td>'.
                        '<td>'.$row['solution_link'].'</td>'.

                        '</tr>';
                    }

                    ?>
                    </tbody>
                </table>

            </div>



        </div>

    </div>

    <!-- /#page-content-wrapper -->
</div>

</body>
