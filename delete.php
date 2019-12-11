<?php 
require "connect.php";

$id_num = $_POST["id"];

$sql = "DELETE FROM students WHERE id_num = $id_num";
$query = $con->query($sql);

if($query){
    echo json_encode("success");
}else{
    echo json_encode("error");
}
?>