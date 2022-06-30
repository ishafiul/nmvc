<?php

namespace app\models;

use app\core\Model;

class Test extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirmPassword;

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
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_EMAIL,self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
            'confirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']],
        ];
    }
    public function register(): bool
    {
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        return $this->save();
    }

    public function updateUser($id){
        return $this->update($id);
    }
}