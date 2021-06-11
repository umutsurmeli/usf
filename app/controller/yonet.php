<?php
use umutsurmeli\system\controller\us_controller;
class yonet extends us_controller {
    public function __construct() {
        parent::__construct();
    
}
public function index()
{
   redirect('yonetim/giris/');
       

}


}