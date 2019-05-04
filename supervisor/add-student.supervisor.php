<!DOCTYPE html>
<html>
<head>
<?php include '../css/navstyle.php'; ?>
<?php include'nav.supervisor.php'; ?>
</head>
<body>
    
   

<div class="main">
     <div class="box" >
              <h2>Add Student</h2>
                    <form  method="post">
                        <div class="form-group">
                            <label>Student ID</label>
                            <input type="text" name="student-id" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Doctor ID</label>
                            <input type="text" name="doctor-id" class="form-control">
                        </div>
                         <button type="submit" name="add-student" class="btn btn-warning">Add Student</button>
                    </form>
        </div>
    </div>
</body>
</html> 
<?php
include '../config.php';

$id = $_SESSION['id'];


 if(isset($_POST['add-student'])){
     $studentId = $_POST['student-id'];
     $doctorId = $_POST['doctor-id'];
   
    
     $sql = "INSERT INTO training (studentId, doctorId, supervisorId)
     VALUES ('$studentId', '$doctorId', '$id')";

     if (mysqli_query($conn, $sql)) {
        echo "New student created successfully";
     } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
}
?>
