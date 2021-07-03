<?php
namespace umutsurmeli\system\model;
use umutsurmeli\system\model\USModel;
class genel_model extends USModel {
public $TabloAdi;
public $PrimaryKey;
public $Fields = array();
public $SimpleFields = array();
public function __construct($TabloAdi) {
parent::__construct();
    $this->TabloAdi = htmlentities($TabloAdi,ENT_QUOTES);
    $this->SetFields();
}
private function SetFields() {
    $select = "DESCRIBE ".$this->TabloAdi;
    $res = $this->db->query($select);
    $result = array();
    $SimpleFields = array();
    while($row = $res->fetch_assoc())
    {
        $result[] = $row;
        if(isset($row['Key'])&&$row['Key']=='PRI') {
            $this->PrimaryKey = $row['Field'];
        }
        $SimpleFields[] = $row['Field'];
    }
    $this->Fields = $result;
    $this->SimpleFields = $SimpleFields;

    
}
public function ekle($columnsData,$htmlencode=true) {
   $sql = "INSERT IGNORE INTO ".$this->TabloAdi;
   $alanadlari = array();
   $alandegerleri = array();
   foreach($columnsData as $columnName=>$columnValue) {
     if($columnName==$this->PrimaryKey) {
         continue;
         
     }
     
     if($htmlencode) {
         $alanadlari[]=htmlentities($columnName,ENT_QUOTES);
         $alandegerleri[] = htmlentities($columnValue,ENT_QUOTES); 
     }
     else {
         $alanadlari[]=$columnName;
         $alandegerleri[] = $columnValue;
     }
    }
    
    $sql .= " (".implode(",", $alanadlari).")";
    $sql .= " VALUES('".implode("','",$alandegerleri)."');";
    $res = $this->db->query($sql);
    return $this->db->insert_id;
}
}