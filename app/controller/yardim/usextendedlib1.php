<?php
use umutsurmeli\system\controller\us_controller;
class usextendedlib1 extends us_controller {
    public function index() {
        //umutsurmeli\app\library\testlib\usextendedlib
        $ns = $this->load->library('testlib\usextendedlib');
        //echo $ns;//umutsurmeli\app\library\testlib\usextendedlibs
        $nso = new $ns();

        $nso->testinstance();
        // $nso->merhaba();
        $this->usinfo();
        $this->thisinfo();
    }
    public function thisinfo()
    {
        echo '<br>'.__CLASS__;
        echo '<br>'.__FUNCTION__;
    }
}