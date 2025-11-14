<?php
/**
 * Perfil de aplicativo
 * 
 * Este archivo permite activar los perfiles de los aplicativos.
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package objetosistema_perfil
 */
class objetosistema_perfil{

var $estado_activo;


function usuarios_perfil($cedula,$idmenu,$DB_gogess)
{
  $listaperfil="select * from kyr_usuariosperfil where alu_ci=? and per_codobj=?";
  

  $rs_gogessform = $DB_gogess->executec($listaperfil,array($cedula,$idmenu));
  if($rs_gogessform)
  {
     	while (!$rs_gogessform->EOF) {
		 	 	 	 
		    			 
			 $this->estado_activo=$rs_gogessform->fields["per_activo"];
	
			 
		  
		   $rs_gogessform->MoveNext();
		}
  
  }
  

}

}

?>