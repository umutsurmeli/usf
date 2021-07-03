<?php
if(!defined('APPPATH')) {exit('Erişim izniniz yok!');}
use umutsurmeli\system\controller;
class yapimasamasinda extends controller\us_controller {
    public function index() {
        $veri['domain'] = config('domain');
        $veri['description'] = 'Bir yerden başlamak lazım.';
        view('standard/yapimasamasinda', $veri, false);
    }
}