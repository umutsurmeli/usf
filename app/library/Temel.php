<?php
namespace umutsurmeli\app\library;
class Temel {
    public $US;
    public function __construct() {
        //$this->US =&get_instance();
        //echo $this->US->rand;
        $protokol = config('protokolezorla');
        $subdomain = config('subdomain');
        $this->URLDogrult($protokol, $subdomain);
}
var $Hata='';
var $SonSorgu='';
function URLDogrult($protokol,$sub='') 
{
    //protokol http veya https
    $YeniUrl='';
    $HataYeri=array();
    $Yonlendirilmeli = false;
    if($sub!='www')
    {
        if(strlen($sub)==0&&stristr($_SERVER['HTTP_HOST'],'www')!==false) {
            $YeniUrl = $_SERVER['HTTP_HOST'];
            //echo $YeniUrl;
            $YeniUrl = str_replace('www.', '', $YeniUrl);
            //exit($YeniUrl);
            $Yonlendirilmeli = true;
            $HataYeri[]=1;
        }
        else if(strlen($sub)==0&&stristr($_SERVER['HTTP_HOST'],'www')===false) {
            $YeniUrl = $_SERVER['HTTP_HOST'];
            //echo $YeniUrl;
            //$YeniUrl = str_replace('www.', '', $YeniUrl);
            //exit($YeniUrl);
            $Yonlendirilmeli = false;
            $HataYeri[]=2;
        }
        else if(strlen($sub)>0&&stristr($_SERVER['HTTP_HOST'],"www")!==false)
        {
            $YeniUrl = str_replace('www', $sub, $_SERVER['HTTP_HOST']);
            $Yonlendirilmeli=true;
            $HataYeri[]=3;
            
        }
        else if(strlen($sub)>0&&stristr($_SERVER['HTTP_HOST'],"www")===false)
        {
            $YeniUrl = str_replace('www', $sub, $_SERVER['HTTP_HOST']);
            $Yonlendirilmeli=false;
            $HataYeri[]=4;
            
        }
        else if(strlen($sub)>0&&stristr($_SERVER['HTTP_HOST'],$sub)===false)
        {
            $YeniUrl = $sub.'.'.$_SERVER['HTTP_HOST'];
            $Yonlendirilmeli = true;
            $HataYeri[]=5;
        }
        else {
            $Yonlendirilmeli=false;
        }
        
        //$Yonlendirilmeli = true;
        $HataYeri[]=6;
    }
    else 
    {
        if(stristr($_SERVER['SERVER_NAME'],"www")===false)
        {
            $YeniUrl = 'www.'.$_SERVER['SERVER_NAME'];
            $Yonlendirilmeli = true;
            $HataYeri[]=7;
        }
        else if(stristr($_SERVER['HTTP_HOST'],"www")===false)
        {
            $YeniUrl = 'www.'.$_SERVER['HTTP_HOST'];
            $Yonlendirilmeli = true;
            $HataYeri[]=8;
        }
        else
        {
            $YeniUrl = $_SERVER['HTTP_HOST'];
            $HataYeri[]=9;
        }
    }
    
    if($protokol == 'http' && $_SERVER['REQUEST_SCHEME'] == 'https') 
    { 
        $YeniUrl = 'http://'.$YeniUrl;
        $Yonlendirilmeli = true;
    }
    else if($protokol == 'https' && $_SERVER['REQUEST_SCHEME'] == 'http') 
    { 
        $YeniUrl = 'https://'.$YeniUrl;
        $Yonlendirilmeli = true;
    }
    else
    {
        $YeniUrl = $protokol.'://'.$YeniUrl;
    }
    
    #us_framework düzenlemesi
    $istek = $_SERVER['REQUEST_URI'];
    
    if(substr($istek,-1)!='/') {
        $istek.='/';
        $Yonlendirilmeli = true;
    }
    $YeniUrl = $YeniUrl.$istek;
    
    
    
    if($Yonlendirilmeli === true)
    {
        //print_r($HataYeri);
        //exit($YeniUrl);
        header('Location: '.$YeniUrl);
        //echo $YeniUrl;
    }
    return;
}
function MesajOnayKoduOlustur($Ident1,$Ident2,$Const1)
{
    //session_start() verilmiş olmalı
    $SonGuvenlikKodu = $_SESSION['gkod']; // Tekrar kontrol edileceği sayfada, tekrar oluşturulmamalı.
    //Decode yok aynı parametreler tekrar encode edilir. Önceden encode Asil Kod ya da Yedek Kod'la eşleşirse istenilen işlemler gerçekleştirilir.
    // Eşleşme sağlanabilmesi için aynı identler kullanılmalı.
        $UniquePart1 = $Ident1;//Kullanıcıya özel olmalı - Kod -
        $UniquePart2 = $Ident2;//Kullanıcıya özel olmalı - EMail -
        $ConstPart = $Const1;//Kullanıcı kayıt tarihi değişmez - KayitTarihi -
        $SessionInfoPart1 = $_SERVER['REMOTE_ADDR']; //Oturuma özel - IP -
        $SessionInfoPart2 = session_id();//Oturuma özel - session_id() -

        $MesajOnayKodu='';
        for($i=0;$i<32;$i++)
        {
            $KodParcasi='';
            if(isset($SonGuvenlikKodu[$i])) {$KodParcasi .= $SonGuvenlikKodu[$i];}
            if(isset($UniquePart1[$i])) {$KodParcasi .= $UniquePart1[$i];}
            if(isset($UniquePart2[$i])) {$KodParcasi .= $UniquePart2[$i];}
            if(isset($ConstPart[$i])) {$KodParcasi .= $ConstPart[$i];}
            if(isset($SessionInfoPart1[$i])) {$KodParcasi .= $SessionInfoPart1[$i];}
            if(isset($SessionInfoPart2[$i])) {$KodParcasi .= $SessionInfoPart2[$i];}

            $MesajOnayKodu .= $KodParcasi;


        }
        $OnayKodBilgileri['MesajOnayKodu'] = md5($MesajOnayKodu);
        $OnayKodBilgileri['MesajOnayKoduKisa'] = substr($OnayKodBilgileri['MesajOnayKodu'], 0,6);


        return $OnayKodBilgileri;

}

function GlobalGoogleArama()
{
    $AnaDizin='';
    if(isset($GLOBALS['AnaDizin'])) {$AnaDizin=$GLOBALS['AnaDizin'];}
    
    $GLOBALS['GoogleArama']='';
    if(file_exists($AnaDizin.'addons/google/googlearama.html')) {
        ob_start();
        include ($AnaDizin.'addons/google/googlearama.html');
        $GLOBALS['GoogleArama']= ob_get_contents();
        ob_end_clean();
    } else {
        $GLOBALS['GoogleArama']='<!-- anadizin: '.$AnaDizin.' google arama bulunamadı -->';
    }
}
function GlobalGoogleWebArama()
{
    $AnaDizin='';
    if(isset($GLOBALS['AnaDizin'])) {$AnaDizin=$GLOBALS['AnaDizin'];}
    
    $GLOBALS['GoogleWebArama']='';
    if(file_exists($AnaDizin.'addons/google/googletumwebarama.html')) {
        ob_start();
        include ($AnaDizin.'addons/google/googletumwebarama.html');
        $GLOBALS['GoogleWebArama']= ob_get_contents();
        ob_end_clean();
    } else {
        $GLOBALS['GoogleWebArama']='<!-- anadizin: '.$AnaDizin.' google arama bulunamadı -->';
    }
}
function  GlobalFacebookPagePlugin() {
    $AnaDizin='';
    $SanalDizin = '';
    if(isset($GLOBALS['AnaDizin'])) {$AnaDizin=$GLOBALS['AnaDizin'];}
    if(isset($GLOBALS['SanalDizin'])) {$SanalDizin=$GLOBALS['SanalDizin'];}
    
    $GLOBALS['FacebookPagePlugin']='';
    if(file_exists($AnaDizin.$SanalDizin.'addons/facebook/page-plugin.html')) {
        ob_start();
        include ($AnaDizin.$SanalDizin.'addons/facebook/page-plugin.html');
        $GLOBALS['FacebookPagePlugin']= ob_get_contents();
        ob_end_clean();
    }
}
function TRtolower($kelime) {
    $yenikelime=$kelime;
    for($i=0;$i<strlen($kelime);$i++) {
        $yenikelime=str_replace('I','ı', $yenikelime);
        $yenikelime=str_replace('İ','i', $yenikelime);
        $yenikelime=str_replace('Ç','ç', $yenikelime);
        $yenikelime=str_replace('Ğ','ğ', $yenikelime);
        $yenikelime=str_replace('Ş','ş', $yenikelime);
        $yenikelime=str_replace('Ö','ö', $yenikelime);
        $yenikelime=str_replace('Ü','ü', $yenikelime);
        
    }
    $yenikelime=strtolower($yenikelime);
    return $yenikelime;
}
function TimeStampParcala($TimeStamp) {
    if(empty($TimeStamp)) {return false;}
    $An = explode(' ', $TimeStamp);
    $Tarih = $An[0];
    $Zaman = $An[1];
    $TarihParcalar= explode('-',$Tarih);
    $ZamanParcalar= explode(':', $Zaman);
    $Hepsi['Yil']=$TarihParcalar[0];
    $Hepsi['Ay']=$TarihParcalar[1];
    $Hepsi['Gun']=$TarihParcalar[2];
    $Hepsi['Saat']=$ZamanParcalar[0];
    $Hepsi['Dakika']=$ZamanParcalar[1];
    $Hepsi['Saniye']=$ZamanParcalar[2];
    $Hepsi['time'] = mktime(intval($Hepsi['Saat']), intval($Hepsi['Dakika']), intval($Hepsi['Saniye']), intval($Hepsi['Ay']), intval($Hepsi['Gun']),intval($Hepsi['Yil']));
    return $Hepsi;

    
}
function DateTimeArray($DateTime) {
    $Zaman['Year'] = substr($DateTime, 0, 4);
    $Zaman['Month'] = substr($DateTime, 5, 2);
    $Zaman['Day'] = substr($DateTime, 8, 2);
    $Zaman['Time'] = substr($DateTime, 11);
    return $Zaman;
}
function HataOku($Veri) {
    ob_start();
    var_dump($Veri);
    $Hata = ob_get_contents();
    ob_end_clean();
    return $Hata;
}
function HataKaydet($Sayfa,$Aciklama,$Baglanti) {
    $query = 'INSERT INTO Log_Hatalar (Sayfa,Aciklama) VALUES ("'.$Sayfa.'","'.$Aciklama.'");';
    $Baglanti->query($query);
}
function create_settings($Baglanti) {
    //trends_ayarları için oluşturuldu ve modifiye edildi.
    //Artık bütün site ayarları bu tablo altında toplanacak Umarım.
    //Id kolonuna foreign keyle bağlantılar oluşturubilir, Id'nin değiştirilmesi sıkıntı yaratabilir.
    //get Id ve set Id metodlarıyla auto_incrementin gereksiz yere artması engellenecek. Bakınız trends_, cnnturk_,sputniknews_
            $sql = 'CREATE TABLE `Settings` (
	`Id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`Application` VARCHAR(255) NOT NULL,
	`Key` VARCHAR(255) NOT NULL,
	`Value` VARCHAR(255) NOT NULL,
	`AdminNote` VARCHAR(255) NULL DEFAULT NULL,
	`Sorter` INT(11) NOT NULL DEFAULT "0",
	`IsActive` TINYINT(1) NOT NULL DEFAULT "1",
	PRIMARY KEY (`Id`),
	UNIQUE INDEX `Key` (`Key`, `Value`),
	INDEX `Application` (`Application`)
)
COLLATE="utf8_general_ci"
ENGINE=InnoDB
;
';
            $Baglanti->query($sql);
}
public  static function  testx() {
    echo __CLASS__.' çalışıyor';
}
}