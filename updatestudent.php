<?php 
require "connect.php";

$id = $_POST["id"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$m_init = $_POST["m_init"];
$course = $_POST["course"];
$year = $_POST["year"];

$sql = "UPDATE students SET fname='$fname', lname='$lname', m_init='$m_init', course='$course', yearlvl='$year' WHERE id_num=$id";

$query = mysqli_query($con, $sql);
if($query){
    echo json_encode($id);
}else{
    echo json_encode("error");
}

?>