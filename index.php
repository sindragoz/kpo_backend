<?php
require("vendor/autoload.php");
include_once $_SERVER['DOCUMENT_ROOT'].'/planetary/model/shedule.php';
 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
 
require 'vendor/autoload.php';
 
$app = new \Slim\App([
    "settings"  => [
        "determineRouteBeforeAppMiddleware" => true,
    ]
]);

$app->get('/', function (Request $request, Response $response) {
	
});

$app->run();
?>