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

			//asigna medico
            if(@$rs_buscadatos_fecha->fields["usua_id"])
			{
			$objformulario->sendvar["usua_idx"]=@$rs_buscadatos_fecha->fields["usua_id"];
			}
			else
			{
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			
			}
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            $rs_atencion = $DB_gogess->executec($datos_atencion,array());
			$valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["anamn_enlacex"]=$aletorioid;
			
			//obtiene datos del representante
			
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			//obtiene datos del representante
?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_titulo">HISTORIA CLINICA:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  $objformulario->generar_formulario_print(@$submit,$table,44,$DB_gogess); ?></td>

    <td bgcolor="#F1F7F8"><span class="css_titulo">C&Oacute;DIGO EVALUACI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  $objformulario->generar_formulario_print(@$submit,$table,88,$DB_gogess); ?></td>

  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_titulo">PACIENTE:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><span class="texto_caja">

      <?php  utf8_decode($objformulario->generar_formulario_print(@$submit,$table,55,$DB_gogess)); ?>
	  <?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]); ?>

    </span></td>

    <td bgcolor="#F1F7F8"><span class="css_titulo">INSTRUCCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_instruccion"];  ?></td>

  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_titulo">FECHA DE NACIMIENTO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></td>

    <td bgcolor="#F1F7F8"><span class="css_titulo">INSTITUCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_institucion"];  ?></td>

  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_titulo">EDAD (A la fecha de la evaluaci&oacute;n):</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php

	if(@$rs_buscadatos_fecha->fields["asighor_fecha"])

	{

	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_buscadatos_fecha->fields["asighor_fecha"]);

	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";

	}

	?></td>

    <td bgcolor="#F1F7F8"><span class="css_titulo">FUENTE DE DATOS:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php 

	//$nfuente= $objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$rs_dcliente->fields["usua_id"],$DB_gogess);

	//echo $nfuente; 
	
		echo $rs_representante->fields["repres_nombre"]." (".$rs_representante->fields["repres_parentesco"].")";

	?></td>

  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_titulo">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo utf8_decode($rs_dcliente->fields["clie_direccion"]);  ?></td>

    <td bgcolor="#F1F7F8"><span class="css_titulo">FECHA DE EVALUACI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo @$rs_buscadatos_fecha->fields["asighor_fecha"]; ?></td>

  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_titulo">TEL&Eacute;FONO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"];  ?></td>

    <td bgcolor="#F1F7F8">&nbsp;</td>

    <td bgcolor="#F1F7F8" class="css_texto">&nbsp;</td>

  </tr>

</table>
<br />
<?php
$formulario_path="../../".$template_reemplazo;
//busca grupos
$busca_g="select distinct fie_groupprint from gogess_sisfield where tab_name='".$table."' and fie_groupprint>0 order by fie_groupprint asc";
$rs_buscag = $DB_gogess->executec($busca_g,array());
				if($rs_buscag)
                   {
	                  while (!$rs_buscag->EOF) {	
					  
					  
					  //verifica si hay datos en el grupo
					  $datos_valordata='';
					  $concatena_data='';
					  $bandera_valor=0;
					  $obtiene_camposlleno="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." order by fie_orden asc";
					  $rs_bbcamposlleno = $DB_gogess->executec($obtiene_camposlleno,array());
					  if($rs_bbcamposlleno)					  
					  {
					     while (!$rs_bbcamposlleno->EOF) {
						 
						   // $datos_valordata='';
						   if($rs_bbcamposlleno->fields["fie_guarda"]==1)
						   {
								//-------------------------------
								$datos_valordata=$objformulario->contenid[$rs_bbcamposlleno->fields["fie_name"]];
								if($datos_valordata=='0')
								{
								 $datos_valordata='';
								}
								
								$concatena_data.=$datos_valordata;
								//-------------------------------
								
						   }	
						   else
						   {
						   
						        if($rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid2')
								{
								  $concatena_data.='si';
								}
						   
						   }
												 
						 $rs_bbcamposlleno->MoveNext();
						 }
					  
					  }
					  
					
					  
					  if($concatena_data)
					  {
					  //echo $rs_buscag->fields["fie_groupprint"]."<br>";
					  
					  $obtiene_campos="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." order by fie_orden asc";
					  $rs_bbcampos = $DB_gogess->executec($obtiene_campos,array());
					  if($rs_bbcampos)
					  {
					       while (!$rs_bbcampos->EOF) {
						   
						   //echo $rs_bbcampos->fields["fie_name"]."<br>";
						   
						   ///------------------------------------------------------
						   $fie_title="";
						   if (!($rs_bbcampos->fields["fie_tactive"]))
							{
								$fie_title="";
							}
							else
							{
							
							   $fie_title="<label><b>".$rs_bbcampos->fields["fie_title"]."</b></label> ";
							}
						   
						   
						   if($rs_bbcampos->fields["fie_guarda"]==1)
						   { 
							
						
							   if (!(@$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]==""))
							   {
									 if ($rs_bbcampos->fields["fie_value"]=="replace")
									 {
										$valorbus=$objformulario->contenid[$rs_bbcampos->fields["fie_name"]];
										$rmp= $objformulario->replace_cmb($rs_bbcampos->fields["fie_tabledb"],$rs_bbcampos->fields["fie_datadb"],$rs_bbcampos->fields["fie_sql"],$valorbus,$DB_gogess);  
									 }
									 else
									 {
										if($rs_bbcampos->fields["fie_typeweb"]=='tiempobloque')
										{
										   $separa_fecha=array();
										   $separa_fecha=explode("-",$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]);
										   
										   $rmp=@$separa_fecha[0]." a&ntilde;os ".@$separa_fecha[1]." meses";
										}
										else
										{
										$rmp=$objformulario->contenid[$rs_bbcampos->fields["fie_name"]];
										}
										
									 }
							        
									if(@$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]!='0')
									{
									 echo utf8_encode($fie_title).'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'">'.$rmp.'</span><br>';						                                     }
							   }
							   else
							   {
								    if($rs_bbcampos->fields["fie_sendvar"])
									{
									
									    //-------------------------------------------------------------------------------------
										
										if ($rs_bbcampos->fields["fie_value"]=="replace")
										 {
											$valorbus=$objformulario->sendvar[$rs_bbcampos->fields["fie_sendvar"]];
											$rmp= $objformulario->replace_cmb($rs_bbcampos->fields["fie_tabledb"],$rs_bbcampos->fields["fie_datadb"],$rs_bbcampos->fields["fie_sql"],$valorbus,$DB_gogess);  
										 }
										 else
										 {
											$rmp=$objformulario->sendvar[$rs_bbcampos->fields["fie_sendvar"]];
										 }
								   
										 echo utf8_encode($fie_title).'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'">'.$rmp.'</span><br>';	
										
										
										//--------------------------------------------------------------------------------------
									 
									
									}

							   
							   }
						   
						   
						   }
						   else
						   {
						   
						         
								 
								  if($rs_bbcampos->fields["fie_archivogrid"])
								  {
								 
								    include("../../".$template_reemplazo."".$rs_bbcampos->fields["fie_archivogrid"]);
								  }
						          else
								  {
			                            
									   if($rs_bbcampos->fields["fie_typeweb"]=='campo_subetiqueta')
										{
										echo "<br><div style='color:#666666' ><b>".utf8_encode($fie_title)."</b></div><br>";
										}
										else
										{
										echo "<br><b>".utf8_encode($fie_title)."</b><hr><br>";
										
										}	
								       
								       
								  }
								  
						   
						   }
						   ///-------------------------------------------------------
						   
						   
						   
						   $rs_bbcampos->MoveNext();
						   }
					  
					  }
					  
					  
					  }
					  
					  $rs_buscag->MoveNext();
					  }
				    }	  

?>
