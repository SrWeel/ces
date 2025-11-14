<?php
	  
	        //---ENLACE
			$valoralet=mt_rand(1,500);
			$aletorioid=$_SESSION['ces1313777_sessid_cedula'].date("Ymdhis").$valoralet;
			//----
			
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$_POST["pVar2"];
			$objformulario->sendvar["codex"]=$aletorioid;
			
			$objformulario->sendvar["hcx"]=$rs_dcliente->fields["clie_rucci"];
			 
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			 

?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#D9E9EC" class="texto_caja" style="font-weight: bold"><div align="center">ESTABLECIMIENTO</div></td>
    <td bgcolor="#D9E9EC"  class="texto_caja" style="font-weight: bold"><div align="center">PACIENTE</div></td>
    <td bgcolor="#D9E9EC"  class="texto_caja" style="font-weight: bold"><div align="center">SEXO</div></td>
    <td bgcolor="#D9E9EC"  class="texto_caja" style="font-weight: bold"><div align="center">NUMERO HOJA</div></td>
    <td bgcolor="#D9E9EC"  class="texto_caja" style="font-weight: bold"><div align="center">HISTORIA CLINICA</div></td>
  </tr>
  <tr>
    <td bgcolor="#D9E9EC"  class="texto_caja"><?php  $objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); ?></td>
    <td bgcolor="#D9E9EC"  class="texto_caja"><?php  $objformulario->generar_formulario(@$submit,$table,5,$DB_gogess); ?></td>
    <td bgcolor="#D9E9EC"  class="texto_caja"><?php echo $rs_dcliente->fields["clie_genero"];  ?></td>
    <td bgcolor="#D9E9EC"  class="texto_caja"><?php  $objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); ?></td>
    <td bgcolor="#D9E9EC"  class="texto_caja"><?php  $objformulario->generar_formulario(@$submit,$table,4,$DB_gogess); ?></td>
  </tr>
</table>
<?php  
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 

     
if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";

?>
<div id=div_<?php echo $table ?> > </div>