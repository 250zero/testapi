<?php

$routes = require_once '../App/route.php';
$current_route = $_SERVER['REQUEST_URI'];
$current_http_method = $_SERVER['REQUEST_METHOD'];
if (array_key_exists($current_route, $routes)) {
    if (array_key_exists($current_http_method, $routes[$current_route])) {
        
        $route_parts = explode('@', $routes[$current_route][$current_http_method]);
        
        $controller_route = $route_parts[0];
        $method = $route_parts[1]; 

        require_once "../App/Controller/{$controller_route}.php";

        $controller = new $controller_route();
        echo $controller->$method();
    }else{
        http_response_code(405);
        print_r(json_encode(['message'=>'Method Not Allowed']));
    }
} else {
    http_response_code(404);
    print_r(json_encode(['message'=>'Not Found']));
}
