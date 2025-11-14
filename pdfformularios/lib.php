<?php

function tipo_campo($campoodo_id,$odopie_id,$clie_id,$enlace,$DB_gogess)
{
  
  $odonto_valor='';
  $campo_clic='';
  $campo_clicsup='';
  $campo_cliccentro='';
  $campo_clicder='';
  $campo_clicizq='';
  $campo_clicinf='';
  if($campoodo_id==1)
  {
    //$busca_data="select * from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$enlace."' and odopie_id='".$odopie_id."'";
	$busca_data="select odonto_valor from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odopie_id='".$odopie_id."'";
    $rs_datad = $DB_gogess->executec($busca_data,array());
	
	@$odonto_valor=$rs_datad->fields["odonto_valor"];
	if($odonto_valor)
	{

$campo='<table width="22" height="20" border="0" cellpadding="0"  style="border-collapse:separate;border-spacing:0px;" >
  <tr>
    <td height="7" colspan="3" class="borde_allmenos" ><center>'.$odonto_valor.'</center></td>
  </tr>
</table>';
	
	}
	else
	{
	$campo='<table width="22" height="20" border="0" cellpadding="0"  style="border-collapse:separate;border-spacing:0px;" >
  <tr>
    <td height="7" colspan="3" class="borde_allmenos" ><center><br></center></td>
  </tr>
</table>';
	}
  }
  if($campoodo_id==2)
  {
	  
	//---------------------------------------- 
	
	$valor_supe='';
	//$busca_supe="select * from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$enlace."' and odopie_id='".$odopie_id."' and odonto_posicion='sup'";
    $busca_supe="select odonto_valor from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odopie_id='".$odopie_id."' and odonto_posicion='sup'";

    $rs_supe = $DB_gogess->executec($busca_supe,array());
	if($rs_supe)
        {
	       while (!$rs_supe->EOF) {
	            
                $grafico_data='';				
				$obtiene_id="";
				$obtiene_id="select * from dns_odontosimbolo where odosimb_id=".$rs_supe->fields["odonto_valor"];
				$rs_obt = $DB_gogess->executec($obtiene_id,array());
				$grafico_data=$rs_obt->fields["odosimb_grafico"];
				
	            $valor_supe.='<img src="../archivo/'.$grafico_data.'" width="6" height="6" />';
				
	           $rs_supe->MoveNext();	   
			  }
		}
	//---------------------------------------- 
	//----------------------------------------
	
	$valor_inf='';
	//$busca_inf="select * from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$enlace."' and odopie_id='".$odopie_id."' and odonto_posicion='inf'";
	$busca_inf="select odonto_valor from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odopie_id='".$odopie_id."' and odonto_posicion='inf'";
    $rs_inf = $DB_gogess->executec($busca_inf,array());
	if($rs_inf)
        {
	       while (!$rs_inf->EOF) {
	            
                $grafico_data='';				
				$obtiene_id="";
				$obtiene_id="select * from dns_odontosimbolo where odosimb_id=".$rs_inf->fields["odonto_valor"];
				$rs_obt = $DB_gogess->executec($obtiene_id,array());
				$grafico_data=$rs_obt->fields["odosimb_grafico"];
				
	            $valor_inf.='<img src="../archivo/'.$grafico_data.'" width="6" height="6" />';
				
				
	           $rs_inf->MoveNext();	   
			  }
		}
	
	//-----------------------------------------
	
	//-----------------------------------------

	$valor_izq='';
	//$busca_izq="select * from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$enlace."' and odopie_id='".$odopie_id."' and odonto_posicion='izq'";
	$busca_izq="select odonto_valor from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odopie_id='".$odopie_id."' and odonto_posicion='izq'";
    $rs_izq = $DB_gogess->executec($busca_izq,array());
	if($rs_izq)
        {
	       while (!$rs_izq->EOF) {
	            
                $grafico_data='';				
				$obtiene_id="";
				$obtiene_id="select * from dns_odontosimbolo where odosimb_id=".$rs_izq->fields["odonto_valor"];
				$rs_obt = $DB_gogess->executec($obtiene_id,array());
				$grafico_data=$rs_obt->fields["odosimb_grafico"];
				
	            $valor_izq.='<img src="../archivo/'.$grafico_data.'" width="6" height="6" />';
				
				
	           $rs_izq->MoveNext();	   
			  }
		}
	
	
	//-----------------------------------------
    
	//-----------------------------------------
   
	$valor_der='';
	//$busca_der="select * from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$enlace."' and odopie_id='".$odopie_id."' and odonto_posicion='der'";
	$busca_der="select odonto_valor from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."'  and odopie_id='".$odopie_id."' and odonto_posicion='der'";
    $rs_der = $DB_gogess->executec($busca_der,array());
	if($rs_der)
        {
	       while (!$rs_der->EOF) {
	            
                $grafico_data='';				
				$obtiene_id="";
				$obtiene_id="select * from dns_odontosimbolo where odosimb_id=".$rs_der->fields["odonto_valor"];
				$rs_obt = $DB_gogess->executec($obtiene_id,array());
				$grafico_data=$rs_obt->fields["odosimb_grafico"];
				
	            $valor_der.='<img src="../archivo/'.$grafico_data.'" width="6" height="6" />';
				
				
	           $rs_der->MoveNext();	   
			  }
		}
	
	
	//------------------------------------------
	
	//------------------------------------------
	
$valor_centro='';
//$busca_centro="select * from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$enlace."' and odopie_id='".$odopie_id."' and odonto_posicion='centro'";
$busca_centro="select odonto_valor from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odopie_id='".$odopie_id."' and odonto_posicion='centro'";
    $rs_centro = $DB_gogess->executec($busca_centro,array());
	if($rs_centro)
        {
	       while (!$rs_centro->EOF) {
	            
                $grafico_data='';				
				$obtiene_id="";
				$obtiene_id="select * from dns_odontosimbolo where odosimb_id=".$rs_centro->fields["odonto_valor"];
				$rs_obt = $DB_gogess->executec($obtiene_id,array());
				$grafico_data=$rs_obt->fields["odosimb_grafico"];
				
	            $valor_centro.='<img src="../archivo/'.$grafico_data.'" width="6" height="6" />';
				
				
	           $rs_centro->MoveNext();	   
			  }
		}
	
	
	//------------------------------------------
	//------------------------------------------
	$valor_grupo='';
	//$busca_grupo="select * from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$enlace."' and odopie_id='".$odopie_id."' and odonto_posicion='grupo'";
    $busca_grupo="select odonto_valor from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odopie_id='".$odopie_id."' and odonto_posicion='grupo'";
	$rs_grupo = $DB_gogess->executec($busca_grupo,array());
	if($rs_grupo)
        {
	       while (!$rs_grupo->EOF) {
	            
                $grafico_data='';				
				$obtiene_id="";
				$obtiene_id="select * from dns_odontosimbolo where odosimb_id=".$rs_grupo->fields["odonto_valor"];
				$rs_obt = $DB_gogess->executec($obtiene_id,array());
				$grafico_data=$rs_obt->fields["odosimb_grafico"];
				
	            $valor_grupo.='<img src="../archivo/'.$grafico_data.'" width="20" height="6" />';
				
				
	           $rs_grupo->MoveNext();	   
			  }
		}
	
	//------------------------------------------
	
	if(!($valor_supe))
	{
	  $valor_supe='&nbsp;';
	}
	
	if(!($valor_izq))
	{
	  $valor_izq='&nbsp;';
	}
	
	if(!($valor_centro))
	{
	  $valor_centro='&nbsp;';
	}
	
	if(!($valor_der))
	{
	  $valor_der='&nbsp;';
	}
	
	if(!($valor_inf))
	{
	  $valor_inf='&nbsp;';
	}
	
    $campo='	

<table width="22" height="20" border="0" cellpadding="0"  style="border-collapse:separate;border-spacing:0px;" >
  <tr>
    <td height="7" colspan="3" '.$campo_clicsup.' class="borde_all" ><center>'.$valor_supe.'</center></td>
  </tr>
  <tr>
    <td '.$campo_clicizq.' height="7" class="borde_all" ><center>'.$valor_izq.'</center></td>
    <td '.$campo_cliccentro.' height="7" class="borde_all" ><center>'.$valor_centro.'</center></td>
    <td '.$campo_clicder.' height="7" class="borde_all" ><center>'.$valor_der.'</center></td>
  </tr>  
  <tr>
    <td height="7" colspan="3" '.$campo_clicinf.' class="borde_all" ><center>'.$valor_inf.'</center></td>
  </tr>
</table>

<table width="22" height="7" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td height="7"  class="borde_all"><center>'.$valor_grupo.'</center></td>
  </tr>
</table>

';
  
  }
  
  return $campo;
}

function genera_pieza($ogrp_id,$tipofodo_id,$oubica_id,$campoodo_id,$clie_id,$campo_enlace,$DB_gogess,$orden)
{
        $retona_data='';
        $lista_d="select odopie_id,tipofodo_codigo from dns_odopiezadental where ogrp_id=".$ogrp_id." and tipofodo_id=".$tipofodo_id." and oubica_id=".$oubica_id." and campoodo_id=".$campoodo_id." order by tipofodo_codigo ".$orden;
		$rs_datad = $DB_gogess->executec($lista_d,array());
        if($rs_datad)
        {
	       while (!$rs_datad->EOF) {	
		   
		   $campo_tipo='';
		   $campo_tipo=tipo_campo($campoodo_id,$rs_datad->fields["odopie_id"],$clie_id,$campo_enlace,$DB_gogess);	   
		   if($campoodo_id==1)
		   {
		     $rs_datad->fields["tipofodo_codigo"]='';
		   }
		   
		   if($oubica_id==1 and $tipofodo_id==3)
		   {
		   $retona_data.='<td align="center" class="cmb_campot2" width="12"><center>'.$rs_datad->fields["tipofodo_codigo"].'</center>'.$campo_tipo.'</td>';
		   }
		   else
		   {
		   $retona_data.='<td align="center" class="cmb_campot2" width="12">'.$campo_tipo.'<center>'.$rs_datad->fields["tipofodo_codigo"].'</center></td>';
		   
		   }

				$rs_datad->MoveNext();	   
			  }
		  }
        return $retona_data;
}


?>