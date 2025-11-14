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

			$valoralet=mt_rand(1,50000);
			$aletorioid=$_SESSION['ces1313777_sessid_cedula'].date("Ymdhis").$valoralet;

			//----

			

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
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
			$objformulario->sendvar["lenguaj_enlacex"]=$aletorioid;
			$objformulario->sendvar["eteneva_idx"]=$eteneva_id;
			
			//obtiene datos del representante
			
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			$datos_ateneva="select * from dns_atencionevaluacion where eteneva_id='".$eteneva_id."'";
            $rs_ateneva = $DB_gogess->executec($datos_ateneva,array());
			
			//obtiene datos del representante
?>
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
<?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]); ?>
    </span></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">INSTRUCCI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC"><?php echo utf8_encode($rs_dcliente->fields["clie_instruccion"]);  ?></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>

    <td bgcolor="#D9E9EC"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">INSTITUCI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC"><?php echo utf8_encode($rs_dcliente->fields["clie_institucion"]);  ?></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">EDAD (A la fecha de la evaluaci&oacute;n):</span></td>

    <td bgcolor="#D9E9EC"><?php

	if(@$rs_buscadatos_fecha->fields["asighor_fecha"])
	{

	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_buscadatos_fecha->fields["asighor_fecha"]);

	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";

	}
	else
	{
	
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_ateneva->fields["eteneva_fecharegistro"]);

	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	
	
	}

	?></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">FUENTE DE DATOS:</span></td>

    <td bgcolor="#D9E9EC"><?php 

	

	//$nfuente= $objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$rs_dcliente->fields["usua_id"],$DB_gogess);

	//echo $nfuente; 
    echo $rs_representante->fields["repres_nombre"]." (".$rs_representante->fields["repres_parentesco"].")";
	?></td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC"><?php echo utf8_encode($rs_dcliente->fields["clie_direccion"]);  ?></td>

    <td bgcolor="#D9E9EC"><span class="css_paciente">FECHA DE EVALUACI&Oacute;N:</span></td>

    <td bgcolor="#D9E9EC">
	
	<?php  
	if(@$rs_buscadatos_fecha->fields["asighor_fecha"])
	{
	echo $rs_buscadatos_fecha->fields["asighor_fecha"];
	}
	else
	{
	echo $rs_ateneva->fields["eteneva_fecharegistro"];
	}
	 ?>
	
	</td>

  </tr>

  <tr>

    <td bgcolor="#D9E9EC"><span class="css_paciente">TEL&Eacute;FONO:</span></td>

    <td bgcolor="#D9E9EC"><?php echo $rs_dcliente->fields["clie_celular"];  ?></td>

    <td bgcolor="#D9E9EC">&nbsp;</td>

    <td bgcolor="#D9E9EC">&nbsp;</td>

  </tr>

</table>

<p>&nbsp;</p>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 

$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 

$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 

$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 

$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 

$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess); 

$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess); 

?>



<div class="form-group">	

<div class="col-md-12">

<?php

$objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); 

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

            $( "#lenguaj_cie" ).autocomplete({

               source: "templateformsweb/maestro_standar_lenguaje/searchcie.php",

               minLength: 1,

			   select: function( event, ui ) {

				  $('#lenguaj_cie_visorcie').val(ui.item.descripcion);

					

			   }

            });

         });

		 
function lenguaj_cie_agregar() {

var datos;

datos=$('#lenguaj_impresiondiagnostica').val() + $('#lenguaj_cie_visorcie').val()+ ",";

$('#lenguaj_impresiondiagnostica').val(datos);



}
	
		 

var config1 ={
  toolbarGroups: [
						{"name":"basicstyles","groups":["basicstyles"]},
						{"name":"paragraph","groups":["list","blocks"]},
						{"name":"styles","groups":["styles"]}
					],
					// Remove the redundant buttons from toolbar groups defined above.
					removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
}



$('#lenguaj_impresiondiagnostica').ckeditor(config1);
$('#lenguaj_recomterapeutica').ckeditor(config1);	 
$('#lenguaj_recomfamiliares').ckeditor(config1);	 
$('#lenguaj_recomescolares').ckeditor(config1);	
$('#lenguaj_recommultidiciplinarias').ckeditor(config1);
</script>