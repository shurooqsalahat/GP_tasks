<!DOCTYPE html>
<html>
<head>
<?php include '../css/navstyle.php'; ?>
<?php include'nav.supervisor.php'; ?>
</head>
<body>
 
   
<div class="main">
    <div class="container">
        <div class="ddd">
            <h2>My Information</h2>
           
            <?php 
            $sql ="SELECT email, phone FROM users WHERE id ='$id' ";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            ?>
               <div> <label>ID:</label> <span><?php echo $id; ?></span></div>
                <div> <label>Phone:</label> <span><?php echo $row['phone']; ?></span></div>
                <div> <label>Email:</label> <span><?php echo $row['email']; ?></span></div>
            <br>
               <div> <label>Do You Want to Change Your Accont Informatiom? </label><button onclick="view()">Change</button></div>
       </div>
        
        
            <div id="box" style="width:100px,display:none">
                <h2>Change Information</h2>
              <form method="post">
                  <div class="form-group">
                    <label>New Phone</label>
                    <input type="text" name="new-phone" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>New Email</label>
                    <input type="text" name="new-email" class="form-control">
                  </div>
                 <div class="form-group">
                    <label>Passsword</label>
                    <input type="password" name="pass1" class="form-control">
                 </div>
                 <div class="form-group">
                    <label>Conform Password</label>
                    <input type="password" name="pass2" class="form-control">
                </div>
                <button type="submit" name="change-info" class="btn btn-warning">Change Info</button>
           </form>  
            <?php

            $errors = array();
            $phone=$email=$pass1=$pass2="";
            if(isset($_POST['change-info'])){
                $email = $_POST['new-email'];
                $phone = $_POST['new-phone'];
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];
                
                if(!empty($email)){
                   
                    $s1 ="SELECT * FROM users WHERE email='$email' LIMIT 1";
                    $r1 = mysqli_query($conn, $s1);
                    $u1 = mysqli_fetch_assoc($r1);
                    if($u1){
                        if($u1['email'] === $email){
                         array_push($errors, "email already exists");
                        }
                    }else{
                        $up1= "UPDATE users 
                        SET email = '$email'
                        WHERE id = '$id'";
                        mysqli_query($conn, $up1);
                    }
                }
                
                if(!empty($phone)){
                   
                    $s2 ="SELECT * FROM users WHERE email='$phone' LIMIT 1";
                    $r2 = mysqli_query($conn, $s2);
                    $u2 = mysqli_fetch_assoc($r2);
                    if($u2){
                        if($u2['phone'] === $phone){
                         array_push($errors, "phone already exists");
                        }
                    }else{
                        $up2= "UPDATE users 
                        SET phone = '$phone'
                        WHERE id = '$id'";
                        mysqli_query($conn, $up2);
                    }
                }

               

              if(!empty($pass1) && !empty($pass2)){
                
                if ($pass1 != $pass2) {
                    array_push($errors, "The two passwords do not match");
                }else {
                 $password = md5($pass1);//encrypt the password before saving in the database
                 $up3 = "UPDATE users 
                 SET password = '$password'
                 WHERE id = '$id'";
                  mysqli_query($conn, $up3);
                }
              }

              
            }
        ?>
 </div>
        <div class="ddd">
            <h2>My Students</h2>
            
            <table class="table table-striped table-dark">
                <tr style="background-color:#222;color: white;">
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Doctor ID</th>
                </tr>
                <?php
                $s = " SELECT studentId, doctorId FROM training WHERE supervisorId = '$id'";
                $r = mysqli_query($conn, $s);
                while ($row = mysqli_fetch_assoc($r)){
                    $studentId = $row["studentId"];
                    $sql = " SELECT id, fname, lname, email, phone FROM users WHERE id = '$studentId' ";
                    $result = mysqli_query($conn, $sql);
                      if(mysqli_num_rows($result) > 0){
                         while($rr = mysqli_fetch_assoc($result)){  
                     ?> 
                        <tr>
                        <td scope="col"><?php echo $rr['id']; ?></td>
                         <td scope="col"><?php echo $rr['fname']." ".$rr['lname']; ?></td>
                         <td scope="col"><?php echo $rr['email'] ?></td>
                         <td scope="col"><?php echo $rr['phone'] ?></td>
                    <?php
                       }
                     }else{
                           echo "";
                      }
                    ?>
                            <td><?php echo $row['doctorId'] ?></td>
                            </tr>
                <?php
                    }
                    ?>
            </table>
        </div>  
        
        <div class="ddd">
            <h2>Doctors</h2>
           
            <table class="table table-striped table-dark">
                <tr style="background-color:#222;color: white;">
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                </tr>
                <?php
                $s = " SELECT DISTINCT doctorId FROM training WHERE supervisorId = '$id'";
                $r = mysqli_query($conn, $s);
                while ($row = mysqli_fetch_assoc($r)){
                    $doctorId = $row["doctorId"];
                    $sql = " SELECT id, fname, lname, email, phone FROM users WHERE id = '$doctorId' ";
                    $result = mysqli_query($conn, $sql);
                      if(mysqli_num_rows($result) > 0){
                         while($rr = mysqli_fetch_assoc($result)){  
                     ?> 
                        <tr>
                        <td scope="col"><?php echo $rr['id']; ?></td>
                         <td scope="col"><?php echo $rr['fname']." ".$rr['lname']; ?></td>
                         <td scope="col"><?php echo $rr['email'] ?></td>
                         <td scope="col"><?php echo $rr['phone'] ?></td>
                        </tr>
                    <?php
                       }
                     }else{
                           echo "";
                      }
                    }
                    ?>
            </table>
        </div>
    </div>
    
 
</div>

<script>
function view() {
  var x = document.getElementById("box");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>



</body>
</html> 