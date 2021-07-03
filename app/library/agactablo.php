<?php
namespace umutsurmeli\app\library;
class agactablo {
public $agac=array();
public $tumdallar = array();
public $derinlik = 1;
public $kokanahtaradi;
public $dalanahtaradi;
public $base_url='';
public $checkbox_ekle=true;
public $DurumAlani = 'Durum';
# her kategorinin bir ana kategorisi olmak zorunda.
public function __construct($dallar,$kokanahtaradi,$dalanahtaradi) {
    $this->tumdallar = $dallar;
    $this->kokanahtaradi = $kokanahtaradi;
    $this->dalanahtaradi = $dalanahtaradi;


}
public function altdalivarmi($anabaslik,$dalanahtari) {
    $this->derinlik++;
    $baslik = 1;
    foreach ($this->tumdallar as $row) {
        $style = '';
        if($row[$this->kokanahtaradi] == $dalanahtari) {
            echo '<br/>';
            if($this->checkbox_ekle) {
                echo '<input name="'.$this->dalanahtaradi.'['.$row[$this->dalanahtaradi].']"';
                echo ' value=1 type="checkbox"/> ';
            }
            if($row[$this->DurumAlani]==0) {$style=' style="color:#000;"';}
            echo '<a href="'.$this->base_url.$row[$this->dalanahtaradi].'/"'.$style.'>'.$anabaslik.'.'.$baslik.' '.$this->baslikbul($row).'</a>';

            $this->altdalivarmi('&nbsp;'.$anabaslik.'.'.$baslik,$row[$this->dalanahtaradi]);
            $baslik++;
        }
        
    }

}

public function basla($kokdegeri=0) {
    ob_start();
    $baslik = 1;
    
    foreach ($this->tumdallar as $row) {
        $style = '';
        if($row[$this->kokanahtaradi] == $kokdegeri) {
            echo '<br/>';
            if($this->checkbox_ekle==true) {
                echo '<input name="'.$this->dalanahtaradi.'['.$row[$this->dalanahtaradi].']"';
                echo ' value=1 type="checkbox"/> ';
            }
            if($row[$this->DurumAlani]==0) {$style=' style="color:#000;"';}
            echo '<a href="'.$this->base_url.$row[$this->dalanahtaradi].'/"'.$style.'>'.$baslik.'. '.$this->baslikbul($row).'</a>';
            $this->altdalivarmi('&nbsp;'.$baslik,$row[$this->dalanahtaradi]);
            $baslik++;
        }
        
    }
    $menuagaci = ob_get_contents();
    ob_end_clean();
    return $menuagaci;
    //echo '<br/>'.$this->derinlik;
}
################
# misafir / ziyaretçi için listeleme metodları
public function misafirbasla($kokdegeri=0) {
    ob_start();
    $baslik = 1;
    foreach ($this->tumdallar as $row) {
        if($row[$this->kokanahtaradi] == $kokdegeri) {
            echo '<br/>';
            echo '<a href="'.$this->base_url.$row['SeoUrl'].'/">'.$baslik.'. '.$this->baslikbul($row).'</a>';
            $this->misafiraltdalivarmi('&nbsp;'.$baslik,$row[$this->dalanahtaradi]);
            $baslik++;
        }
        
    }
    $menuagaci = ob_get_contents();
    ob_end_clean();
    return $menuagaci;
    //echo '<br/>'.$this->derinlik;
}
public function misafiraltdalivarmi($anabaslik,$dalanahtari) {
    $this->derinlik++;
    $baslik = 1;
    foreach ($this->tumdallar as $row) {
        if($row[$this->kokanahtaradi] == $dalanahtari) {
            echo '<br/>';

            echo '<a href="'.$this->base_url.$row['SeoUrl'].'/">'.$anabaslik.'.'.$baslik.' '.$this->baslikbul($row).'</a>';

            $this->misafiraltdalivarmi('&nbsp;'.$anabaslik.'.'.$baslik,$row[$this->dalanahtaradi]);
            $baslik++;
        }
        
    }

}
# misafir / ziyaretçi için listeleme metodları
################

public function baslikbul($satir) {
    for($i=1;$i<5;$i++) {
        $baslik = 'H'.$i;
        if(!empty($satir[$baslik])) {
            return $satir[$baslik];
        }
    }
    return '';
}

}


