<?php
namespace umutsurmeli\system\model;
use mysqli;
use umutsurmeli\system\model\QueryBuilder;

class usmodel {
    public static $baglanti;
    public $db;
    public $QueryBuilder;
    public function __construct() {
        $this->db= usmodel::$baglanti;
        
        $this->QueryBuilder = new QueryBuilder($this->db);
        
            
        }

    public function qb($method_name)
    {

        $fnExist=method_exists($this->QueryBuilder, $method_name);
        $mysqliFnExist = method_exists($this->db, $method_name);
        //echo gettype($func)." - ".intval($fnExist);
        //echo "<br/>";
        $arg_list = func_get_args();
        if(empty($arg_list)) {exit("$method_name, $arg1, $arg2...");}
        
        $func_unlink = array_shift($arg_list);
        
        if($fnExist)
        {
            
            
            
            //var_dump($arg_list);exit();
            //var_dump($arg_list);
            #$class = new QueryBuilder($this->db);

            return call_user_func_array(array($this->QueryBuilder, $method_name), $arg_list);
        }
        else if($mysqliFnExist) {
            return call_user_func_array(array($this, $method_name), $arg_list);
        }
        

    }
    public static function baglan()
    {
            $ayarlar = config("database");
            if($ayarlar["aktif"]&& is_null(usmodel::$baglanti))
            {

                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                usmodel::$baglanti = @new mysqli($ayarlar["host"], $ayarlar["user"], $ayarlar["pass"], $ayarlar["db"], $ayarlar["port"], $ayarlar["socket"]);
                if(usmodel::$baglanti->connect_errno)
                {
                    exit("Veri tabanı bağlantı hatası!");
                }
                usmodel::$baglanti->set_charset("utf8");
                //echo "<br/>1 kere bağlandı<br/>";

                return usmodel::$baglanti;
            }
            return;
            
    }
    /**
     * select
     *
     * Alan/Kolon isimleri virgül ile ayrılır
     * Örnek select("Adi,Soyadi");
     *
     * @param $columnNames Kolon isimleri
     */
    public function select($columnNames)
    {
        return $this->qb(__FUNCTION__,$columnNames);
    }
    
    public function query($queryString) {
        return $this->qb(__FUNCTION__,$queryString);
    }
    public function get($TableName="")
    {
        return $this->qb(__FUNCTION__,$TableName);
    }
    public function from($TableName)
    {
        return $this->qb(__FUNCTION__,$TableName);
    }
    public function where($DiziVeyaYazi,$NullVeyaDeger=null,$Escape=true) {
        return $this->qb(__FUNCTION__,$DiziVeyaYazi,$NullVeyaDeger,$Escape);
    }
    /**
     * 
     * @param type $limitlength : Getirilecek satır sayısı. Zorunlu.
     * @param type $limitstart  : Başlangıç satır numarası.
     * @return type
     */
    public function limit($limitlength,$limitstart=null) {
        return $this->qb(__FUNCTION__,$limitlength,$limitstart);
    }
    public function get_compiled_select() {
        return $this->qb(__FUNCTION__);
    }
}

