<?php
namespace App\Controllers;

use eftec\bladeone\BladeOne;

class Controller{
    protected function view($nameFile, $data=[]){
        //$nameFile : tên file view
        //$data : dữ liệu truyền vào view
        // include_once :
        //Xác định đường dẫn đến thưu mục views;
        $view = __DIR__ .'/../../resources/views';
        //Xác định đường dẫn nơi lưu trữ file biên dịch 
        $cache = __DIR__ .'/../../storage/cache';
        $bladeOne = new BladeOne($view, $cache, BladeOne::MODE_DEBUG);
        //Thực thi
        echo $bladeOne->run($nameFile, $data);
    }
}