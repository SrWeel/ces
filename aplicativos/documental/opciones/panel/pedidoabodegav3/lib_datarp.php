<?php


function busca_paradescargarapaciente($periodo_actual,$centro_id,$cuadrobm_id,$detpre_cantidad,$detpretmp_id,$egrec_id_v,$centro_redpublica,$detapreoper_id,$DB_gogess,$objformulario)
{

  $periodo_actual=$objformulario->replace_cmb("dns_periodobodega","perio_id,perio_anio"," where perio_activo=","1",$DB_gogess);

 $centro_idb=$centro_id;
 $array_asigmovi=array(); 
 $lista_compras='';
					if($cuadrobm_id>0)
					{
				
				 $busca_paraentrega="select * from dns_movimientoinventario where tipom_id=1 and moviin_fecharegistro>='2023-01-01' and cuadrobm_id='".$cuadrobm_id."' and year(moviin_fecharegistro)>='".$periodo_actual."' and centro_id='".$centro_id."' order by 	moviin_fechadecaducidad asc";
				  
					}
					
					$rs_paraentrega = $DB_gogess->executec($busca_paraentrega,array());
                    if($rs_paraentrega)
				    {
						while (!$rs_paraentrega->EOF) {	
						
						
						
	  $moviin_redpublica=$rs_paraentrega->fields["moviinb_redpublica"];
	  $moviin_nlote=$rs_paraentrega->fields["moviin_nlote"];
	  
	  $lista_nproducto="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
	  $rs_nproducto = $DB_gogess->executec($lista_nproducto,array());
	  
	  $cuadrobm_codigoatc=$rs_nproducto->fields["cuadrobm_codigoatc"];

						
						
						
						
	  
	    $ncampo_val='cuadrobm_principioactivo';
		$nom1='';					
		if($rs_nproducto->fields["cuadrobm_nombredispositivo"])
		{
		   $nom1=$rs_nproducto->fields["cuadrobm_nombredispositivo"].' ';
		}
		
		$nom2='';					
		if($rs_nproducto->fields["cuadrobm_primerniveldesagregcion"])
		{
		   $nom2=$rs_nproducto->fields["cuadrobm_primerniveldesagregcion"].' ';
		}
		
		$nom3='';					
		if($rs_nproducto->fields["cuadrobm_presentacion"])
		{
		   $nom3=$rs_nproducto->fields["cuadrobm_presentacion"].' ';
		}
		 
		$nom4='';					
		if($rs_nproducto->fields["cuadrobm_concentracion"])
		{
		   $nom4=$rs_nproducto->fields["cuadrobm_concentracion"].' ';
		}
		
		$concatena_nom=$nom1.$nom2.$nom3.$nom4;
		
		
	  //envios pacientes
	 $busca_entregados="select sum(moviin_totalenunidadconsumo) as totalv from dns_movimientoinventario where centro_id='".$centro_id."' and (entregamoviin_id='".$rs_paraentrega->fields["moviin_id"]."' or  entregamoviin_id='0') and tipom_id=2 and moviin_nlote ='".$rs_paraentrega->fields["moviin_nlote"]."' and cuadrobm_id='".$cuadrobm_id."' and centro_id='".$centro_id."' and perioac_id='".$periodo_actual."' and moviincent_id=0";
	  $rs_entregados = $DB_gogess->executec($busca_entregados,array());
	  // envios pacientes
	  
	  //trasnferencias
	  
	  $busca_entregadost="select sum(moviin_totalenunidadconsumo) as totalv from dns_movimientoinventario where centro_id='".$centro_id."' and entregamoviin_id='0' and tipom_id=2 and moviin_nlote ='".$rs_paraentrega->fields["moviin_nlote"]."' and cuadrobm_id='".$cuadrobm_id."' and centro_id='".$centro_id."' and perioac_id='".$periodo_actual."' and moviincent_id='".$rs_paraentrega->fields["moviin_id"]."'";
	  $rs_entregadost = $DB_gogess->executec($busca_entregadost,array());
	  
	  //trasferencias
	  
	  $actual_porlote=0;
	  $actual_porlote=$rs_paraentrega->fields["moviin_totalenunidadconsumo"]-$rs_entregados->fields["totalv"]-$rs_entregadost->fields["totalv"];
	 // $actual_porlote=0;
	 
	 
	  if($actual_porlote>0)
	  {
	  
	                  $boton_check=' <input name="checkbox_data[]" type="checkbox" id="checkbox_data" value="'.$rs_paraentrega->fields["moviin_id"].'" onClick="suma_valores()" > ';
					 
	                 
  
                     if($boton_check)
						{
							if($actual_porlote>=$detpre_cantidad)
							{
							   if($detpre_cantidad>0)
							   {
							   $array_asigmovi[]=$rs_paraentrega->fields["moviin_id"]."|".$detpre_cantidad."|".$cuadrobm_codigoatc."|".$cuadrobm_id."|".$detpretmp_id;
							   $detpre_cantidad=0;
							   }
							}
							else
							{
							  if($actual_porlote>0)
							  {
							  $array_asigmovi[]=$rs_paraentrega->fields["moviin_id"]."|".$restante_valor."|".$cuadrobm_codigoatc."|".$cuadrobm_id."|".$detpretmp_id;
							  $detpre_cantidad=$detpre_cantidad-$restante_valor;
							  }
							
							}
						 }	
  
  
  
  
        }
						
						
						
						
						
					
					      $rs_paraentrega->MoveNext();
					      }
					}	
					
					
    return $array_asigmovi; 

}


function busca_paradescargar($periodo_actual,$centro_id,$cuadrobm_id,$detpre_cantidad,$detpretmp_id,$egrec_id_v,$centro_redpublica,$DB_gogess)
{

 $centro_idb=$centro_id;
 $array_asigmovi=array(); 
 $lista_compras='';
					if($cuadrobm_id>0)
					{
				 $lista_compras="select * from dns_compras RIGHT join dns_principalmovimientoinventario on dns_compras.compra_id=dns_principalmovimientoinventario.compra_id where dns_principalmovimientoinventario.tipom_id=1  and cuadrobm_id='".$cuadrobm_id."' order by moviin_fechadecaducidad asc";
					}
					
					$rs_lcompras = $DB_gogess->executec($lista_compras);
                    if($rs_lcompras)
				    {
						while (!$rs_lcompras->EOF) {	
						
						$moviin_redpublica=$rs_lcompras->fields["moviin_redpublica"];
						$moviin_nlote=$rs_lcompras->fields["moviin_nlote"];
						
						$busca_code="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
						$rs_bcode = $DB_gogess->executec($busca_code);
						
						$cuadrobm_codigoatc=$rs_bcode->fields["cuadrobm_codigoatc"];
						
						//busca no procesados
						$compra_nsecx='';
						//echo $busca_npd="select distinct dns_egresocentros.egrec_id from dns_temporaldespacho inner join dns_egresocentros on dns_temporaldespacho.egrec_id=dns_egresocentros.egrec_id where moviin_id='".$rs_lcompras->fields["moviin_id"]."' and egrec_anulado=0 and egrec_procesado=0 and dns_egresocentros.egrec_id!='".$egrec_id_v."'";
						
						$busca_npd="select distinct dns_egresocentros.egrec_id from dns_temporaldespacho inner join dns_egresocentros on dns_temporaldespacho.egrec_id=dns_egresocentros.egrec_id where moviin_id='".$rs_lcompras->fields["moviin_id"]."' and egrec_anulado=0 and egrec_procesado=0 and dns_egresocentros.egrec_id!='".$egrec_id_v."'";
						 
                        $rs_npd = $DB_gogess->executec($busca_npd);
						if($rs_npd)
						{
						   while (!$rs_npd->EOF) {
						   						   
						    $compra_nsecx.=str_pad($rs_npd->fields["egrec_id"], 10, "0", STR_PAD_LEFT).' - ';
						   
						    $rs_npd->MoveNext();
						   }						
						}
						
						//busca no procesados
						
						
						//busca_movimientos_fuera
						//moviintranscent_id
						
						$lista_ent="select sum(moviin_totalenunidadconsumo) as entregadot from  dns_principalmovimientoinventario where (moviintranscent_id='".$rs_lcompras->fields["moviin_id"]."') and centro_id='55' and tipom_id=2 and tomfis_id>0 and 	cuadrobm_id='".$cuadrobm_id."'";
						
						$rs_ent = $DB_gogess->executec($lista_ent);
						$entregadot=0;
						$entregadot=$rs_ent->fields["entregadot"];
						
						$lista_ent2="select sum(moviin_totalenunidadconsumo) as entregadot from  dns_principalmovimientoinventario where (moviintranscent_id='".$rs_lcompras->fields["moviin_id"]."') and centro_id='55' and tipom_id=2 and tomfis_id=0 and 	cuadrobm_id='".$cuadrobm_id."'";
						
						$rs_ent = $DB_gogess->executec($lista_ent2);
						$entregadot2=0;
						//$entregadot2=$rs_ent->fields["entregadot"];
						
						
						//busca_movimientos_fuera
						
						
						//busca lo ingresado en comprobante
						
						$busca_asig="select sum(cantidad_val) as totalegreso from dns_temporaldespacho inner join dns_egresocentros on dns_temporaldespacho.egrec_id=dns_egresocentros.egrec_id where moviin_id='".$rs_lcompras->fields["moviin_id"]."' and egrec_anulado=0";
                        $rs_asig = $DB_gogess->executec($busca_asig);
						
						$cantidad_asig=0;

						if(@$rs_asig->fields["totalegreso"])
						{
						  $cantidad_asig=$rs_asig->fields["totalegreso"];
						}
						else
						{
						  $cantidad_asig=0;
						}
						
						
						$valor_movimiento=0;
                        $valor_movimiento=$rs_lcompras->fields["moviin_totalenunidadconsumo"];
						
						$restante_valor=$valor_movimiento-$cantidad_asig-$entregadot-$entregadot2;
						//busca lo ingresado en comporbante
						
						$busca_quees="select * from dns_motivomovimiento where tipomov_id='".$rs_lcompras->fields["tipomov_id"]."'";
						$rs_queess = $DB_gogess->executec($busca_quees);
						$or_data=$rs_queess->fields["tipomov_nombre"];
						
						if($restante_valor>0)
						{
						
						//.' -> '. $lista_ent.' -> '.$busca_asig
											
						$boton_check='';
						if($moviin_redpublica==1 and $centro_redpublica==1)
						{
						  
						   $boton_check=' <input name="radio_lote" id="radio_lote" type="radio" value="'.$rs_lcompras->fields["moviin_id"].'" /> ';
						  
						}
						
						if($moviin_redpublica==1 and $centro_redpublica==0)
						{
						  
						   $boton_check='';
						  
						}
						
						if($moviin_redpublica==0 and $centro_redpublica==1)
						{
						  
						   $boton_check='';
						  
						}
						
						if($moviin_redpublica==0 and $centro_redpublica==0)
						{
						  $boton_check=' <input name="radio_lote" id="radio_lote" type="radio" value="'.$rs_lcompras->fields["moviin_id"].'" /> ';						
						}
						
						echo "Restantevalor:".$restante_valor."<br>";
						echo "depercantidad:".$detpre_cantidad."<br>";
						
						if($boton_check)
						{
							if($restante_valor>=$detpre_cantidad)
							{
							   if($detpre_cantidad>0)
							   {
							   $array_asigmovi[]=$rs_lcompras->fields["moviin_id"]."|".$detpre_cantidad."|".$cuadrobm_codigoatc."|".$cuadrobm_id."|".$detpretmp_id;
							   $detpre_cantidad=0;
							   }
							}
							else
							{
							  if($restante_valor>0)
							  {
							  $array_asigmovi[]=$rs_lcompras->fields["moviin_id"]."|".$restante_valor."|".$cuadrobm_codigoatc."|".$cuadrobm_id."|".$detpretmp_id;
							  $detpre_cantidad=$detpre_cantidad-$restante_valor;
							  }
							
							}
						 }	
					
					
					
					     }
					
					               $rs_lcompras->MoveNext();
					                      }
					}	
					
					
    return $array_asigmovi; 

}

?>
