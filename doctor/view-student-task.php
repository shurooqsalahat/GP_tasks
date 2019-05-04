<?php
    require '../config.php';
?>

<html>
    <head>
         <?php include 'nav-doctor.php'; ?>
        <?php include '../css/navstyle.php';?>
       
    </head>

    <body>
<div class="main">
        <div class="container">
            <br><br>
            <table class="table table-striped table-dark">
                <thead>
                    <tr style="background-color:#222;color: white;">
                        <th scope="col">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Show Tasks</th>
                     
                    </tr>
                </thead>
                <tbody>
                   <?php
        
                     
                     $sql = " SELECT u.id,u.fname,u.lname FROM users u INNER JOIN training t ON u.id = t.studentId WHERE t.doctorId = '$id'";
                     $result = mysqli_query($conn, $sql);
                     mysqli_fetch_all($result,MYSQLI_ASSOC);
                     $count = 0;
                        foreach ($result as $value){
                            echo '<tr>';
                            echo '<td scope="row">'.++$count.'</td>';
                            echo '<td scope="row">'.$value['fname']." ".$value['lname'].'</td>'; 
                            echo '<td scope="row"><button class="show-details btn btn-dark" data-toggle="modal" data-target="#exampleModal" data-id="'.$value['id'].'">Show</button></td>';
                            echo '</tr>';
                        }

?>

                </tbody>
            </table>

        </div>

        <!-- Modal -->
       <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="">Details Attachment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Details()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-dark">
                            <thead>
                            <tr style="background-color:#222;color: white;">
                                <th scope="col">#</th>
                                <th scope="col">Task Name</th>
                                <th scope="col">Weight Hour</th>
                                <th scope="col">Due To</th>
                                <th scope="col">Delivery On</th>
                                <th scope="col">Evaluation</th>
                                <th scope="col">File Task</th>
                                <th scope="col">File Deliver</th>
                            </tr>
                            </thead>
                            <tbody id="contain-body-table">
                            </tbody>
                        </table>
                        <script>
                            $(document).on("click", ".show-details", function () {
                                var id = $(this).data('id');
                                ajax();
                            });
                            function ajax() {
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        var json = JSON.parse(this.responseText);
                                        if(json.length>0)
                                            detailsStudent_table(json);
                                        else
                                            document.getElementById('pare').innerHTML += "no any details";
                                        //alert(json[0][0]);
                                        //document.getElementById('pare').innerHTML += this.responseText;
                                    }
                                };
                                xhttp.open("POST", "DetailsStudentByid.php", true);
                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                               
                            }
                            function detailsStudent_table(json)
                            {
                                for(var i = 0; i < json.length ; i++) {
                                    var tr = document.createElement('tr');
                                    var td = document.createElement('td');
                                    td.appendChild(document.createTextNode(i+1));
                                    tr.appendChild(td);
                                    for (var j = 0; j < 7; j++){
                                        var td = document.createElement('td');
                                        if( j > 4 && j < 7) {
                                            var link = document.createElement('a');
                                            if(j==6)
                                                link.href = '../tasks/Student/'+json[i][j]+'.txt';
                                            else
                                                link.href = '../tasks/SuperVisor/'+json[i][j]+'.txt';
                                            link.target = '_blank';
                                            link.innerHTML = json[i][j];
                                            td.appendChild(link);
                                        }
                                        else
                                            td.appendChild(document.createTextNode(json[i][j]));
                                        tr.appendChild(td);
                                    }
                                    document.getElementById('contain-body-table').appendChild(tr);
                                }
                            }
                            function Details() {
                                window.location.reload();
                            }
                        </script>
                        <p id="pare"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="Details()">Close</button>
                    </div>
        </div>
            </div>
    </div></div>
    </body>
</html>