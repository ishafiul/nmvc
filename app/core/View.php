<?php

namespace app\core;

use app\core\Exceptions\NotFound;

class View
{
    public string $title=TITLE;
    public string $description=DESCRIPTION;
    public array $keywords=KEYWORDS;
    public string $author=AUTHOR;
    private NotFound $notFound;
    public function render($view,$data=null,$http_code=null): void
    {
        $this->notFound =new NotFound();
        $content = $this->content($view,$data);
        $layout = $this->layout();
        $view = str_replace('<!--content-->',$content,$layout);
        //http_response_code($http_code);
        echo $view;
    }

    /**
     * @throws NotFound
     */
    private function content($view, $data): bool|string
    {
        if (!empty($data)){
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        ob_start();
        if ($this->isViewExist($view)){
            include_once __DIR__.'./../views/'.$view.'.php';
        }else{
            throw $this->notFound;
        }
        return ob_get_clean();
    }
    private function layout(): bool|string
    {
        ob_start();
        include_once __DIR__.'./../views/layouts/app.php';
        return ob_get_clean();
    }
    public function isViewExist($view): bool
    {
        if (file_exists( __DIR__.'./../views/'.$view.'.php')){
           return true;
        }
        else{
            return false;
        }
    }
}