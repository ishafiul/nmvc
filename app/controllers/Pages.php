<?php
  class Pages extends Controller {
    public function __construct(){
     //your models gose here . example : $this->ModelName = $this->model('model_class_name');
    }
    
    public function index(){
      $data = [
        'title' => 'BlogMVC',
        'description' => ''
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to share posts with other users'
      ];

      $this->view('pages/about', $data);
    }
      public function contact(){
          $data = [
              'title' => 'Contacts Us',
              'description' => 'Blog MVC'
          ];

          $this->view('pages/contact', $data);
      }

  }