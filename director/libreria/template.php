<?php
/**
 * Templates del administrador
 * 
 * Esta clase permite conectarse con el administrador
 *
 * @author Ecohevea <franklin.aguas@gogess.com>
 * @version 1.0
 * @package template
 */
class template{
var $resultado;

function select_template($DB_gogess)
{

  $selecmenu1="select * from gogess_template where tem_active=1";  
  
  $rs_templatey = $DB_gogess->Execute($selecmenu1);

  
  while (!$rs_templatey->EOF) {	
                $this->path_template=$rs_templatey->fields["tem_path"];			
                $this->titulo_template=$rs_templatey->fields["tem_nombre"];
				$rs_templatey->MoveNext();
			}   
 

 
}


function desplegarencuadros($arreglolista,$border,$cellpadding,$cellspacing,$columnas)
{
    $nregistros=count($arreglolista);
	if($nregistros>0)
	{
	
	$columna=$columnas;
	$filascal=($nregistros/$columna)+1;
	
		//para decimales arreglar
	$fila=$filascal;
	$k=0;	
	echo '<table  border="'.$border.'" cellpadding="'.$cellpadding.'" cellspacing="'.$cellspacing.'">';
	for ($i=0;$i<=$fila-1;$i++)
	{
	   echo '<tr>';
	     
		 for($j=0;$j<=$columna-1;$j++)
		 {
		   echo '<td>'.@$arreglolista[$k].'</td>';
		   $k++;
		 
		 }
		 
	   echo '</tr>';	  
	}
	echo '</table>';
    }
}



}

?>