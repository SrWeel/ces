<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$obj_util=new util_funciones();
$fecha_valor=$_POST["fecha_valor"];

$hora_ini='07:15';
$hora_fin='12:45';

function horario_maniana($usua_id,$ndia,$hora,$fecha_valor,$DB_gogess)
{

  $nombre_data=''; 
  
  
  $busca_hmaniana="select * from cereni_pacientemateria inner join cereni_asignamaterias on cereni_pacientemateria.asigm_id=cereni_asignamaterias.asigm_id inner join cereni_horario on cereni_pacientemateria.horac_id=cereni_horario.horac_id where (horac_horai='".$hora."') and dia_id='".$ndia."' and cereni_asignamaterias.usua_id='".$usua_id."'";
  $rs_hm= $DB_gogess->executec($busca_hmaniana,array());  
  if($rs_hm)
   {
	   while (!$rs_hm->EOF) {
	   
	    $asigm_id=$rs_hm->fields["asigm_id"];
	   
	    $busca_clieter="select * from app_cliente where clie_id='".$rs_hm->fields["clie_id"]."'";
        $rs_bclieter = $DB_gogess->executec($busca_clieter,array());		
		$nombre_p='';
		$nombre_dato=array();
		$nombre_dato=explode(" ",$rs_bclieter->fields["clie_nombre"]);
		
		$apellido_dato=array();
		$apellido_dato=explode(" ",$rs_bclieter->fields["clie_apellido"]);
		
        $nombre_p=$nombre_dato[0]." ".$apellido_dato[0]." | ".$rs_hm->fields["horac_horai"]."-".$rs_hm->fields["horac_horaf"];
			
		$function_tomaasi='';
		$function_tomaasi='activar_asisgrupo("'.$rs_hm->fields["asigm_id"].'","'.$rs_hm->fields["clie_id"].'","'.$rs_hm->fields["centro_id"].'","'.$usua_id.'","'.$fecha_valor.'")';		
		
		//estado:$('#asisgrupo_id'+asigm_id+clie_id+centro_id).prop('checked')
		$busca_asistencia="select * from cereni_asistenciagrupo where asigm_id='".$rs_hm->fields["asigm_id"]."' and clie_id='".$rs_hm->fields["clie_id"]."' and centro_id='".$rs_hm->fields["centro_id"]."',asig_fecha='".$fecha_valor."'";
		$rs_bcasietg = $DB_gogess->executec($busca_asistencia,array());
		
		$check_asistencia='';
		
		if($_SESSION['ces1313777_sessid_inicio']==$usua_id)
			 {
					  
			  if($rs_bcasietg->fields["asig_asiste"]==1)
			  {
			  $check_asistencia='<input onclick='.$function_tomaasi.' name="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" type="checkbox" id="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" value="1" checked="checked" />';
			  }
			  else
			  {
			  $check_asistencia='<input onclick='.$function_tomaasi.' name="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" type="checkbox" id="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" value="1" />';							  
			  }
			  
			 }
			 else
			 {
				if($_SESSION['ces1313777_usua_adm']==1)
				{
								  
					  if($rs_bcasietg->fields["asig_asiste"]==1)
					  {
					  $check_asistencia='<input onclick='.$function_tomaasi.' name="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" type="checkbox" id="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" value="1" checked="checked" />';
					  }
					  else
					  {
					  $check_asistencia='<input onclick='.$function_tomaasi.' name="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" type="checkbox" id="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" value="1" />';							  
					  }
				
				}
			 
			 
			 }
							 
							 
		$link_alerta='';
		$nombre_data.='<table width="100%" height="100%" border="1" cellpadding="0" cellspacing="0">
			  <tr>
			    <td '.$link_alerta.'  style="cursor:pointer" ><img src="images/alertaasistencia.png" width="20" height="20" /></td>
				<td style="background-color:#E1EFF4;" ><center><span style="color:#5B79B0;font-size:6px" ><b>'.utf8_encode($nombre_p).'</span></center></td><td>'.$check_asistencia.'</td><td>/</td>
			  </tr>
		 </table>';
  
   
          $rs_hm->MoveNext();
	   }
   }
   
   //echo $asigm_id."<br>";
   
   $link_evoluciongrupo='onclick=ver_formularioenpantalla(\'aplicativos/documental/datos_standargrupoterapia.php\',\'Editar\',\'divBody_ext\',\''.$asigm_id.'\',\'69\',0,0,0,0,0)';     
   if($nombre_data)
   {
     $nombre_data='<div '.$link_evoluciongrupo.' ><img src="images/evolucion.png" width="30" height="30" /></div>'.$nombre_data;   
   }
   
   //=======================================================================================
   
$busca_hmaniana="select * from cereni_pacientemateria inner join cereni_asignamaterias on cereni_pacientemateria.asigm_id=cereni_asignamaterias.asigm_id inner join cereni_horario on cereni_pacientemateria.horac_id=cereni_horario.horac_id where (horac_horai='".$hora."') and dia_id='8' and cereni_asignamaterias.usua_id='".$usua_id."'";
  $rs_hm= $DB_gogess->executec($busca_hmaniana,array());  
  if($rs_hm)
   {
	   while (!$rs_hm->EOF) {
	   
	     $asigm_id=$rs_hm->fields["asigm_id"];
	   
	    $busca_clieter="select * from app_cliente where clie_id='".$rs_hm->fields["clie_id"]."'";
        $rs_bclieter = $DB_gogess->executec($busca_clieter,array());		
		$nombre_p='';        
		
		$nombre_dato=array();
		$nombre_dato=explode(" ",$rs_bclieter->fields["clie_nombre"]);
		
		$apellido_dato=array();
		$apellido_dato=explode(" ",$rs_bclieter->fields["clie_apellido"]);		
        $nombre_p=$nombre_dato[0]." ".$apellido_dato[0]." | ".$rs_hm->fields["horac_horai"]."-".$rs_hm->fields["horac_horaf"];
		
		$function_tomaasi='';
		$function_tomaasi='activar_asisgrupo("'.$rs_hm->fields["asigm_id"].'","'.$rs_hm->fields["clie_id"].'","'.$rs_hm->fields["centro_id"].'","'.$usua_id.'","'.$fecha_valor.'")';	
		
		$busca_asistencia="select * from cereni_asistenciagrupo where asigm_id='".$rs_hm->fields["asigm_id"]."' and clie_id='".$rs_hm->fields["clie_id"]."' and centro_id='".$rs_hm->fields["centro_id"]."' and asig_fecha='".$fecha_valor."'";
		$rs_bcasietg = $DB_gogess->executec($busca_asistencia,array());
		
		$check_asistencia='';
		
		if($_SESSION['ces1313777_sessid_inicio']==$usua_id)
			 {
					  
			  if($rs_bcasietg->fields["asig_asiste"]==1)
			  {
			  $check_asistencia='<input onclick='.$function_tomaasi.' name="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" type="checkbox" id="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" value="1" checked="checked" />';
			  }
			  else
			  {
			  $check_asistencia='<input onclick='.$function_tomaasi.' name="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" type="checkbox" id="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" value="1" />';							  
			  }
			  
			 }
			 else
			 {
				if($_SESSION['ces1313777_usua_adm']==1)
				{
								  
					  if($rs_bcasietg->fields["asig_asiste"]==1)
					  {
					  $check_asistencia='<input onclick='.$function_tomaasi.' name="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" type="checkbox" id="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" value="1" checked="checked" />';
					  }
					  else
					  {
					  $check_asistencia='<input onclick='.$function_tomaasi.' name="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" type="checkbox" id="asisgrupo_id'.$rs_hm->fields["asigm_id"].$rs_hm->fields["clie_id"].$rs_hm->fields["centro_id"].$usua_id.'" value="1" />';							  
					  }
				
				}
			 
			 
			 }
		
	
		$link_alerta='onclick=abrir_standar(\'aplicativos/documental/opciones/panel/calendarioseguros/obsgrupo.php\',\'OBSERVACION\',\'divBody_obs\',\'divDialog_obs\',400,250,\''.$rs_hm->fields["asigm_id"].'\',\''.$rs_hm->fields["clie_id"].'\',\''.$rs_hm->fields["centro_id"].'\',\''.$usua_id.'\',\''.$fecha_valor.'\',0,0);';		
		
		$nombre_data.='<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td '.$link_alerta.'  style="cursor:pointer" ><img src="images/alertaasistencia.png" width="20" height="20" /></td>
				<td><center><span style="color:#000000;font-size:8px" ><b>'.utf8_encode($nombre_p).'</span></center></td><td>'.$check_asistencia.'</td><td>/</td>
			  </tr>
		 </table>';
  
   
          $rs_hm->MoveNext();
	   }
   }
   
  //echo $asigm_id."<br>";

   $link_evoluciongrupo='onclick=ver_formularioenpantalla(\'aplicativos/documental/datos_standargrupoterapia.php\',\'Editar\',\'divBody_ext\',\''.$asigm_id.'\',\'69\',0,0,0,0,0)';     
   if($nombre_data)
   {
     $nombre_data='<div '.$link_evoluciongrupo.' ><img src="images/evolucion.png" width="30" height="30" /></div>'.$nombre_data;   
   }
   
    return $nombre_data;
}

function bevolucion_general($fecha,$hora,$DB_gogess)
{
   //$
   $ndia='';
   $fechats = strtotime($fecha);
   $nombre_data='';
   
   switch (date('w', $fechats)){
    case 0: $ndia="DOMINGO"; break;
    case 1: $ndia="LUNES"; break;
    case 2: $ndia="MARTES"; break;
    case 3: $ndia="MIERCOLES"; break;
    case 4: $ndia="JUEVES"; break;
    case 5: $ndia="VIERNES"; break;
    case 6: $ndia="SABADO"; break;
   }
   
   $nombre_data='';
   $busca_evaluacion="select * from faesa_evaluacionasigahorario where asighor_fecha='".$fecha."' and asighor_hora='".$hora."'";
   	 
   $rs_eceva= $DB_gogess->executec($busca_evaluacion,array());
   
   if($rs_eceva)
   {
	   while (!$rs_eceva->EOF) {
	   
	    //$nombre_data='<span style="color:#ABC9E0" ><b>EVALUACION INTEGRAL </b></span>';
		$busca_clieter="select * from app_cliente where clie_id='".$rs_eceva->fields["clie_id"]."'";
        $rs_bclieter = $DB_gogess->executec($busca_clieter,array());
		
		$nombre_p='';
        $nombre_p=$rs_bclieter->fields["clie_nombre"]." ".$rs_bclieter->fields["clie_apellido"];
		
		$link_paciente='onclick="ver_formularioenpantalla(\'aplicativos/documental/datos_pacientes.php\',\'Editar\',\'divBody_ext\',\''.$rs_eceva->fields["clie_id"].'\',\'25\',0,0,0,0,99)" ';
		
		$nombre_data.='<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td style="background-color:#CCCCCC" '.$link_paciente.' ><center><span style="color:#5B79B0" ><b>EVALUACION<br>'.utf8_encode($nombre_p).'</span></center></td>
			  </tr>
		 </table>';
	   

	   
	   $rs_eceva->MoveNext();
	   }
   }
   
   return $nombre_data;
}


//busca evaluacion

function bevolucion($usua_id,$fecha,$hora,$DB_gogess)
{
   //$
   $ndia='';
   $fechats = strtotime($fecha);
   $nombre_data='';
   
   switch (date('w', $fechats)){
    case 0: $ndia="DOMINGO"; break;
    case 1: $ndia="LUNES"; break;
    case 2: $ndia="MARTES"; break;
    case 3: $ndia="MIERCOLES"; break;
    case 4: $ndia="JUEVES"; break;
    case 5: $ndia="VIERNES"; break;
    case 6: $ndia="SABADO"; break;
   }
   
   $nombre_data='';
   $busca_evaluacion="select * from faesa_evaluacionasigahorario where usua_idmedi='".$usua_id."' and asighor_fecha='".$fecha."' and asighor_hora='".$hora."'";
   	 
   $rs_eceva= $DB_gogess->executec($busca_evaluacion,array());
   
   if($rs_eceva)
   {
	   while (!$rs_eceva->EOF) {
	   
	    //$nombre_data='<span style="color:#ABC9E0" ><b>EVALUACION INTEGRAL </b></span>';
		$busca_clieter="select * from app_cliente where clie_id='".$rs_eceva->fields["clie_id"]."'";
        $rs_bclieter = $DB_gogess->executec($busca_clieter,array());
		
		$nombre_p='';
        $nombre_p=$rs_bclieter->fields["clie_nombre"]." ".$rs_bclieter->fields["clie_apellido"];
		
		$link_paciente='onclick="ver_formularioenpantalla(\'aplicativos/documental/datos_pacientes.php\',\'Editar\',\'divBody_ext\',\''.$rs_eceva->fields["clie_id"].'\',\'25\',0,0,0,0,99)" ';
		
		$nombre_data.='<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td style="background-color:#CCCCCC" '.$link_paciente.' ><center><span style="color:#5B79B0" ><b>EVALUACION<br>'.utf8_encode($nombre_p).'</span></center></td>
			  </tr>
		 </table>';
	   

	   
	   $rs_eceva->MoveNext();
	   }
   }
   
   return $nombre_data;
}

?>
<center>
<table width="100%" border="1" cellpadding="5" cellspacing="0" >
  <tr>
    <td style="padding-top:6px; padding-bottom:6px; padding-left:6px; padding-right:6px;font-size:10px" >Horario</td> 
	<?php
	$lista_personal="select * from app_usuario where usua_estado=1 and especi_id not in (5,6,0) and usua_id!=74";
	$rs_personal= $DB_gogess->executec($lista_personal,array());
	if($rs_personal)
    {
	   while (!$rs_personal->EOF) {
	   
	   $nombre_uno='';
	   $nombre_uno=explode(" ",$rs_personal->fields["usua_nombre"]);
	   
	   $nombre_dos='';
	   $nombre_dos=explode(" ",$rs_personal->fields["usua_apellido"]);
	   
	   echo '<td style="padding-top:6px; padding-bottom:6px; padding-left:6px; padding-right:6px;font-size:9px" >'.utf8_encode($nombre_uno[0]).'<br>'.utf8_encode($nombre_dos[0]).'</td>';
	   
	   
	   
	   $rs_personal->MoveNext();
	   }
	 }  
	?>
	
  </tr>
  <?php
  $concaten_h='';
  $slq_horext="select distinct horac_horai from cereni_pacientemateria inner join cereni_asignamaterias on cereni_pacientemateria.asigm_id=cereni_asignamaterias.asigm_id inner join cereni_horario on cereni_pacientemateria.horac_id=cereni_horario.horac_id";
  $rs_hoext= $DB_gogess->executec($slq_horext,array());
  if($rs_hoext)
    {
	   while (!$rs_hoext->EOF) {
	   
	     $concaten_h.=$rs_hoext->fields["horac_horai"].",";
	   
	    $rs_hoext->MoveNext();
	   }
	}   
  
  $concaten_h=substr($concaten_h,0,-1);
  $obj_util->horassueltas=$concaten_h;
  $arreglo_horas=array();
  $arreglo_horas=$obj_util->genera_arrayhora($hora_ini,$rango_hora,$hora_fin);
  for($hi=0;$hi<count($arreglo_horas);$hi++)
		{	
		
		
  ?>		   
    <tr>
     <td style='padding-top:5px; padding-bottom:5px; padding-left:5px; padding-right:5px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold'   >
	       <?php  echo $arreglo_horas[$hi]; ?>
	 </td> 
	 
	 <?php
	$lista_personal="select * from app_usuario where usua_estado=1 and especi_id not in (5,6,0) and usua_id!=74";
	$rs_personal= $DB_gogess->executec($lista_personal,array());
	if($rs_personal)
    {
	   while (!$rs_personal->EOF) {
	   
	   $lista_buscat="select terap_id,atenc_hc,especi_id,faesa_terapiasregistro.usua_id,faesa_terapiasregistro.clie_id,terap_fecha,terap_hora,terap_autorizacion,terap_estado,terap_fechapago,terap_nfactura,faesa_terapiasregistro.centro_id,faesa_terapiasregistro.usuar_id,terap_fecharegistro,terap_recuperacion,terap_observacion,terap_tipoevatera,tipopac_id,clie_nombre,clie_apellido,terap_asiste,terap_motivo from  faesa_terapiasregistro left join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where faesa_terapiasregistro.usua_id=".$rs_personal->fields["usua_id"]." and terap_fecha='".$fecha_valor."' and terap_hora='".$arreglo_horas[$hi]."' and terap_cancelado=0";
	   
	   echo '<td style="padding-top:6px; padding-bottom:6px; padding-left:6px; padding-right:6px;font-size:9px" width="280px" >';
	   
	   $rs_lbuscat = $DB_gogess->executec($lista_buscat,array());
					 if($rs_lbuscat)
					 {
						  while (!$rs_lbuscat->EOF) {
						  
						     $paciente_data='';
							 $alerta='';
							 
							$nombre_dato=array();
							$nombre_dato=explode(" ",$rs_lbuscat->fields["clie_nombre"]);
							
							$apellido_dato=array();
							$apellido_dato=explode(" ",$rs_lbuscat->fields["clie_apellido"]);	
							
							$terap_motivo='';
							 if($rs_lbuscat->fields["terap_motivo"])
							 {
							   $terap_motivo='('.$rs_lbuscat->fields["terap_motivo"].')';
							 }
							
							$check_asistencia='';
							
							if($_SESSION['ces1313777_sessid_inicio']==$rs_lbuscat->fields["usua_id"])
							 {
							  $function_tomaasi='activar_asis("'.$rs_lbuscat->fields["terap_id"].'")';						  
							  if($rs_lbuscat->fields["terap_asiste"]==1)
							  {
							  $check_asistencia='<input onclick='.$function_tomaasi.' name="asistencia_id'.$rs_lbuscat->fields["terap_id"].'" type="checkbox" id="asistencia_id'.$rs_lbuscat->fields["terap_id"].'" value="1" checked="checked" />';
							  }
							  else
							  {
							  $check_asistencia='<input onclick='.$function_tomaasi.' name="asistencia_id'.$rs_lbuscat->fields["terap_id"].'" type="checkbox" id="asistencia_id'.$rs_lbuscat->fields["terap_id"].'" value="1" />';							  
							  }
							  
							 }
							 else
							 {
							    if($_SESSION['ces1313777_usua_adm']==1)
								{
								
								      $function_tomaasi='activar_asis("'.$rs_lbuscat->fields["terap_id"].'")';						  
									  if($rs_lbuscat->fields["terap_asiste"]==1)
									  {
									  $check_asistencia='<input onclick='.$function_tomaasi.' name="asistencia_id'.$rs_lbuscat->fields["terap_id"].'" type="checkbox" id="asistencia_id'.$rs_lbuscat->fields["terap_id"].'" value="1" checked="checked" />';
									  }
									  else
									  {
									  $check_asistencia='<input onclick='.$function_tomaasi.' name="asistencia_id'.$rs_lbuscat->fields["terap_id"].'" type="checkbox" id="asistencia_id'.$rs_lbuscat->fields["terap_id"].'" value="1" />';							  
									  }
								
								}
							 
							 
							 }
							 
							 
						     $paciente_data=ucwords(strtolower(utf8_encode($rs_lbuscat->fields["clie_nombre"]." ".$rs_lbuscat->fields["clie_apellido"]))).$alerta;						  
						     $busca_medico="select * from app_usuario where usua_id='".$rs_lbuscat->fields["usua_id"]."'";
						     $rs_bmedico = $DB_gogess->executec($busca_medico,array());						  
						      echo '<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
									  <tr>
										<td style="background-color:#E1EFF4" ><center><span style="color:#000000" ><b>'.$paciente_data.$terap_motivo.' /</b></span></center></td><td style="background-color:#E1EFF4">'.$check_asistencia.'</td>
									  </tr>
								 </table>';
						  
						  
					         $rs_lbuscat->MoveNext();
						  }
					 
					 }	
					 
		 echo bevolucion($rs_personal->fields["usua_id"],$fecha_valor,$arreglo_horas[$hi],$DB_gogess);	
		 //echo $fecha_valor."<br>";		 
		 $ndia_valor=date('N',strtotime($fecha_valor));		
		 if($ndia_valor<6)
		 {  
		 echo horario_maniana($rs_personal->fields["usua_id"],$ndia_valor,$arreglo_horas[$hi],$fecha_valor,$DB_gogess);
         }
	   
	   echo '</td>';	   
	   
	   
	   $rs_personal->MoveNext();
	   }
	 }  
	?>
	 
	 
   </tr> 
  <?php
        }
   ?>
</table>   
</center>  

<div id="actu_asistencia"></div>
<div id="divBody_obs"></div>

<script type="text/javascript">
<!--
function activar_asis(terap_id)
{
  
  $("#actu_asistencia").load("aplicativos/documental/opciones/panel/calendarioseguros/aplicar_asistencia.php",{   

	 terap_id:terap_id,
	 estado:$('#asistencia_id'+terap_id).prop('checked')
	 

  },function(result){  

 

  });  

  $("#actu_asistencia").html("Espere un momento...");  
  
  
 
}

function activar_asisgrupo(asigm_id,clie_id,centro_id,usua_id,asig_fecha)
{
  
  $("#actu_asistencia").load("aplicativos/documental/opciones/panel/calendarioseguros/aplicar_asistenciagrupo.php",{   

	 asigm_id:asigm_id,
	 clie_id:clie_id,
	 centro_id:centro_id,
	 usua_id:usua_id,
	 asig_fecha:asig_fecha,
	 estado:$('#asisgrupo_id'+asigm_id+clie_id+centro_id+usua_id).prop('checked') 

  },function(result){  

  });  

  $("#actu_asistencia").html("Espere un momento...");   
 
}

//  End -->
</script> 

<?php
}
else
{
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado, ingrese su usuario y clave y vuelva a seleccionar la opci&oacute;n</div>';
//enviar
//$varable_enviafunc=base64_encode("desplegar_grid_atencion();");
$varable_enviafunc='';
//enviar
echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession"></div>
';


}
?>