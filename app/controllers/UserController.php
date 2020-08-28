<?php


namespace app\controllers;


use app\models\BreadCrumbs;
use app\models\User;
use ishop\BreadcrumbsRender;

class UserController extends AppController
{

    public function loginAction(){

        if(!empty($_POST['user']['login']) && !empty($_POST['user']['password'])){

            $modUser = new User();

            if($modUser->login()){
                $_SESSION["success"] = "Вход выполнен успешно";
                redirect('/');
            }

            $_SESSION["errors"] = "Введеный логин или пароль не верны";
            redirect();


        }




        $breadCrumbs = BreadcrumbsRender::getBreadcrumbs('home','login');
        $this->set(compact('breadCrumbs'));

    }
    public function signupAction(){
        if(isset($_POST['user'])){
            $instModel = new User();
            $data = $_POST['user'];
            $instModel->load($data);

            if(!$instModel->validate($data) || !$instModel->checkUniq()){
                $_SESSION['formData'] = $data;
                $instModel->setSessionErrors();

            }else{
                $instModel->attributes['password'] = password_hash($instModel->attributes['password'],
                    PASSWORD_DEFAULT);
                if($instModel->saveInBD("user")){
                    $_SESSION['success'] = "Регистрация прошла успешна!";
                    foreach ($data as $key=>$value){
                        if($key != "password"){
                            $_SESSION["user"][$key] = $value;
                        }
                    }
                    redirect('/');
                }else{
                    $_SESSION['errors'] = "Бд временно не доступна";
                }

            }
            redirect();

            }

        $breadCrumbs = BreadcrumbsRender::getBreadcrumbs('home','signup');
        $this->set(compact('breadCrumbs'));
    }
    public function logoutAction(){
        $name = $_SESSION['user']['name'];

        unset($_SESSION['user']);
        $_SESSION['success'] = "Пользователь $name вышел из аккаунта";

        redirect();

    }


}