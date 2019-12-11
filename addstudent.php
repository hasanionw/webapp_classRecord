<?php 
require "connect.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$m_init = $_POST["m_init"];
$course = $_POST["course"];
$year = $_POST["year"];

$sql = "INSERT INTO students (fname, lname, m_init, course, yearlvl) 
        VALUES ('$fname', '$lname', '$m_init', '$course', '$year')";

$query = mysqli_query($con, $sql);

if($query){
    echo json_encode("success");
}else{
    echo json_encode("error");
}
?>