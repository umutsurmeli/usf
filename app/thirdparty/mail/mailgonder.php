<?php

class mailgonder
{
    // PHPMailer > Sendmail'i kullanır. hotmail'e mail gitmiyor. 
    // iç yazışmalarda kullanılabilir.
    protected $Mailer; // phpmailer veya snipworks
    protected $Kime = array();//'a@b.com=>ali veli';
    protected $Kimden = array('mail'=>'','AdSoyad'=>'');
    protected $Kopya = array();//'a@b.com=>ali veli';
    protected $GizliKopya = array();//'a@b.com=>ali veli';
    protected $Konu;
    protected $Mesaj;
    protected $MesajHTML;
    public $gondericimetod;
    
    public function __construct($Kime,$Kimden='') {
        if(!filter_var($Kime,FILTER_VALIDATE_EMAIL))
        {
            exit('Kime bilgisi girilmeli!');
        }
        $this->KimeEkle($Kime);
        

    }

    public function sendmail()
    {
        //PHPMailer/sendmail kullanır.
        require(APPPATH.'thirdparty/mail/PHPMailer/autoload.php');
        $this->Mailer = new PHPMailer\PHPMailer\PHPMailer();
        $this->gondericimetod = 'phpmailer.sendmail';
        
        $phpmailer = $this->Mailer;
        $phpmailer->isSendmail();
        // Kimden Ekle
        if(!empty($this->Kimden)) {
            $phpmailer->setFrom($this->Kimden['mail'], $this->Kimden['AdSoyad']);
        }
        else
        {
            exit('Kimden bilgisi boş bırakılamaz!');
        }
        
        // Kime Ekle

        foreach ($this->Kime as $mail=>$AdSoyad)
        {

            $phpmailer->addAddress($mail,$AdSoyad);

        }
        
        // CC Ekle
        if(!empty($this->Kopya))
        {
            foreach($this->Kopya as $mail=>$AdSoyad)
            {
                $phpmailer->addCC($mail,$AdSoyad);
            }
        }
        
        // BCC Ekle
        if(!empty($this->GizliKopya))
        {
            foreach($this->GizliKopya  as $mail=>$AdSoyad)
            {
                $phpmailer->addBCC($mail,$AdSoyad);
            }
        }
        
        // Konu ekle
        if(!empty($this->Konu))
        {
            $phpmailer->Subject=$this->Konu;
        }
        
        if(!empty($this->MesajHTML))
        {
            $phpmailer->msgHTML($this->MesajHTML);
        }
        else if(!empty($this->Mesaj))
        {
            $phpmailer->msgHTML($this->Mesaj);
        }
        else {
            exit('Boş mesaj gönderilemez!');
        }
        
        /*
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
        */
        if(!$phpmailer->send()) {
            return false;
        }
        else {
            return true;
        }
        
        
        
        
    }
    public function smtp()
    {
        require(APPPATH.'thirdparty/mail/phpsmtp/src/Email.php');
        $this->Mailer = new Snipworks\Smtp\Email(config('smtphost'),config('smtpport'));
        $this->gondericimetod = 'snipworks.smtp';
        $smtpmail = $this->Mailer;

        $smtpmail->setProtocol(Snipworks\Smtp\Email::TLS);

        $smtpmail->setLogin(config('systemfrom'), config('systemsmtppass'));
        
        // Kime Ekle

        foreach ($this->Kime as $mail=>$AdSoyad)
        {

            $smtpmail->addTo($mail,$AdSoyad);

        }

        // CC Ekle
        if(!empty($this->Kopya))
        {
            foreach($this->Kopya as $mail=>$AdSoyad)
            {
                $smtpmail->addCC($mail);
            }
        }

        // $BCC maillerde görünüyor!!!!!!! $smtpmail->addBcc('info@nkada.com');
        if(!empty($this->Kimden)) {
            $smtpmail->setFrom($this->Kimden['mail'], $this->Kimden['AdSoyad']);
        }
        else
        {
            exit('Kimden bilgisi boş bırakılamaz!');
        }
        
        // Konu ekle
        if(!empty($this->Konu))
        {

            $smtpmail->setSubject($this->Konu);
        }
        
        if(!empty($this->MesajHTML))
        {

            $smtpmail->setHtmlMessage($this->MesajHTML);
        }
        else if(!empty($this->Mesaj))
        {

            $smtpmail->setHtmlMessage($this->Mesaj);
        }
        else {
            exit('Boş mesaj gönderilemez!');
        }
        

        if($smtpmail->send()){
            return true;
        } else {
            return false;
        }
    }
    public function KonuEkle($Konu)
    {
        if(!is_string($Konu)) {
            exit('Konu boş bırakılamaz!');
        }
        $this->Konu = $Konu;
    }
    public function KimeEkle($mail,$AdSoyad='')
    {
        if(is_string($mail)) {
            $mail = trim($mail);
        }
        else {
            exit('girilen mail geçersiz');
        }
        if(is_string($AdSoyad)) {
            $AdSoyad = trim($AdSoyad);
        }
        
        if(!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
            exit('girilen mail geçersiz!');
        }
        $this->Kime[$mail] =  $AdSoyad;
    }
    public function KopyaEkle($mail,$AdSoyad='')
    {
        if(is_string($mail)) {
            $mail = trim($mail);
        }
        else {
            exit('girilen mail geçersiz');
        }
        if(is_string($AdSoyad)) {
            $AdSoyad = trim($AdSoyad);
        }
        
        if(!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
            exit('girilen mail geçersiz!');
        }
        $this->Kopya[$mail] =  $AdSoyad;
    }
    public function GizliKopyaEkle($mail,$AdSoyad='')
    {
        if(is_string($mail)) {
            $mail = trim($mail);
        }
        else {
            exit('girilen mail geçersiz');
        }
        if(is_string($AdSoyad)) {
            $AdSoyad = trim($AdSoyad);
        }
        
        if(!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
            exit('girilen mail geçersiz!');
        }
        $this->GizliKopya[$mail] =  $AdSoyad;
    }
    public function KimdenEkle($mail,$AdSoyad='')
    {
        if(is_string($mail)) {$mail = trim($mail);}
        else {exit('geçersiz mail!');}
        
        if(is_string($AdSoyad)) {$AdSoyad = trim($AdSoyad);}
        else {exit('Ad Soyad geçersiz veri tipi!');}
                
        if(!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
            exit('Kimden maili geçersiz!');
        }
        $this->Kimden['mail'] = $mail;
        $this->Kimden['AdSoyad'] = $AdSoyad;
    }
    public function MesajHTMLEkle($icerik)
    {
        $this->MesajHTML = $icerik;
    }
    public function MesajEkle($mesaj)
    {
        $this->Mesaj = htmlentities($mesaj,ENT_QUOTES);
    }

    
    
}

