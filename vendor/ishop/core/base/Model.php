<?php


namespace ishop\base;


use ishop\Db;
use Valitron\Validator;

abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
     Db::instance();

    }


    public function load($data){

        foreach ($this->attributes as $key=>$val){
            if(isset($data[$key])){
                $this->attributes[$key] =$data[$key];
            }
        }
    }

    public function validate($data){
        Validator::langDir(WWW."/validator/lang");
        Validator::lang("ru");
        $validator = new Validator($data);
        $validator->rules($this->rules);
        if($validator->validate()){
            return true;
        }else{
            $this->errors = $validator->errors();
            return false;
        }
    }

    public function setSessionErrors(){
        $strErrors = "<ul>";

        foreach ($this->errors as $error){
            foreach ($error as $textError){
                $strErrors .= "<li> $textError </li>";
            }
        }

        $strErrors .= "</ul>";
        $_SESSION['errors'] = $strErrors;
    }

    public function saveInBD($table){
        $tbl = \R::dispense($table);
        foreach ($this->attributes as $key=>$value){
            $tbl->$key = $value;
        }


        return \R::store($tbl);
    }

    public function update($table,$id){
        $tbl = \R::load($table, $id);
        foreach ($this->attributes as $key=>$value){
            $tbl->$key = $value;
        }
        return \R::store($tbl);
    }

}