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

            $this->mail = new PHPMailer(true);

                //$this->mail->IsSMTP();
			    
				$this->mail->SMTPAuth = false;
				$this->mail->SMTPSecure = false;
			   $this->mail->Port = 25;

                //$this->mail->SMTPAuth = true;

               // $this->mail->SMTPSecure = "ssl";

                //$this->mail->Host = "smtp.gmail.com";

                //$this->mail->Port = 465;

                //$this->mail->Username = "franklin.aguas@gmail.com";#"amceesystems@gmail.com";

                //$this->mail->Password = "lanena2019";

           

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

