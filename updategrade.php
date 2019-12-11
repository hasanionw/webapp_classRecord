<?php
require "connect.php";

$class_id = $_POST["class_id"];
$student_id = $_POST["student_id"];

if($_POST["pmg"] == 0 || $_POST["pmg"] == "" || $_POST["pmg"]== "NG"){
    $pmg = 0.0000000001;
}else{
    $pmg = $_POST["pmg"];
}

if($_POST["mg"] == 0 || $_POST["mg"] == "" || $_POST["mg"]== "NG"){
    $mg = 0;
}else{
    $mg = $_POST["mg"];
}

if($_POST["pfg"] == 0 || $_POST["pfg"] == "" || $_POST["pfg"]== "NG"){
    $pfg = 0;
}else{
    $pfg = $_POST["pfg"];
}

$fg = ($pmg + $mg + $pfg)/3;

$sql = "UPDATE classlist SET PMG=$pmg, MG=$mg, PFG=$pfg, FG=$fg WHERE class_id=$class_id && student_id=$student_id";
$result = $con->query($sql);

if($result){
    echo json_encode("success");
}

?>