<?php

function base_url($uri = '')
{
    $selfurl = $_SERVER['PHP_SELF'];


    $baseurl = substr($selfurl, 0,strpos($selfurl,'index.php'));
    $baseurl = PROTOCOL.DOMAIN.$baseurl.$uri;
    return $baseurl;
}
function redirect($uri = '')
{
    $base_url = base_url();
    header('Location: '.$base_url.$uri);
    exit();
}

//////////////
// HEADER İÇİNE DEĞİŞKEN SCRIPT VE CSS BAĞLANTISI EKLEME
//

function addScript($scriptsArray,$development=true) {
    
    /*
      Örnek:
      $scriptsArray=array(
               array(
                   'src'=>'x/abc.js',
                    'attributes'=>array(
                            array('name'=>'async','value'=>'true')
                           ,array('name'=>'defer','value'=>'')
                        )
                   )
          );
    */
    $random='?rand='.rand(10,999);
      
    if(!is_array($scriptsArray)||count($scriptsArray)==0) {
        return '';
    } 
    $allScripts='';
    foreach ($scriptsArray as $script) {
        $randomnum = $random;
        
        ####
        # url içinde başka parametre varsa randomnum kullanma. recaptcha için eklendi.
            if(stristr($script['src'],'?')!==false||$development===false) {
                $randomnum = '';
            }
        #
        ###
            
        $allScripts.="\r\n\t\t".'<script type="text/javascript" src="'.$script['src'].$randomnum.'"';
        if(isset($script['attributes'])&&count($script['attributes'])>0) {
            foreach($script['attributes'] as $attribute) {
                $allScripts.=' '.$attribute['name'];
                if(isset($attribute['value'])&&strlen($attribute['value'])>0) {
                    $allScripts.='="'.$attribute['value'].'"';
                }
                unset($attribute);
            }
            
        }
        $allScripts.='></script>';
    }
    return $allScripts;
}
function addStyle($stylesArray,$development=true) {
    
    /*
      Örnek:
      $stylesArray=array(
               array(
                   'href'=>'x/abc.css',
                    'attributes'=>array(
                           array('name'=>'id','value'=>'x123')
                        )
                   )
          );
    */
    $random='?rand='.rand(10,999);
      
    if(!is_array($stylesArray)||count($stylesArray)==0) {
        return '';
    } 
    $allStyles='';
    foreach ($stylesArray as $style) {
        ####
        # url içinde başka parametre varsa randomnum kullanma. recaptcha için eklendi.
            if(stristr($style['href'],'?')!==false||$development===false) {
                $random = '';
            }
        #
        ###
        $allStyles.="\r\n\t\t".'<link rel="stylesheet" href="'.$style['href'].$random.'"';
        if(isset($style['attributes'])&&count($style['attributes'])>0) {
            foreach($style['attributes'] as $attribute) {
                $allStyles.=' '.$attribute['name'];
                if(isset($attribute['value'])&&strlen($attribute['value'])>0) {
                    $allStyles.='="'.$attribute['value'].'"';
                }
                unset($attribute);
            }
            
        }
        $allStyles.='/>';
    }
    return $allStyles;
}

//
// HEADER İÇİNE DEĞİŞKEN SCRIPT VE CSS BAĞLANTISI EKLEME 
/////////////


function DateTimeToGunAyYil($datetime,$saatekle=true,$ayrac='.') {
    $Yil = substr($datetime, 0,4);
    $Ay = substr($datetime, 5,2);
    $Gun = substr($datetime,8,2);
    
    $GunAyYil = $Gun.$ayrac.$Ay.$ayrac.$Yil;
    if($saatekle===false) {
        
        return $GunAyYil;
    }
    
    $GunAyYil = $GunAyYil.' '.trim(substr($datetime,10));
    return $GunAyYil;
    
    
}
function GunAyYilToDateTime($GunAyYil,$Saat) {
        // 28.02.2021 13:43:35 => 2021-02-28 13:43:35
        $GunAyYil = trim($GunAyYil);
        $Saat = trim($Saat);
        $TarihParcalar = explode('.',$GunAyYil);
        $datetime = $TarihParcalar[2].'-'.$TarihParcalar[1].'-'.$TarihParcalar[0].' '.$Saat;
        return $datetime;
}
function SayiTR($FloatSayi,$OndalikKismi = 2) {
    //Bu dönüşüm sağlandıktan sonra sayı hesaplamalarda kullanılamaz.
    $FloatSayi = (float) $FloatSayi;
    $TRSayi = number_format($FloatSayi, $OndalikKismi, ',','.');
    return $TRSayi;
}

function BelirliSayidaKarakter($Kelime,$KarakterSayisi){    
    $Kelime = substr($Kelime,0,$KarakterSayisi).(strlen($Kelime) > $KarakterSayisi ? '...'  : '');     
    return $Kelime; 
}

function latinharflerikullan($cumle)
{

    
    $cumle = str_replace('ç','c',$cumle);
    $cumle = str_replace('Ç','C',$cumle);
    $cumle = str_replace('İ','I',$cumle);
    $cumle = str_replace('ı','i',$cumle);
    $cumle = str_replace('ğ','g',$cumle);
    $cumle = str_replace('Ğ','G',$cumle);
    $cumle = str_replace('ö','o',$cumle);
    $cumle = str_replace('Ö','O',$cumle);
    $cumle = str_replace('ş','s',$cumle);
    $cumle = str_replace('Ş','S',$cumle);
    $cumle = str_replace('ü','u',$cumle);
    $cumle = str_replace('Ü','U',$cumle);

    
    return $cumle;
}
function urltextolustur($cumle)
{
    $cumle = trim($cumle);
    $cumle = latinharflerikullan($cumle);
    $cumle = mb_strtolower($cumle,'UTF-8');
    $eskidegerler = array(' ','"','!',"'",'#','^','+','$','%','&','/','{','(','[',')',']','=','}','?','*','\\','-','.',',','`','é',';','<','>','|',':','´','₺');
    $yenidegerler = array('_');
    $cumle = str_replace($eskidegerler,$yenidegerler,$cumle);
    return $cumle;
    
}
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
/**
 * 
 * @param string $url
 * @return string url sonuna taksim '/' ekler.
 */
function taksim($url)
{
   if(substr($url,-1,1)!='/') {$url=$url.'/';}
   return $url;
}
function post($key='') {
    if(strlen($key)==0) {
        return $_POST;
    }
    else if(isset($_POST[$key])) {
        return $_POST[$key];
    }
    return;
}
function ses($key='') {
    if(strlen($key)==0) {
        return $_SESSION;
    }
    else if(isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }
    return;
}