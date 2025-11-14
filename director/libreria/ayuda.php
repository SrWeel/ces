<?php
class ayuda_aqualis{
var $ayuda;
var $cuadroayuda;

function maymin($txt)
{
   return $txt;
}

function desplegar_ayuda($table,$DB_gogess)
{
  if ($table)
  {
        $selecTabla="select * from  gogess_sistable where tab_name like '".$table."'";
		
		$rs_ayuda = $DB_gogess->Execute($selecTabla);
		
       if($rs_ayuda)
	   {
  		
			while (!$rs_ayuda->EOF) 
			{	
				$this->ayuda=$rs_ayuda->fields[$this->maymin("tab_information")];
                 $rs_ayuda->MoveNext();
            }	
		}
					
		$this->cuadroayuda= '<table width="150" height="250"  border="0" cellpadding="0" cellspacing="4" class="ayudatborde"><tr><td bgcolor="#F0F3F4" valign="top"><span class="ayudatregistros"> &nbsp;'.$this->ayuda.'</span></td></tr></table>';	
		
   }
}

}


?>