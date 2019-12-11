<?php 
require "connect.php";
$id = $_GET["id"];

$sql = "SELECT * FROM students WHERE id_num = $id";
$result = $con->query($sql);
$data = $result->fetch_assoc();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="icon/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a06f703f0a.js" crossorigin="anonymous"></script>
    <title><?php echo $id ?> - Class Record</title>
    <style>
        header {
            display: flex;
            padding: 20px 80px;
            justify-content: space-between;
            align-items: center;
        }

        h4, h5 {
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

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
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
    <div class="content container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <?php echo $data["fname"]." ".$data["lname"] ?>
                    <small class="badge badge-success text-wrap"><?php echo $data["id_num"] ?></small>
                </h5>
                <a href="students.php" class="btn btn-outline-danger">< Go back</a>
            </div>
            <table class="table card-body">
                    <?php 
                    $sql = "SELECT CL.*, C.class_id, C.courseCode, C.courseDesc, C.teacher_id
                    FROM classlist as CL 
                    JOIN classes as C ON C.class_id = CL.class_id
                    WHERE CL.student_id = ".$data["id_num"];
                    $result = $con->query($sql);

                    if($result->num_rows > 0){
                        ?>
                <thead class="text-center bg-success text-white">
                    <tr>
                        <th>Class No.</th>
                        <th>Course Code</th>
                        <th>Course Description</th>
                        <th>Teacher</th>
                        <th>Midterm Grade</th>
                        <th>Final Grade</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php
                        while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row["class_id"] ?></td>
                        <td><?php echo $row["courseCode"] ?></td>
                        <td><?php echo $row["courseDesc"] ?></td>
                        <td>
                            <?php
                                $sql2 = "SELECT * FROM teachers WHERE teacher_id = ".$row["teacher_id"];
                                $result2 = $con->query($sql2);
                                $teacher = $result2->fetch_assoc();

                                echo $teacher["fname"]." ".$teacher["lname"];
                            ?>
                        </td>
                        <td>
                            <?php
                                if($row["MG"]==0){
                                    echo "NG";
                                }else if($row["MG"] > 3.0 && $row["MG"] < 3.5){
                                    echo "NC";
                                }else if($row["MG"] > 3.4){
                                    echo "5.0";
                                }else{
                                    echo number_format($row["MG"], 1);
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if($row["FG"]==0){
                                    echo "NG";
                                }else if($row["FG"] > 3.0 && $row["FG"] < 3.5){
                                    echo "NC";
                                }else if($row["FG"] > 3.4){
                                    echo "5.0";
                                }else{
                                    echo number_format($row["FG"], 1);
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        } 
                    ?>
                </tbody>
            </table>
                    <?php
                    }else{
                    ?>
                    <p class="text-center text-danger mt-4 mx-5"><i class="fas fa-exclamation-triangle mr-1"></i>This student is not enrolled in any course as of the moment!</p>
                    </table>
                    <?php
                    }
                    ?>
                
            
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $("#logoutBtn").on("click", () => { 
                alert("Logout successful!")
                window.location.href = "login.php"
            })
        })
    </script>

  </body>
</html>