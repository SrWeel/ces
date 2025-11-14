<?php

function calcular_edad($fechan,$fechafin){
$resultado=array();
$separa_anios=array();
$valor_anio=0;
$valor_mes=0;
$fechainicial = new DateTime($fechan);
$fechafinal = new DateTime($fechafin);
$diferencia = $fechainicial->diff($fechafinal);
$meses = ( $diferencia->y * 12 ) + $diferencia->m;

$anios=$meses/12;
$separa_anios=explode(".",$anios);
$valor_anio=@$separa_anios[0];
$valor_mes=("0.".@$separa_anios[1])*12;

$resultado["anio"]=$valor_anio;
$resultado["mes"]=$valor_mes;

return $resultado;
}
	  
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
			
			 $datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
             $rs_atencion = $DB_gogess->executec($datos_atencion,array());
			 

?>
<style type="text/css">
<!--
.css_paciente {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>


<table width="800" border="1" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#D9E9EC"><span class="css_paciente">HISTORIA CLINICA:</span></td>
    <td bgcolor="#D9E9EC"><?php  $objformulario->generar_formulario(@$submit,$table,4,$DB_gogess); ?></td>
    <td bgcolor="#D9E9EC"><span class="css_paciente">C&Oacute;DIGO EVALUACI&Oacute;N:</span></td>
    <td bgcolor="#D9E9EC"><?php  $objformulario->generar_formulario(@$submit,$table,8,$DB_gogess); ?></td>
  </tr>
  <tr>
    <td bgcolor="#D9E9EC"><span class="css_paciente">PACIENTE:</span></td>
    <td bgcolor="#D9E9EC"><span class="texto_caja">
      <?php  $objformulario->generar_formulario(@$submit,$table,5,$DB_gogess); ?>
    </span></td>
    <td bgcolor="#D9E9EC"><span class="css_paciente">INSTRUCCI&Oacute;N:</span></td>
    <td bgcolor="#D9E9EC"><center><?php echo $rs_dcliente->fields["clie_instruccion"];  ?></center></td>
  </tr>
  <tr>
    <td bgcolor="#D9E9EC"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>
    <td bgcolor="#D9E9EC"><center><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></center></td>
    <td bgcolor="#D9E9EC"><span class="css_paciente">INSTITUCI&Oacute;N:</span></td>
    <td bgcolor="#D9E9EC"><center><?php echo $rs_dcliente->fields["clie_institucion"];  ?></center></td>
  </tr>
  <tr>
    <td bgcolor="#D9E9EC"><span class="css_paciente">EDAD (A la fecha de la evaluaci&oacute;n):</span></td>
    <td bgcolor="#D9E9EC"><center><?php
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fecha"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	?></center></td>
    <td bgcolor="#D9E9EC"><span class="css_paciente">FUENTE DE DATOS:</span></td>
    <td bgcolor="#D9E9EC"><center><?php 
	
	$nfuente= $objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$rs_dcliente->fields["usua_id"],$DB_gogess);
	echo $nfuente; 
	?></center></td>
  </tr>
  <tr>
    <td bgcolor="#D9E9EC"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>
    <td bgcolor="#D9E9EC"><center><?php echo $rs_dcliente->fields["clie_direccion"];  ?></center></td>
    <td bgcolor="#D9E9EC"><span class="css_paciente">FECHA DE EVALUACI&Oacute;N:</span></td>
    <td bgcolor="#D9E9EC"><center><?php echo $rs_atencion->fields["atenc_fecha"]; ?></center></td>
  </tr>
  <tr>
    <td bgcolor="#D9E9EC"><span class="css_paciente">TEL&Eacute;FONO:</span></td>
    <td bgcolor="#D9E9EC"><center><?php echo $rs_dcliente->fields["clie_telefono"];  ?></center></td>
    <td bgcolor="#D9E9EC">&nbsp;</td>
    <td bgcolor="#D9E9EC">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<div class="form-group">	
<div class="col-md-12">
<?php
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
</div>
</div>



<div class="form-group">	
<div class="col-md-12">
<?php
$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
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
            $( "#diagn_ciex" ).autocomplete({
               source: "templateformsweb/maestro_standar_consultaexterna/searchcie.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		  $(function() {
            $( "#prod_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_consultaexterna/searchpro.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#prod_descripcionx').val(ui.item.descripcion);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		 
		 $(function() {
            $( "#inven_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_consultaexterna/searchmed.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#inven_codigox').val(ui.item.codigo);
				  $('#inven_valorunitx').val(ui.item.valorunitario);
					
			   }
            });
         });
</script>