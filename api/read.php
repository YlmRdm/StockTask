<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/db.php';
    include_once '../class/stocks.php';
    include_once '../config/error.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Stock($db);

    $stmt = $items->getStocks();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $stockArr = array();
        $stockArr = array(
            "code" => 0,
            "msg" => "success"
        );

        $stockArr["data"] = array();
        $stockArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "product_id" => $product_id,
                "name" => $name,
                "stock" => $stock,
                "created_date" => $created_date
            );
            array_push($stockArr["data"], $e);
        }
        echo json_encode($stockArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No stocks found.")
        );
    }
?>