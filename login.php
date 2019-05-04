<?php
include 'config.php' ;
 ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/lss.css">
    </head>
<body>
    <div class="box">
        
        <h2>Login</h2>
        
        <form  method="post">
            
            <div class="inputBox">
             <input type="" name="email" required="">
             <label>Email</label>
            </div>
            <div class="inputBox" >
                <input type="password" name="password" required="">
                <label>Password</label>
                
            </div>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>    
</html>

<?php 
session_start();  

$email=$pass="";
      
   
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    $sql = "SELECT * FROM users where email = '$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
           $row = mysqli_fetch_assoc($result);

           if ($row['password'] == md5($pass)){
            $_SESSION['id'] = $row["id"];
            $_SESSION['name'] = $row['fname'].' '.$row['lname'];

        if($row['type'] == 'student'){
            header('Location:student/my-account.student.php');
          }else  if($row['type'] == 'Supervisor'){
            header('Location:supervisor/my-account.supervisor.php ');
          }else{
               header('Location:doctor/my-account.doctor.php');
          }
         } else{
            echo "Invalid email or password";
          }
    }
}
    
?>
