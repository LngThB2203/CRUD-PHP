<?php
namespace App\Models;

use App\Models\Model;

class CategoryModel extends Model {
    protected $table = "categories";
    private $conn;

    public function __construct() {
        $this->conn = new Model();
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM $this->table";
        $this->conn->setSql($sql);
        return $this->conn->all();
    }

    public function getCategoryById($id) {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $this->conn->setSql($sql);
        return $this->conn->first([$id]);
    }

    public function addCategory($name, $image) {
        $sql = "INSERT INTO $this->table (`name`, `image`) VALUES (?,?)";
        $this->conn->setSql($sql);
        return $this->conn->execute([$name,$image]);
    }

    public function updateCategory( $name, $image,$id) {
        $sql = "UPDATE $this->table SET `name` = ?, `image` = ? WHERE `id` = ?";
        $this->conn->setSql($sql);
        return $this->conn->execute([$name, $image, $id]);
    }

    public function deleteCategory($id) {
        $sql = "DELETE FROM $this->table WHERE `id` = ?";
        $this->conn->setSql($sql);
        return $this->conn->execute([$id]);
    }
}
