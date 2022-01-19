<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class Pages extends Controller
{
    public function index(Request $request){
        if ($request->isGet()){
            $data =[
                'dfsdf'=>'dsf'
            ];
            $this->view('index');
        }
        if ($request->isPost()){
            $body = $request->getBody();
        }
    }
}