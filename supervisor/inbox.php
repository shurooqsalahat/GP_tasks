<?php
include("../model.php");// connect to db
session_start();

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
                                <ul>
                                    <?php
                                    $result =getReceivedMails($_SESSION['email']);
                                    $nor = $result->num_rows;
                                    if ($nor <=0){
                                       echo' <li><span class="label label-danger">No Messages</span> </li>';

                                    }
                                    else {
                                        for ($i = 0; $i < $nor; $i++) {
                                            $row = $result->fetch_array();
                                            echo '<li>';
                                            if ($row['is_read']==0){
                                                echo '<span class="label label-danger">Unread</span>';
                                            }

                                          echo'   <b>'.$row['subject'].'</b> <i>( '.$row['from'].' )</i>
                                        <span class="quickMenu">
                                    <a href="#" class="fas fa-envelope-open-text" onclick="openMsg()"><i></i></a>
                                        <a href="#" class="fas fa-trash delete-message" data-id="'.$row[0].'"><i></i></a> </span>
                                    </li>';
                                        }

                                    }

                                    ?>

                                </ul>
                            </div>
                            <br>
                            <div class="form-line row">
                                <div class="col-sm-4">
                                    <a href="#" onclick="showNewMsgForm()" class="btn btn-danger btn-block">New Email</a>
                                </div>

                            </div>
                            <br><br>
                            <div id="opened-msg" style="display: none;">
                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <div class="message-title" id="msg-title">
                                        </div>
                                    </div>
                                </div>

                                <div class="header" id="msg-header">
                                    <img class="avatar" src="https://bootdey.com/img/Content/avatar/avatar7.png">

                                    <div class="from">
                                        <span id="sender-name"></span>
                                        <span id="sender-email"> </span>
                                    </div>

                                </div>
                                <div class="content">
                                    <p id="msg-content">
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <form method="post" id="send_email" action="../controller.php" style="display: none;">
                                <div class="form-group">
                                    <div class="form-line row">
                                        <div class="col-sm-2">
                                            <input name="src" value="send_message" hidden>
                                            <label for="sel2">Select Email/s:</label>

                                        </div>
                                        <div class="col-sm-8">

                                            <select multiple="multiple" class="form-control" id="send-to-emails" name="students[]">

                                                <?php
                                                $result = getSupervisorStudents($_SESSION['id']);
                                                $nor = $result->num_rows;
                                                for ($i = 0; $i < $nor; $i++) {
                                                    $row = $result->fetch_array();
                                                    echo " <option value= '$row[0]''>" . $row[2] . " " . $row[3] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <!--   <select class="selectpicker" id="selectpicker" multiple data-live-search="true">

                                               </select>-->
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
                                    <input   onclick="validate_send_msg()" type="submit" class="btn btn-success" value="Send message">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="menu1" class= "panel panel-default tab-pane fade">

                        <div class="panel-body message">
                            <div class="message-title">Sent Messages :
                            </div>
                            <div class="attachments">
                                <ul>
                                    <?php
                                    $result =getSentMails($_SESSION['email']);
                                    $nor = $result->num_rows;
                                    if ($nor <=0){
                                    echo' <li><span class="label label-danger">No Messages</span> </li>';

                                    }
                                    else {
                                    for ($i = 0; $i < $nor; $i++) {
                                    $row = $result->fetch_array();
                                    echo '<li>';
                                        //echo " <option value= '$row[0]''>" . $row[2] . " " . $row[3] . "</option>";
                                        if ($row['is_read']==0){
                                        echo '<span class="label label-danger">Unread</span>';
                                        }

                                        echo'   <b>'.$row['subject'].'</b> <i>( '.$row['to'].' )</i>
                                        <span class="quickMenu">
                                    <a href="#" class="fas fa-envelope-open-text" onclick="openMsg()"><i></i></a>
                                        <a href="#" class="fas fa-trash delete-message" data-id="'.$row[0].'"><i></i></a> </span>
                                    </li>';
                                    }

                                    }

                                    ?>

                                </ul>
                            </div>
                            <div id="sent-opened-msg" style="display: none;">
                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <div class="message-title" id="msg-title">
                                        </div>
                                    </div>
                                </div>

                                <div class="header" id="msg-header">


                                    <div class="from">
                                        <span id="reciver-name"></span>
                                        <span id="reciver-email"> </span>
                                    </div>

                                </div>
                                <div class="content">
                                    <p id="msg-content">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>




