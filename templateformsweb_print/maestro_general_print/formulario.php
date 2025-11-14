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

?>
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
						   
						        if($rs_bbcamposlleno->fields["fie_typeweb"]=='campogridatencion' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid2' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campoapl')
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
									 echo utf8_decode($fie_title).'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'">'.$rmp.'</span><br>';						                                     }
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
								   
										 echo utf8_decode($fie_title).'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'">'.$rmp.'</span><br>';	
										
										
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
										echo "<br><div style='color:#666666' ><b>".utf8_decode($fie_title)."</b></div><br>";
										}
										else
										{
										echo "<br><br><b>".utf8_decode($fie_title)."</b><hr>";
										
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
      <?php  echo utf8_decode($rs_us->fields["usua_siglastitulo"]." ".$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]); ?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>
      <?php  echo utf8_decode($rs_us->fields["usua_piefirma"]); ?><br>
	  SIGNATURE<br>
	  
    </strong></td>
  </tr>
  <tr>
    <td><strong>
      <?php
//	$ncentro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$objformulario->contenid["centro_id"],$DB_gogess);
	
//	echo utf8_decode($ncentro);
	?>
    </strong></td>
  </tr>
</table>
