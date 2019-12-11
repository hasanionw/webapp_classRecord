<?php 
require "connect.php";

$courseCode = $_POST["courseCode"];
$courseDesc = $_POST["courseDesc"];
$teacher = $_POST["teacher"];

$sql = "INSERT INTO classes (`courseCode`, `courseDesc`, `teacher_id`) VALUES ('$courseCode', '$courseDesc', '$teacher')";
$result = $con->query($sql);

if($result){
    echo json_encode("success");
}else{
    echo mysqli_error($con);
    echo json_encode("error");
}

?>