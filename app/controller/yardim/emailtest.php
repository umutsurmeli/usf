<?php

use umutsurmeli\system\controller\us_controller;
    //$this->load->thirdparty('PHPMailer/src');

class emailtest extends us_controller {
    public function __construct() {
        parent::__construct();

    require('app/thirdparty/mail/mailgonder.php');

    
}
public function index()
{


    if(!empty($_POST['to'])&& array_key_exists(getUserIpAddr(), config('guvenliIP')))
    {
        $mailgonder = new mailgonder($_POST['to']);
        $mailgonder->KimdenEkle(config('systemfrom'));
        $mailgonder->KonuEkle('deneme maili');
        $mailgonder->MesajEkle('Bu bir denemedir.');
        switch($_POST['metod'])
        {
            case 'sendmail';
            $sonuc=$mailgonder->sendmail();
            break;
            case 'smtp':
                $sonuc=$mailgonder->smtp();
                break;
            default :
                $sonuc=false;
        }
        echo intval($sonuc).' '.$mailgonder->gondericimetod;
    }
    else
    {
        echo  getUserIpAddr();
    }
    
    //$stylesArray[]  = array('href'=>'https://fonts.googleapis.com/css?family=Open+Sans:400,600');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/all.min.css');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/bootstrap.min.css');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/template1.css');
    $header['styles'] = addStyle($stylesArray);
    $veri['header'] = view('standard/template1/1_header',$header);
    //$veri['menu'] = view('underconstruction/2_menu');
    //$veri['banner'] = view('underconstruction/3_banner');
    //$veri['content'] = view('standard/template1/4_content');
    //$veri['action'] = view('standard/template1/5_action');
    $footer['domain'] = config('domain');
    $veri['footer'] = view('standard/template1/6_footer',$footer);
    view('yardim/view_emailtest', $veri, false);  
}
public function indexx()
{

    include(APPPATH.'thirdparty/PHPMailer/autoload.php');
    if(!empty($_POST['to'])) {
        
        //$mail = new $classname();
        //Create a new PHPMailer instance
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        //Set PHPMailer to use the sendmail transport
        $mail->isSendmail();
        //Set who the message is to be sent from
        $mail->setFrom('from@example.com', 'First Last');
        //Set an alternative reply-to address
        $mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress('umutsurmeli@hotmail.com', 'John Doe');
        $mail->addCC('info@nkada.com','asdf asdf');
        //Set the subject line
        $mail->Subject = 'PHPMailer sendmail test';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->msgHTML('<p>merhaba</p>');
        //Replace the plain text body with one created manually

        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }

    
    //$stylesArray[]  = array('href'=>'https://fonts.googleapis.com/css?family=Open+Sans:400,600');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/all.min.css');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/bootstrap.min.css');
    $stylesArray[]  = array('href'=>base_url().'assets/template1/css/template1.css');
    $header['styles'] = addStyle($stylesArray);
    $veri['header'] = view('standard/template1/1_header',$header);
    //$veri['menu'] = view('underconstruction/2_menu');
    //$veri['banner'] = view('underconstruction/3_banner');
    //$veri['content'] = view('standard/template1/4_content');
    //$veri['action'] = view('standard/template1/5_action');
    $footer['domain'] = config('domain');
    $veri['footer'] = view('standard/template1/6_footer',$footer);
    view('yardim/view_emailtest', $veri, false);
    
}


public function sendmailtest() {
    /* çalışıyor iç yazışmalarda kullanılmalı.
    require(APPPATH.'thirdparty/PHPMailer/sendmail.php');
    $sendmail = new sendmail();
    $sendmail->KimeEkle('umutsurmeli@hotmail.com','Umut SÜRMELİ');
    $sendmail->KimdenEkle(config('systemfrom'));
    $sendmail->KopyaEkle('info@nkada.com');
    $sendmail->GizliKopyaEkle('umut@umutsurmeli.com','Umut SÜRMELİ');
    $sendmail->KonuEkle('Deneme');
    $sendmail->MesajEkle('Bu bir deneme!<?=$test;?>');
    $sendmail->gonder();
     * 
     */
}
public function smtptest() {
    require(APPPATH.'thirdparty/mail/phpsmtp/src/Email.php');
    $mail = new Snipworks\Smtp\Email('mail.umutsurmeli.com', 587);
    $mail->setProtocol(Snipworks\Smtp\Email::TLS);
    $mail->setLogin(config('systemfrom'), config('systemsmtppass'));
    $mail->addTo('umutsurmeli@gmail.com', 'Example Receiver');
    $mail->addCC('umutsurmeli@yahoo.com');
    // $BCC maillerde görünüyor!!!!!!! $mail->addBcc('info@nkada.com');
    $mail->setFrom('umut@umutsurmeli.com', 'umut sürmeli');
    $mail->setSubject('Example subject');
    $mail->setHtmlMessage('<b>Example message</b>...');

    if($mail->send()){
        echo 'Success!';
    } else {
        echo 'An error occurred.';
    }

}
public function duzmail()
{
    $headers = 'From: '. config('systemfrom');
    mail('umutsurmeli@yahoo.com','deneme','mesaj',$headers);
}
}