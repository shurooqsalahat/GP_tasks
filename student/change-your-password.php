
<?php
include("../model.php");// connect to db
session_start();


?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tasks Tracker</title>
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tasks Tracker</title>
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS
    ================================================== -->
    <!-- Bootstrap css file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Font awesome css file:: for slider -->
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <!-- Superslide css file-->

    <link rel="stylesheet" href="../style.css">

    <script src="change-your-password.js"></script>
    <?php include "../header.php"?>
</head>

<header id="header">
</header>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <?php include "sidebar.php"?>
    </div>
    <div class="container" style="   margin-top: 30px;">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-1">
                <p class="text-left">
                <h3>Change Your Password:</h3></p>
                <form method="post" id="passwordForm">
                    <input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="New Password" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-6">
                            <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 Characters Long<br>
                            <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Uppercase Letter
                        </div>
                        <div class="col-sm-6">
                            <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Lowercase Letter<br>
                            <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Number
                        </div>
                    </div>
                    <input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Repeat Password" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-12">
                            <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Passwords Match
                        </div>
                    </div>
                    <input  onclick="validate_new_password()" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Change Password">
                </form>
            </div><!--/col-sm-6-->
        </div><!--/row-->
    </div>
</div>
