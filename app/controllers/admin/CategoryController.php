<?php


namespace app\controllers\admin;


use app\models\AppModel;
use app\models\Category;
use ishop\App;

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

            $alias = AppModel::createAlias('category', 'alias', $data["title"], $id);
            $cat = \R::load('category', $id);
            $cat->alias = $alias;
            \R::store($cat);

            $_SESSION['success'] = "Добавлена категория";

        };

            redirect();

        }
        $this->setMeta("Новая категория");

    }

    public function editAction(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $category = \R::findOne("category", "id = ?", [$id]);
            App::$app->setProperty('parent_id', $category->parent_id);
        }
        if(!empty($_POST)){

            $categoryModel = new Category();
            $data = $_POST;
            $categoryModel->load($data);
            if(!$categoryModel->validate($data)){
                $categoryModel->setSessionErrors();
                redirect();
            }

            if($id = $categoryModel->update('category', $data['id'] )){
                $alias = AppModel::createAlias('category', 'alias', $data["title"], $id);
                $category = \R::load('category', $id);
                $category->alias = $alias;
                App::$app->setProperty('parent_id', $category->parent_id);
                \R::store($category);

                $_SESSION['success'] = "Категория успешно отредактированая";
            }
        }

        $this->set(compact('category'));
        $this->setMeta("Редактирование категории");
    }

}