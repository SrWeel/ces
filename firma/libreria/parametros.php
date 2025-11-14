<?php
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

        $selecTabla="select * from sibase_datosg";   
		
		$rs_parametro = $DB_gogess->Execute($selecTabla);

		while (!$rs_parametro->EOF) 
		{
  		
				$this->titulo=$rs_parametro->fields[$this->maymin("dat_titulo")];
				$this->timp=$rs_parametro->fields[$this->maymin("dat_timp")];
				$this->pimp=$rs_parametro->fields[$this->maymin("dat_pimp")];
				$this->dat_logoimp=$rs_parametro->fields[$this->maymin("dat_logoimp")];
				$this->creditos=$rs_parametro->fields[$this->maymin("dat_creditos")];
				
				$rs_parametro->MoveNext();
            }

}
}


?>