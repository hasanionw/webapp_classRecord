<?php
require "connect.php";

$id = $_POST["id"];
$teacher = $_POST["teacher"];

$sql = "UPDATE classes SET teacher_id = $teacher WHERE class_id = $id";
$result = $con->query($sql);

if($result){
    echo json_encode("success");
}
?>