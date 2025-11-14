<?php
//DATOS PORTAL
$objportal= new portal();
//TEMPLATE PORTAL
$objtemplatep = new  templatep();
//SESION
$objacceso_session = new  session_system();
//contenido portal
$objcontenido_sistema=new contenido_sistema();
//grids apl
 $objgrid_fk = new  grid_gogess();
//varios
$objvarios= new util_funciones();


//menu
$objmenuweb= new menuweb();

//portal
$objcontenido_portal = new  contenidop();  

//validaciones
$objvalidacion = new  formulas_globales(); 

//facturacion
$objimpuestos = new impuestos_cfg();
$objCfgSistema=new sistema_cfg();

//bodegas
$objBodega=new obj_bodegas();

//bodegas
$objFormulascontable=new obj_formulascontable();
//buscador
$objBuscadorfunciones=new buscador_funciones();
?>