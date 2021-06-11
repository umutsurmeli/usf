<?php
use umutsurmeli\system\controller\us_controller;
class viewtest extends us_controller {
    public function index() {

        $degiskenler['x']='y';

        echo view('standard/template1/1_header', $degiskenler);
        //echo 'yo';
        //echo config('yokartik');
        //echo config('derinconfig');
        echo '<br/>'.self::$_constructor->rand;
        echo '<br/>'.$this->rand;
        //var_dump($this->session);
        
        

    }
    public function thisinfo()
    {

    }
}