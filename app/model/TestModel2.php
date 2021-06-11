<?php
namespace umutsurmeli\app\model;
use umutsurmeli\system\model\usmodel;
class TestModel2 extends usmodel {
    public $abc=4;
    public function __construct() {
        parent::__construct();
    }
    public function x()
    {
        //var_dump(self::$baglanti);
        #@$rs=$this->qb("query","SELECT * FROM oc_country","yz");
        #var_dump($rs->fetch_array());
        echo $this->select("select","*,3,5");
        //$this->qb('query');
        /*
        $_ = function($z) use ($this)
        {
            if(property_exists($this, $z))
            echo $this->{$z};
            else 
            {
                echo (string) $z . 'yok!';
            }
        };
        @$_(yo);
        */
    }
}
