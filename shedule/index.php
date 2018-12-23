<?php
require($_SERVER['DOCUMENT_ROOT'].'/planetary/vendor/autoload.php');
include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/shedule.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/auth.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
 
$app = new \Slim\App([
    "settings"  => [
        "determineRouteBeforeAppMiddleware" => true,
    ]
]);

$app->get('/', function (Request $request, Response $response) {
  $shedule=Shedule::getSheduleByDayId($_GET['day_id']);  
	//echo json_encode($shedule);
	$response = $response->withHeader('Content-type', 'application/json');
	$response = $response->withJson($shedule);
	return $response;
});

$app->post('/', function(Request $request, Response $response) {
	$token=$request->getHeader("Authorization")[0];
		if(!Auth::isAuthorized($token)){
		return $response->withStatus(401);
		
	}
	$orders=Shedule::createShedule($request->getBody());
});

$app->run();
?>