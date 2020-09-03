<?php


namespace app\controllers\admin;


use app\models\User;

class UserController extends AppController
{
    public function loginAdminAction(){

        if(!empty($_POST)){
            $userModel = new User();
            if($userModel->login(true)){
                $_SESSION['success'] = "You is admin";
            }else{
                $_SESSION['errors'] = "You is not admin";
            }
            if(User::isAdmin()){
                redirect(ADMIN);
            }else{
                redirect();
            }
        }
        $this->layout = 'loginAdmin';

    }

}