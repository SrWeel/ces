<?php
class objetosistema_perfil{

var $estado_activo;
var $estado_maker;
var $estado_checker;
var $estado_consulta;

function usuarios_perfil($cedula,$idmenu,$DB_gogess)
{
  $listaperfil="select * from factur_usuarios_perfil where usr_cedula='".$cedula."' and perusu_codobj='".$idmenu."' ";

  $rs_gogessform = $DB_gogess->Execute($listaperfil);
  if($rs_gogessform)
  {
     	while (!$rs_gogessform->EOF) {
		 	 	 	 
		    			 
			 $this->estado_activo=$rs_gogessform->fields["perusu_activo"];
			 $this->estado_maker=$rs_gogessform->fields["perusu_maker"];
			 $this->estado_checker=$rs_gogessform->fields["perusu_checker"];
			 $this->estado_consulta=$rs_gogessform->fields["perusu_consulta"];
			 
		  
		   $rs_gogessform->MoveNext();
		}
  
  }
  

}

}

?>