<?php

namespace app\models;

use app\core\Model;
use JetBrains\PhpStorm\ArrayShape;

class Test extends Model
{
    public $submit;
    public $submit2;

    public function insert()
    {
        //echo $this->submit;
    }


    public function rules(): array
    {
        return [
            'submit' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_MAX,'max'=>5]],
            'submit2' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'submit']],
        ];
    }
}