<?php
namespace umutsurmeli\app\model;
use umutsurmeli\system\model\USModel;
class TestModel extends USModel {
    public function __construct() {
        parent::__construct();
    }
    public function x()
    {
        echo '<br/>asdf';
        echo '<br>'.$this->select('yo,so');

    }
}
