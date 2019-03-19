<?php
require($_SERVER['DOCUMENT_ROOT'].'/planetary/vendor/autoload.php');
include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/news.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/auth.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
 
$app = new \Slim\App([
    "settings"  => [
        "determineRouteBeforeAppMiddleware" => true,
    ]
]);

$app->get('/', function (Request $request, Response $response) use ($app){
    $news=News::getNews();
	$response = $response->withHeader('Content-type', 'application/json');
	if(array_key_exists('id',$_GET))
	$response = $response->withJson(News::getNewsById($_GET['id']));
	else{
	$response = $response->withJson(News::getNews());
	}
	return $response;
});

$app->post('/', function(Request $request, Response $response) {
	$token=$request->getHeader("Authorization")[0];
	if(!Auth::isAuthorized($token)){
		return $response->withStatus(401);
		
	}
    $news=News::createNews($request->getBody());
});

$app->run();
?>

