<?php 
//MVC
//Model
//View
//Controller
// include_once "app/Models/Model.php";
// $model = new Model();
// var_dump(value: $model->connect());
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "vendor/autoload.php";
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(paths: __DIR__);
use App\Models\ProductModel;
session_start();
$dotenv ->load();
include_once 'routes/web.php';
// $pro =new ProductModel();
// var_dump(value:$pro ->getAllProducts());
?>