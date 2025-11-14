<?php
$griddata.='<table width="600" border="0" cellpadding="0" cellspacing="2">';

$listagrid="select * from ca_factura_detalle where comcab_id='".$objformulario->contenid["comcab_id"]."'";  
   $rs_campos = $DB_gogess->Execute($listagrid); 
   if($rs_campos)
   {
			 while (!$rs_campos->EOF) {
			 $i++;
		
  
			 
			  $griddata.='<tr>
    <td valign="top" >'.$rs_campos->fields["comcabdet_cantidad"].'</td>
    <td valign="top" >'.$rs_campos->fields["comcabdet_codprincipal"].'</td>
    <td valign="top" >'.$rs_campos->fields["comcabdet_descripcion"].'</td>
    <td valign="top" >'.$rs_campos->fields["comcabdet_total"].'</td>
  </tr>';
			
			   $sub_totalval= $rs_campos->fields["comcabdet_total"] - $rs_campos->fields["comcabdet_descuento"];
			   $valor_total=$valor_total + $sub_totalval;
			
			  $rs_campos->MoveNext();
			 }
     }

$griddata.='</table>';

$variable_objeto["grid_factura"]=$griddata;
?>