<!DOCTYPE html>
<html>
<head>
<?php include '../css/navstyle.php'; ?>
<?php include'nav.supervisor.php'; ?>
</head>
<body>
<div class="main">
 <div class="box" >
             <h2>Add Task</h2>
             <form method="post">
                  <div class="form-group">
                    <label>Task Name</label>
                    <input type="text" name="task-name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Wieghted Hours</label>
                    <input type="text" name="weighted-hours" class="form-control">
                  </div>
                 <div class="form-group">
                    <label>Due To</label>
                    <input type="date" nmae="due-to" class="form-control">
                 </div>
                 <div class="form-group">
                    <label>Send To</label>
                    <input type="text" name="student-id" class="form-control">
                    <small  class="form-text text-muted">Enter id for the student</small>
                </div>
                 <div class="form-group">
                    <input type="file" name="file-supervisor" class="form-control-file">
                </div>
                <button type="submit" name="add-task" class="btn btn-warning">Add Task</button>
           </form>
        </div>
    </div>

 <?php
include '../config.php';
$id = $_SESSION['id'];
 if(isset($_POST['add-task'])){
     $taskName = $_POST['task-name'];
     $weightedHours = $_POST['weighted-hours'];
     $dueTo = htmlentities($_POST['due-to']);
     $fileSupervisor = $_POST['file-supervisor'];
     $studentId = $_POST['student-id'];
     
     $s = "SELECT doctorId FROM training WHERE studentId ='$studentId' AND supervisorId = '$id' ";
     $result = mysqli_query($conn, $s);
     $row = mysqli_fetch_assoc($result);
     $doctorId = $row["doctorId"];
     $sql = "INSERT INTO tasks (taskName, weightedHour, dueTo , studentId, fileSupervisor, supervisorId, doctorId)
     VALUES ('$taskName', '$weightedHours', '$dueTo', '$studentId', '$fileSupervisor','$id', '$doctorId')";

     if (mysqli_query($conn, $sql)) {
        echo "New task created successfully";
     } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
     
     
}
?>
         
   
    <