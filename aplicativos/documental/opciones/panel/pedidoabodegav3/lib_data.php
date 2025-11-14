<?php


function busca_paradescargarapaciente($periodo_actual,$centro_id,$cuadrobm_id,$detpre_cantidad,$detpretmp_id,$egrec_id_v,$centro_redpublica,$detapreoper_id,$DB_gogess)
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
						$entregadot2=$rs_ent->fields["entregadot"];
						
						
						//busca_movimientos_fuera
						
						
						//busca lo ingresado en comprobante
						
						//$busca_asig="select sum(cantidad_val) as totalegreso from dns_temporaldespacho inner join dns_egresocentros on dns_temporaldespacho.egrec_id=dns_egresocentros.egrec_id where moviin_id='".$rs_lcompras->fields["moviin_id"]."' and egrec_anulado=0";
                        //$rs_asig = $DB_gogess->executec($busca_asig);
						
						$cantidad_asig=0;

						//if(@$rs_asig->fields["totalegreso"])
						//{
						  //$cantidad_asig=$rs_asig->fields["totalegreso"];
						//}
						//else
						//{
						  //$cantidad_asig=0;
						//}
						
		$cantidad_valentre=0;
		//$busca_entregado="select sum(detapre_cantidad) as cantidad_val from dns_detalleprecuenta where detapreoper_id='".detapreoper_id."'";
		//$rs_okentreg = $DB_gogess->executec($busca_entregado,array());		
		//$cantidad_valentre=$rs_okentreg->fields["cantidad_val"];
						
						
						$valor_movimiento=0;
                        $valor_movimiento=$rs_lcompras->fields["moviin_totalenunidadconsumo"];
						
						$restante_valor=$valor_movimiento-$cantidad_asig-$entregadot-$entregadot2;
						//busca lo ingresado en comporbante
						
						$busca_quees="select * from dns_motivomovimiento where tipomov_id='".$rs_lcompras->fields["tipomov_id"]."'";
						$rs_queess = $DB_gogess->executec($busca_quees);
						$or_data=$rs_queess->fields["tipomov_nombre"];
						
						//echo '<br>---------------------mayor---<br>';
						//echo $restante_valor;
						//echo '<br>---------------------mayor---<br>';
						
						if($restante_valor>0)
						{
						
						//.' -> '. $lista_ent.' -> '.$busca_asig
											
						$boton_check='';
						
						  
						   $boton_check=' <input name="radio_lote" id="radio_lote" type="radio" value="'.$rs_lcompras->fields["moviin_id"].'" /> ';
						 
						
						//echo "Restantevalor:".$restante_valor."<br>";
						//echo "depercantidad:".$detpre_cantidad."<br>";
						
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
