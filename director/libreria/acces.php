<?php
/**
 * Valida el acceso al sistema
 * 
 * Esta clase permite validar el acceso al sistema
 *
 * @author Ecohevea <franklin.aguas@gogess.com>
 * @version 1.0
 * @package acceso_system
 */

class acceso_system{
var $resultado;
var $user;
var $pass;
var $name;
var $perid;
var $oficina;
var $iduser;

function maymin($txt)
{
   return $txt;
}

function acept_session($sisusu,$pwdusu,$DB_gogess)
{
  $sisusu = addslashes(trim($sisusu));
  $pwdusu = md5(addslashes(trim($pwdusu)));
  $selecmenu="select * from gogess_sisusers,gogess_perfil where gogess_sisusers.per_id=gogess_perfil.per_id and sisu_usu like '$sisusu' and  sisu_pwd like '$pwdusu'";  
  
 
 $rs_acc = $DB_gogess->Execute($selecmenu);
  while (!$rs_acc->EOF) {
	
	
                $this->user=$rs_acc->fields[$this->maymin("sisu_usu")];			
				$this->iduser=$rs_acc->fields[$this->maymin("sisu_id")];	
				$this->pass=$rs_acc->fields[$this->maymin("sisu_pwd")];			
				$this->name=$rs_acc->fields[$this->maymin("sisu_name")];			
				$this->perid=$rs_acc->fields[$this->maymin("per_id")];
				$this->oficina=$rs_acc->fields[$this->maymin("cod_oficina")];
		
	 $rs_acc->MoveNext();		
    }

}
}


?>