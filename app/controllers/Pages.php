<?php
class Pages extends Controller {
    public function __construct(){
    }

    public function index()
    {// function name will define what will be the page url that user will input

        $this->view('pages/index'); // which view will load
    }
}