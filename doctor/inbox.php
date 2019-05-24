<?php
include("../model.php");// connect to db
session_start();
if(!isset($_SESSION['email']) ){ //if login in session is not set
    header("Location: ../404.php");
}
if (!isDoctor($_SESSION['email'])){
    header("Location: ../404.php");

}
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="inbox.js"></script>
    <link href="../style.css" rel="stylesheet">
    <link href="inbox.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->


</head>
<header id="header">
    <?php include "../header.php"?>
</header>



<body>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper" style="margin-top:-20px">
        <?php include "sidebar.php"?>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <?php if (isset($_SESSION['Message'])) {
                if ($_SESSION['Message'] == 'This Task already assignee to selected students' ||
                    $_SESSION['Message'] == 'This Task not assigned to this student' ||
                    $_SESSION['Message'] == 'This Student is already exist') {
                    $msg = "<div class=\"alert alert-danger\">
            <a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>OOPS!</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
                } else if ($_SESSION['Message'] == 'Message sent successfully' ||
                    $_SESSION['Message']=='Data updated') {
                    $msg = "<div class=\"alert alert-success\">
            <a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>Good</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";

                }
            }

            unset($_SESSION['Message']);

            ?>


            <?php if (isset($msg ))
                echo $msg ; ?>

            <div class="row inbox">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#inbox"><i class="fa fa-inbox"></i> Inbox</a></li>
                    <li><a data-toggle="tab" href="#menu1"><i class="fa fa-rocket"></i> Sent</a></a></li>
                </ul>

                <div class="tab-content">
                    <div class="panel panel-default tab-pane fade in active" id="inbox">
                        <div class="panel-body message">
                            <div class="message-title">Received Messages :
                            </div>
                            <div class="attachments">
                                <ul id="live_inbox_data">

                                </ul>
                            </div>
                            <br>
                            <div class="form-line row">
                                <div class="col-sm-4">
                                    <a href="#" onclick="showNewMsgForm()" class="btn btn-danger btn-block">New Email</a>
                                </div>

                            </div>
                            <br><br>
                            <div id="opened-msg" style="">
                            </div>
                            <hr>
                            <form method="post" id="send_email" action="../controller.php" style="display: none;">
                                <div class="form-group">
                                    <div class="form-line row">
                                        <div class="col-sm-12">
                                            <input name="src" value="doctor_send_message" hidden>

                                            <input type="email" class="form-control" id="message_subject" name="to"
                                                   placeholder="To" >

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="message_subject" name="message_subject"
                                           placeholder="Message Subject" >
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" id="message" name="body" rows="12"
                                              placeholder="Click here to write the msg" >

                                    </textarea></div>
                                <div class="form-group">
                                    <input   onclick="validate_send_msg()" type="button" class="btn btn-success" value="Send message">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="menu1" class= "panel panel-default tab-pane fade">

                        <div class="panel-body message">
                            <div class="message-title">Sent Messages :
                            </div>
                            <div class="attachments">
                                <ul id="live_sent_data">


                                </ul>
                            </div>
                            <div id="sent-opened-msg" >

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>




