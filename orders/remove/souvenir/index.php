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

$app->post('/', function(Request $request, Response $response) {
	$token=$request->getHeader("Authorization")[0];
	if(!Auth::isAuthorized($token)){
		return $response->withStatus(401);
		
	}
	$orders=Orders::removeSouvenirOrder($request->getBody());
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

