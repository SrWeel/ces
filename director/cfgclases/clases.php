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
include_once($director."adodb/adodb.inc.php");
include_once($director."cfgclases/config.php");
include_once($director."libreria/formulario.php");
include_once($director."libreria/menu/menu.php");
include_once($director."libreria/acces.php");
include_once($director."libreria/session.php");
include_once($director."libreria/template.php");
include_once($director."libreria/templateform.php");
include_once($director."libreria/estadisticas.php");
include_once($director."libreria/botones/botones.php");
include_once($director."libreria/parametros.php");
include_once($director."libreria/ayuda.php"); 
include_once($director."libreria/formatoxml.php"); 
include_once($director."libreria/lista.php"); 
include_once($director."libreria/encriptadata.php"); 
include_once($director."libreria/generavariables.php");
include_once($director."libreria/formulas_globales.php");
include_once($director."libreria/fecha.php");
include_once($director."libreria/opciones.php");


  //nuevo grid

 include_once($director."libreria/grid/datos_grid.php"); 
 include_once($director."libreria/grid_plus/datos_plus_grid.php"); 
 include_once($director."libreria/libhanor/users.php");
 
 //FUNCIONES GENERALES
 include_once($director."libreria/funciones_generales.php");

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