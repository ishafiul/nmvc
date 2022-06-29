<?php

namespace app\models;

use app\core\Model;

class Test extends Model
{
    public $submit;
    public $submit2;

    public function tableName():string
    {
        return 'test';
    }
    public function attributes():array
    {
        return ['firstname', 'lastname', 'email', 'password'];
    }
    public function rules(): array
    {
        return [
            'submit' => [self::RULE_EMAIL,self::RULE_REQUIRED,[self::RULE_MAX,'max'=>25]],
            'submit2' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'submit']],
        ];
    }
    public function getData(){
        return $this->all();
    }
}