<?php
echo (isset($header)?$header:'<!-- $header -->');
echo (isset($menu)?$menu:'<!-- $menu -->');
echo (isset($banner)?$banner:'<!-- $banner -->');
?>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
      <section class="row tm-pt-4 tm-pb-6">
        <div class="col-12 tm-page-cols-container">
          <div class="tm-page-col-right">
            <h1 class="tm-text-secondary tm-mb-5">
              Çalışıyoruz
            </h1>
              <form action="" method="post">
                  <input name="to" placeholder="to" value=""/>
                 <br/> <input name="subject" placeholder="subject" value=""/>
                  <br/><textarea name="message">
                      
                  </textarea>
                  <br/><select name="metod">
                      <option value="sendmail">sendmail</option>
                      <option value="smtp">smtp</option>
                  </select>
                  <br/><input type="submit" value="Gönder"/>
              </form>
          </div>
        </div>
      </section>
<div>



      
<?=(isset($action)?$action:'<!-- $action -->');?>
<?=(isset($footer)?$footer:'<!-- $footer -->');?>