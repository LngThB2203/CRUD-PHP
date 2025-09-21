<?php
namespace App\Models;
use App\Models\Model;
// include "Model.php";
class ProductModel extends Model{
    protected $table = "products";
    private $conn;

    public function __construct(){
        $this->conn = new Model();
    }
        
    public function getAllProducts(){
        $sql = "SELECT p.*, c.name AS category_name
            FROM $this->table AS p
            JOIN categories AS c ON p.category_id = c.id";;
        $this->conn->setSql($sql);
        return $this-> conn -> all();
    }

    public function addProduct($id, $name, $price, $image, $quantity, $status, $category_id){
        $sql = "INSERT INTO $this->table(`id`, `name`, `price`, `image`, `quantity`, `status`, `category_id`) 
        VALUES (?,?,?,?,?,?,?)"; 
        $this->conn->setSql( $sql);
        return $this->conn->execute([$id, $name, $price, $image, $quantity, $status, $category_id]);
    }
    
    public function deleteProduct($id){
        $sql = "DELETE FROM $this->table WHERE id = ?"; 
        $this->conn->setSql( $sql);
        return $this->conn->execute([$id]);
    }
    
    public function getIDProduct($id){
        $sql = "SELECT p.*, c.name AS category_name
            FROM $this->table AS p
            JOIN categories AS c ON p.category_id = c.id
            WHERE p.id = ?";
        $this->conn->setSql( $sql);
        return $this->conn->first([$id]);
    }
    public function updateProduct($name, $price, $image, $quantity, $status, $id, $category_id){
        $sql = "UPDATE $this->table SET 
        `name`= ?,
        `price`= ?,
        `image`= ?,
        `quantity`= ?,
        `status`= ?,
        `category_id` =?
        WHERE `id`= ?"; // Câu lệnh Sql
        $this->conn->setSql( $sql);
        return $this->conn->execute([$name, $price, $image, $quantity, $status, $id, $category_id]);
    }
}
