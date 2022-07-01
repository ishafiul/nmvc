<?php

namespace app\core;

abstract class Model
{
    private Database $db;

    public function __construct()
    {
        $this->db =new Database();
    }

    const RULE_REQUIRED = 'required';
    const RULE_EMAIL = 'email';
    const RULE_MIN = 'min';
    const RULE_MAX = 'max';
    const RULE_MATCH = 'match';
    const RULE_UNIQUE = 'unique';
    public array $errors = [];



    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
    abstract public function rules();
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($rule)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, ['min' => $rule['min']]);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX,['max' => $rule['max']]);
                }

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, ['match' => $rule['match']]);
                }
                /*
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $db = Application::$app->db;
                    $statement = $db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :$uniqueAttr");
                    $statement->bindValue(":$uniqueAttr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorByRule($attribute, self::RULE_UNIQUE);
                    }
                }*/
            }
        }
        return empty($this->errors);
    }

    public function errorMessage()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'Record with with this {field} already exists',
        ];
    }
    public function addError($attribute, $rule, $params=[])
    {
        $errorMessage = $this->errorMessage()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }
        $this->errors[$attribute][] = $errorMessage;
    }
    public function hasError($attr)
    {
        return $this->errors[$attr]??false;
    }
    public function firstErr($attr){
        return $this->errors[$attr][0]??false;
    }

    abstract public function tableName():string;
    abstract public function attributes():array;

    public function all(){
        $this->db->query('SELECT * FROM '.$this->tableName());
        return $this->db->resultSet();
    }
    public function getById($id, array $except=null){
        $this->db->query('DROP TABLE IF EXISTS temp'.$this->tableName());
        $this->db->execute();
        if ($except==null){
            $this->db->query('SELECT * FROM '.$this->tableName().' WHERE id ='.$id);
        }else{

            $this->db->query('CREATE TABLE temp'.$this->tableName().' SELECT * FROM '.$this->tableName());
            $this->db->execute();
            $this->db->query('ALTER TABLE temp'.$this->tableName().' DROP COLUMN '.implode(",", $except));
            $this->db->execute();
            $this->db->query('SELECT * FROM temp'.$this->tableName().' WHERE id ='.$id);
            if (!empty($this->db->resultSet())){
                $returnValue = $this->db->resultSet()[0];
            }else{
                $returnValue = false;
            }

            $this->db->query('DROP TABLE temp'.$this->tableName());
            if ($this->db->execute()){
                return $returnValue;
            }

        }
        if (!empty($this->db->resultSet())){
            return $this->db->resultSet()[0];
        }else{
            return false;
        }
    }

    public function deleteAll($condition):string{
        $this->db->query('DELETE FROM '.$this->tableName().' WHERE'.$condition);
        $this->db->execute();
        return true;
    }
    public function delete($id):string{
        $this->db->query('DELETE FROM '.$this->tableName().' WHERE id='.$id);
        $this->db->execute();
        return true;
    }
    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $this->db->query('INSERT INTO '.$tableName.'( '.implode(",", $attributes) .' ) VALUES ( '. implode(",", $params).')');
        foreach ($attributes as $attribute) {
            $this->db->bind(":$attribute", $this->{$attribute});
        }
        $this->db->execute();
        return true;
    }
    public function update($id): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => "$attr=:$attr", $attributes);
        $this->db->query('UPDATE '.$tableName.' SET '.implode(",", $params).' WHERE id='.$id);
        foreach ($attributes as $attribute) {
            $this->db->bind(":$attribute", $this->{$attribute});
        }
        $this->db->execute();
        return true;

    }
}