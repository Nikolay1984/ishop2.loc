<?php


namespace app\controllers;


class UserController extends AppController
{

    public function loginAction(){
        if(isset($_POST['login'])){
            debug($_POST,1);
        }

    }
    public function signupAction(){

    }
    public function logoutAction(){

    }


}