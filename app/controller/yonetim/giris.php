<?php
use umutsurmeli\system\controller\us_controller;
class giris extends us_controller {
    public function __construct() {
    parent::__construct();
        

}
public function index()
{
    
    $KullaniciAdi = post('KullaniciAdi');
    $Sifre = post('Sifre');
    $posts = post();
    if(!empty($Sifre)&&!empty($KullaniciAdi)) {
        model('yonetim\girismodel');
        $girismodel = new \umutsurmeli\app\model\yonetim\girismodel();
        $yoneticibilgiler = $girismodel->giriskontrol($KullaniciAdi, $Sifre);
        if(!empty($yoneticibilgiler)) {
            $this->oturumac($yoneticibilgiler);

        }
    }
    
    $domain = config('domain');
    $description = config('description');
    //$stylesArray[]  = array('href'=>'https://fonts.googleapis.com/css?family=Open+Sans:400,600');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/all.min.css');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/bootstrap.min.css');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/template1.css');
    $header['styles'] = addStyle($stylesArray);
    $header['domain'] = $domain;
    $header['description'] = $description;
    $veri['header'] = view('standard/template1/1_header',$header);
    //$veri['menu'] = view('yonetim/2_menu');
    //$veri['banner'] = view('underconstruction/3_banner');
    //$veri['content'] = view('yonetim/girisform');
    //$veri['action'] = view('standard/template1/5_action');
    $footer['domain'] = $domain;
    $veri['footer'] = view('standard/template1/6_footer',$footer);
    view('yonetim/giris', $veri, false);


       

}
public function cikis() {
    $this->session->destroy();
    redirect('yonetim/giris/');
}
public function oturumac($yoneticibilgiler) {
        $_SESSION['oturum'] = 1;
        $_SESSION['KullaniciAdi'] = $yoneticibilgiler['KullaniciAdi'];
        $_SESSION['KullaniciId'] = $yoneticibilgiler['Id'];
        redirect('yonetim/anasayfa/');
}
public function neyse()
{
    echo 'neyse';
}
}