<?php

use app\controllers\Pages;
use app\core\App;
$app =new app();
$app->router->get('/',function (){
    echo 'this is a function approach';
});

$app->router->get('/index',[Pages::class,'index']);
$app->router->get('/hola/{id}',[Pages::class,'hola']);
$app->router->post('/index',[Pages::class,'index']);
$app->router->get('/hello','hello');

$app->run();