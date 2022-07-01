<?php

use app\controllers\Pages;
use app\core\App;
$app =new app();
$app->router->get('/','hello');

$app->router->get('/test',[Pages::class,'index']);
$app->router->get('/test/create',[Pages::class,'create']);
$app->router->get('/test/{id}',[Pages::class,'show']);
$app->router->post('/test',[Pages::class,'store']);
$app->router->post('/test/delete/{id}',[Pages::class,'delete']);
$app->router->get('/test/edit/{id}',[Pages::class,'edit']);
$app->router->post('/test/{id}',[Pages::class,'update']);

$app->run();