<?php
/**
 * Templates del administrador por tabla
 * 
 * Esta clase permite conectarse con el administrador
 *
 * @author Ecohevea <franklin.aguas@gogess.com>
 * @version 1.0
 * @package templateform
 */
class templateform{

var $titulo_tabla;
var $tab_mdobuscar;
var $tabla_activa;
var $path_templateform;
var $tab_nameenlace;

function maymin($txt)
{
   return $txt;
}

function select_templateform($table,$DB_gogess)
{
 
  $selecmenu1="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_name like '$table'"; 
  //echo $selecmenu1;
  $rs_tforms = $DB_gogess->Execute($selecmenu1);
  
  if($rs_tforms)
  {
  
    while (!$rs_tforms->EOF)
			{	
			
                $this->path_templateform=$rs_tforms->fields[$this->maymin("st_path")];			
				$this->tabla_activa=$rs_tforms->fields[$this->maymin("tab_actv")];	
				$this->tab_mdobuscar=$rs_tforms->fields[$this->maymin("tab_mdobuscar")];	
                $this->titulo_tabla=$rs_tforms->fields[$this->maymin("tab_title")];
				$this->timp=$rs_tforms->fields[$this->maymin("st_timp")];	
				$this->pimp=$rs_tforms->fields[$this->maymin("st_pimp")];	
				$this->tab_nlista=$rs_tforms->fields[$this->maymin("tab_nlista")];
				
				@$this->tab_nameenlace=$rs_tforms->fields[$this->maymin("tab_nameenlace")];
				@$this->tab_campoenlace=$rs_tforms->fields[$this->maymin("tab_campoenlace")];
				@$this->tab_tipoenlace=$rs_tforms->fields[$this->maymin("tab_tipoenlace")];
				@$this->tab_nombreenlace=$rs_tforms->fields[$this->maymin("tab_nombreenlace")];
				$this->tab_tablaregreso=$rs_tforms->fields[$this->maymin("tab_tablaregreso")];
				$this->tab_id=$rs_tforms->fields[$this->maymin("tab_id")];
				
				$this->tab_campoprimario=$rs_tforms->fields[$this->maymin("tab_campoprimario")];
				$this->tab_tipocampoprimariio=$rs_tforms->fields[$this->maymin("tab_tipocampoprimariio")];
				
				$rs_tforms->MoveNext();
			}   
	}		
 
}

}

?>