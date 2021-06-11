<?php
namespace umutsurmeli\app\library\testlib;
use umutsurmeli\system\library\load;
class usextendedlib extends load  {
    
    public function __construct() {

        
    }
    static public function yofunc() {
        echo '<br/>2. derinlik: '.__FUNCTION__;
        echo '<br/>'.base_url();
    }
    public function testinstance()
    {
        global $umutsurmeli;
        echo '<br/>'.__CLASS__;
        echo '<br/>'.__FUNCTION__.' '.$umutsurmeli->rand;
    }

    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

