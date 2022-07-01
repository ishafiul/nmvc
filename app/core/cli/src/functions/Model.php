<?php

namespace Console\functions;

class Model
{

    public function create(mixed $name)
    {

        $path = dirname(__DIR__, 4).'\models';
        $className = ucfirst($name);
        if (file_exists($path.'/'.$className.'.php')){
            return '<fg=#f9c33d>'.'Model Already Exist!'.'</>';
        }
        else{
            $creteFile = fopen($path.'/'.$className.'.php','w');
            $code = '<?php

namespace app\models;

use app\core\Model;

class '.$className.' extends Model
{
    public function rules(): array
    {
        return [];
    }
}
';
            fwrite($creteFile,$code);
            return '<fg=green>'.$name.' Model Created!'.'</>';
        }
    }
}