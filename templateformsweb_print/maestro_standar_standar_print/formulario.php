<style type="text/css">
<!--

.texto_caja {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;		
 }
.style3 {font-weight: bold; font-size: 10px; }
.style4 {font-size: 10px}

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
			
			$objformulario->sendvar["conext_etiquetasignosvx"]=$rs_atencion->fields["atenc_enlace"];
			
			
			$valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["anamn_enlacex"]=$aletorioid;
			
			//obtiene datos del representante
			
			
			$datos_usuario="select * from app_usuario where usua_id='".$objformulario->contenid["usua_id"]."'";
            $rs_us = $DB_gogess->executec($datos_usuario,array());
			
			//obtiene datos del representante
?>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td colspan="8" bgcolor="#F1F7F8"><span class="css_paciente"><strong>HISTORIA CLINICA:</strong><span class="css_texto">
      <?php  echo $rs_atencion->fields["atenc_hc"]; ?>
    </span></span></td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#F1F7F8"><strong>I. DATOS DEL USUARIO/USUARIA </strong></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><strong>Apellidos </strong></td>
    <td bgcolor="#F1F7F8"><strong>Nombres</strong></td>
    <td bgcolor="#F1F7F8"><strong>Fecha de nacimiento </strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Sexo</strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Estado Civil </strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Instrucci&oacute;n</strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Seguro</strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Empresa donde trabaja </strong></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><span class="css_texto"><span class="texto_caja"><?php echo $rs_dcliente->fields["clie_apellido"]; ?>
      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
    </span></span></td>
    <td bgcolor="#F1F7F8"><span class="texto_caja"><?php echo $rs_dcliente->fields["clie_nombre"]; ?></span></td>
    <td bgcolor="#F1F7F8"><span class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></span></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_genero"];  ?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php  
	$civil_estado=$objformulario->replace_cmb("app_estadocivil","civil_id,civil_nombre","where civil_id=",$rs_dcliente->fields["civil_id"],$DB_gogess);
	echo $civil_estado;
	 ?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php
	
	$instru_estado=$objformulario->replace_cmb("dns_instruccion","instruccion_id,instruccion_nombre","where instruccion_id=",$rs_dcliente->fields["clie_instruccion"],$DB_gogess);
	echo $instru_estado;
	
	?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php
	
	$nseguro=$objformulario->replace_cmb("faesa_tipopaciente","tipopac_id,tipopac_nombre","where tipopac_id=",$rs_dcliente->fields["tipopac_id"],$DB_gogess);
	echo $nseguro;
	
	?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_dondetrabaja"];  ?></td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#F1F7F8"><span class="css_paciente"><strong>EDAD (A la fecha de atenci&oacute;n):</strong></span>      <?php
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fechaingreso"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	
	?></td>
  </tr>
</table>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td bgcolor="#F1F7F8"><strong>Nacionalidad</strong></td>
    <td bgcolor="#F1F7F8"><strong>Pa&iacute;s</strong></td>
    <td bgcolor="#F1F7F8"><strong>C&eacute;dula de Ciudadania o Pasaporte</strong></td>
    <td colspan="3" bgcolor="#F1F7F8"><strong>Lugar de recidencia actual </strong></td>
    <td bgcolor="#F1F7F8"><strong>Direcci&oacute;n Domiciliaria</strong></td>
    <td bgcolor="#F1F7F8"><strong>No Telef&oacute;nico </strong></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><span class="css_texto"><span class="texto_caja"><?php 
	if($rs_dcliente->fields["nac_id"]==56)
	{
	
	  echo '1';
	}
	else
	{
	
	   echo '2';
	}

	 ?></span></span></td>
    <td bgcolor="#F1F7F8">
	<?php
	$nombrepais='';
	$nombrepais=$objformulario->replace_cmb("cesdb_arcombos.dns_nacionalidad","nac_id,nac_nombre","where nac_id=",$rs_dcliente->fields["nac_id"],$DB_gogess);
	echo $nombrepais;
	
	$provinciav=$objformulario->replace_cmb("cesdb_arcombos.app_provincia","prob_codigo,prob_nombre","where prob_codigo like ",$rs_dcliente->fields["prob_codigo"],$DB_gogess);
	$cantonv=$objformulario->replace_cmb("cesdb_arcombos.app_canton","cant_codigo,cant_nombre","where cant_codigo like ",$rs_dcliente->fields["cant_codigo"],$DB_gogess);
	?>	</td>
    <td bgcolor="#F1F7F8"><?php echo $rs_dcliente->fields["clie_rucci"]; ?></td>
    <td bgcolor="#F1F7F8"><?php echo $provinciav; ?></td>
    <td bgcolor="#F1F7F8"><?php echo $cantonv; ?></td>
    <td bgcolor="#F1F7F8"><?php echo $rs_dcliente->fields["clie_parroquia"]; ?></td>
    <td bgcolor="#F1F7F8"><span class="texto_caja"><span class="css_texto"><?php echo $rs_dcliente->fields["clie_direccion"];  ?></span></span></td>
    <td bgcolor="#F1F7F8"><span class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"];  ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><span class="style3">1=Ecu/ 2=Ext </span></td>
    <td bgcolor="#F1F7F8"><span class="style4"></span></td>
    <td bgcolor="#F1F7F8"><span class="style4"></span></td>
    <td bgcolor="#F1F7F8"><span class="style3">Provincia</span></td>
    <td bgcolor="#F1F7F8"><span class="style3">Cant&oacute;n</span></td>
    <td bgcolor="#F1F7F8"><span class="style3">Parroquia</span></td>
    <td bgcolor="#F1F7F8"><span class="style3">Calle Principal y Secundaria </span></td>
    <td bgcolor="#F1F7F8"><span class="style3">Convencional/Celular</span></td>
  </tr>
</table>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10%" bgcolor="#D3E0EB"><span class="texto_caja"><b>ESTABLECIMIENTO:</b></span></td>
    <td width="26%" bgcolor="#D3E0EB" class="css_texto"><?php echo $nomb_centro; ?>    </td>
    <td width="16%" bgcolor="#D3E0EB"><span class="texto_caja"><b>PROFESIONAL:</b></span></td>
    <td width="48%" bgcolor="#D3E0EB" class="css_texto"><?php echo $nomb_medico; ?></td>
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
					  $obtiene_camposlleno="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." and fie_active=1 order by fie_orden asc";
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
						   
						        if($rs_bbcamposlleno->fields["fie_typeweb"]=='campogridsub' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid2' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campoapl')
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
					  
					  $obtiene_campos="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." and fie_active=1 order by fie_orden asc";
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
											   if($rs_bbcampos->fields["fie_typeweb"]=='checkbox_peke')
											   {
													if($objformulario->contenid[$rs_bbcampos->fields["fie_name"]]==1)
													{
													$rmp='<img src="visto_dns.png" width="20" height="18" />';
													}
													else
													{
													$rmp='';
													}
											   }
											   else
											   {
											   $rmp=$objformulario->contenid[$rs_bbcampos->fields["fie_name"]];  
											   }
											   
										}
										
									 }
							        
									if(@$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]!='0')
									{
									 echo $fie_title.'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'">'.$rmp.'</span><br>';						                                     }
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
								   
										 echo $fie_title.'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'">'.$rmp.'</span><br>';	
										
										
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
										echo "<br><div style='color:#666666' ><b>".$fie_title."</b></div><br>";
										}
										else
										{
										   if($rs_bbcampos->fields["fie_typeweb"]=='campoespaciolineablanco')
										   {
										      echo "";
											}
											else
											{
											   echo "<br><b>".$fie_title."</b><hr><br>";
											}  
										
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

?><br /><br />
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" valign="bottom">________________________________________________</td>
  </tr>
  <tr>
    <td><strong>
      <?php  echo $rs_us->fields["usua_siglastitulo"]." ".$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]; ?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>
      <?php  echo $rs_us->fields["usua_piefirma"]; ?><br>
	  CODIGO:<?php  echo $rs_us->fields["usua_codigo"]; ?><br>
	  FOLIO:<?php  echo $rs_us->fields["usua_msp"]; ?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>
      <?php
	$ncentro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$objformulario->contenid["centro_id"],$DB_gogess);
	
	echo $ncentro;
	?>
    </strong></td>
  </tr>
</table>
