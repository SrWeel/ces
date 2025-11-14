<?php
/*define('DURACION_SESION','175200'); //2 horas
ini_set("session.cookie_lifetime",DURACION_SESION);
ini_set("session.gc_maxlifetime",DURACION_SESION); 
ini_set("session.save_path","/tmp");
session_cache_expire(DURACION_SESION);
session_start();
session_regenerate_id(true); 

echo $_SESSION['ces1313777_sessid_nombreusuario'];*/

@$tiempossss=44420000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

echo $_SESSION['ces1313777_sessid_nombreusuario'];

?>