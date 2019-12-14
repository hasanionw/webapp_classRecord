<?php 
require "connect.php";

$courseCode = $_POST["courseCode"];
$courseDesc = $_POST["courseDesc"];
$teacher = $_POST["teacher"];

$sql = "INSERT INTO classes (`courseCode`, `courseDesc`, `teacher_id`) VALUES ('$courseCode', '$courseDesc', '$teacher')";
$result = $con->query($sql);

if($result){
    echo json_encode("success"); // Mao ni dawaton sa success function sa ajax
}else{
    echo mysqli_error($con);
    echo json_encode("error");  // Mao ni dawaton sa error function sa ajax
}

?>