<?php


namespace app\widgets\currency;


use ishop\App;

class Currency
{
    protected $tpl;
    protected $currency;
    protected $currencies;
    private $html;

    public function __construct()
    {
        $this->tpl = APP. "/widgets/currency/currency_tpl/currency.php";
        $this->run();
    }
    public function __toString()
    {
        return $this->html;
    }

    private function run(){
        $this->currency = App::$app->getProperty("currency");
        $this->currencies = App::$app->getProperty("currencies");
        $this->html = $this->getHtml();
    }

    private function getHtml(){
        ob_start();
        require "$this->tpl";
        return ob_get_clean();
    }

    public static function getCurrency($currencies){

        if(isset($_COOKIE["currency"]) && array_key_exists($_COOKIE["currency"], $currencies) ){
            $key = $_COOKIE["currency"];
        }else{
            $key = key($currencies);
        }
        $res = $currencies[$key];
        $res["code"] = $key;

        return $res;

    }
    public static function getCurrencies(){
        return \R::getAssoc("SELECT code, title,symbol_left,symbol_right,value,base 
FROM currency ORDER BY base DESC ");
    }

}