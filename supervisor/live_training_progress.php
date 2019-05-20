<?php
include "../model.php";
include "../connect_DB.php";

if (isset($_POST['search_name'])){
    $name = $_POST['search_name'];
}
$row =null;
if(isset($_POST['search_id'])){
    $id= $_POST['search_id'];
}

if (isset($_POST['select'])) {
    $select = $_POST['select'];

    if ($select == 'student_name') {


    }

    if ($select == 'student_id') {

    }

    if ($select == 'task_name') {

        $result = getByTaskName($name);
        $nor = $result->num_rows;
        if ($nor <= 0) {
            return;
        }

        for ($i = 0; $i < $nor; $i++) {
            $row = $result->fetch_array();
            echo $row['task_name'];
        }
    }


    if ($select == 'task_id') {

    }

}