<?php
  if (isset($director))
  {
     $director=$director."/";
  }
  else
  {
     $director="";
  }
  
//Clases para el sistema 
 include($director."adodb/adodb.inc.php");
 include($director."cfgclases/config.php");
 include($director."libreria/acces.php");
  include($director."libreria/parametros.php");
 include($director."libreria/formulario.php");
 include($director."libreria/session.php");
 include($director."libreria/varsend.php");
 include($director."libreria/template.php");
 include($director."libreria/templateform.php");
 
 //Menu portal - contenidos
 include ($director."libreria/contenido.php");


 include ($director."libreria/templatep.php");
 
 include ($director."libreria/datosportal.php");
 include ($director."libreria/objetosweb.php");
 include ($director."libreria/estadisticas.php");


 include($director."libreria/botones.php");
 include($director."libreria/paginar.php");

 include($director."libreria/fecha.php");
 include($director."libreria/lista.php");  
 include($director."libreria/formulas_globales.php"); 
 //nuevo grid
 include($director."libreria/grid/datos_grid.php");  
 include($director."libreria/opciones.php");
 
 //enlace fakturasweb
 include($director."libreria/fackturasweb/impuestos.php");
 
 require_once($director."libreria/dompdf/dompdf_config.inc.php");
 
 //menu_generico de formularios
 include($director."libreria/menu_generico/menu_generico.php");

 //enlace cfg sistemas
 include($director."libreria/sistema/sistemacfg.php");
 
 include($director."libreria/perfil/obt_perfil.php");
 include($director."libreria/acceso/controlclv.php");

 
 
 $objperfil= new objetosistema_perfil();
 
 
 $objimpuestos = new impuestos_cfg();
 
 $objgrid_fk = new  grid_gogess();
 //nuevo grid


//validaciones
 $objvalidacion = new  formulas_globales();
//Botones
  $objbotones= new boton_aqualis();
  $objpaginar= new paginardatos();
     //Lista reportes
  $objgridtabla=new listadogrid();
  
//Sesiones
  $objacceso_system = new  acceso_system();
  $objacceso_session = new  session_system(); 
 // Formularios 
 $objformulario= new formulario(); 
//Conexion a la base de datos

//Objeto template
  $objtemplatep = new  templatep();
//Objeto contenido
  $objcontenido = new  contenidop();  
//Objeto tablas templates
  $objtableform= new templateform();
  if(!empty($table))
  {
  if ($table)
  {
  $objtableform->select_templateform($table,$DB_gogess);	
  }
  }
//Objeto Datos Portales
  $objportal= new portal();  
//Objetos para la Web
  $objtweb= new objetosweb();  
  
 // Estadisticas
 //$objest= new estadisticas(); 
 
 //Parametros generales
  $objparametros= new parametros_generales();
  $objparametros->parametros($DB_gogess);
    //opciones botones
  $objopciones_botones= new opciones_botones();
  
  //sistema
  $objCfgSistema=new sistema_cfg();
  
  //cambio de clave
  $objcontrolclv=new cambio_clvcontrol();
  
?>