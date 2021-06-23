<?php
namespace umutsurmeli\system\library;
//use umutsurmeli\system\controller\us_controller;
class session {
    //private $_flashdatalist;
    //private $_tempdatalist;
    public static $flashdatatemizlendi = 0;

    public function __construct() {
        $this->flashdataclear();
        $this->tempdataclear();

        
}

/**
 * 
 * @param type $key tek kullanımlık oturum değişkeni adı.
 * @param type $value tek kullanımlık oturum değişkeni değeri.
 */
public function flashdata($key,$value) {
    $_SESSION[$key] = $value;
    $_SESSION['_flashdatalist'][$key] = 0;
}
/**
 * 
 * @param type $key süreli kullanımlı oturum değişkeni adı.
 * @param type $value süreli kullanımlı oturum değişkeni değeri.
 * @param type $second oturum değişkeni kullanım ömrü (saniye cinsinden).
 */
public function tempdata($key,$value,$second) {
    $_SESSION[$key] = $value;
    $_SESSION['_tempdatalist'][$key] = time()+$second;
}
private function flashdataclear() {
    $flashdatatemizlendi = \umutsurmeli\system\library\session::$flashdatatemizlendi;
    if($flashdatatemizlendi==0) {
        if(isset($_SESSION['_flashdatalist'])&&!empty($_SESSION['_flashdatalist'])) {
            foreach ($_SESSION['_flashdatalist'] as $fdkey=>$val) {
                if($val==1) {
                    unset($_SESSION[$fdkey]);
                    unset($_SESSION['_flashdatalist'][$fdkey]);
                }
                else if($val==0) {
                    $_SESSION['_flashdatalist'][$fdkey] = 1;
                }
            }
            
        }
      \umutsurmeli\system\library\session::$flashdatatemizlendi=1;
    }
}
private function tempdataclear() {
    if(isset($_SESSION['_tempdatalist'])&&!empty($_SESSION['_tempdatalist'])) {
        foreach($_SESSION['_tempdatalist'] as $key=>$val) {
            if(time() > $val) {
                unset($_SESSION[$key]);
                unset($_SESSION['_tempdatalist'][$key]);
            }
        }
    }
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
