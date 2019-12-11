<?php
require_once "connect.php";

$id_num =  $_GET["id"];
$sql = "SELECT * FROM students WHERE id_num = $id_num";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($query);
?>
<?php require "connect.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="icon/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Update <?php echo $id_num ?> - Class Record</title>
    <style>
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
        
        .navCards {
            display: none;
        }

        .activeCard {
            display: block;
        }
    </style>
  </head>
  <body>
    <header class="bg-light">
        <h4 class="text-success font-weight-lighter"><img src="icon/logo.png" width="50" height="50" alt="">Class Record</h4>
        <nav class="mynav">
            <ul>
                <li><a href="index.php" class="text-success">Classes</a></li>
                <li><a href="students.php" class="text-success active">Students</a></li>
                <li><a href="#" class="text-danger" id="logoutBtn">Logout</a></li>
            </ul>
        </nav>
    </header>
    <hr>
    <div class="container mt-5" id="newStudentCard">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Update <?php echo $row["id_num"] ?></h4>
                <button class="btn btn-outline-danger float-right" id="backBtn">< Go back</button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-3">
                            <label for="fname">First name</label>
                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $row["fname"] ?>">
                        </div>
                        <div class="col-sm-4">
                            <label for="lname">Last name</label>
                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $row["lname"] ?>">
                        </div>
                        <div class="col-sm-1">
                            <label for="m_init">M.I.</label>
                            <select name="m_init" id="m_init" class="form-control">
                                <?php
                                $initials = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",);
                                foreach($initials as $init){
                                    if($row["m_init"] == $init){
                                ?>
                                <option value="<?php echo $init ?>" selected><?php echo $init ?></option>
                                <?php
                                    }else{
                                ?>
                                <option value="<?php echo $init ?>"><?php echo $init ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="course">Course</label>
                            <input type="text" class="form-control" name="course" id="course" value="<?php echo $row["course"] ?>">
                        </div>
                        <div class="col-sm-1">
                            <label for="year">Year</label>
                            <select name="year" id="year" class="form-control">
                                <?php 
                                $yearlvls = array("1", "2", "3", "4");
                                foreach($yearlvls as $year){
                                    if($row["yearlvl"] == $year){
                                ?>
                                    <option value="<?php echo $year ?>" selected><?php echo $year ?></option>
                                <?php 
                                    }else{
                                ?>
                                    <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" id="updateBtn">Update</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $("#classes").on("click", function(){
                window.location.href="index.php";
            })

            $("#students, #backBtn").on("click", function(){
                window.location.href="students.php";
            })

            // $("#backBtn").on("click", function(){
            //     window.location.href="students.php";
            // })

            $("#updateBtn").on("click", function(){
                var fname = $("#fname").val();
                var lname = $("#lname").val();
                var m_init = $("#m_init").val();
                var course = $("#course").val();
                var year = $("#year").val();

                $.ajax({
                    url: "updatestudent.php",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: <?php echo $id_num ?>,
                        fname: fname,
                        lname: lname,
                        m_init: m_init,
                        course: course,
                        year: year,
                    },
                    success: function(info){
                        alert("Successfully updated "+info+"!");
                        window.location.href="students.php";
                    }
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
