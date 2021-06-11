<?php
namespace umutsurmeli\app\library\yonetim;
class libyonetim {
    public $US;
    public function __construct() {
        //$this->US =&get_instance();
        //echo $this->US->rand;
    }
    public function oturumkontrol() {
        if(empty(ses('oturum'))) {
            redirect('yonetim/giris/cikis');
        }
    }

}