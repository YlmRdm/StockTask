<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/db.php';
    include_once '../class/stocks.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Stock($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->product_id = $data->product_id;
    
    // Data values
    $item->name = $data->name;
    $item->stock = $data->stock;
    $item->created_date = date('Y-m-d H:i:s');
    
    if($item->updateStock()){
        echo json_encode("Data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>