<?php

use umutsurmeli\system\controller\us_controller;
class bircnt extends us_controller {
    public function __construct() {
        parent::__construct();
    
}
public function index()
{
    echo 'deneme';
    echo config('APIKey');
}
}