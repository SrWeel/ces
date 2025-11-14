<?php

  if ($director)
  {
     $director=$director."/";
  }
  else
  {
     $director="";
  }
//Clases para el sistema 
 include($director."libreria/dbcc.php");
 include($director."libreria/formulario.php");
 include($director."libreria/menu.php");
 include($director."libreria/acces.php");
 include($director."libreria/session.php");
 include($director."libreria/varsend.php");
 include($director."libreria/template.php");
 include($director."libreria/templateform.php");
 include ("libreria/menup.php");
 include ("libreria/templatep.php");
 include ("libreria/contenido.php");
 include ("libreria/datosportal.php");
 include ("libreria/objetosweb.php");
 include ("libreria/estadisticas.php");
include("libreria/class.paginaZ.php");
// include($director."fckeditor.php") ;
 include($director."libreria/botones.php");
// include($director."fckeditor.php") ;
include($director."libreria/fecha.php");

include($director."libreria/objlista.php");

$objfechasp= new fechasp();


//Botones
  $objbotones= new boton_aqualis();
?>