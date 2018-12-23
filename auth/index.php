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

$app->post('/', function(Request $request, Response $response) use ($app) {
	if(array_key_exists('unauth', $_GET)){
		$token=$request->getHeader("Authorization")[0];
		$result=Auth::Unauthorize($token);
		return $response->write($result);
	}
    $login=json_decode($request->getBody())->login;
	$pass=json_decode($request->getBody())->password;
	$i=Auth::Authorize($login,$pass);
	if($i==null){
		$response=$response->withStatus(400);
        $response=$response->write("Bad login");
		return $response;
	}
	else
		return $response->withHeader('Content-type', 'application/json')->withJson($i);
});
$app->run();
?>



