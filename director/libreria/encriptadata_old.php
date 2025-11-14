<?php

	
class encriptandodata{



function encrypt($text) {

            $key = "yTohterp02hTrs0Ms31tq606";// 24 bit Key
			$iv = "6wmary0z";// 8 bit IV
			$bit_check=8;// bit amount for diff algor.
			$text_num =str_split($text,$bit_check);
			$text_num = $bit_check-strlen($text_num[count($text_num)-1]);
			for ($i=0;$i<$text_num; $i++) {$text = $text . chr($text_num);}
			$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
			mcrypt_generic_init($cipher, $key, $iv);
			$decrypted = mcrypt_generic($cipher,$text);
			mcrypt_generic_deinit($cipher);
			return base64_encode($decrypted);
   }
   
   
function decrypt($encrypted_text){     
               
            $key = "yTohterp02hTrs0Ms31tq606";// 24 bit Key
			$iv = "6wmary0z";// 8 bit IV
			$bit_check=8;// bit amount for diff algor.
			$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
			mcrypt_generic_init($cipher, $key, $iv);
			$decrypted = mdecrypt_generic($cipher,base64_decode($encrypted_text));			
			mcrypt_generic_deinit($cipher);
			$last_char=substr($decrypted,-1);
			for($i=0;$i<$bit_check-1; $i++){
				if(chr($i)==$last_char){
			  
					$decrypted=substr($decrypted,0,strlen($decrypted)-$i);
					break;
				}
			}
			return $decrypted;
   }


}
?>
