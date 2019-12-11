<?php require "connect.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="icon/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a06f703f0a.js" crossorigin="anonymous"></script>

    <title>Students - Class Record</title>
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

        .fixedBody::-webkit-scrollbar {
            width: 0px !important;
        }

        .fixedBody::-webkit-scrollbar-thumb {
            background: #FF0000;
        }
        
        .navCards {
            display: none;
        }

        .activeCard {
            display: block;
        }

        .asdf > th {
            font-weight: lighter;
        }

        .table td {
            vertical-align: middle !important;
        }

        .rounded-l {
            border-radius: 25px 25px 0;
            border-right: 0;
            padding-left: 15px;
        }

        .rounded-l::placeholder {
            font-size: .85rem;
            font-style: italic;
        }

        .rounded-r {
            border-radius: 25px;
            background-color: white;
            border-left: 0;
        }

        .form-control-no-border:focus {
            border-color:#ccc;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        #addNewStudent {
            flex: 1;
        }

        .input-group.ml-5 {
            flex: 4;
        }

        .card-title.d-inline {
            flex: 0;
        }

        .form-control.form-select {
            flex: 1;
            border-radius: 25px;
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
    <div class="container mt-5 navCards activeCard" id="studentCard">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Students</h4>
                <div class="input-group ml-5 mr-2">
                    <input type="text" class="form-control form-control-no-border rounded-l" id="searchInput" placeholder="Search students by ID number or by name...">
                    <div class="input-group-append">
                        <span class="input-group-text rounded-r"></span>
                    </div>
                </div>
                <select id="courseFilter" class="form-control form-select mr-2">
                    <option class="courseFilter" value="BSICT">BSICT</option>
                    <option class="courseFilter" value="BSIT">BSIT</option>
                    <option class="courseFilter" value="BSCS">BSCS</option>
                    <option class="courseFilter" value="BSIS">BSIS</option>
                    <option class="courseFilter" value="All" selected>All</option>
                </select>
                <button class="btn btn-outline-secondary btn-sm mr-5" id="searchbtn"><i class="fas fa-search"></i></button>
                <button class="btn btn-outline-success btn-sm mx-2 float-right" id="addNewStudent" data-toggle="modal" data-target="#addStudentModal">+ Add New Student</button>
            </div>
            <div class="card-body fixedBody">
                <table class="table" id="table">
                    <thead class="bg-success text-white text-center">
                        <tr class="asdf">
                            <th style="width: 10%">ID Number</th>
                            <th style="width: 20%">Student Name</th>
                            <th style="width: 15%">Course</th>
                            <th style="width: 10%">Year</th>
                            <th style="width: 10%">Update</th>
                            <th style="width: 10%">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php 
                            $sql = "SELECT * FROM students";
                            $query = mysqli_query($con, $sql);

                            while($row=mysqli_fetch_assoc($query)){
                        ?>
                        <tr class="tr">
                            <td><?php echo $row["id_num"] ?></td>
                            <td><a href="studyload.php?id=<?php echo $row["id_num"] ?>" class="btn btn-link text-success searchname" data-toggle="tooltip" data-placement="top" title="View grades" target="_blank"><?php echo $row["fname"]." ".$row["m_init"].". ".$row["lname"] ?></a></td>
                            <td class="coursesearch"><?php echo $row["course"] ?></td>
                            <td><?php echo $row["yearlvl"] ?></td>
                            <td><a href="update.php?id=<?php echo $row["id_num"] ?>" class="btn btn-link text-warning">Update</a></td>
                            <td><button class="btn btn-link text-danger deleteStudentBtn" href="#" id="<?php echo $row['id_num'] ?>">Delete</button></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="fade modal" tabindex="-1" role="dialog" id="addStudentModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-5">
                            <label for="fname">First name</label>
                            <input type="text" class="form-control" name="fname" id="fname" placeholder='e.g. "John"'>
                        </div>
                        <div class="col-sm-5">
                            <label for="lname">Last name</label>
                            <input type="text" class="form-control" name="lname" id="lname" placeholder='e.g. "Doe"'>
                        </div>
                        <div class="col-sm-2">
                            <label for="m_init">M.I.</label>
                            <select name="m_init" class="form-control" id="m_init">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                                <option value="K">K</option>
                                <option value="L">L</option>
                                <option value="M">M</option>
                                <option value="N">N</option>
                                <option value="Ñ">Ñ</option>
                                <option value="O">O</option>
                                <option value="P">P</option>
                                <option value="Q">Q</option>
                                <option value="R">R</option>
                                <option value="S">S</option>
                                <option value="T">T</option>
                                <option value="U">U</option>
                                <option value="V">V</option>
                                <option value="W">W</option>
                                <option value="X">X</option>
                                <option value="Y">Y</option>
                                <option value="Z">Z</option>
                                <option value="">N/A</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-10">
                            <label for="course">Course</label>
                            <input type="text" class="form-control" name="course" id="course" placeholder='e.g. "BSICT", "BSIT", "BSCS"'>
                        </div>
                        <div class="col-sm-2">
                            <label for="year">Year</label>
                            <select name="year" id="year" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-link text-success" id="addStudentBtn">Add Student</button>
            </div>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){         
            document.getElementById("searchbtn").addEventListener("click", () => {
                let i, 
                selectValue = document.getElementById("courseFilter").value, 
                tr = document.getElementsByTagName("tr"),
                searchInput = document.getElementById("searchInput"),
                filter = searchInput.value.toUpperCase(),
                nameTd, idTd, courseTd,
                filteredName, filteredId

                for(i = 0; i < tr.length; i++){
                    nameTd = tr[i].getElementsByClassName("searchname")[0]
                    idTd = tr[i].getElementsByTagName("td")[0]
                    courseTd = tr[i].getElementsByClassName("coursesearch")[0]

                    if(nameTd && courseTd || idTd && courseTd){
                        filteredName = nameTd.innerHTML || nameTd.textContent
                        filteredId = idTd.innerHTML || idTd.textContent
                        if(filteredName.toUpperCase().indexOf(filter) > -1 && courseTd.innerText == selectValue || filteredName.toUpperCase().indexOf(filter) > -1 && selectValue == "All" || filteredId.toUpperCase().indexOf(filter) > -1 && courseTd.innerText == selectValue || filteredId.toUpperCase().indexOf(filter) > -1 && selectValue == "All"){
                            tr[i].style.display = ""
                        }else{
                            tr[i].style.display = "none"
                        }
                    }
                }
            })

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $("#classes").on("click", function(){
                window.location.replace("index.php")
            })

            $(".deleteStudentBtn").on("click", function(){
                var id = $(this).attr("id")
                var r = confirm("Are you sure you want to delete this student and all the student's information?");
                if(r == true){
                    $.ajax({
                        url: "delete.php",
                        type: 'post',
                        dataType: 'json',
                        data: { id: id },
                        success: function(info){
                            alert("Student deleted.")
                            location.reload()
                            console.log(info)
                        },
                        error: function(){
                            alert("Error")
                        }
                    })
                }
            })

            $("#addStudentBtn").on("click", function(){
                var fname = $("#fname").val(),
                lname = $("#lname").val(),
                m_init = $("#m_init").val(),
                course = $("#course").val(),
                year = $("#year").val()

                $.ajax({
                    url: "addstudent.php",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        fname: fname,
                        lname: lname,
                        m_init: m_init,
                        course: course,
                        year: year,
                    },
                    success: function(){
                        alert("Successfully added student!")
                        location.reload()
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