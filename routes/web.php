<?php 
use Bramus\Router\Router;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
$router = new Router();
$router->get('/', function(){
    echo "123456789";
});
// Ct: $route->phuong_thuc('đường dẫn', Ten_class::class.'@ten_phương thức);
// Phương thức: get/post
$router->get('/product', ProductController::class . '@index');
$router->get('/product/home', ProductController::class . '@home');
$router->get('/product/create', ProductController::class . '@create');
$router->post('/product/store', ProductController::class . '@store');
$router->get('/product/delete/{id}', ProductController::class . '@delete');
$router->get('/product/edit/{id}', ProductController::class.'@edit');
$router->post('/product/edit/{id}', ProductController::class.'@update');

$router->get('/category', CategoryController::class . '@index');
$router->get('/category/create', CategoryController::class . '@create');
$router->post('/category/store', CategoryController::class . '@store');
$router->get('/category/edit/{id}', CategoryController::class . '@edit');
$router->post('/category/edit/{id}', CategoryController::class . '@update');
$router->get('/category/delete/{id}', CategoryController::class . '@delete');

$router->run();
?>