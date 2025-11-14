<?php
/**
 * Acceso al sistema
 * 
 * Este archivo permite ingresar al sistema.
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package acceso_system
 */
class acceso_system{
var $resultado;
var $user;
var $pass;
var $name;
var $perid;
var $idenlace;

var $usuariog;
var $claveg;
var $nombreg;
var $codes;
var $idtabla;
var $codigoactiva;

var $tablaingreso;

function maymin($txt)
{
   return $txt;
}

function acept_session($sisusu,$pwdusu,$DB_gogess)
{
  $sisusu = addslashes(trim($sisusu));
  $pwdusu = md5(addslashes(trim($pwdusu)));
  $selecmenu="select * from ".$this->tablaingreso." where ".$this->usuariog." like '$sisusu' and  ".$this->claveg." like '$pwdusu' and guia_activo=1";  
//echo $selecmenu;
   $resultado = $DB_gogess->Execute($selecmenu);




while (!$resultado->EOF) {

                $this->user=$resultado->fields[$this->maymin($this->usuariog)];			
				$this->pass=$resultado->fields[$this->maymin($this->claveg)];			
				$this->name=$resultado->fields[$this->maymin($this->nombreg)];			
				$this->codigoactiva=$resultado->fields[$this->maymin($this->codes)];	
				$this->idenlace=$resultado->fields[$this->maymin($this->idtabla)];	
				$this->perid=$resultado->fields[$this->maymin("per_id")];
				
                 $resultado->MoveNext();
			}   
}
}


?>