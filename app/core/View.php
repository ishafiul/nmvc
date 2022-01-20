<?php

namespace app\core;

class View
{
    public function render($view,$data=null){

        $content = $this->content($view,$data);
        $layout = $this->layout();
        $view = str_replace('<!--content-->',$content,$layout);
        echo $view;
    }
    private function content($view,$data): bool|string
    {
        if (!empty($data)){
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        ob_start();
        include_once __DIR__.'./../views/'.$view.'.php';
        return ob_get_clean();
    }
    private function layout(): bool|string
    {
        ob_start();
        include_once __DIR__.'./../views/layouts/app.php';
        return ob_get_clean();
    }



}