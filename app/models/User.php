<?php


namespace app\models;


class User extends AppModel
{
        public $attributes = [
            "login"=>'',
            "password"=>'',
            "name"=>'',
            "email"=>'',
            "address"=>'',
            "role"=> 'user'
        ];

        public $rules = [
            'required' => ['login','password','name','email','address'],
            'email'=>['email'],
            'lengthMin'=>[
                ['password',6]
            ]
        ];


        public function checkUniq(){
            $user = \R::findOne("user", "email = ? OR login = ?",
                [$this->attributes['email'], $this->attributes['login']]);

            if($user){
                if($user->login == $this->attributes['login']){
                    $this->errors['uniq'][] = "Такой логин занят";
                }
                if($user->email == $this->attributes['email']){
                    $this->errors['uniq'][] = "Такой email занят";
                }
                return false;
            }

            return true;
        }

        public function login($isAdmin = false){
            $login =  $_POST['user']['login'] ;
            $password =  $_POST['user']['password'] ;

            if($isAdmin){
                $user = \R::findOne("user","login = ? AND role = 'admin'",[$login]);
            }else{
                $user = \R::findOne("user","login = ? ",[$login]);
            }


            if($user){
                if(password_verify($password, $user['password'])){

                    foreach ($user as $key=>$value){

                        if($key != 'password'){

                            $_SESSION['user'][$key] = $value;
                        }

                    }
                    return true;
                }
            }

            return false;



        }






}