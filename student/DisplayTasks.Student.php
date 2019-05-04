<?php
    require '../config.php';
?>

<html>
    <head>
        <?php include 'nav.Student.php'; ?>
        <?php include '../css/navstyle.php'; ?>
    </head>

    <body>
<div class="main">
        <div class="container">
            <br><br>
                        <div class="modal-body">
                            <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#Deliver" onclick="tasks()">Deliver Task</button>
                            <br><br>
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
                                    <th scope="col">State</th>

                                </tr>
                                </thead>
                                <tbody id="contain-body-table">
                                </tbody>
                            </table>
                            <script>
                                ajax();
                                function ajax() {
                                    var id = '<?php echo $_SESSION['id']; ?>';
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
                                    xhttp.open("POST", "../Doctor/DetailsStudentByid.php", true);
                                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhttp.send("id="+id);
                                }
                                function detailsStudent_table(json)
                                {
                                    for(var i = 0; i < json.length ; i++) {
                                        var tr = document.createElement('tr');
                                        var td = document.createElement('td');
                                        td.appendChild(document.createTextNode(i+1));
                                        tr.appendChild(td);
                                        for (var j = 0; j < 8; j++){
                                            var td = document.createElement('td');
                                            if(j==7) {
                                                var itag = document.createElement('i');
                                                if(json[i][3]!=null) {
                                                    itag.setAttribute('class','fas fa-check-double');
                                                    itag.setAttribute('style','color:green');
                                                } else {
                                                    itag.setAttribute('class','fas fa-times');
                                                    itag.setAttribute('style','color:red');
                                                }
                                                td.appendChild(itag);
                                            }
                                            else if( j > 4 && j < 7) {
                                                if (!json[i][j]) {
                                                    td.appendChild(document.createTextNode('---'));
                                                    td.setAttribute('style','color:red;font-weight:bold');
                                                } else {
                                                    var link = document.createElement('a');
                                                    if (j == 6)
                                                        link.href = '../tasks/Student/' + json[i][j] + '.txt';
                                                    else{
                                                        link.href = '../tasks/SuperVisor/' + json[i][j] + '.txt';
                                                        link.setAttribute('class','filetasks')
                                                    }
                                                    link.target = '_blank';
                                                    link.innerHTML = json[i][j];
                                                    td.appendChild(link);
                                                }
                                            }
                                            else {
                                                if(json[i][j])
                                                    td.appendChild(document.createTextNode(json[i][j]));
                                                else{
                                                    td.appendChild(document.createTextNode('---'));
                                                    td.setAttribute('style','color:red;font-weight:bold');
                                                }
                                            }
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

        </div>

        <!-- Modal -->
        <div class="modal fade" id="Deliver" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Deliver Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reload()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="DisplayTasks.php" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="file_task">Select Task:</label>
                                </div>
                                <select class="custom-select" name="file_task" id="file_task">

                                </select>
                            </div>
                            <br>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="file">Uplode Your File (.txt):</label>
                                </div>
                                <input type="file" name="task_file_up" id="file">
                            </div>
                            <script>
                                    function tasks() {
                                        var file_tasks = document.getElementsByClassName('filetasks');
                                        for(var i = 0; i < file_tasks.length;i++)
                                        {
                                            var option = document.createElement('option');
                                            var trans = ""+file_tasks[i];
                                            var arr = trans.split('/');
                                            var filltering = arr[arr.length-1];
                                            filltering = filltering.replace('.txt','');
                                            option.appendChild(document.createTextNode(filltering));
                                            option.value = filltering;
                                            document.getElementById('file_task').appendChild(option);
                                        }
                                    }
                                    function reload() {
                                        window.location.reload();
                                    }
                            </script>
                            <br>
                            <button type="submit" class="btn btn-primary">Deliver</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="reload()">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>

<?php
    if(isset($_POST['file_task']))
    {
        $value = $_POST['file_task'];
        $fileSuper = $value;
        $tmp_name = $_FILES["task_file_up"]["tmp_name"];
        $name = $value.''.$_SESSION['id'].'.txt';
        $name_on_update = $value.''.$_SESSION['id'];
        move_uploaded_file($tmp_name, "../tasks/Student/$name");
        $sql = 'UPDATE tasks SET fileStudent = "'.$name_on_update.'", deliveryOn = "'.date("Y/m/d").'" WHERE fileSupervisor = "'.$fileSuper.'" AND studentId = '.$_SESSION['id'];
        mysqli_query($conn, $sql);
        //echo $tmp_name . ' ' . $name . ' ' . $_SESSION['id'];
    }
?>