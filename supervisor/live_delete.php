<?php
include('../model.php');
$id = $_POST["id"];
echo $id;
deleteStudentBeId($id);