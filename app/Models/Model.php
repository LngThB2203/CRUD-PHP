<?php
//Tạo namespace : 
namespace App\Models;
use PDO;
use PDOException;
use Exception;
class Model
{
    // //Kết nối CSDL
    // private $host = "localhost";
    // private $dbname = "web3014.01";
    // private $username = "root";
    // private $password = "";
    //Thuộc tính chứa kết nối CSDL
    private $pdo;
    //Thuộc tính chứa câu lệnh sql 
    private $sql;
    //Thuộc tính chứa kết quả thực hiện câu lệnh
    private $sta;
    public function __construct(){
        $this-> pdo = $this->connect();
    }
    // Hàm
    protected function connect(){
        try {
        $conn = new PDO(
            "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}",
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]
        );

        // code test
        // if($conn){
        //     return "Kết nối thành công";            
        // }
        return $conn;
        } catch (PDOException $e) {
            throw new Exception("Connection failed:". $e->getMessage());
        }
    }
    protected function setSql($sql){
        $this->sql = $sql;
    }

    protected function execute($option= []){
        try {
            $this->sta = $this->pdo->prepare($this->sql);
            if(!empty($option)){
                foreach($option as $key =>$value){
                    $this->sta->bindValue($key+1, $value);
                }
            }
            $this-> sta ->execute();
            return $this-> sta;
        } catch (PDOException $e) {
            throw new Exception("Error executing query:". $e->getMessage());
        }
    }

    //phuơng thức giúp truy vấn dữ liệu
    //Có nhiều bản ghi
    //Có 1 bản ghi
    //Đặt 2 hằng số dùng để phân biệt 2 trạng thái của fetch
    const FETCH_ALL = "all";
    const FETCH_FIRST = 'first';
    private function executeQuery($option =[], $fethModel = self::FETCH_ALL){
        //mặc định trạng thái truy vấn là lấy nhiều bản ghi
        $result = $this->execute($option);
        if(!$result){
            return false;
        }else {
            return $fethModel == self::FETCH_ALL 
            ? $result->fetchAll(PDO::FETCH_OBJ)
            : $result->fetch(PDO::FETCH_OBJ);
        }
    }

    protected function all($option = []){
        return $this-> executeQuery(option:$option);
    }

    protected function first($option = []){
        return $this-> executeQuery($option, self::FETCH_FIRST);
    }
}
?>