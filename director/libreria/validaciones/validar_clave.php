<?php

$valida1=1;
$valida2=1;
$valida3=1;
 if (!preg_match('`[A-Z]`',$_REQUEST[$_POST['campo_validar']])){
      
        
	  $valida1=0;
	  
   }
  
  if (!preg_match('`[0-9]`',$_REQUEST[$_POST['campo_validar']])){
     
      $valida2=0;
   } 
   
   

  // if(!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',$_REQUEST[$_POST['campo_validar']]) )
   //{   
   //  $valida3=0;
  // }


   
   
   $verifcatdo=$valida1*$valida2;
   
   if(!($verifcatdo))
   {
   
   echo "false";

   }
   else
   {
     echo "true";

   
   }

?>