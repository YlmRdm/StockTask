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

    $item->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();

    $item->getSingleStock();

    if($item->name != null){

        $emp_arr = array(
            "product_id" =>  $item->product_id,
            "name" => $item->name,
            "stock" => $item->stock,
            "created_date" => $item->created_date
        );
        http_response_code(200);
        echo json_encode($emp_arr);
    }
    else{
        http_response_code(404);
        echo json_encode("Data not found.");
    }
?>