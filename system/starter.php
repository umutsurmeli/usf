<?php

if(isset($_SERVER['PATH_INFO'])) {
        $istek=explode('/',$_SERVER['PATH_INFO']);
        
        $umutsurmeliyolu= APPPATH.'controller/';
        $testedilenyol = '';
        $umutsurmeliyuklendi = false;
        foreach($istek as $value) {
            #kontrollerı bul
            $testedilenyol .= $value;
            if(file_exists($umutsurmeliyolu.$testedilenyol.'.php')) {
                if(is_dir($umutsurmeliyolu.$testedilenyol)) {
                    exit('Bir klasörde aynı isimli dosya ve klasör olmamalı!');
                }
                //echo $testedilenyol.' bulundu';
                #kalanların ilki metod ismi gerisi parametre olacak

                // $kalanlar /kategori/kategoriler URL için hata verdi.
                // $kalanlar = str_replace('/'.$testedilenyol, '', $_SERVER['PATH_INFO']);
                $taksimvetestedilenyol = '/'.$testedilenyol;

                $kalanlarbaslangic = strlen($taksimvetestedilenyol);
                $kalanlar = substr($_SERVER['PATH_INFO'],$kalanlarbaslangic);

                
                //echo $umutsurmeliyolu.$testedilenyol.'.php';
                include(SYSTEMPATH.'controller/us_controller.php');

                include($umutsurmeliyolu.$testedilenyol.'.php');
                $umutsurmeliyuklendi = true;

                //echo '<br/>kalanlar:'.$kalanlar;
                #metod ve argümanlar

                $kalanlardizi = explode('/', $kalanlar);

                        if(class_exists($value)) {
                            $umutsurmeli = new $value();
                            
                        }
                        else {
                            $umutsurmeli = new umutsurmeli\system\controller\us_controller();
                            $umutsurmeli->sayfabulunamadi();
                            exit();
                        }
                        //print_r($kalanlardizi);
                        if(count($kalanlardizi)>1 && strlen($kalanlardizi[1])>0) {
                            $method = $kalanlardizi[1];
                            #argümanları başka bir diziye aktarıyoruz.
                            $arguments = array();
                            for($i=2;$i<count($kalanlardizi);$i++) {
                                if($kalanlardizi[$i] != '') {
                                    $arguments[] = $kalanlardizi[$i];
                                }
                            }

                        //print_r($arguments);

                            if(method_exists($umutsurmeli, $method)) {

                                call_user_func_array(array($umutsurmeli,$method), $arguments);
                            }
                            
                            else {
                                $umutsurmeli->sayfabulunamadi();
                            }
                        }
                        else {

                                
                               $umutsurmeli->index();

                        }
                        //print_r($kalanlardizi);
                //echo '<br/>';
                break;

            }
            else {
                //$umutsurmeli = new us_controller();
                //$umutsurmeli->index();
                if($testedilenyol!='') {
                    $testedilenyol.='/';
                }
                
            }
        }
        #####################################################
        # default controller altında metod var mı?
        if(!empty(DEFAULT_CONTROLLER)&&$umutsurmeliyuklendi===false)
        {
            
            $defaultcontrolleryolu = APPPATH.'controller/'.DEFAULT_CONTROLLER.'.php';
            if(file_exists($defaultcontrolleryolu))
            {
                
                require_once(SYSTEMPATH.'controller/us_controller.php');
                //exit('yyy');//require_once(SYSTEMPATH.'controller/us_controller.php');
                require_once($defaultcontrolleryolu);
                $umutsurmelidefaultcontroller = DEFAULT_CONTROLLER;
                $umutsurmeli = new $umutsurmelidefaultcontroller();

                $methodveparametreler = explode('/',$_SERVER['PATH_INFO']);
                $methodveparametreler = array_filter($methodveparametreler,function($v,$k){
                    $v = trim($v);
                    if($v=='') {
                        return false;
                    }
                    return true;
                },ARRAY_FILTER_USE_BOTH);
                $methodveparametreler = array_values($methodveparametreler);
                $method = $methodveparametreler[0];
                if(method_exists($umutsurmeli, $method))
                {
                    
                    array_shift($methodveparametreler);
                    $parametreler = array_values($methodveparametreler);
                    call_user_func_array(array($umutsurmeli,$method), $parametreler);
                    
                }
                else
                {
                    $umutsurmeli->sayfabulunamadi();
                }
                
                //if(method_exists($defaultcontrolleryolu, $umutsurmeliyolu))
                exit();
            }
            
        }
        
        # default controller altında metod var mı?
        #####################################################
        if($umutsurmeliyuklendi === false) {
            require_once(SYSTEMPATH.'controller/us_controller.php');
            $umutsurmeli = new umutsurmeli\system\controller\us_controller();
            $umutsurmeli ->sayfabulunamadi();            
        }
}
else
{

    include(SYSTEMPATH.'controller/us_controller.php');
    if(DEFAULT_CONTROLLER=='') {
        $umutsurmeli = new us_controller();
        $umutsurmeli->index();
    }
    else {

        
        $defaultcontrollerpath = APPPATH.'controller/'.DEFAULT_CONTROLLER.'.php';
        if(!file_exists($defaultcontrollerpath)) {
            exit('Default controller bulunamadı!');
        }
        include($defaultcontrollerpath);
        
        if(stristr(DEFAULT_CONTROLLER,'/')!==false) {
            $defaultcontrolleradi = substr(DEFAULT_CONTROLLER, strrpos(DEFAULT_CONTROLLER,'/')+1);
        }
        else {
            $defaultcontrolleradi = DEFAULT_CONTROLLER;
        }
        
        $umutsurmeli = new $defaultcontrolleradi();
        $umutsurmeli->index();
    }
    

}