<?php 
require "connect.php";

$id = $_POST["id"];
$class_id = $_POST["class_id"];

$sql = "DELETE FROM classlist WHERE class_id = $class_id && student_id = $id";
$result = $con->query($sql);

if($result){
    echo json_encode("success");
}
?>