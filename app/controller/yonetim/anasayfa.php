<?php
use umutsurmeli\system\controller\us_controller;
class anasayfa extends us_controller {
    public function __construct() {
    parent::__construct();
    $libyonetim = new \umutsurmeli\app\library\yonetim\libyonetim();
    $libyonetim->oturumkontrol();
    
}
public function index()
{
    echo '<a href="'.base_url().'yonetim/giris/cikis/">Çıkış</a>';
    var_dump($_SESSION);
    var_dump($_COOKIE);
    echo $_SERVER['HTTP_HOST'].'<br/>'.$_SERVER['REQUEST_SCHEME'];
}

}