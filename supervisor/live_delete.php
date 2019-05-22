<?php
include('../model.php');
$id = $_POST["id"];
deleteStudentBeId($id);
deleteTrainingByStudentId($id);