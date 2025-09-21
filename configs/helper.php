<?php 
// Hỗ trợ load ảnh
if(!function_exists('storage')){
    function storage($fileName){
         $path = str_replace(
            basename($_SERVER['SCRIPT_NAME']),'', $_SERVER['SCRIPT_NAME']
         );
         return !empty($fileName) 
         ? $path.'storage/uploads/'.$fileName 
         : '';
    }
}
// Hỗ trợ router
if(!function_exists('route')){
    function route($nameUrl, $param = []){
        if(count($param) > 0){
            foreach($param as $key => $value){
                $path = str_replace(
                    "{".$key."}", 
                    $value, 
                    $nameUrl);
            }
        }else{
            $path = $nameUrl;
        }
        $scriptPath = str_replace(
            basename($_SERVER['SCRIPT_NAME']),'', $_SERVER['SCRIPT_NAME']
         );
         return $_SERVER['REQUEST_SCHEME'].'://'
         .$_SERVER['HTTP_HOST'].$scriptPath.$path;
    }
}
// Thông báo
if(!function_exists('flash')){
    function flash($key, $msg, $route){
        $_SESSION[$key] = $msg;
         switch($key){
            case 'success':
                unset($_SESSION['errors']);
                break;
            case 'erorrs':
                unset($_SESSION['success']);
                break;          
        }
        header('location:'.route($route).'?msg='.$key);
        die;
    }
}
?>