<?php

namespace app\core;

class Controller
{
    public function view($view,$data=null){
        App::$app->view->render($view,$data);
    }
}