<?php

namespace Console\functions;

class Controller
{
    public function generate($name){
        $path = dirname(__DIR__, 4).'\controllers';
        $className = ucfirst($name);
        if (file_exists($path.'/'.$className.'.php')){
            return '<fg=#f9c33d>'.'Controller Already Exist!'.'</>';
        }
        else{
            $creteFile = fopen($path.'/'.$className.'.php','w');
            $code = '<?php 
namespace app\controllers;
use app\core\Controller;
            
class '.$className.' extends Controller
{
   //functions
}
';
            fwrite($creteFile,$code);
            return '<fg=green>'.$name.' Controller Created!'.'</>';
        }
    }
}