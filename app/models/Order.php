<?php


namespace app\models;


use ishop\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Order extends AppModel
{


    public static function saveOrder($data,$table = 'order'){
        $instOrder = new self();
        $instOrder->attributes=[
            'user_id'=>'',
            'note'=>'',
            'currency'=>''
        ];
        $instOrder->load($data);
        $order_id = $instOrder->saveInBD($table);
        self::saveOrderProduct($order_id);
        return $order_id;
    }

    public static function saveOrderProduct($order_id){
        $sql_req = '';

        foreach ($_SESSION['productsInCart'] as $product_id => $product){
            $product_id = (int)$product_id;
            $sql_req.= "($order_id,$product_id,{$product['quantity']},'{$product['name']}',{$product['price']}),";
        };
        $sql_req = trim($sql_req, ',');

        \R::exec("INSERT INTO order_product (order_id,product_id,qty,title, price) VALUE $sql_req");

    }

    public static function orderEmail( $order_id, $user_email){
        // Create the Transport
        $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_server'), App::$app->getProperty('smtp_port'),
        App::$app->getProperty('smtp_protocol')))
            ->setUsername(App::$app->getProperty('smtp_login'))
            ->setPassword(App::$app->getProperty('smtp_password'));

// Create the Mailer using your created Transport
        ob_start();
        require VIEWS.'/mail/mail_order.php';
        $body = ob_get_clean();

        $mailer = new Swift_Mailer($transport);

// Create a message
        $message = (new Swift_Message("Заказ № $order_id"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo(['multimillionerishe.programmers@gmail.com'])
            ->setBody($body,"text/html")
        ;

        $messageUser = (new Swift_Message("Заказ № $order_id"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo([$user_email => $_SESSION['user']['name']])
            ->setBody($body,"text/html")
        ;
// Send the message
        $result = $mailer->send($message);
        $result = $mailer->send($messageUser);
        unset($_SESSION['productsInCart']);
        unset($_SESSION['productsInCart.quantity']);
        unset($_SESSION['productsInCart.sum']);
        $_SESSION['success'] = "Ваш заказ на стаф оформлен. Никулин выехал на мопеде";

    }
}