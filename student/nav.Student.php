<?php
include '../config.php';
session_start();

$name = $_SESSION['name'];
$id = $_SESSION['id'];
?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
    <div class="navbar-header">
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
  <a href="my-account.student.php" >My Account</a>
  <a href="../inbox.php">Inbox</a>
  <a href="DisplayTasks.Student.php" >My Task</a>
</div>

 