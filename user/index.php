<?php
require($_SERVER['DOCUMENT_ROOT'].'/planetary/vendor/autoload.php');
include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/user.php';
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
		return $response->withStatus(401)->write(json_decode($token));
		
	}
	$user=User::getUser(json_decode($token));
	return $response->withJson($user[0])->withHeader('Content-type', 'application/json');
});

$app->post('/', function(Request $request, Response $response) {
	
    $orders=User::createUser($request->getBody());
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
