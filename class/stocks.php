<?php
    class Stock{

        // Connection
        private $conn;

        // Table
        private $db_table = "Data";

        // Columns
        public $product_id;
        public $name;
        public $stock;
        public $created_date;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getStocks(){
            $sqlQuery = "SELECT product_id, name, stock, created_date FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createStock(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        stock = :stock,
                        created_date = :created_date";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->stock=htmlspecialchars(strip_tags($this->stock));
            $this->created_date=htmlspecialchars(strip_tags($this->created_date));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":stock", $this->stock);
            $stmt->bindParam(":created_date", $this->created_date);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // GET SINGLE PRODUCT
        public function getSingleStock(){
            $sqlQuery = "SELECT
                        product_id, 
                        name, 
                        stock,
                        created_date
                        FROM
                        ". $this->db_table ."
                        WHERE 
                        product_id = ?
                        LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->product_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->stock = $dataRow['stock'];
            $this->created_date = $dataRow['created_date'];
        }      

        // UPDATE
        public function updateStock(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        stock = :stock,
                        created_date = :created_date
                    WHERE 
                        product_id = :product_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->stock=htmlspecialchars(strip_tags($this->stock));
            $this->created_date=htmlspecialchars(strip_tags($this->created_date));
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":stock", $this->stock);
            $stmt->bindParam(":created_date", $this->created_date);
            $stmt->bindParam(":product_id", $this->product_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // DELETE
        function deleteStock(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE product_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
        
            $stmt->bindParam(1, $this->product_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>