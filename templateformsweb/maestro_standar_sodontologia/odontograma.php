<style type="text/css">
<!--

.cmb_campot {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	border: 1px solid #666666;			
 }

.cmb_campot2 {
	font-size: 9px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;		
 }
 

.txt_odonto{
    font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;		
} 


-->
</style>
<?php
$objvarios= new util_funciones();
$nlace_valor='';
$campo_enlace='odonto_enlace';
$link_opcion='';
if($this->contenid[$campo_enlace])
{
$nlace_valor=$this->contenid[$campo_enlace];
}
else
{
$nlace_valor=$this->sendvar[$this->fie_sendvar]; 
}

$clie_id=$this->sendvar["clie_idx"];


function tipo_campo($campoodo_id,$odopie_id,$clie_id,$enlace,$DB_gogess)
{
  
  $odonto_valor='';
  $campo_clic='';
  if($campoodo_id==1)
  {
    //$busca_data="select * from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$enlace."' and odopie_id='".$odopie_id."'";
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
	
	
    $campo='
<table width="50" height="5" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5" onclick="listar_borrar('.$clie_id.','.$odopie_id.')" style="cursor:pointer"  ><div align="left"><img src="archivo/listadientes.png" width="20" height="15" ></div></td>
  </tr>
</table>	
	<div id="cuadro_'.$odopie_id.'" >
<table width="50" height="50" border="1" cellpadding="0" cellspacing="0">
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

</div>';
  
  }
  
  return $campo;
}
//oubica_id
// 1 -> SUPERIOR
// 2 -> INFERIOR
// ogrp_id
// 1 -> GRUPO 1
// 2 -> GRUPO 2
// tipofodo_id
// 1 -> RECESIÓN
// 2 -> MOVILIDAD
// 3 -> VESTIBULAR
// 4 -> LINGUAL
//campoodo_id
// 1 -> texto
// 2 -> cuadro

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
		   $retona_data.='<td align="center" class="cmb_campot2" >'.$campo_tipo.''.$rs_datad->fields["tipofodo_codigo"].'</td>';

				$rs_datad->MoveNext();	   
			  }
		  }
        return $retona_data;
}
?>
<br><div class="txt_odonto">
SELECCIONAR EL SIMBOLO ANTES DE APLICAR EN EL ODONTOGRAMA<BR>
MOVILIDAD Y RECESION:MARCAR "X" (1,2 &Oacute; 3), SI APLICA</div>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	
	<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >RECESI&Oacute;N</td>
		<?php
		$despliega='';
		$despliega=genera_pieza(1,1,1,1,$clie_id,$nlace_valor,$DB_gogess,'desc');
		echo $despliega;
		?>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >MOVILIDAD</td>
        <?php
		$despliega='';
		$despliega=genera_pieza(1,2,1,1,$clie_id,$nlace_valor,$DB_gogess,'desc');
		echo $despliega;
		?>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >VESTIBULAR</td>
        <?php
		$despliega='';
		$despliega=genera_pieza(1,3,1,2,$clie_id,$nlace_valor,$DB_gogess,'desc');
		echo $despliega;
		?>
      </tr>
    </table>
	<br>
	<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >LINGUAL</td>
		<?php
		$despliega='';
		$despliega=genera_pieza(1,4,1,2,$clie_id,$nlace_valor,$DB_gogess,'desc');
		echo $despliega;
		?>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >LINGUAL</td>
        <?php
		$despliega='';
		$despliega=genera_pieza(1,4,2,2,$clie_id,$nlace_valor,$DB_gogess,'desc');
		echo $despliega;
		?>
      </tr>
      
    </table><br>
	
	
	<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >VESTIBULAR</td>
        <?php
		$despliega='';
		$despliega=genera_pieza(1,3,2,2,$clie_id,$nlace_valor,$DB_gogess,'desc');
		echo $despliega;
		?>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >MOVILIDAD</td>
        <?php
		$despliega='';
		$despliega=genera_pieza(1,2,2,1,$clie_id,$nlace_valor,$DB_gogess,'desc');
		echo $despliega;
		?>
      </tr>
	  <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >RECESI&Oacute;N</td>
		<?php
		$despliega='';
		$despliega=genera_pieza(1,1,2,1,$clie_id,$nlace_valor,$DB_gogess,'desc');
		echo $despliega;
		?>
      </tr>
    </table>
	
	
	</td>
    <td><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >RECESI&Oacute;N</td>
        <?php
		$despliega='';
		$despliega=genera_pieza(2,1,1,1,$clie_id,$nlace_valor,$DB_gogess,'asc');
		echo $despliega;
		?>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >MOVILIDAD</td>
        <?php
		$despliega='';
		$despliega=genera_pieza(2,2,1,1,$clie_id,$nlace_valor,$DB_gogess,'asc');
		echo $despliega;
		?>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >VESTIBULAR</td>
        <?php
		$despliega='';
		$despliega=genera_pieza(2,3,1,2,$clie_id,$nlace_valor,$DB_gogess,'asc');
		echo $despliega;
		?>
      </tr>
    </table>
	<br>
      <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >LINGUAL</td>
          <?php
		$despliega='';
		$despliega=genera_pieza(2,4,1,2,$clie_id,$nlace_valor,$DB_gogess,'asc');
		echo $despliega;
		?>
        </tr>
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >LINGUAL</td>
          <?php
		$despliega='';
		$despliega=genera_pieza(2,4,2,2,$clie_id,$nlace_valor,$DB_gogess,'asc');
		echo $despliega;
		?>
        </tr>
      </table><br>
      <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >VESTIBULAR</td>
          <?php
		$despliega='';
		$despliega=genera_pieza(2,3,2,2,$clie_id,$nlace_valor,$DB_gogess,'asc');
		echo $despliega;
		?>
        </tr>
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >MOVILIDAD</td>
          <?php
		$despliega='';
		$despliega=genera_pieza(2,2,2,1,$clie_id,$nlace_valor,$DB_gogess,'asc');
		echo $despliega;
		?>
        </tr>
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold" >RECESI&Oacute;N</td>
          <?php
		$despliega='';
		$despliega=genera_pieza(2,1,2,1,$clie_id,$nlace_valor,$DB_gogess,'asc');
		echo $despliega;
		?>
        </tr>
      </table></td>
  </tr>
</table>
<div id="div_diente"></div>
<?php
$cuenta_ar=0;
$lista_ar=array();
$lista_listados="select * from dns_odontosimbolo";
$rs_listasimb = $DB_gogess->executec($lista_listados,array());
        if($rs_listasimb)
        {
	       while (!$rs_listasimb->EOF) {

if($this->bloqueo_valor==0)
{		   

$link_opcion='selecciona_simbolo("'.$rs_listasimb->fields["odosimb_id"].'","'.$rs_listasimb->fields["odosimb_grafico"].'");';		
}   
			   
$lista_ar[$cuenta_ar]='<table width="100" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td onclick='.$link_opcion.' style="cursor:pointer"  ><img src="archivo/'.$rs_listasimb->fields["odosimb_grafico"].'" width="20" height="20" />
	<input name="id_simbolo_'.$rs_listasimb->fields["odosimb_id"].'" type="hidden" id="id_simbolo_'.$rs_listasimb->fields["odosimb_id"].'" value="'.$rs_listasimb->fields["odosimb_id"].'" />
	<input name="gr_simbolo_'.$rs_listasimb->fields["odosimb_id"].'" type="hidden" id="gr_simbolo_'.$rs_listasimb->fields["odosimb_id"].'" value="'.$rs_listasimb->fields["odosimb_grafico"].'" />
	</td>
    <td nowrap="nowrap" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">'.$rs_listasimb->fields["odosimb_nombre"].'</td>
  </tr>
</table>';
$cuenta_ar++;
			   
			$rs_listasimb->MoveNext();	 
		   }
		}  

$border=1;
$cellpadding=1;
$cellspacing=1;
$columnas=3;		

?>
<center><br>
<table width="700" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="200">
	 <div id="div_simboloselecc" >
	   <input name="id_simbolo" type="hidden" id="id_simbolo" value="0" />
	   <div id="grafico_img">
	   
	   </div>
	 </div>
	</td>
    <td>
	<b>9 SIMBOLOG&Iacute;A DEL ODONTOGRAMA</b>
	<?php
	$objvarios->desplegarencuadros($lista_ar,$border,$cellpadding,$cellspacing,$columnas);	
	?>
	</td>
  </tr>
</table>
</center><br>

<div id="divBody_dientel"></div>

<script type="text/javascript">
<!--

function guarda_dientevalor(clie_id,campoodo_id,odopie_id,odonto_valor)
{
 <?php
 if($this->bloqueo_valor==0)
 {
 ?>
  $("#div_diente").load("templateformsweb/maestro_standar_odontologia/guarda_diente.php",{
	
    clie_id:clie_id,
	campoodo_id:campoodo_id,
	odonto_enlace:'<?php echo $nlace_valor; ?>',
	odopie_id:odopie_id,
	odonto_valor:odonto_valor
	
  },function(result){  


  });  

  $("#div_diente").html("Espere un momento...");  
  <?php
  }
  ?>

}

function selecciona_simbolo(id_simb,ngrafico)
{
    
	$('#id_simbolo').val(id_simb);
	$('#grafico_img').html('<img src="archivo/'+ngrafico+'" width="40" height="40" />');
	
}



function guarda_valorposicion(clie_id,campoodo_id,odopie_id,odonto_valor,posicion)
{

 if($("#id_simbolo").val()>0)
 {
    
		  $("#div_diente").load("templateformsweb/maestro_standar_odontologia/guarda_dientepo.php",{
			
			clie_id:clie_id,
			campoodo_id:campoodo_id,
			odonto_enlace:'<?php echo $nlace_valor; ?>',
			odopie_id:odopie_id,
			odonto_valor:odonto_valor,
			posicion:posicion
		  },function(result){  
			  
			  despliega_diente(clie_id,campoodo_id,odopie_id);

		  });  

		  $("#div_diente").html("Espere un momento...");  
  
  
 }
 else
 {
	 alert("Por favor seleccione opci\u00f3n dando clic en los s\u00edmbolos");
 }

}

function despliega_diente(clie_id,campoodo_id,odopie_id)
{
  $("#cuadro_"+odopie_id).load("templateformsweb/maestro_standar_odontologia/diente.php",{
	
    clie_id:clie_id,
	campoodo_id:campoodo_id,
	odonto_enlace:'<?php echo $nlace_valor; ?>',
	odopie_id:odopie_id
	
  },function(result){  


  });  

  $("#cuadro_"+odopie_id).html("Espere un momento...");  
	 
	
}

function listar_borrar(clie_id,odopie_id)
{
	
	abrir_standar("templateformsweb/maestro_standar_odontologia/listadiente.php","Lista","divBody_dientel","divDialog_dientel",500,400,clie_id,"<?php echo $nlace_valor; ?>",odopie_id,0,0,0,'<?php echo @$this->bloqueo_valor; ?>');
}

//  End -->
</script>