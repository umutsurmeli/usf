<?php
namespace umutsurmeli\app\config;
class config  extends \umutsurmeli\system\library\config {

    ###########################################
    #         ayarlar burada tanımlanır       #

    public $domain = 'usf.umutsurmeli.com';
    public $description = 'umutsurmeli framework deneme.';
    public $smtphost = '';
    public $smtpport = 0;
    public $systemfrom = '';
    public $systemsmtppass = '';

    public $guvenliIP = array(
       
    );
    
    public $database = array(
        'aktif'=>false
        ,'host'=>''
        ,'user'=>''
        ,'pass'=>''
        ,'db'=>''
        ,'port'=>3306
        ,'socket'=>null
        ,'charset'=>'utf8'
    );
    
    public $config_autoload = array('bin');//'config2','config3_1\config3');
    
    // array('library'=>'run (bool) default'); // çok gerekmedikçe true kullanma
    public $library_autoload = array();
    
    // library/Temel
    public $protokolezorla = 'https';
    public $subdomain = 'usf';
    
    #         ayarlar burada tanımlanır       #
    ###########################################



    public function __construct() {
        parent::__construct();


    }
}