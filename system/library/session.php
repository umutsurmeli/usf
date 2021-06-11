<?php
namespace umutsurmeli\system\library;
//use umutsurmeli\system\controller\us_controller;
class session {
    private $_flashdata;
    private $_tempdata;

    public function __construct() {
        foreach($_SESSION as $key=>$value) {
            if(!property_exists($this, $key)) {
            $this->{$key} = $value;
            }
        }
}
public function clear()
{

}
public function flashdata($key,$value=null) {
    
}
public function destroy() {
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',time()-86400,'/');
    setcookie('PHPSESSID','',time()-86400,'/');
    session_regenerate_id(true);
}


}
