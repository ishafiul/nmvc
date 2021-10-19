<?php
class Pages extends Controller {
    public function __construct(){
        $this->gg = $this->model('Newmodel');
    }

    public function index()
    {
        $this->view('pages/index'); // which view will load
    }
    public function load()
    {
        $data = $this->gg->getinitdata(3);
        $this->view('pages/loadmore',$data); // which view will load
    }
    public function data()
    {
        $row  = $_POST['row'];
        $data = $this->gg->getnextdata($row,3);
        $this->view('pages/data',$data); // which view will load
    }
}