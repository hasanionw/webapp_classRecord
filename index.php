<?php require "connect.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="icon/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Classes - Class Record</title>
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
    </style>
  </head>
  <body>
  <header class="bg-light ">
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
    <div class="container navCards activeCard mt-5" id="classCard">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Classes</h4>
                <button class="btn btn-outline-primary btn-sm mx-2 float-right" id="addNewClass" data-toggle="modal" data-target="#addClassModal">+ Add New Class</button>
            </div>
            <div class="card-body fixedBody">
                <div class="card-columns">
                    <?php
                    $sql = "SELECT * FROM classes";
                    $result = $con->query($sql);

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                    ?>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header bg-success text-white">
                                <h4 class="card-title"><?php echo $row["courseCode"] ?></h4>
                                <small class="card-category badge badge-dark text-wrap"><?php echo $row["courseDesc"] ?></small>
                            </div>
                            <div class="card-body">
                                Teacher: <?php 
                                    $sql1 = "SELECT fname, lname FROM teachers WHERE teacher_id = ".$row["teacher_id"]."";
                                    $data = $con->query($sql1);
                                    $res = $data->fetch_assoc();
                                    
                                    echo $res["fname"]." ".$res["lname"];                                    
                                ?>
                                <br>
                                # of students: <?php 
                                    $sql = "SELECT COUNT(*) AS count FROM classlist WHERE class_id = ".$row["class_id"];
                                    $resultnum = $con->query($sql);
                                    while($num = $resultnum->fetch_assoc()){
                                        echo $num['count'];
                                    }
                                ?>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-outline-primary btn-sm viewClassBtn" id="<?php echo $row["class_id"] ?>">View</button>
                                <button class="btn btn-outline-danger btn-sm deleteClassBtn" id="<?php echo $row["class_id"] ?>">Delete</button>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="fade modal" tabindex="-1" role="dialog" id="addClassModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="courseCode">Course Code</label>
                    <input type="text" class="form-control" name="courseCode" id="courseCode">
                </div>
                <div class="form-group">
                    <label for="courseDesc">Course Description</label>
                    <input type="text" class="form-control" name="courseDesc" id="courseDesc">
                </div>
                <div class="form-group">
                    <label for="teacher">Teacher</label>
                    <select name="teacher" id="teacher" class="form-control">
                        <?php 
                        $sql = "SELECT * FROM teachers";
                        $result = $con->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                ?>
                        <option value="<?php echo $row["teacher_id"] ?>"><?php echo $row["fname"]." ".$row["lname"] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-link text-success" id="addClassBtn">Add Class</button>
            </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $.fn.removeCard = function(){
                $(this).removeClass("activeCard");
            }

            $.fn.addActive = function(){
                $(this).addClass("activeCard");
            }
            
            $("#classes").on("click", function(){
                $(".navCards").removeCard();
                $("#classCard").addActive();
            })

            $("#students").on("click", function(){
                var url = "students.php";
                $(location).attr('href', url);
            })

            $("#addNewStudent").on("click", function(){
                $(".navCards").removeCard();
                $("#newStudentCard").addActive();
            })

            $("#addClassBtn").on("click", function(){
                var courseCode = $("#courseCode").val();
                var courseDesc = $("#courseDesc").val();
                var teacher = $("#teacher").val();
                $.ajax({
                    url: "addclass.php",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        courseCode: courseCode,
                        courseDesc: courseDesc,
                        teacher: teacher
                    },
                    success: function(info){
                        alert("Success!");
                        location.reload();
                        console.log(info);
                    }
                });
            });

            $(".deleteClassBtn").on("click", function(){
                var id = $(this).attr("id");
                var r = confirm("Are you sure you want to delete this class?");
                if(r == true){
                    $.ajax({
                        url: "deleteclass.php",
                        type: 'post',
                        dataType: 'json',
                        data: {id: id},
                        success: function(info){
                            alert("Delete successful!");
                            location.reload();
                            console.log(info);
                        },
                        error: function(info){
                            alert("Error in deleting!");
                            console.log(info);
                        }
                    })
                }
            })

            $(".viewClassBtn").on("click", function(){
                var id = $(this).attr("id");
                window.location.href = "viewclass.php?id="+id;
            })

            $("#logoutBtn").on("click", () => { 
                alert("Logout successful!")
                window.location.href = "login.php"
            })
        });
    </script>
  </body>
</html>