<?php

use umutsurmeli\system\controller\us_controller;
class ac extends us_controller {

    var $x='0';
    public function index() {
        echo __CLASS__.' controller.';
        echo '<br/>'.base_url();
        echo '<br/><a href="'.base_url('yokartik/ac/B/').'">B</a>';
        echo '<br/><a href="'.base_url('yokartik/ac/c/').'">c</a>';
       $lib=$this->load->library('testlib');
       //$lib = new umutsurmeli\app\library\testlib();
       $lib::yofunc();
       
       
       $libxx = new $lib();
       $libxx->yofunc();
       
       $this->load->library('testlib\testlib');
       $lib = new umutsurmeli\app\library\testlib\testlib();
       $lib::yofunc();
    }
    public function B($x='',$y='') {
        echo '<br/><font color="red">merhaba $x:'.$x.'  $y:'.$y.'</font>';
        echo '<br/>'.base_url();
    
}
public function c()
{
    echo '<br/>'.base_url();
}
}



