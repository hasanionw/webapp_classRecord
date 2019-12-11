<?php 
require "connect.php";

$id = $_POST["id"];

$qry = "DELETE FROM classlist WHERE class_id = $id";
$res = $con->query($qry);

if($res){
    $sql = "DELETE FROM classes WHERE class_id = '$id'";
    $result = $con->query($sql);

    if($result){
        echo json_encode("success");
    }else{
        echo json_encode("error");
    }
}

?>