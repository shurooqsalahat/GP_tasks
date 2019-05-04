<?php
include 'config.php';

 $errors = array();
 $id=$fname=$lname=$email=$pass1=$pass2=$type="";
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass1 = $_POST['password'];
        $pass2 = $_POST['passwordrep'];
        $type = $_POST['type'];
        
        if ($pass1 != $pass2) {
	        array_push($errors, "The two passwords do not match");
        }

        $user_check_query = "SELECT * FROM users WHERE phone='$phone' OR email='$email' OR id='$id' LIMIT 1";
       $result = mysqli_query($conn, $user_check_query);
       $user = mysqli_fetch_assoc($result);
        
        if($user){ // if user exists
              if($user['id'] === $id){
            array_push($errors, "id already exists");
            }
            
            if($user['phone'] === $phone){
            array_push($errors, "phone already exists");
            }

          if($user['email'] === $email){
          array_push($errors, "email already exists");
          }
        }
        
        if (count($errors) == 0) {
        $password = md5($pass1);//encrypt the password before saving in the database
         $insert = "INSERT INTO users (id, fname, lname, email, phone, password, type) VALUES ('$id', '$fname', '$lname', '$email', '$phone', '$password', '$type')";
          mysqli_query($conn, $insert);
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/lss.css">
</head>
    
    
<body>
    
    
<div class="box">
        
        <h2>Sign Up</h2>
        
        <form  method="post">
            <div class="inputBox">
             <input type="" name="id" required="">
             <label>ID</label>
            </div>
            
            <div class="inputBox">
             <input type="" name="fname" required="">
             <label>First Name</label>
            </div>
            
			<div class="inputBox">
             <input type="" name="lname" required="">
             <label>Last Name</label>
            </div>
            
			<div class="inputBox">
             <input type="" name="email" required="">
             <label>Email</label>
            </div>
            
			<div class="inputBox">
             <input type="" name="phone" required="">
             <label>Phone</label>
            </div>

            <div class="inputBox" >
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            
           <div class="inputBox" >
                <input type="password" name="passwordrep" required="">
                <label>Confirm Password</label>
            </div>
            
            
           <div class="form-group">
               <label for="sel1" style="color: white;padding: 16px;font-size: 16px;">Select a Role</label>
                 
                      <select class="form-control" id="sel1" name="type">
                        <option value="student">Student</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Supervisor">Supervisor</option>
                     </select>     
            </div>
            
            <?php  if (count($errors) > 0) : ?>
            <div class="error">
               <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
            <?php  endif ?>

            <input type="submit" name="submit" value="Submit">
            
        </form>
    </div>
	</body>
	</html>