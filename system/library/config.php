<?php
namespace umutsurmeli\system\library;

class config {
    protected $system = array();
    public function __construct() {
        $this->system = array();
        #################################################
        ##### sistem tanımlamaları burada yapılır #######
        $this->system['neyse'] = 'her neyse';
        
        
        
        
        
        ##### sistem tanımlamaları burada yapılır #######
        #################################################
        $this->savechilditems();
        if(array_key_exists('config_autoload', $this->system)) {
            
            $this->autoload($this->system['config_autoload']);
        }
    }
    public  function item($param) {
        if(array_key_exists($param, $this->system))
        {
            return $this->system[$param];
        }
        else
        {
            http_response_code(500);
            exit('config->system içinde '.$param.' anahtarı bulunamadı!');
        }
    }
    private function savechilditems($configOb='')
    {
        if(empty($configOb)) {
            $vars = get_class_vars(get_class($this));
        }
        else {
            $vars = get_class_vars(get_class($configOb));
        }

        foreach($vars as $key=>$value)
        {
            if(!array_key_exists($key, $this->system)&&$key!='system')
            {
                $this->system[$key] = $value;
            }

        }
    }
    private function load($appconfigfilePath)
    {
        $appconfigfullPath = APPPATH.'config/'.str_replace('\\', '/', $appconfigfilePath).'.php';
        $classfullpath = 'u'.'muts'.'urmeli\\'.str_replace('/','\\',$appconfigfullPath);
        $classfullpath = substr($classfullpath,0,strpos($classfullpath,'.php'));
        if(file_exists($appconfigfullPath)&&!class_exists($classfullpath)) {
            require_once($appconfigfullPath);
            $instance = new $classfullpath();
            $this->savechilditems($instance);
        }
        else if(!file_exists($appconfigfullPath)) {
            exit($appconfigfullPath.' yok');
        }
        return $classfullpath;
    }
    private function autoload($configpatharray) {
        foreach($configpatharray as $configpath) {
            $this->load($configpath);
        }
    }



}

