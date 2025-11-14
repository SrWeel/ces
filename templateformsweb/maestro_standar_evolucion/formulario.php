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
$resultado["mes"]=round($valor_mes);

return $resultado;
}

?>

<style type="text/css">

<!--

.css_paciente {

	font-size: 10px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-weight: bold;

}

.css_texto {

	font-size: 10px;

	font-family: Verdana, Arial, Helvetica, sans-serif;



}

-->

</style>

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

			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];

			$objformulario->sendvar["atenc_idx"]=$atenc_id;

			$objformulario->sendvar["clie_idx"]=$rs_atencion->fields["clie_id"];

			$valoralet=mt_rand(1,500);

			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;

			
             $datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
             $rs_atencion = $DB_gogess->executec($datos_atencion,array());

			$objformulario->sendvar["evolu_enlacex"]=$aletorioid;

			

?>

<table width="800" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">HISTORIA CLINICA:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><?php  $objformulario->generar_formulario(@$submit,$table,4,$DB_gogess); ?></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">C&Oacute;DIGO EVALUACI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><?php  $objformulario->generar_formulario(@$submit,$table,8,$DB_gogess); ?></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">PACIENTE:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,5,$DB_gogess); ?>

    </span></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">INSTRUCCI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo utf8_encode($rs_dcliente->fields["clie_instruccion"]);  ?></center></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></center></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">INSTITUCI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo utf8_encode($rs_dcliente->fields["clie_institucion"]);  ?></center></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">EDAD (A la fecha de la evaluaci&oacute;n):</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php

	if(@$rs_buscadatos_fecha->fields["asighor_fecha"])
	{
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_buscadatos_fecha->fields["asighor_fecha"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	}

	?></center></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">FUENTE DE DATOS:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php 

	

	$nfuente= $objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$rs_dcliente->fields["usua_id"],$DB_gogess);

	echo $nfuente; 

	?></center></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo utf8_encode($rs_dcliente->fields["clie_direccion"]);  ?></center></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">FECHA DE EVALUACI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo @$rs_buscadatos_fecha->fields["asighor_fecha"]; ?></center></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">TEL&Eacute;FONO:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo $rs_dcliente->fields["clie_telefono"];  ?></center></td>

    <td bgcolor="#D9E9EC">&nbsp;</td>

    <td bgcolor="#D9E9EC" class="css_texto">&nbsp;</td>

  </tr>

  <tr class="css_texto">

    <td colspan="4" bgcolor="#D9E9EC"><b>Motivo:</b><?php echo utf8_encode($rs_atencion->fields["atenc_observacion"]); ?></td>

  </tr>

</table>


<?php			 

$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 

?>

<b>MEDICO REGISTRA EVOLUCI&Oacute;N: <?php echo $objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);  ?></b>

<div class="form-group">	

<div class="col-md-12">

<?php

$objformulario->generar_formulario(@$submit,$table,30,$DB_gogess); 

?>

</div>

</div>



<?php			 

$objformulario->generar_formulario(@$submit,$table,40,$DB_gogess); 

?>   



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