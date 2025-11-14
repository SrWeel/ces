<?php
   if(trim($_REQUEST[$_POST['campo_validar']])>0)
   {
   if(trim($_REQUEST[$_POST['campo_validar']]))
   {
   echo "true";
   }
   else
   {
   echo "false";
   }
   }
   else
   {
     echo "false";

   
   }

?>