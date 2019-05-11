<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>website Name</title>
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>website Name</title>
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS
    ================================================== -->
    <!-- Bootstrap css file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome css file:: for slider -->
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <!-- Superslide css file-->
    <link rel="stylesheet" href="../css/superslides.css">
    <link rel="stylesheet" href="../style.css">
    <!-- Slick slider css file :: for previous and next-->
    <link href="../css/slick.css" rel="stylesheet">
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet prefetch'
          href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>
    <!-- smooth animate css file -->
    <link rel="stylesheet" href="../css/animate.css">

    <script src="supervisor-info.js"></script>
    <link href="supervisor-information.css" rel="stylesheet">

    <script>
        $(function () {
            $("#header").load("../header.html");
            $("#sidebar-wrapper").load("sidebar.html");

        });
    </script>
</head>

<header id="header">
</header>


<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div class="form-line row">
        <div class="col-md-4 py-5 bg-primary text-white text-center" style="height: 464px;">
            <div class="card-body" style="margin-top: 28px;">
                <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                <h2 class="py-3">Welcome {{supervisor name}}</h2>
                <p>In this page you can see your information and update them.

                </p></div>
        </div>
        <div class="col-md-8 py-5 border" style="margin-top: 17px;">
                    <h4 class="pb-4" style="margin-top: 59px;">Your Information</h4>
                    <form>
                        <div class="form-line row">
                            <div class=" col-md-2">
                                First Name
                            </div>

                            <div class=" col-md-6">
                                <input id="first_name" name="First Name" placeholder="First Name" class="form-control" type="text">
                            </div>
                            <div class=" col-md-2" id="first-name-btn">
                                <button class="update"   type='button'onclick="updateField('first_name')"><span><i class="fa fa-pencil"></i></span>
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="form-line row">
                            <div class=" col-md-2">
                                Last Name
                            </div>

                            <div class=" col-md-6">
                                <input id="last_name" name="last_name" placeholder="Last Name" class="form-control" type="text">
                            </div>
                            <div class=" col-md-2">
                                <button class="update"  type='button' onclick="updateField('last_name')"><span><i class="fa fa-pencil"></i></span>
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="form-line row">
                            <div class=" col-md-2">
                                Phone No.
                            </div>

                            <div class=" col-md-6">
                                <input id="phone" name="phone" placeholder="phone" class="form-control" type="text">
                            </div>
                            <div class=" col-md-2">
                                <button class="update" type='button' onclick="updateField('phone')"><span><i class="fa fa-pencil"></i></span>
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="form-line row" style="margin-bottom: 162px;">
                            <div class=" col-md-2">
                                Email
                            </div>

                            <div class=" col-md-6">
                                <input id="email" name="email" placeholder="Email" class="form-control" type="text">
                            </div>
                            <div class=" col-md-2">
                                <button class="update" type='button'onclick="updateField('email')"><span><i class="fa fa-pencil"></i></span>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="buttons">
                            <button class="add" type='button'>Save Changes</button>
                            <button class="like" type='button' onclick="cancel()"><span>Cancel</span></button>
                        </div>
                    </form>







        </div>
    </div>

</div>

