<?php
include("../model.php");// connect to db
session_start();

?>

<head>
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
    <!-- Slick slider css file :: for previous and next-->
    <link href="../css/slick.css" rel="stylesheet">
    <!-- Circle counter cdn css file -->
    <link rel='stylesheet prefetch'
          href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>
    <!-- smooth animate css file -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- Main structure css file -->

    <!-- for validation-->
    <script src="supervisor.js"></script>
    <link href="add-student.css" rel="stylesheet">

    <script>
        $(function(){
            $("#header").load("../header.html");
            $("#sidebar-wrapper").load("sidebar.html");

        });
    </script>
</head>

<header id="header">
</header>
<body>
<div class="modal fade" id="add_student_modal"  style="z-index: 2000">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Student</h4>
            </div>
            <div class="modal-body">
                    <div class="form-line row">
                        <div class="col-sm-12">
                            fill the form with student info :
                        </div>
                    </div>
                        <form id="add_student_form" action="../controller.php" method="REQUEST" method="post" >
                            <div class="form-line row">
                                <div class="col-sm-12">
                                    <label for="first_name">First Name:</label>
                                    <input name="src" value="addStudent" type="hidden"/>
                                    <input type="text" id="first_name" name="first"></input>
                                </div>
                            </div>
                            <div class="form-line row">
                                <div class="col-sm-12">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" id="last_name" name="last"></input>
                                </div>
                            </div>
                            <div class="form-line row">
                                <div class="col-sm-12">
                                    <label for="email">Email:</label>
                                    <input type="text" id="email" name="email"></input>
                                </div>
                            </div>

                            <div class="form-line row">
                                <div class="col-sm-12">
                                    <label for="phone">Phone:</label>
                                    <input type="tel" id="phone" name="phone"></input>
                                </div>
                            </div>
                            <div class="form-line row">
                                <div class="col-sm-12">
                                    <select name="doctor" id="doctor" class="required">
                                        <option value="0"> select Dctor</option>
                                        <?php
                                        $result = getAllDoctors();
                                        $nor = $result->num_rows;
                                        for ($i = 0; $i < $nor; $i++) {
                                            $row = $result->fetch_array();
                                            echo " <option value= '$row[0]''>" . $row[2] ." ".$row[3] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" name="submit" id="submit" onclick="form_submit()">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <!--            <div class="row">
                            <div class="alert alert-warning">
                                <strong>Warning!</strong> Please enter a valid value in all the required fields before proceeding.
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        </div>-->

            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Doctor</th>
                    <th style="text-align:center;width:100px;" >

                    </th>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Alphabet puzzle</td>
                    <td>2016/01/15</td>
                    <td>Done</td>
                    <td>1000</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs dt-edit" id="update-modal-btn">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs dt-delete">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>

                </tbody>
            </table>

            <div class="form-line row">
                <div class="col-sm-12 text-right">
                    <button type="button" id="MybtnModal" class="btn btn-primary">Add New Student</button>
                </div>
            </div>
            <!-- .modal -->
            <div class="modal fade" id="update_student_modal"  style="z-index: 2000">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Student Information</h4>
                        </div>
                        <div class="modal-body">
                            <form id="update_student_modal" action="../controller.php" method="" method="" >
                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <label for="first_name">First Name:</label>
                                        <input name="src" value="addStudent" type="hidden"/>
                                        <input type="text" id="u_first_name" name="first">
                                    </div>
                                </div>
                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" id="u_last_name" name="last">
                                    </div>
                                </div>
                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <label for="email">Email:</label>
                                        <input type="text" id="u_email" name="email">
                                    </div>
                                </div>

                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <label for="phone">Phone:</label>
                                        <input type="tel" id="u_phone" name="phone">
                                    </div>
                                </div>
                                <div class="form-line row">
                                    <div class="col-sm-12">
                                        <select name="doctor" id="u_doctor" class="required">
                                            <option value="0"> select Dctor</option>
                                            <?php
                                            $result = getAllDoctors();
                                            $nor = $result->num_rows;
                                            for ($i = 0; $i < $nor; $i++) {
                                                $row = $result->fetch_array();
                                                echo " <option value= '$row[0]''>" . $row[2] ." ".$row[3] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" name="submit" id="submit" onclick="update_submit()">Update</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- /#page-content-wrapper -->
</div>

</body>