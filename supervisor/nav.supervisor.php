<?php
include '../config.php';
session_start();
$name = $_SESSION['name'];
$id = $_SESSION['id'];
?>

<nav class="navbar navbar-inverse" >
    <div class="container-fluid">
    <div class="navbar-header" >
      <a class="navbar-brand" href="#">WebSiteNameeeeeeee</a>
        <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-bell"></span> </a></li>

    </ul>
    </div>
    <ul class="nav navbar-nav  navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $name ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../logout.php">Log out</a></li>
        </ul>
      </li>
    </ul>
    </div>
    </nav>

<div class="sidenav">
  <a href="my-account.supervisor.php" >My Account</a>
  <a href="../inbox.php">Inbox</a>
  <a href="add-task.supervisor.php" >Add Task</a>
  <a href="add-student.supervisor.php" >Add Student</a>
  <a href="view-task.supervisor.php" >All Task</a>
    
    <button class="dropdown-btn" >Students<i class="fa fa-caret-down"></i> 
  </button>
  <div class="dropdown-container">
       <?php
     //هون بدي اجيب كل الطلاب اللي عند المشرف واعرض اسماؤهم و الاي دي حقتهم
      $s = " SELECT studentId FROM training WHERE supervisorId = '$id'";
       $r = mysqli_query($conn, $s);
       while ($row = mysqli_fetch_assoc($r)){
         $studentId = $row["studentId"];
         $sql = " SELECT id, fname, lname FROM users WHERE id = '$studentId' ";
         $result = mysqli_query($conn, $sql);
      
                  if(mysqli_num_rows($result) > 0){
                     while($rr = mysqli_fetch_assoc($result)){  
                 ?> 
                    <a href="#"><?php echo $rr['fname']." ".$rr['lname']." ".$rr['id']; ?></a>
                <?php
                   }
                 }else{
                       echo "";
                  }
       }
     ?> 
  </div>
 <a href="evaluate.supervisor.php">Task Evaluation</a>
</div>

 <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
        
</script>
