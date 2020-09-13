<?php

header("Content-Type: application/json");

if(isset($_POST['limit'])){
    require_once "../../config/connection.php";
    include "functions.php";

    $limit = $_POST['limit'];
    $recepti = receptiSvi($limit); 
    
    echo json_encode($recepti);

} else {
    echo json_encode(["poruka"=> "Limit nije poslat."]);
    http_response_code(400); 
    zabeleziGreske($ex->getMessage());
}