<?php
include('../model.php');

session_start();
$id = $_POST["id"];
deleteTrainingByID($id);