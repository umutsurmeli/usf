<?php
namespace umutsurmeli\app\library\testlib;
use umutsurmeli\system\library\load;
class testlib extends load{
    public function __construct() {
        echo '<br/>'.__CLASS__;
    }
    static public function yofunc() {
        echo '<br/>2. derinlik: '.__FUNCTION__;
        echo '<br/>'.base_url();
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

