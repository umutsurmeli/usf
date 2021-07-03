<?php
namespace umutsurmeli\system\library;
//use umutsurmeli\system\controller\us_controller;
class load {
    public $test = 'aab';
    public function __construct() {
        $library_autoload = config('library_autoload');
        if(!empty($library_autoload)) {
            foreach($library_autoload as $yol=>$run) {
                $this->library($yol,$run);
            }
        }
    }
    public function library($classShortPath,$run=false) {
        
        $classfullpath = $this->classloader($classShortPath, __FUNCTION__);
        if($run) {
            return new $classfullpath();
        }
        return $classfullpath;
    }
    public function systemlibrary($classShortPath) {
        
        $classfullpath = $this->systemclassloader($classShortPath, __FUNCTION__);
        return $classfullpath;
    }
    public function model($classShortPath,$createNew=true) {
        if(!class_exists('umutsurmeli\system\model\usmodel')) {
            require_once(SYSTEMPATH.'model/QueryBuilder.php');
            require_once(SYSTEMPATH.'model/usmodel.php');
            $initus = \umutsurmeli\system\model\usmodel::baglan();
        }
        
        $classfullpath = $this->classloader($classShortPath, __FUNCTION__);
        
        if($createNew) {
            return new $classfullpath();
        }
        
        return $classfullpath;
    }
    public function systemmodel($classShortPath,$createNew=true) {
        if(!class_exists('umutsurmeli\system\model\usmodel')) {
            require_once(SYSTEMPATH.'model/QueryBuilder.php');
            require_once(SYSTEMPATH.'model/usmodel.php');
            $initus = \umutsurmeli\system\model\usmodel::baglan();
        }
        
        $classfullpath = $this->systemclassloader($classShortPath, __FUNCTION__);
        
        if($createNew) {
            return new $classfullpath();
        }
        
        return $classfullpath;
    }
    public function view($yol,$degiskenler=array(),$degerdondur=true) {
        if(file_exists(VIEWPATH.$yol.'.php')) {
            if(!empty($degiskenler)&&is_array($degiskenler)) {
                foreach ($degiskenler as $key=>$value) {
                    ${$key} = $value;
                }
            }
            ob_start();
            require_once(VIEWPATH.$yol.'.php');
            $icerik = ob_get_contents();
            ob_end_clean();

            if($degerdondur===false) {
                echo $icerik;
            }
            else {
                return $icerik;
            }
            
        }
        else {
            exit('Görünüm dosyası  bulunamadı, yolu doğru yazdığınızdan emin olunuz!');
        }
    
    }
    protected function classloader($classShortPath,$loader) {
        
        $filepath = APPPATH.$loader.'/'.str_replace('\\', '/', $classShortPath).'.php';
        $classfullpath = 'umut'.'surmeli\\'.str_replace('/','\\',$filepath);
        $classfullpath = substr($classfullpath,0,strpos($classfullpath,'.php'));
        if(file_exists($filepath)&&!class_exists($classfullpath)) {
            require_once($filepath);
        }
        else if(!file_exists($filepath)) {
            exit($filepath.' yok');
        }
        return $classfullpath;
    }
    protected function systemclassloader($classShortPath,$loader) {
        $systemsubfolder = '';
        switch($loader)
        {
            case  'systemlibrary':
                $systemsubfolder = 'library';
                break;
            case  'systemmodel':
                $systemsubfolder = 'model';
                break;
            
            default:
                exit('Tanımsız sistem nesnesi yüklenmeye çalışıldı!');
                
        }
        
        $filepath = SYSTEMPATH.$systemsubfolder.'/'.str_replace('\\', '/', $classShortPath).'.php';
        $classfullpath = 'umut'.'surmeli\\'.str_replace('/','\\',$filepath);
        $classfullpath = substr($classfullpath,0,strpos($classfullpath,'.php'));
        if(file_exists($filepath)&&!class_exists($classfullpath)) {
            require_once($filepath);
        }
        else if(!file_exists($filepath)) {
            exit($filepath.' yok');
        }
        return $classfullpath;
    }

    public function merhaba()
    {
        echo '<br/>merhaba '.__CLASS__;
    }


}