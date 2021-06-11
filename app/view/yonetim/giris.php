<?php
echo (isset($header)?$header:'<!-- $header -->');
echo (isset($menu)?$menu:'<!-- $menu -->');
echo (isset($banner)?$banner:'<!-- $banner -->');
unset($abc);
?>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form method="post" action="">
    Kullanıcı Adı: <input name="KullaniciAdi" value=""/>
    Şifre: <input name="Sifre" value=""/>
    <input type="submit" value="Giriş"/>
</form>    

<div>



      
<?=(isset($action)?$action:'<!-- $action -->');?>
<?=(isset($footer)?$footer:'<!-- $footer -->');?>