<?php
namespace umutsurmeli\app\model\yonetim;
use umutsurmeli\system\model\USModel;
class girismodel extends USModel {
    public function __construct() {
        parent::__construct();
    }
    public function giriskontrol($KullaniciAdi,$Sifre)
    {

       $query = "SELECT * FROM yonetim";
       $query .= " WHERE KullaniciAdi = (?) AND Sifre = (?)";
       $query .= " LIMIT 1";
       $stmt = $this->db->prepare($query);
       $stmt->bind_param("ss",$KullaniciAdi,$Sifre);
       
       $stmt->execute();
       $res = $stmt->get_result();
       $row = $res->fetch_assoc();
       $stmt->free_result();
       $stmt->close();
       return $row;
        
    }
}
