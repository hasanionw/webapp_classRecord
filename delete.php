<?php 
require "connect.php";

$id_num = $_POST["id"];

$sql = "DELETE FROM classlist WHERE student_id = $id_num";
$query = $con->query($sql);

if($query){
    $sql1 = "DELETE FROM students WHERE id_num = $id_num";
    $res = $con->query($sql1);

    if($res){
        echo json_encode("success");
    }else{
        echo json_encode("error");
    }
}else{
    echo json_encode("error");
}
?>