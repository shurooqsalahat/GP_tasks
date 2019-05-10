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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- for validation-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
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
                                    <label for="doctor">Doctor :</label>
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
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Amount</th>
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
                        <button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs dt-delete">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Layout for poster</td>
                    <td>2016/01/31</td>
                    <td>Planned</td>
                    <td>1834</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs dt-delete">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Image creation</td>
                    <td>2016/01/23</td>
                    <td>To Do</td>
                    <td>1500</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs dt-delete">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Create font</td>
                    <td>2016/02/26</td>
                    <td>Done</td>
                    <td>1200</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;">
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
        </div>
    </div>

    <!-- /#page-content-wrapper -->
</div>

</body>
