<?php
    require '../config.php';
    session_start();
    if(isset($_POST['id']))
    {
        $id =$_POST['id'] ;
        $sql = " SELECT taskName, weightedHour, dueTo, evaluation,  FROM tasks WHERE studentId = '$id'";
        $result = mysqli_query($conn, $sql);
        mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($result);
    }