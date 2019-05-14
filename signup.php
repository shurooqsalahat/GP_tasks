<?php
include("model.php");// connect to db

session_start();


?>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WpF Degree : Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="img/wpf-favicon.png"/>

    <!-- CSS
    ================================================== -->
    <!-- Bootstrap css file-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file-->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Superslide css file-->
    <link rel="stylesheet" href="css/superslides.css">
    <!-- Slick slider css file -->
    <link href="css/slick.css" rel="stylesheet">
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet prefetch'
          href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>
    <!-- smooth animate css file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/animate.css">
    <!-- preloader -->
    <link rel="stylesheet" href="css/queryLoader.css" type="text/css"/>
    <!-- gallery slider css -->
    <link type="text/css" media="all" rel="stylesheet" href="css/jquery.tosrus.all.css"/>
    <!-- Default Theme css file -->
    <link id="switcher" href="css/themes/default-theme.css" rel="stylesheet">
    <!-- Main structure css file -->
    <link href="style.css" rel="stylesheet">
    <link href="log-in.css" rel="stylesheet">
    <script src="js/controller.js"> </script>
    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="js/controller.js"></script>
    <![endif]-->

</head>
<?php include "out_header.php";?>

<div class="main">
    <section class="signup">
        <div class="container">
            <?php
            if (isset($_SESSION['Message'])) {
                if ($_SESSION['Message'] == 'This Data is Required' || $_SESSION['Message'] == "Password not match"
                    || $_SESSION['Message'] == "Password Must be 8 digits or more" ||
                    $_SESSION['Message'] == "Check phone structure" || $_SESSION['Message'] = "This user not Exist Signup pleased") {

                    $msg = "<div class=\"alert alert-danger\">
            <a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>OOPS!</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
                } else {
                    $msg  = "<div class=\"alert alert-success\">
            <a class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
            <strong>Good</strong> <span id=\"failed-text\">" . $_SESSION['Message'] . "</span>
        </div>";
                }
            }
            unset($_SESSION['Message']);
            ?>
            <div class="form-line row">
                <div class="col-sm-12">
                    <?php if (isset($msg ))
                        echo $msg ; ?>
                </div>
            </div>
            <div class="signup-content">

                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form action="controller.php" method="REQUEST" class="register-form" id="register-form">
                        <div class="form-group">
                            <input name="src" value="signup" type="hidden"/>
                            <label for="name"><i class="fa fa-user"></i></label>
                            <input type="text" name="first" id="name" placeholder="First name Name">
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="fa fa-user"></i></label>
                            <input type="text" name="last" id="name" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="fa fa-phone"></i></label>
                            <input type="number" name="phone" id="phone" placeholder="phone">
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fa fa-envelope"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="fa fa-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="fa fa-lock"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password">
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register">
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="img/signup-image.jpg" alt="sing up image"></figure>
                    <a href="login.php" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>

</div>