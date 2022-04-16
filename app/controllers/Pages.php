<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\Test;

class Pages extends Controller
{
 /*   public function index(Request $request){

        $model = new Test();
        if ($request->isGet()){
            $data =[
                'dfsdf'=>'dsf',
                'model'=>$model
            ];
            $this->view('index',$data);
        }
        if ($request->isPost()){

            $model->loaddata($request->getBody());
            $model->validate();
            //var_dump($model->errors);
            if ($model->validate()){
                echo 'success';
            }
            $data =[
                'model'=>$model
            ];
            $this->view('index',$data);
        }
    }
    public function hola(Request $request){

        $model = new Test();
        if ($request->isGet()){
            echo '<pre>';
            var_dump($request->getBody(), $request->getRouteParam('id'));
            echo '</pre>';
        }
    }*/
}