<?php
use app\controllers\Pages;
use app\core\App;
use app\core\Request;

$app =new app();
$app->router->get('/',function (Request $request){
    echo 'this is a function approach';
    $body = $request->getBody();
    //var_dump($_ENV);

});

$app->router->get('/index',[Pages::class,'index']);
$app->router->post('/index',[Pages::class,'index']);

$app->router->get('/hello','hello');

$app->run();