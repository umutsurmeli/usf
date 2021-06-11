<?php
namespace umutsurmeli\system\controller;
if(!defined('APPPATH')) {exit('Bu sayfaya erişim izniniz yok!');}

class us_controller {
    public $version = '1.0';

    public static $_constructor;
    var $load;
    var $library;
    var $model;
    var $helper;
    var $db;
    var $rand;
    var $email;
    var $session;
    public function __construct() {
        
        ##########
        # # router metodunu kullandığınız zaman ön tanımlı alt sınıfları
        # \umutsurmeli\system\controller\us_controller::$_constructor ile çağırınız.
            if(is_null(\umutsurmeli\system\controller\us_controller::$_constructor)) {
                \umutsurmeli\system\controller\us_controller::$_constructor = &$this;

                $this->ushelpers();
                
                require_once(SYSTEMPATH.'library/config.php');
                require_once(APPPATH.'config/config.php');
                $this->config = new \umutsurmeli\app\config\config();

                //loader
                require_once(SYSTEMPATH.'library/load.php');
                $this->load = new \umutsurmeli\system\library\load();






                require_once(SYSTEMPATH.'library/session.php');
                $this->session = new \umutsurmeli\system\library\session();

                $this->rand = rand(1000,9999);
            }
        #
        # #
        ###########


    }

    public function sayfabulunamadi()
    {
        //header("HTTP/1.1 404 Not Found");
        http_response_code(404);
        echo 'sayfa bulunamadi!';

    }
    protected function ushelpers()
    {
       $systemhelpersdir = realpath(SYSTEMPATH.'helpers');
       
       $dirh = opendir($systemhelpersdir);
       while($file = readdir($dirh))
       {
           if(is_file($systemhelpersdir.'/'.$file)) {
               require_once($systemhelpersdir.'/'.$file);
           }




       }

       
    }
    /**
     * 
     * @param type $referer_func her zaman __FUNCTION__ girilir
     * @param type $targetcontroller app/controller altındaki "sxklasor/ykontroller"
     * @param type $target_function ykontroller altındaki metod ismi girilir.
     */
    protected function __routeToMethod($referer_func,$targetcontroller,$target_function)
    {
        
        $refererinfo = get_class($this).'/'.$referer_func.'/';

        $targetcontrollerpath = APPPATH.'controller/'.$targetcontroller.'.php';
        if(file_exists($targetcontrollerpath)&&strpos($targetcontroller,'..')===false)
        {
            require_once($targetcontrollerpath);
            if(strpos($targetcontroller,'/')!==false) {
                $targetcontrollername = substr($targetcontroller,strrpos($targetcontroller,'/')+1);
            }
            else {
                $targetcontrollername = substr($targetcontroller,strrpos($targetcontroller,'/'));
            }
            

            $umutsurmeli = new $targetcontrollername();

            $arguments_baslangicyeri = strpos($_SERVER['PATH_INFO'],$referer_func)+strlen($referer_func);
            $argumentstring = substr($_SERVER['PATH_INFO'],$arguments_baslangicyeri);

            

            $arguments = array();
            if(!empty($argumentstring))
            {
                $arguments = explode('/',$argumentstring);
                $arguments = array_filter($arguments,function($v,$k){
                    if(trim($v)=='') return false;
                    else return true;
                },ARRAY_FILTER_USE_BOTH);

                
            }

            $arguments = array_values($arguments);
            call_user_func_array(array($umutsurmeli,$target_function),$arguments);
        }

        
    }
    public function path_segments($index='')
    {

        if(!empty($_SERVER['PATH_INFO'])) {
         $path_ham = explode('/',$_SERVER['PATH_INFO']);
            $path_info = array_filter($path_ham,function($v,$k) {
                if(trim($v)=='') {return false;}
                return true;
            },ARRAY_FILTER_USE_BOTH);
            
          $path_segments = array_values($path_info);
          
          if(is_numeric($index)&& array_key_exists(intval($index), $path_segments)) {
              return $path_segments[intval($index)];
          }
          else if($index=='') {
            return $path_segments;
          }
          return false;
        }
        return false;
    }

    
}