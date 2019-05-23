<?php
include('../model.php');
$id = $_POST["id"];
$row =getTaskByID($id);
//echo $row['task_name'];
deleteTrainingByStudentTaskName($row['task_name']);
deleteTaskBeId($id);

