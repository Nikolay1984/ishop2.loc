<?php


namespace app\controllers\admin;


use ishop\App;
use ishop\BreadcrumbsRender;
use ishop\Pagination;

class OrderController extends AppController
{
    public function indexAction(){
        $breadCrumbs = BreadcrumbsRender::getBreadcrumbs("home","список заказов","admin");
        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`, `order`.`date`, `order`.`update_at`, `order`.`currency`, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
  JOIN `user` ON `order`.`user_id` = `user`.`id`
  JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
  GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` ");
        $count = count($orders);
        $orders = Pagination::getCurrentProducts($orders,1);
        $htmlPagination = Pagination::getHtmlPagination();



        $this->setMeta("All orders");
        $this->set(compact("breadCrumbs","htmlPagination","orders","count"));


    }

    public function viewAction(){
        $breadCrumbs = BreadcrumbsRender::getBreadcrumbs("home","описание заказа","admin");
        $order_id = $_GET['id'];
        $order = \R::getRow("SELECT `order`.*, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
  JOIN `user` ON `order`.`user_id` = `user`.`id`
  JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
  WHERE `order`.`id` = ?
  GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT 1", [$order_id]);

        $order_products = \R::findAll('order_product','order_id = ?',[$order_id]);
        $this->setMeta("Заказ № $order_id");

        $this->set(compact("breadCrumbs","order","order_products"));

    }

    public function changeAction(){

        $order_id = $_GET["id"];

        if($_GET['status'] == 1){
            $status = "1";
        }else{
            $status = "2";
        }

        $order = \R::load('order', $order_id);

        if(!$order){
            throw new \Exception('Страница не найдена', 404);
        }

        $order->status = $status;
        $order->update_at = date("Y-m-d H:i:s");

        \R::store($order);

        $_SESSION['success'] = 'Изменения сохранены';
        redirect();



    }

    public function deleteAction(){

        $id_order = $_GET["id"];

        $order = \R::load("order", $id_order);
        \R::trash($order);
        $_SESSION['success'] = "Товар успешно удален";
        redirect('/admin/order/');
    }

}