<?php
namespace umutsurmeli\system\model;
class QueryBuilder  {
    public  $db;
    private $queryString=array();
    public $last_query;
    public function __construct($dbobj) {
        $this->db =$dbobj;
        $selfObj = $this;



        
    }
    public function select($colNames)
    {
        if(empty($colNames)) {return false;}
        
        $selectqr = "SELECT ";
        $i=0;
        if(stristr($colNames,",")) {
            $cols = explode(",", $colNames);
            foreach ($cols as $colName) {
                $colName=trim($colName);
                if(!empty($colName))
                {
                    if($i>0) {$selectqr.=",";}
                    
                    $selectqr.=$colName;
                    $i++;
                }
            }
            
        }
        return $selectqr;
    }

    public function query($queryStr) {
        try {
            $res = $this->db->query($queryStr);
            return $res;
        } catch (\mysqli_sql_exception $ex) {
            switch ($this->db->errno)
            {
                case 1064:
                    echo "sorgu hatalı: ";//.$ex->getLine();
                    break;
                default :
                    echo "Bir hata oluştu!";
            }
        }

    }
    public function get($TableName="")
    {
        
        if(!empty($TableName))
        {
            $this->queryString["FROM"] = $TableName;

            
        }
            $this->last_query = $this->get_compiled_select();
            $result = $this->query($this->last_query);
            //echo $this->last_query;
            //var_dump($result);
            $this->queryString = array();
            $ResultObj = new Result($result);
            return $ResultObj;
            
    }
    public function from($TableName)
    {
        $this->queryString["FROM"] = $TableName;
    }
    public function get_compiled_select()
    {
        $select = "SELECT ";
        if(array_key_exists("SELECT", $this->queryString)) {
            if(!empty($this->queryString["SELECT"])) {
                $select .= $this->queryString["SELECT"];
            }
        }
        else {
            $select.= " *";
        }
        
        if(array_key_exists("FROM", $this->queryString)) {
            if(!empty($this->queryString["FROM"])) {
                $select .= " FROM ".$this->queryString["FROM"];
            }
        }
        else {
            exit(" this->from(Tablo adı) veya this->get(Tablo adı) kullanılmalı!");
        }
        
        if(array_key_exists("WHERE", $this->queryString)) {
            if(!empty($this->queryString["WHERE"])) {
                $select .= " WHERE";
                $i=0;
                foreach($this->queryString["WHERE"] as $field=>$value) {
                    if($i>0) {$select.= " AND";}
                    $select.= " ".$field.$value;
                    
                    $i++;
                }
                
                
            }
        }
        if(array_key_exists("LIMIT", $this->queryString)) {
            
            $select .= $this->queryString["LIMIT"];
            
        }
        
        return $select;
        
    }

    public function where($DiziVeyaYazi,$NullVeyaDeger,$Escape=true) {
                    $eschar = "";
                    if($Escape) {$eschar="`";}
        if(is_array($DiziVeyaYazi))
        {
            $i=0;
            foreach($DiziVeyaYazi as $field=>$value)
            {
                    $search = array("!","<",">","=");
                    $replace = array(1,2,3,4);
                    $isaretcount = 0;
                    str_replace($search, $replace, $field, $isaretcount);
                    


                    if($isaretcount>0)
                    {
                        //$select.= " ".$field." = '".$value."'";
                        $this->queryString["WHERE"][$eschar.$field.$eschar]="'".$value."'";
                    }
                    else {
                        $this->queryString["WHERE"][$eschar.$field.$eschar]=" = '".$value."'";
                    }
                    

                
                
                
                $i++;
            }
        }
        else if(is_string($DiziVeyaYazi)) {

                    
                    $search = array("!","<",">","=");
                    $replace = array(1,2,3,4);
                    $isaretcount = 0;
                    str_replace($search, $replace, $DiziVeyaYazi, $isaretcount);
                    if(is_null($NullVeyaDeger))
                    {
                        $this->queryString["WHERE"][$eschar.$DiziVeyaYazi.$eschar] = null;
                    }
                    else
                    {
                        if($isaretcount>0)
                        {
                            
                            $this->queryString["WHERE"][$eschar.$DiziVeyaYazi.$eschar] = "'".$NullVeyaDeger."'";
                        }
                        else
                        {

                            $this->queryString["WHERE"][$eschar.$DiziVeyaYazi.$eschar] = " = '".$NullVeyaDeger."'";
                        }
                    }
        }

    }
    public function limit($limitlength,$limitstart=null) {
        $limitlength = (int) $limitlength;
        if($limitlength<=0) {
            exit("Limit geçersiz!");
        }
        
        if(is_null($limitstart)) {
            $limit = " LIMIT ".$limitlength;
        }
        else {
            $limitstart = (int) $limitstart;
            if($limitstart<0) {
                exit("Limitstart geçersiz!");
            }
            $limit = " LIMIT ".$limitstart.",".$limitlength;
        }
        $this->queryString["LIMIT"] = $limit;
    }

}
class Result
{
    protected $result;
    public function __construct($mysqlires){
        $this->result = $mysqlires;
    }
    public function row_array()
    {
        while($row=$this->result->fetch_assoc())
        {
            return $row;
        }
    }
    public function result_array()
    {
        $rows = array();
        while($row=$this->result->fetch_assoc())
        {
            $rows[] = $row;
        }
        return $rows;
    }
}