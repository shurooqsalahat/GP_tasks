<?php
include '../config.php';

 if(isset($_POST['evaluate'])){
     $id = $_POST['id'];
     $evaluation = $_POST['evaluation'];
    
    //عشان الريكورد بكون موجود في الداتا بيس قبل فبنعمله update
     $sql = "UPDATE tasks 
     SET evaluation = '$evaluation'
     WHERE id = '$id'";

     if (mysqli_query($conn, $sql)) {
        echo "You evaluate successfully";
     } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
}
?>
<!DOCTYPE html>
<head>
<?php include '../css/navstyle.php'; ?>
<?php include'nav.supervisor.php'; ?>
</head>
<body>
<div class="main">
 <div class="box" >
             
                <h2>Task Evaluation</h2>
                    <form  method="post">
                        <div class="form-group">
                            <label>Task ID</label>
                            <input type="" name="id" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Evaluation</label>
                            <input type="text" name="evaluation" class="form-control">
                        </div>
                         <button type="submit" name="evaluate" class="btn btn-warning">Evaluate</button>
                    </form>
            
        </div>
    </div>
    
   
</body>
</html> 