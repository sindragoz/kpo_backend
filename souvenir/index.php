<?php
require($_SERVER['DOCUMENT_ROOT'].'/planetary/vendor/autoload.php');
include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/souvenir.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/auth.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
 
$app = new \Slim\App([
    "settings"  => [
        "determineRouteBeforeAppMiddleware" => true,
    ]
]);

$app->get('/', function (Request $request, Response $response) use ($app){
    $orders=Souvenir::getSouvenirs();
	$response = $response->withHeader('Content-type', 'application/json');
	$response = $response->withJson($orders);
	return $response;
});

$app->post('/', function(Request $request, Response $response) {
		$token=$request->getHeader("Authorization")[0];
		if(!Auth::isAuthorized($token)){
		return $response->withStatus(401);
		
	}
    echo json_decode($request->getBody())->login;
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

