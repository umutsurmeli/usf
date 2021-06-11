<?php

# v.1.001 
# .htaccess ile app ve system klasörlerine direk erişim engellendi.


#
# helper.php güncellendi addScript,addStyle iyileştirildi.


# v.1.002
# ayar tanımlama (app/config/config.php) alanı belirlendi.
# sistem propertiesleri ile çakışması ihtimaline karşın 
# sistem propertye atama engellendi.
# çağırma işlemi $this->config->item($param) metoduna atandı.

# v.1.003 ayar ve view çağrımı için kolay config() ve view()
# fonksiyonları eklendi. Ana kontroller load metodunu çağırmaları
# sağlandı.
# Test teması yüklendi.

# v.1.004 app ve system klasörleri tekrar organize edildi. js, css, img,
# örnek template assets klasörü altına alındı.
# view/standard altında templateX'e ait parçalar çoğaltılmak
# üzere saklandı.
# underconstruction klasörü oluşturuldu ve templateX parçalarından
# yararlanılarak controller view() başvuruları değiştirildi.

# v.1.005 alternatif mail kütüphaneleri eklendi. sendmail ve smtp
# uygulamaları ile iki farklı yöntemle mail gönderilebiliyor.
# hosting domainine mail giderken sendmail başka domainler için
# smtp kullanılıyor.

# v.1.007 QueryBuilder temelleri atıldı.

# V.1.008 Controller var ancak içindeki tanım dosya adı ile uyumlu
# değilse sayfabulunamadi() çalıştır.
# Versiyon numarası index.php' ye eklendi.


# V.1.009 QueryBuilder select işlemleri geliştirildi.

# V.1.011 __routeToMethod fonksiyonu ile bir controllerdan 
# başka bir kontroller metoduna yönlendirme sağlanıyor.
# defaultclass url'de görünmediği zaman
#  URL yapısı proje/metod şeklinde görüntüleniyor.
# proje/metod router ile başka bir controller/metoda yönlendirilir ise
# Örnek olarak proje/{görünmeyen_default_controller}/metod/arg1,arg2,arg...
# sonsuz argüment ile seo için daha uyumlu olan örnek
# proje/kategoriler/arg1/arg2/arg3... dağılımlı URL elde ediliyor.
# yukarıdaki satırda "kategoriler" bir kontroller değil aslında default
# controllerın metodu. altındaki argümentlerde başkabircontroller/başkabirmetod
# altında değerlendiriliyor.

# V.1.012 "kategori/kategoriler" veya "yardim/yardimlar" benzeri URL
# yapısında oluşan metodun bulunamaması hatası düzeltildi.
# $umutsurmeli->path_segments($index='') fonksiyonu eklendi.

# v.1.013 taksim() eklendi. model/$this->where() iyileştirildi.

