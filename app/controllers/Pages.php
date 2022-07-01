<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\Exceptions\NotFound;
use app\core\Request;
use app\models\Test;

class Pages extends Controller
{
    public NotFound $exception;
    private Test $model;

    public function __construct()
    {
        $this->model = new Test();
        $this->exception =new NotFound();
        parent::__construct();
        //$this->middleware(new authMiddleware(['index']));
    }

    /**
     * @throws Created
     */
    public function index(Request $request){


        if ($request->isGet()){
            $data =[
                'data'=>$this->model->all(),
                'model'=>$this->model,
                'metadata'=>[
                    'title'=>'Hello page',
                    'description'=>'Here is my page description',
                    'keywords'=>['test','hello'],
                    'author'=>'ishaf',
                ]
            ];
            $this->view('test/index',$data);
        }

    }
    public function store(Request $request){
        if ($request->isPost()){
            $this->model->loaddata($request->getBody());
            $this->model->validate();
            if ($this->model->validate() && $this->model->register()){
                App::$app->flashMessage->setFlash('success','user created','/test');
            }
            $data =[
                'model'=>$this->model,
            ];
            $this->view('test/create',$data);
        }
    }
    public function create(Request $request){
        if ($request->isGet()){
            $data =[
                'model'=>$this->model,
                'metadata'=>[
                    'title'=>'Hello page',
                    'description'=>'Here is my page description',
                    'keywords'=>['test','hello'],
                    'author'=>'ishaf',
                ]
            ];
            $this->view('test/create',$data);
        }
    }

    /**
     * @throws NotFound
     */
    public function edit(Request $request){
        if ($request->isGet()){
            $data =[
                'data'=>$this->model->getById($request->getRouteParam('id'),['password']),
                'model'=>$this->model,
                'metadata'=>[
                    'title'=>'Hello page',
                    'description'=>'Here is my page description',
                    'keywords'=>['test','hello'],
                    'author'=>'ishaf',
                ]
            ];
            if ($this->model->getById($request->getRouteParam('id'),['password'])){
                $this->view('test/edit',$data);
            }else{
                throw $this->exception;
            }

        }
    }
    public function delete(Request $request){
        if ($request->isPost()) {
            $this->model->delete($request->getRouteParam('id'));
            App::$app->flashMessage->setFlash('success','Deleted '.$request->getRouteParam('id'),'/test');
        }
    }
    public function update(Request $request){
        if ($request->isPost()){
            $this->model->loaddata($request->getBody());
            if ($this->model->updateUser($request->getRouteParam('id'))){
                App::$app->flashMessage->setFlash('success','User Updated','/test');
            }
            else{
                App::$app->flashMessage->setFlash('success','cant Updated','/test');
            }
            $data =[
                'model'=>$this->model,
            ];
            $this->view('test/create',$data);
        }
    }

    /**
     * @throws NotFound
     */
    public function  show(Request $request){
        if ($request->isGet()){
            $data =[
                'data'=>$this->model->getById($request->getRouteParam('id'),['password']),
                'model'=>$this->model,
                'metadata'=>[
                    'title'=>'Show',
                    'description'=>'Here is my page description',
                    'keywords'=>['test','hello'],
                    'author'=>'ishaf',
                ]
            ];
            if ($this->model->getById($request->getRouteParam('id'))){
                $this->view('test/show',$data);
            }else{
                throw $this->exception;
            }
        }
    }
}