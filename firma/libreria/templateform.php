<?php
class templateform{
var $resultado;

function maymin($txt)
{
   return $txt;
}

function select_templateform($table,$DB_gogess)
{
  $selecmenu1="select * from sibase_sistable,sibase_styletable where sibase_sistable.st_id=sibase_styletable.st_id and tab_name like '$table'";
  
  $resultado1 = $DB_gogess->Execute($selecmenu1);
    
  while (!$resultado1->EOF) {
 	
                $this->path_templateform=$resultado1->fields[$this->maymin("st_pathweb")];			
				$this->tabla_activa=$resultado1->fields[$this->maymin("tab_actv")];	
				$this->tab_mdobuscar=$resultado1->fields[$this->maymin("tab_mdobuscar")];	
                $this->titulo_tabla=strtoupper($resultado1->fields[$this->maymin("tab_title")]);
				$this->timp=$resultado1->fields[$this->maymin("st_timp")];	
				$this->pimp=$resultado1->fields[$this->maymin("st_pimp")];	
				$this->tab_nlista=$resultado1->fields[$this->maymin("tab_nlista")];
				
				$this->tab_nameenlace=$resultado1->fields[$this->maymin("tab_nameenlace")];
				$this->tab_campoenlace=$resultado1->fields[$this->maymin("tab_campoenlace")];
				$this->tab_tipoenlace=$resultado1->fields[$this->maymin("tab_tipoenlace")];
				$this->tab_nombreenlace=$resultado1->fields[$this->maymin("tab_nombreenlace")];
				$this->tab_tablaregreso=$resultado1->fields[$this->maymin("tab_tablaregreso")];
				$this->tab_id=$resultado1->fields[$this->maymin("tab_id")];
				
				$this->tab_campoprimario=$resultado1->fields[$this->maymin("tab_campoprimario")];
				$this->tab_tipocampoprimariio=$resultado1->fields[$this->maymin("tab_tipocampoprimariio")];
				
                 $resultado1->MoveNext();
			}   
 
}

}

?>