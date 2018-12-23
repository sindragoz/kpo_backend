<?php
require($_SERVER['DOCUMENT_ROOT'].'/planetary/vendor/autoload.php');
include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/orders.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/auth.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
 
$app = new \Slim\App([
    "settings"  => [
        "determineRouteBeforeAppMiddleware" => true,
    ]
]);

$app->get('/', function (Request $request, Response $response) use ($app){
	$token=$request->getHeader("Authorization")[0];
	if(!Auth::isAuthorized($token)){
		return $response->withStatus(401);	
	}
	$user_id=$_GET['user_id'];
    $orders=Orders::getSeatOrders($user_id);
	$response = $response->withHeader('Content-type', 'application/json');
	$response = $response->withJson($orders);
	return $response;
});

$app->post('/', function(Request $request, Response $response) {
	$token=$request->getHeader("Authorization")[0];
	if(!Auth::isAuthorized($token)){
		return $response->withStatus(401);
		
	}
    $orders=Orders::createSeatOrder($request->getBody());
});

$app->run();
/*
{
  "login":"Dan",
  "password":"1",
  "name":"Danil"
}
*/
?>

