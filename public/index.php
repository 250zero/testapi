<?php 

$routes = require_once '../App/route.php';
$current_route = $_SERVER['REQUEST_URI'];

if( array_key_exists($current_route,$routes)){
    $route_parts = explode('@',$routes[$current_route]);
    $controller_route = $route_parts[0];
    $method = $route_parts[1];
   
    require_once "../App/Controller/{$controller_route}.php";

    $controller = new $controller_route(); 
    echo $controller->$method(); 
}else{
    http_response_code(404); 
}
