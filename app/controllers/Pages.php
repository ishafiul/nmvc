<?php
  class Pages extends Controller {
    public function __construct(){
     
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