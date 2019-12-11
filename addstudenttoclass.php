<?php 
require "connect.php";

$student = $_POST["student"];
$id = $_POST["id"];
$pmg = $_POST["pmg"];
$mg = $_POST["mg"];
$pfg = $_POST["pfg"];

if(empty($pmg)){
    $pmg = 0;
}

if(empty($mg)){
    $mg = 0;
}

if(empty($pfg)){
    $pfg = 0;
}

$fg = ($pmg+$mg+$pfg)/3;

$sql = "INSERT INTO classlist (class_id, student_id, PMG, MG, PFG, FG) VALUES ('$id', '$student', '$pmg', '$mg', '$pfg', '$fg')";
$result = $con->query($sql);

if($result){
    echo json_encode("success");
}

?>