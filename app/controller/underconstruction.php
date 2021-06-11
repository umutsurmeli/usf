<?php

use umutsurmeli\system\controller\us_controller;
class underconstruction extends us_controller {
    public function __construct() {
        parent::__construct();
    
}
public function index()
{
    
    //$stylesArray[]  = array('href'=>'https://fonts.googleapis.com/css?family=Open+Sans:400,600');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/all.min.css');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/bootstrap.min.css');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/template1.css');
    $header['styles'] = addStyle($stylesArray);
    $veri['header'] = view('standard/template1/1_header',$header);
    $veri['menu'] = view('underconstruction/2_menu');
    $veri['banner'] = view('underconstruction/3_banner');
    //$veri['content'] = view('standard/template1/4_content');
    //$veri['action'] = view('standard/template1/5_action');
    $footer['domain'] = config('domain');
    $veri['footer'] = view('standard/template1/6_footer',$footer);
    view('underconstruction/view_underconstruction', $veri, false);


       

}
public function neyse()
{
    var_dump($this->rand);
    $this->__routeToMethod(__FUNCTION__, 'yardim/viewtest', 'index');
}
}