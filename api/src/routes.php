<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/users', '\App\Controller\UserController:new');

$app->post('/cards/new', '\App\Controller\CardController:new');
$app->patch('/cards/{id}', '\App\Controller\CardController:click');
$app->get('/cards/{id}', '\App\Controller\CardController:game');

$app->get('/', function(Request $request, Response $response, $args) {
  $this->logger->info("GET / route");
  return "";
});

