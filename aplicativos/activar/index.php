<?php
//Parametres de ingreso al sistema
$accesousuario=1;

include(@$director."libreria/estructura/aqualis_master.php");
  
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 

$obj_session_apl= new session_apl();
$obj_session_apl->seleccion_acc_apl($accesousuario,$DB_gogess);
$objcontenido_apl=new contenido_apl();
$objperfil=new objetosistema_perfil();
$obj_cmb=new FormularioCmb();
$objtableform= new templateform();
$objformulario= new  ValidacionesFormulario();
//print_r($gogess_sisfield);
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

include($ap_path."css.php");
include($ap_path."js.php");

include($ap_path."entorno.php");	



?>