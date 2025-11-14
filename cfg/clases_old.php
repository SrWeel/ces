<?php
date_default_timezone_set('America/Guayaquil');
define('ADODB_ASSOC_CASE',2); 
require_once(@$director."libreria/adodb/adodb.inc.php");
require_once(@$director."libreria/conexion/capa_base.php");
require_once(@$director."cfg/conexion.php");

//--------------------------
 require_once(@$director."libreria/formulario/form.php");
 require_once(@$director."libreria/formulario/campo.php");
 require_once(@$director."libreria/formulario/proceso.php");
 require_once(@$director."libreria/formulario/cmb.php");
 require_once(@$director."libreria/formulario/validaciones.php");
 require_once(@$director."libreria/template/template.php");
 require_once(@$director."libreria/template/datosportal.php");

 //--------------------------

 //sesiones

 require_once(@$director."libreria/sesion/session.php");
 require_once(@$director."libreria/sesion/acces.php"); 

 //sesiones aplicativos

 require_once(@$director."libreria/sessionapl/sessionapl.php"); 
 require_once(@$director."libreria/contenido/contenido.php");  
 require_once(@$director."libreria/apl/contenido.php");  


 //---------------------------

 require_once(@$director."libreria/perfil/obt_perfil.php");
 require_once(@$director."libreria/apl/templateform.php");

 //----------------------------

 require_once(@$director."libreria/grid/datos_grid.php");
 
 //-------MENU GENERICO.......

 require_once(@$director."libreria/menu_generico/menu_generico.php");

 //-------FUNCIONES VARIAS......

 require_once(@$director."libreria/util/util.php");
 
 //--------MENU-----------------
 include(@$director."libreria/menuweb/menu.php");  
 
 //---satos del portal web contenido------------
  include(@$director."libreria/portal/contenido.php");  
  
 //---cedulas---
include(@$director."libreria/formulas_globales.php");

//facturacion
include($director."libreria/cfgimpuestos/impuestos.php");
include($director."libreria/sistema/sistemacfg.php");
include($director."libreria/sri/sri.php");
include($director."libreria/sri/factura.php");

require_once($director."libreria/dompdf/dompdf_config.inc.php");
include($director."libreria/lib_parametros_r.php");
include($director."libreria/lib_pdf.php");
?>