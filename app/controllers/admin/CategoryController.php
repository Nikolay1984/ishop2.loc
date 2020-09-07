<?php


namespace app\controllers\admin;


use app\models\Category;

class CategoryController extends AppController
{
    public function indexAction(){
        $this->setMeta("Все категории");
    }
    public function deleteAction(){
        $id_category = $_GET['id'];

        $children = \R::count('category',"parent_id = ?", [$id_category]);
        $error = "";
        if($children){
            $error .= "Удалить категорию невозможно, вней есть подкатегории";
        }
        $products = \R::count('product',"category_id = ?", [$id_category]);
        if($products){
            $error .= "Удалить категорию невозможно, вней есть товары";
        }
        if($error){
            $_SESSION['errors'] = $error;
            redirect();
        }
        $category = \R::load('category', $id_category);
        \R::trash($category);
        $_SESSION['success'] = "Категория, успешно удалена";
        redirect();

    }

    public function addAction(){
        if(!empty($_POST)){
        $categoryModel = new Category();
        $data = $_POST;
        $categoryModel->load($data);
        if(!$categoryModel->validate($data)){
            $categoryModel->setSessionErrors();
            redirect();
        }



        if($id = $categoryModel->saveInBD('category')){

        };


        }
        $this->setMeta("Новая категория");

    }

}