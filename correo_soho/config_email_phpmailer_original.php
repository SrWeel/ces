<?php
#include("phpmailer-gmail/class.phpmailer.php");
#include("phpmailer-gmail/class.smtp.php");

#require_once("PHPMailer_v51/class.phpmailer.php");
#require_once("PHPMailer_v51/class.smtp.php");

class cjEmail {
    var $mail;

    #------------------------Parametros Posibles--------------
    #$Parametros["plugin"]="PHPMailer";"PHP_Mail_Function";
    #$Parametros["Servidor_Correo"]="gmail";"cnj";

    public function __construct($Parametros){
        if($Parametros["plugin"]=="PHPMailer"){
		        
				$this->mail->SMTPDebug  = 2;
                $this->mail = new PHPMailer(true);
                $this->mail->IsSMTP(); 
				//$this->mail->IsMail();            
                $this->mail->SMTPAuth = true;
                $this->mail->SMTPSecure = "ssl";
               // echo $this->mail->Host = gethostbyname("mail.cereni.net");
				$this->mail->Host = "smtp.hostinger.com";
                $this->mail->Port = 465;
                $this->mail->Username = "proformas@ces.com";
                $this->mail->Password = "Proformas.2022";
				
           
        }
        return $this->mail;
    }

    public function __set($var,$val) {
	$this->$var=$val;
    }

    public function __get($var) {
        return $this->$var;
    }    
}
?>
