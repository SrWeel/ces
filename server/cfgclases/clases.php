<?php

 if (@$director)



  {



     @$director=$director."/";



  }



  else



  {



     $director="";



  }



//Clases para el sistema



 define('ADODB_ASSOC_CASE',2); 



 include($director."adodb/adodb.inc.php");



 include($director."cfgclases/config.php");



 include($director."libreria/formulario.php");



 include($director."libreria/menu/menu.php");



 include($director."libreria/acces.php");



 include($director."libreria/session.php");



 include($director."libreria/template.php");



 include($director."libreria/templateform.php");



 include($director."libreria/estadisticas.php");



 include($director."libreria/botones/botones.php");



 include($director."libreria/parametros.php");



 include($director."libreria/ayuda.php"); 



 include($director."libreria/formatoxml.php"); 



 include($director."libreria/lista.php"); 



 include($director."libreria/encriptadata.php"); 



 include($director."libreria/generavariables.php");



 include($director."libreria/formulas_globales.php");



 include($director."libreria/fecha.php");



 include($director."libreria/opciones.php");



  



  //nuevo grid



 include($director."libreria/grid/datos_grid.php"); 



 
 include($director."libreria/grid_plus/datos_plus_grid.php"); 


 



 $objfechasp= new fechasp();



 



 function maymin($txt)



{



   return $txt;



}



 



     $objvalidacion = new  formulas_globales();



	 //Template General



	 



  $objtemplate = new  template();



  $objtemplate->select_template($DB_gogess);







 //Genera Variables



  $objgvariable = new  generavariables();



 



 //Encripta data



  $objencripta = new  encriptandodata();



 //Utilizando Librerias







  //Formulario



  $objformulario = new  formulario();



  $objformulario->ptaeditor=$ptaeditor;



  //Menu General



  $objmenu = new  menu();



  $objmenu->submenuact=@$smenu;







  //Sistemas



  $objacceso_system = new  acceso_system();



  //Sessiones



  $objacceso_session = new  session_system();







  



  //Templates Formularios de tablas  



  $objtableform= new templateform();



  if (@$table)



  {



  $objtableform->select_templateform($table,$DB_gogess);	



  }



  //Botones



  $objbotones= new boton_aqualis();



  //Parametros generales



  $objparametros= new parametros_generales();



  $objparametros->parametros($DB_gogess);



  



  $objformulario->em_patharchivo=$objparametros->em_patharchivo;



  



  //Ayuda



  $objayuda=new ayuda_aqualis();



  $objayuda->desplegar_ayuda(@$table,$DB_gogess);



  



  //



  $objxml=new formatoxml();



    //Lista reportes



  $objgridtabla=new listadogrid();



  //opciones botones



  $objopciones_botones= new opciones_botones();



  //nuevo grid



   $objgrid_fk = new  grid_gogess();

  $objgrid_plus = new  grid_plus_gogess();

?>