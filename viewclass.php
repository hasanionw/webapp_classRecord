<?php require "connect.php";

$id = $_GET["id"];
$sql = "SELECT * FROM classes WHERE class_id = $id";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$title = $row["courseCode"];
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="icon/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><?php echo $title; ?> - Class Record</title>
    <style>
        ::-webkit-scrollbar {
            width: 0px !important;
        }

        header {
            display: flex;
            padding: 20px 80px;
            justify-content: space-between;
            align-items: center;
        }

        h4 {
            margin: 0 !important;
        }

        header > h4 > img {
            margin-right: 10px;
        }

        .mynav > ul {
            list-style: none;
            margin: 0;
        }

        .mynav > ul > li {
            display: inline;
            padding-left: 30px;
        }

        .mynav > ul > li > a.active {
            filter: brightness(70%);
        }

        hr {
            margin: 0;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fixedBody {
            max-height: 425px;
            overflow-y: auto;
        }

        .pointer {
            cursor: pointer;
        }

        .asdftable > thead > tr > th{
            font-weight: lighter;
        }

        .asdftable > tbody > tr > td {
            vertical-align: middle;
        }

        .asdfdiv {
            justify-content: space-between;
            align-items: center;
        }
    </style>
  </head>
  <body>
    <header class="bg-light">
        <h4 class="text-success font-weight-lighter"><img src="icon/logo.png" width="50" height="50" alt="">Class Record</h4>
        <nav class="mynav">
            <ul>
                <li><a href="index.php" class="text-success active">Classes</a></li>
                <li><a href="students.php" class="text-success">Students</a></li>
                <li><a href="#" class="text-danger" id="logoutBtn">Logout</a></li>
            </ul>
        </nav>
    </header>
    <hr>
    <div class="container mt-5">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <h4 class="card-title d-inline"><i><?php echo $row["courseCode"] ?>: <?php echo $row["courseDesc"] ?></i></h4>
                    <button class="btn btn-outline-danger float-right" id="backBtn">< Go back</button>
                </div>
                <div class="card-body fixedBody">
                    <p>Teacher: <b>
                    <?php 
                        $sql = "SELECT * FROM teachers WHERE teacher_id = ".$row["teacher_id"];
                        $result = $con->query($sql);
                        $res = $result->fetch_assoc();
                        $selected = $row["teacher_id"];

                        echo $res["fname"]." ".$res["lname"]; 
                    ?>
                        </b><button class="btn btn-link text-warning btn-sm editTeacher" id="<?php echo $row["teacher_id"] ?>" data-toggle="modal" data-target="#editTeacherModal">Edit</button>
                    <?php
                    ?>
                    </p>
                    <div class="d-flex asdfdiv mb-3">
                        <h4 class="font-weight-lighter">List of students</h4>
                        <button class="btn btn-outline-primary d-inline" data-toggle="modal" data-target="#addStudentModal">+ Add student</button>
                    </div>
                    <table class="table asdftable text-center table-striped">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>#</th>
                                <th>ID Number</th>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>PMG</th>
                                <th>MG</th>
                                <th>PFG</th>
                                <th>FG</th>
                                <th>Update Grade</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $studentcount = 1;
                        $sql = "SELECT CL.*, S.fname, S.lname, S.yearlvl, S.course 
                        FROM classlist AS CL 
                        JOIN students AS S ON CL.student_id=S.id_num 
                        WHERE CL.class_id = $id";
                        $result = $con->query($sql);
                        if($result->num_rows > 0){
                            while($student = $result->fetch_assoc()){
                        ?>
                            <tr>
                                <td>
                                    <?php echo $studentcount; $studentcount++; ?>
                                </td>
                                <td>
                                    <?php echo $student["student_id"] ?>
                                </td>
                                <td>
                                    <?php echo $student["fname"]." ".$student["lname"] ?>
                                </td>
                                <td>
                                    <?php echo $student["course"] ?>
                                </td>
                                <td>
                                    <?php echo $student["yearlvl"] ?>
                                </td>
                                <td id="<?php echo $student["student_id"] ?>PMG">
                                    <?php
                                    if($student["PMG"]==0){
                                        echo "NG";
                                    }else if($student["PMG"] > 3.0 && $student["PMG"] < 3.5){
                                        echo "NC";
                                    }else if($student["PMG"] > 3.4){
                                        echo "5.0";
                                    }else{
                                        echo number_format($student["PMG"], 1);
                                    }
                                    ?>
                                </td>
                                <td id="<?php echo $student["student_id"] ?>MG">
                                    <?php
                                    if($student["MG"]==0){
                                        echo "NG";
                                    }else if($student["MG"] > 3.0 && $student["MG"] < 3.5){
                                        echo "NC";
                                    }else if($student["MG"] > 3.4){
                                        echo "5.0";
                                    }else{
                                        echo number_format($student["MG"], 1);
                                    }
                                    ?>
                                </td>
                                <td id="<?php echo $student["student_id"] ?>PFG">
                                <?php
                                    if($student["PFG"]==0){
                                        echo "NG";
                                    }else if($student["PFG"] > 3.0 && $student["PFG"] < 3.5){
                                        echo "NC";
                                    }else if($student["PFG"] > 3.4){
                                        echo "5.0";
                                    }else{
                                        echo number_format($student["PFG"], 1);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($student["PMG"] == 0 || $student["MG"] == 0 || $student["PFG"] == 0 ){
                                        echo "NG";
                                    }else if($student["FG"] > 3.0 && $student["FG"] < 3.5){
                                        echo "NC";
                                    }else if($student["FG"] > 3.4){
                                        echo "5.0";
                                    }else{
                                        echo number_format($student["FG"], 1);
                                    }
                                    ?>
                                </td>
                                <td><button class="btn btn-link text-warning updateModal" data-toggle="modal" data-target="#updateModal" id="<?php echo $student["student_id"] ?>">Update</button></td>
                                <td><button class="btn btn-link text-danger delBtn" name="<?php echo $student["student_id"] ?>">Delete</button></td>
                            </tr>
                        <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="student">Student</label>
                    <select name="student" id="student" class="form-control">
                    <?php 
                    $sql = "SELECT * FROM students";
                    $result = $con->query($sql);
                    if($result->num_rows > 0){
                        while($stud = $result->fetch_assoc()){
                    ?>
                        <option value="<?php echo $stud["id_num"] ?>">
                            <?php echo $stud["fname"]." ".$stud["lname"] ?>
                        </option>
                    <?php
                        }
                    }
                    ?>
                    </select>
                    <p id="classId" hidden><?php echo $id ?></p>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-4">
                            <label for="pmg">Pre-midterm Grade</label>
                            <input type="text" name="pmg" id="pmg" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="pmg">Midterm Grade</label>
                            <input type="text" name="mg" id="mg" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="pmg">Pre-final Grade</label>
                            <input type="text" name="pfg" id="pfg" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addStudentToClassBtn">Add</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="teacher">Teacher</label>
                    <select name="teacher" id="teacher" class="form-control">
                    <?php 
                    $sql = "SELECT * FROM teachers";
                    $result = $con->query($sql);
                    if($result->num_rows > 0){
                        while($teach = $result->fetch_assoc()){
                            if($teach["teacher_id"] == $selected){
                                ?>
                        <option value="<?php echo $teach["teacher_id"] ?>" selected="selected">
                            <?php echo $teach["fname"]." ".$teach["lname"] ?>
                        </option>
                                <?php
                            }else{
                                ?>
                        <option value="<?php echo $teach["teacher_id"] ?>">
                            <?php echo $teach["fname"]." ".$teach["lname"] ?>
                        </option>
                                <?php
                            }
                        }
                    }
                    ?>
                    </select>
                    <p id="classId2" hidden><?php echo $id ?></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateTeacher">Update</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-4">
                            <label for="pmg">PMG</label>
                            <input type="text" name="pmg" id="updatePmg" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="mg">MG</label>
                            <input type="text" name="mg" id="updateMg" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="pfg">PFG</label>
                            <input type="text" name="pfg" id="updatePfg" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" id="updateGradeBtn">Update Grade</button>
            </div>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        "use strict"

        $(document).ready(function(){
            console.log(navigator.appName)

            $("#classes").on("click", function(){
                window.location.href = "index.php"
            })

            $("#addStudentToClassBtn").on("click", function(){
                var student = $("#student").val(),
                id = $("#classId").text(),
                pmg = $("#pmg").val(),
                mg = $("#mg").val(),
                pfg = $("#pfg").val()

                $.ajax({
                    url: "addstudenttoclass.php",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        student: student, 
                        id: id,
                        pmg: pmg,
                        mg: mg,
                        pfg: pfg
                    },
                    success: function(info){
                        alert("Successfully added!")
                        location.reload();
                    },
                    error: function(){
                        alert("Student already exists!")
                    }
                })
            })

            $(".delBtn").on("click", function(){
                var r = confirm("Are you sure?")
                if(r == true){
                    var id = $(this).attr("name");
                    var class_id = $("#classId").text()
              
                    $.ajax({
                        url: "deletestudentinclass.php",
                        type: 'post',
                        dataType: 'json',
                        data: {id: id, class_id: class_id},
                        success: function(){
                            alert("Successfully deleted!")
                            location.reload();
                        },
                        error: function(){
                            alert("Error");
                        }
                    })
                }
            })

            $("#backBtn").on("click", function(){
                window.location.replace("index.php")
            });

            $("#updateTeacher").on("click", function(){
                var teacher = $("#teacher").val()
                var id = $("#classId2").text()

                $.ajax({
                    url: "updateteacher.php",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id,
                        teacher: teacher
                    },
                    success: function(){
                        alert("Update success!")
                        location.reload()
                    }
                })
            })

            $(".updateModal").on("click", function(){
                var thisId = $(this).attr("id")
                $("#updateModalTitle").text("Update "+thisId+"'s grade")
                var pmg = $("#"+thisId+"PMG").text()
                var mg = $("#"+thisId+"MG").text()
                var pfg = $("#"+thisId+"PFG").text()
                $("#updatePmg").val(pmg.trim())
                $("#updateMg").val(mg.trim())
                $("#updatePfg").val(pfg.trim())


                $("#updateGradeBtn").on("click", function(){
                    var class_id = $("#classId").text()
                    var pmgInt = $("#updatePmg").val()
                    var mgInt = $("#updateMg").val()
                    var pfgInt = $("#updatePfg").val()
                   
                    $.ajax({
                        url: "updategrade.php",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            class_id: class_id,
                            student_id: thisId,
                            pmg: pmgInt,
                            mg: mgInt,
                            pfg: pfgInt
                        },
                        success: function(){
                            alert("Successfully updated grade!")
                            location.reload()
                        },
                        error: function(){
                            alert("error")
                        }
                    })
                })
            })

            $("#logoutBtn").on("click", () => { 
                alert("Logout successful!")
                window.location.href = "login.php"
            })
        })
    </script>
  </body>
</html>
