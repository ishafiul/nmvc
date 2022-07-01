<?php

namespace app\components\form;

use app\core\Model;

class BasicForm
{
    public static function start($method, $attrs=[],$action=null)
    {

        if ($action==null){
            $action = '';
        }
        $addAttributes ='';
        foreach ($attrs as $key =>$value){
            $addAttributes =$addAttributes.$key.'="'.$value.'" ';
        }
        //echo $addAttributes;
        echo sprintf('<form action="%s" method="%s" %s>',$action,$method,$addAttributes);

    }
    public static function end(){
        echo '</form>';
    }
    public static function input(Model $model,$name, $errorClass, $attrs=[], $type=null,$values=null ): void
    {
        if ($type==null){
            $type = 'text';
        }
        $addAttributes ='';

        $errorClass = $model->hasError($name)?$errorClass:" ";
        $class=$errorClass.' ';
        foreach ($attrs as $key =>$value){
            if ($key == 'class'){
                $class = $class.$value.' ';
            }
            else{
                $addAttributes =$addAttributes.$key.'="'.$value.'" ';
            }
        }
        //echo nl2br($class);
        echo sprintf('<input type="%s" value="%s" class="%s" name="%s" %s>',$type,empty($model->$name)?$values:$model->$name,$class,$name,$addAttributes);
    }

    public static function error(Model $model,$errorFor)
    {
        echo $model->firstErr($errorFor);
    }
}