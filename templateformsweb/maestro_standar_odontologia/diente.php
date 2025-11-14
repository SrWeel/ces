<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();


$clie_id=$_POST["clie_id"];
$campoodo_id=$_POST["campoodo_id"];
$odonto_enlace=$_POST["odonto_enlace"];
$odopie_id=$_POST["odopie_id"];


function tipo_campo($campoodo_id,$odopie_id,$clie_id,$enlace,$DB_gogess)
{
  
  $odonto_valor='';
  $campo_clic='';
  if($campoodo_id==1)
  {
  //$busca_data="select odonto_valor from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$enlace."' and odopie_id='".$odopie_id."'";
    $busca_data="select odonto_valor from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odopie_id='".$odopie_id."'";
	$rs_datad = $DB_gogess->executec($busca_data,array());
	
	@$odonto_valor=$rs_datad->fields["odonto_valor"];
	
	$campo_clic='onchange=guarda_dientevalor("'.$clie_id.'","'.$campoodo_id.'","'.$odopie_id.'",$("#text_di'.$odopie_id.$clie_id.'").val()) style="cursor:pointer"';
	
	$campo='<input name="text_di'.$odopie_id.$clie_id.'" type="text" id="text_di'.$odopie_id.$clie_id.'" value="'.$odonto_valor.'" size="2" class="cmb_campot"  '.$campo_clic.' /><br>';
  }
  if($campoodo_id==2)
  {
	  
	//---------------------------------------- 
	$campo_clicsup='onclick=guarda_valorposicion("'.$clie_id.'","'.$campoodo_id.'","'.$odopie_id.'",$("#id_simbolo").val(),"sup") style="cursor:pointer"';
	
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
				
	            $valor_supe.='<img src="archivo/'.$grafico_data.'" width="7" height="7" />';
				
	           $rs_supe->MoveNext();	   
			  }
		}
	//---------------------------------------- 
	//----------------------------------------
	$campo_clicinf='onclick=guarda_valorposicion("'.$clie_id.'","'.$campoodo_id.'","'.$odopie_id.'",$("#id_simbolo").val(),"inf") style="cursor:pointer"';
	
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
				
	            $valor_inf.='<img src="archivo/'.$grafico_data.'" width="7" height="7" />';
				
				
	           $rs_inf->MoveNext();	   
			  }
		}
	
	//-----------------------------------------
	
	//-----------------------------------------
	$campo_clicizq='onclick=guarda_valorposicion("'.$clie_id.'","'.$campoodo_id.'","'.$odopie_id.'",$("#id_simbolo").val(),"izq") style="cursor:pointer"';
	
	
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
				
	            $valor_izq.='<img src="archivo/'.$grafico_data.'" width="7" height="7" />';
				
				
	           $rs_izq->MoveNext();	   
			  }
		}
	
	
	//-----------------------------------------
    
	//-----------------------------------------
    $campo_clicder='onclick=guarda_valorposicion("'.$clie_id.'","'.$campoodo_id.'","'.$odopie_id.'",$("#id_simbolo").val(),"der") style="cursor:pointer"';
	
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
				
	            $valor_der.='<img src="archivo/'.$grafico_data.'" width="7" height="7" />';
				
				
	           $rs_der->MoveNext();	   
			  }
		}
	
	
	//------------------------------------------
	
	//------------------------------------------
	$campo_cliccentro='onclick=guarda_valorposicion("'.$clie_id.'","'.$campoodo_id.'","'.$odopie_id.'",$("#id_simbolo").val(),"centro") style="cursor:pointer"';
	
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
				
	            $valor_centro.='<img src="archivo/'.$grafico_data.'" width="7" height="7" />';
				
				
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
				
	            $valor_grupo.='<img src="archivo/'.$grafico_data.'" width="30" height="7" />';
				
				
	           $rs_grupo->MoveNext();	   
			  }
		}
	
	//------------------------------------------
    $campo='<table width="50" height="50" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5" colspan="4" '.$campo_clicsup.' ><center>'.$valor_supe.'
	&nbsp;</center></td>
  </tr>
  <tr>
    <td '.$campo_clicizq.' ><center>'.$valor_izq.'&nbsp;</center></td>
    <td colspan="2" '.$campo_cliccentro.' ><center>'.$valor_centro.'&nbsp;</center></td>
    <td '.$campo_clicder.' ><center>'.$valor_der.'&nbsp;</center></td>
  </tr>
  
  <tr>
    <td height="5" colspan="4" '.$campo_clicinf.' ><center>'.$valor_inf.'&nbsp;</center></td>
  </tr>
</table>

<table width="50" height="5" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5"  ><center>'.$valor_grupo.'&nbsp;</center></td>
  </tr>
</table>

';
  
  }
  
  return $campo;
}

function genera_pieza($odopie_id,$campoodo_id,$clie_id,$campo_enlace,$DB_gogess)
{
        $retona_data='';
        $lista_d="select * from dns_odopiezadental where odopie_id='".$odopie_id."'";
		$rs_datad = $DB_gogess->executec($lista_d,array());
        if($rs_datad)
        {
	       while (!$rs_datad->EOF) {	
		   
		   $campo_tipo='';
		   $campo_tipo=tipo_campo($campoodo_id,$rs_datad->fields["odopie_id"],$clie_id,$campo_enlace,$DB_gogess);	   
		   $retona_data.=''.$campo_tipo.'';

				$rs_datad->MoveNext();	   
			  }
		  }
        return $retona_data;
}

$despliega='';
$despliega=genera_pieza($odopie_id,$campoodo_id,$clie_id,$odonto_enlace,$DB_gogess);
echo $despliega;
?>