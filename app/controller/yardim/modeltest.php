<?php

use umutsurmeli\system\controller\us_controller;
    //$this->load->thirdparty('PHPMailer/src');

class modeltest extends us_controller {
    public function __construct() {
        parent::__construct();
    }
    public function index()
    {

        $x1=model('TestModel');
        $x1->x();
        
        $x2 = model('TestModel2',false);
        $x3 = new $x2();
        echo $x3->x();
        
        //var_dump($x2->x());

    }
}

