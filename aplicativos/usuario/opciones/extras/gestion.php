<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
$cliente=$_POST["pVar1"];

 $director="../../../../";
 include ("../../../../cfgclases/clases.php");
?>


<style type="text/css">
.Estilo4 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
</style>
<table width="405" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td colspan="6" bgcolor="#ABBEC2"><div align="center"><span class="Estilo4">DEUDA</span></div></td>
  </tr>
  <tr>
  <td width="97" height="32" bgcolor="#DAE2E4"><div align="center" class="Estilo4">CUENTA/OPERACION</div></td>
    <td width="97" height="32" bgcolor="#DAE2E4"><div align="center" class="Estilo4">CUOTA VENCIDA</div></td>
    <td width="97" bgcolor="#DAE2E4"><div align="center" class="Estilo4">VALOR VENCIDO</div></td>
    <td width="95" bgcolor="#DAE2E4"><div align="center" class="Estilo4">PAGO MINIMO</div></td>
    <td width="102" bgcolor="#DAE2E4"><div align="center" class="Estilo4">TOTAL DEUDA</div></td>
    <td width="8" bgcolor="#DAE2E4"><div align="center"></div></td>
  </tr>
 <?php
	   // echo $cedula=$objformulario->contenid["clie_cedula"];
		 
		
  $datosoperacion="select * from cobr_operacion where clie_cedula='".$cliente."'";
  $okoperacion = $DB_gogess->Execute($datosoperacion);
     	while (!$okoperacion->EOF) {			
	  
     echo '<tr>';
	 
	 
	  echo  '<td bgcolor="#E9EEEF"><span class="Estilo6"> '.$okoperacion->fields["oper_operacion"].'</span></td>';
      echo  '<td bgcolor="#E9EEEF"><span class="Estilo6"> '.$okoperacion->fields["oper_cuotavenc"].'</span></td>';
        echo  '<td bgcolor="#E9EEEF"><span class="Estilo6">'.$okoperacion->fields["oper_valorvenc"].'</span></td>';
		 echo  '<td bgcolor="#E9EEEF"><span class="Estilo6">'.$okoperacion->fields["oper_pagominimo"].'</span></td>';
		  echo  '<td bgcolor="#E9EEEF"><span class="Estilo6">'.$okoperacion->fields["oper_totaldeuda"].'</span></td>';
        
	  
	   $okoperacion->MoveNext();	
	  }
	  
	  ?>
</table>
