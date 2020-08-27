<?php


namespace app\controllers;


use app\models\BreadCrumbs;
use app\models\User;
use ishop\BreadcrumbsRender;

class UserController extends AppController
{

    public function loginAction(){
        if(isset($_POST['user'])){
            debug($_POST,1);
        }
        $breadCrumbs = BreadcrumbsRender::getBreadcrumbs('home','login','viewLogAndReg');
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
                }else{
                    $_SESSION['errors'] = "Бд временно не доступна";
                }

            }
            redirect();

        }
        $breadCrumbs = BreadcrumbsRender::getBreadcrumbs('home','signup','viewLogAndReg');
        $this->set(compact('breadCrumbs'));
    }
    public function logoutAction(){

    }


}