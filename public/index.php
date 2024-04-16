<?php 
require_once '../autoload.php';

$routes = require_once '../App/route.php';

$current_raw_route = explode('?',$_SERVER['REQUEST_URI']) ;
$current_route = $current_raw_route[0];
if(empty($current_raw_route[1])){
    $current_uri_params =[];
}else{
    parse_str($current_raw_route[1],$current_uri_params);
}
 
$current_http_method = $_SERVER['REQUEST_METHOD'];


if (array_key_exists($current_route, $routes)) {
    if (array_key_exists($current_http_method, $routes[$current_route])) {
        
        $route_parts = explode('@', $routes[$current_route][$current_http_method]);
        
        $controller_route = $route_parts[0];
        $method = $route_parts[1]; 
         
        if(empty($current_uri_params)){
            $request_body = file_get_contents('php://input');    
            
            if(!is_array( $request_body)){
                $request_body = json_decode($request_body,true); 
            } 
        }else{
            $request_body =  $current_uri_params ;
        }

        $controller = new $controller_route();
        $response = $controller->$method($request_body);
        
        http_response_code($response['status']);
        echo json_encode($response['message']);
    }else{
        http_response_code(405);
        print_r(json_encode([ 'Method Not Allowed']));
    }
} else {
    http_response_code(404);
    print_r(json_encode([ 'Not Found']));
}
