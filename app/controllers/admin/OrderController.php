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

}