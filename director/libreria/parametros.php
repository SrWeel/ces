<?php

/**
 * Manejo de parametros
 * 
 * Esta clase permite manejar parametros
 *
 * @author Ecohevea <franklin.aguas@gogess.com>
 * @version 1.0
 * @package parametros_generales
 */
//Variables generales del sistema
class parametros_generales{
var $titulo;
var $timp;
var $pimp;

function maymin($txt)
{
   return $txt;
}

function parametros($DB_gogess)
{

        $selecTabla="select * from gogess_datosg";   
		
		$rs_parametro = $DB_gogess->Execute($selecTabla);

		while (!$rs_parametro->EOF) 
		{
  		
				$this->titulo=$rs_parametro->fields[$this->maymin("em_titulo")];
				$this->timp=$rs_parametro->fields[$this->maymin("em_timp")];
				$this->pimp=$rs_parametro->fields[$this->maymin("em_pimp")];
				$this->em_logoimp=$rs_parametro->fields[$this->maymin("em_logoimp")];
				$this->em_patharchivo=$rs_parametro->fields[$this->maymin("em_patharchivo")];
				$rs_parametro->MoveNext();
            }
}
}


?>