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
			
			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];
			
			$objformulario->sendvar["atenc_idx"]=$atenc_id;
			 
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			 

?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#D9E9EC" class="texto_caja" style="font-weight: bold"><div align="center">ESTABLECIMIENTO</div></td>
    <td bgcolor="#D9E9EC"  class="texto_caja" style="font-weight: bold"><div align="center">PACIENTE</div></td>
    <td bgcolor="#D9E9EC"  class="texto_caja" style="font-weight: bold"><div align="center">SEXO</div></td>
    <td bgcolor="#D9E9EC"  class="texto_caja" style="font-weight: bold"><div align="center">CODIGO</div></td>
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

<div class="form-group">	
<div class="col-md-6">
<?php
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
</div>
<div class="col-md-6">
<?php
$objformulario->generar_formulario(@$submit,$table,6,$DB_gogess); 
?>
</div>
</div>

<div class="form-group">	
<div class="col-md-6">
<?php
$objformulario->generar_formulario(@$submit,$table,72,$DB_gogess); 
?>
</div>
<div class="col-md-6">
<?php
$objformulario->generar_formulario(@$submit,$table,73,$DB_gogess); 
?>
</div>
</div>

<div class="form-group">	
<div class="col-md-3">
<?php
$objformulario->generar_formulario(@$submit,$table,7,$DB_gogess); 
?>
</div>
<div class="col-md-3">
<?php
$objformulario->generar_formulario(@$submit,$table,71,$DB_gogess); 
?>
</div>
<div class="col-md-3">
<?php
$objformulario->generar_formulario(@$submit,$table,8,$DB_gogess); 
?>
</div>
<div class="col-md-3">
<?php
$objformulario->generar_formulario(@$submit,$table,81,$DB_gogess); 
?>
</div>
</div>


<div class="form-group">	
<div class="col-md-6">
<?php
$objformulario->generar_formulario(@$submit,$table,9,$DB_gogess); 
?>
</div>
<div class="col-md-6">
<?php
$objformulario->generar_formulario(@$submit,$table,10,$DB_gogess); 
?>
</div>
</div>

<div class="form-group">	
<div class="col-md-6">
<?php
$objformulario->generar_formulario(@$submit,$table,11,$DB_gogess); 
?>
</div>
<div class="col-md-6">
<?php
$objformulario->generar_formulario(@$submit,$table,12,$DB_gogess); 
?>
</div>
</div>

<div class="form-group">	
<div class="col-md-12">
<?php
$objformulario->generar_formulario(@$submit,$table,14,$DB_gogess); 
?>
</div>
</div>

<?php     
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

<script>
 	  $(function() {
            $( "#prod_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_laboratorio/searchpro.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#prod_descripcionx').val(ui.item.descripcion);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
</script>