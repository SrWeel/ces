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

	  

	        //---ENLACE

			$valoralet=mt_rand(1,500);

			$aletorioid=$_SESSION['ces1313777_sessid_cedula'].date("Ymdhis").$valoralet;

			//----

			

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	

            $objformulario->sendvar["horax"]=date("h:i:s");

			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["usr_tpingx"]=0;

			$objformulario->sendvar["clie_idx"]=$clie_id;

			$objformulario->sendvar["codex"]=$aletorioid;

			

			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];

			

			$objformulario->sendvar["atenc_idx"]=$atenc_id;

			 

			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			//asigna medico

			$objformulario->sendvar["usua_idx"]=@$rs_buscadatos_fecha->fields["usua_id"];

			

			 $datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;

             $rs_atencion = $DB_gogess->executec($datos_atencion,array());

			 

			$valoralet=mt_rand(1,500);

			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;

			

			$objformulario->sendvar["psic_enlacex"]=$aletorioid;

			

			$objformulario->sendvar["eteneva_idx"]=$eteneva_id;

			 



?>
<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">

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

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo $rs_dcliente->fields["clie_instruccion"];  ?></center></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></center></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">INSTITUCI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo $rs_dcliente->fields["clie_institucion"];  ?></center></td>

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

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo $rs_dcliente->fields["clie_direccion"];  ?></center></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">FECHA DE EVALUACI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo @$rs_buscadatos_fecha->fields["asighor_fecha"]; ?></center></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">TEL&Eacute;FONO:</span></td>

    <td bgcolor="#D9E9EC" class="css_texto"><center><?php echo $rs_dcliente->fields["clie_telefono"];  ?></center></td>

    <td bgcolor="#D9E9EC">&nbsp;</td>

    <td bgcolor="#D9E9EC" class="css_texto">&nbsp;</td>

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



<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td class="css_paciente">AREA</td>

    <td class="css_paciente">MARCADOR</td>

    <td class="css_paciente">OBSERVACIONES</td>

  </tr>

  <tr>

    <td class="css_texto">Familiar</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,9,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,10,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Social</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,11,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,12,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Escolar</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,13,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,14,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Personal</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,15,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,16,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">General</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,17,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,18,$DB_gogess); ?>

    </span></td>

  </tr>

</table>

</div>

</div>







<div class="form-group">	

<div class="col-md-12">

<?php

$objformulario->generar_formulario(@$submit,$table,19,$DB_gogess); 

?>



<B>WISC:</B>

<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td class="css_paciente">SUB ESCALAS</td>

    <td class="css_paciente">PUNTAJE - PERCENTIL</td>

    <td class="css_paciente">INTERPRETACI&Oacute;N</td>

  </tr>

  <tr>

    <td class="css_texto">Comprensi&oacute;n verbal</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,20,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,21,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Razonamiento percentual</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,22,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,23,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Memoria de trabajo</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,24,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,25,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Velocidad procesual</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,26,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,27,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Coeficiente Intelectual Total</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,28,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,29,$DB_gogess); ?>

    </span></td>

  </tr>

</table>

<br /><br />

<B>WPPSI ( 2 a&ntilde;os 6 meses a 3 a&ntilde;os 11 meses):</B>

<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td class="css_paciente">SUB ESCALAS</td>

    <td class="css_paciente">PUNTAJE - PERCENTIL</td>

    <td class="css_paciente">INTERPRETACI&Oacute;N</td>

  </tr>

  <tr>

    <td class="css_texto">Coeficiente verbal</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,30,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,31,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Coeficiente ejecutivo</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,32,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,33,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Coeficiente Total</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,36,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,37,$DB_gogess); ?>

    </span></td>

  </tr>

   <tr>

    <td class="css_texto">Lenguaje</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,361,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,371,$DB_gogess); ?>

    </span></td>

  </tr>

</table>



<br /><br />



<B>WPPSI ( 4 a&ntilde;os 0 meses a 7 a&ntilde;os 3 meses):</B>

<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td class="css_paciente">SUB ESCALAS</td>

    <td class="css_paciente">PUNTAJE - PERCENTIL</td>

    <td class="css_paciente">INTERPRETACI&Oacute;N</td>

  </tr>

  <tr>

    <td class="css_texto">Coeficiente verbal</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,120,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,121,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Coeficiente ejecutivo</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,122,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,123,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Velocidad de procesamiento</td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,124,$DB_gogess); ?>

    </span></td>

    <td class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,125,$DB_gogess); ?>

    </span></td>

  </tr>

  <tr>

    <td class="css_texto">Coe