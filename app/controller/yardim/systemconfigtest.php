<?php
use umutsurmeli\system\controller\us_controller;
class systemconfigtest extends us_controller {
    public function index() {

        
        echo $this->config->item('neyse');
        var_dump($this->config);

    }
    public function thisinfo()
    {

    }
}