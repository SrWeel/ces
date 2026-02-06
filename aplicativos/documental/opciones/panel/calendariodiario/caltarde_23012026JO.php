<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<style type="text/css">
<!--
input[type=checkbox] {
    transform: scale(2);
    -ms-transform: scale(2);
    -webkit-transform: scale(2);
    padding: 10px;
}
-->
</style>

<?php
if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$obj_util=new util_funciones();
//$obj_agendar=new cls_agendamiento();

$fecha_valor=$_POST["fecha_valor"];

$hora_ini='07:00';
$hora_fin='20:00';


$centro_id=$_SESSION['ces1313777_centro_id'];

function horario_maniana($usua_id,$ndia,$hora,$DB_gogess)
{

  $nombre_data='';
  $busca_hmaniana="select * from cereni_pacientemateria inner join cereni_asignamaterias on cereni_pacientemateria.asigm_id=cereni_asignamaterias.asigm_id inner join cereni_horario on cereni_pacientemateria.horac_id=cereni_horario.horac_id where (horac_horai='".$hora."') and dia_id='".$ndia."' and cereni_asignamaterias.usua_id='".$usua_id."'";
  $rs_hm= $DB_gogess->executec($busca_hmaniana,array());  
  if($rs_hm)
   {
	   while (!$rs_hm->EOF) {
	   
	    $busca_clieter="select * from app_cliente where clie_id='".$rs_hm->fields["clie_id"]."'";
        $rs_bclieter = $DB_gogess->executec($busca_clieter,array());		
		$nombre_p='';
		$nombre_dato=array();
		$nombre_dato=explode(" ",$rs_bclieter->fields["clie_nombre"]);
		
		$apellido_dato=array();
		$apellido_dato=explode(" ",$rs_bclieter->fields["clie_apellido"]);
		
        $nombre_p=$nombre_dato[0]." ".$apellido_dato[0]." | ".$rs_hm->fields["horac_horai"]."-".$rs_hm->fields["horac_horaf"];
		
		$nombre_data.='<table width="100%" height="100%" border="1" cellpadding="0" cellspacing="0">
			  <tr>
				<td  ><center><span style="color:#000000;font-size:8px" ><b>'.utf8_encode($nombre_p).'</span></center></td>
			  </tr>
		 </table>';
  
   
          $rs_hm->MoveNext();
	   }
   }
   
   //=======================================================================================
   
$busca_hmaniana="select * from cereni_pacientemateria inner join cereni_asignamaterias on cereni_pacientemateria.asigm_id=cereni_asignamaterias.asigm_id inner join cereni_horario on cereni_pacientemateria.horac_id=cereni_horario.horac_id where (horac_horai='".$hora."') and dia_id='8' and cereni_asignamaterias.usua_id='".$usua_id."'";
  $rs_hm= $DB_gogess->executec($busca_hmaniana,array());  
  if($rs_hm)
   {
	   while (!$rs_hm->EOF) {
	   
	    $busca_clieter="select * from app_cliente where clie_id='".$rs_hm->fields["clie_id"]."'";
        $rs_bclieter = $DB_gogess->executec($busca_clieter,array());		
		$nombre_p='';        
		
		$nombre_dato=array();
		$nombre_dato=explode(" ",$rs_bclieter->fields["clie_nombre"]);
		
		$apellido_dato=array();
		$apellido_dato=explode(" ",$rs_bclieter->fields["clie_apellido"]);		
        $nombre_p=$nombre_dato[0]." ".$apellido_dato[0]." | ".$rs_hm->fields["horac_horai"]."-".$rs_hm->fields["horac_horaf"];
		
		$nombre_data.='<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td  ><center><span style="color:#000000;font-size:8px" ><b>'.utf8_encode($nombre_p).'/</span></center></td>
			  </tr>
		 </table>';
  
   
          $rs_hm->MoveNext();
	   }
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



//ejecuta agendamiento preconfigurado
$fecha_agendar=$fecha_valor;

//ejecuta agendamiento preconfigurado
?>
    <center>
        <table border="0" cellpadding="8" cellspacing="0" style="background-color:#ffffff; box-shadow:0 4px 12px rgba(0,0,0,0.15); border-radius:12px; overflow:hidden; width:auto;">
            <tr style="background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <td style="padding:15px; font-size:18px; font-weight:bold; color:#ffffff; text-shadow:0 2px 4px rgba(0,0,0,0.3); white-space:nowrap; text-align:center;">Horario</td>
                <?php
                $lista_personal="select * from app_usuario where usua_estado=1 and usua_agenda=1 and usua_id!=74 and usua_id='".$_SESSION['ces1313777_sessid_inicio']."' and centro_id='".$centro_id."'";
                $rs_personal= $DB_gogess->executec($lista_personal,array());
                if($rs_personal)
                {
                    while (!$rs_personal->EOF) {

                        $nombre_uno='';
                        $nombre_uno=explode(" ",$rs_personal->fields["usua_nombre"]);

                        $nombre_dos='';
                        $nombre_dos=explode(" ",$rs_personal->fields["usua_apellido"]);

                        //busca columnas
                        $lista_buscat="select count(*) as totalr from faesa_terapiasregistro left join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where faesa_terapiasregistro.usua_id=".$rs_personal->fields["usua_id"]." and terap_fecha='".$fecha_valor."' and terap_cancelado=0 and terap_hora>='".$hora_ini."'";
                        $rs_buscat= $DB_gogess->executec($lista_buscat,array());
                        //busca columnas

                        //busca especilidad
                        $n_especialidad='';
                        $buespe="select * from app_usuario us inner join dns_gridfuncionprofesional espe on us.usua_enlace=espe.usua_enlace inner join cesdb_arextension.dns_profesion prof on espe.prof_id=prof.prof_id where us.usua_id='".$rs_personal->fields["usua_id"]."' and prof.prof_id not in (38,777,888,911116,77)";
                        $rs_buespe= $DB_gogess->executec($buespe,array());
                        if($rs_buespe)
                        {
                            while (!$rs_buespe->EOF) {

                                $n_especialidad.= $rs_buespe->fields["prof_nombre"]." ";

                                $rs_buespe->MoveNext();
                            }

                        }
                        //busca especialidad


                        // if($rs_buscat->fields["totalr"]>0)
                        // {
                        echo '<td style="padding:15px; font-size:16px; background:linear-gradient(to bottom, #f8f9fa 0%, #e9ecef 100%); border-left:2px solid #dee2e6; white-space:nowrap; text-align:center;"><b style="color:#2c3e50;">'.$rs_personal->fields["usua_nombre"].'<br>'.$nombre_dos[0].'</b><div style="color:#667eea; font-weight:bold; margin-top:5px; font-size:14px;">'.$n_especialidad.'</div></td>';
                        // }


                        $rs_personal->MoveNext();
                    }
                }
                ?>
            </tr>
            <?php
            $arreglo_horas=array();
            $arreglo_horas=$obj_util->genera_arrayhora($hora_ini,$rango_hora,$hora_fin);
            for($hi=0;$hi<count($arreglo_horas);$hi++)
            {

                $bandera=0;
                $lista_personal="select * from app_usuario where usua_estado=1 and usua_agenda=1 and usua_id!=74 and usua_id='".$_SESSION['ces1313777_sessid_inicio']."' and centro_id='".$centro_id."'";
                $rs_personal= $DB_gogess->executec($lista_personal,array());
                if($rs_personal)
                {
                    while (!$rs_personal->EOF) {

                        $lista_buscat="select terap_id,atenc_hc,especi_id,faesa_terapiasregistro.usua_id,faesa_terapiasregistro.clie_id,terap_fecha,terap_hora,terap_autorizacion,terap_estado,terap_fechapago,terap_nfactura,faesa_terapiasregistro.centro_id,faesa_terapiasregistro.usuar_id,terap_fecharegistro,terap_recuperacion,terap_observacion,terap_tipoevatera,tipopac_id,clie_nombre,clie_apellido from  faesa_terapiasregistro left join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where faesa_terapiasregistro.usua_id=".$rs_personal->fields["usua_id"]." and terap_fecha='".$fecha_valor."' and terap_hora='".$arreglo_horas[$hi]."' and terap_cancelado=0";

                        $rs_lbuscat = $DB_gogess->executec($lista_buscat,array());

                        if($rs_lbuscat->fields["terap_id"]>0)
                        {
                            $bandera=1;
                        }

                        $rs_personal->MoveNext();
                    }
                }


                if($bandera==1)
                {
                    ?>
                    <tr>
                        <td style='padding-top:2px; padding-bottom:2px; padding-left:2px; padding-right:2px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold'>
                            <?php echo $arreglo_horas[$hi]; ?>
                        </td>

                        <?php
                        $lista_personal="select * from app_usuario where usua_estado=1 and usua_agenda=1 and usua_id!=74 and usua_id='".$_SESSION['ces1313777_sessid_inicio']."' and centro_id='".$centro_id."'";
                        $rs_personal= $DB_gogess->executec($lista_personal,array());
                        if($rs_personal)
                        {
                            while (!$rs_personal->EOF) {


                                //busca columnas
                                $lista_buscat="select count(*) as totalr from faesa_terapiasregistro left join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where faesa_terapiasregistro.usua_id=".$rs_personal->fields["usua_id"]." and terap_fecha='".$fecha_valor."' and terap_cancelado=0 and terap_hora>='".$hora_ini."'";
                                $rs_buscat= $DB_gogess->executec($lista_buscat,array());
                                //busca columnas

                                // if($rs_buscat->fields["totalr"]>0)
                                // {

                                $lista_buscat="select terap_id,atenc_hc,especi_id,faesa_terapiasregistro.usua_id,faesa_terapiasregistro.clie_id,terap_fecha,terap_hora,terap_autorizacion,terap_estado,terap_fechapago,terap_nfactura,faesa_terapiasregistro.centro_id,faesa_terapiasregistro.usuar_id,terap_fecharegistro,terap_recuperacion,terap_observacion,terap_tipoevatera,tipopac_id,clie_nombre,clie_apellido,terap_motivo,terap_asiste,quiro_id,terap_medicompanies,terap_copago from  faesa_terapiasregistro left join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where faesa_terapiasregistro.usua_id=".$rs_personal->fields["usua_id"]." and terap_fecha='".$fecha_valor."' and terap_hora='".$arreglo_horas[$hi]."' and terap_cancelado=0";

                                echo '<td style="padding:8px; font-size:8px; vertical-align:top; text-align:center;">';

                                $rs_lbuscat = $DB_gogess->executec($lista_buscat,array());
                                if($rs_lbuscat)
                                {
                                    while (!$rs_lbuscat->EOF) {
                                        $paciente_data = '';
                                        $terap_motivo = '';
                                        $n_quirofano = '';
                                        $check_asistencia = '';
                                        $contenido_observacion = '';

                                        // === DETECTAR TURNO EXTRA ===
                                        $observacion = trim($rs_lbuscat->fields["terap_observacion"] ?? '');
                                        $es_turno_extra = false;

                                        if ($observacion !== '') {
                                            if (stripos($observacion, 'TURNO EXTRA') !== false) {
                                                $es_turno_extra = true;
                                            }
                                        }

                                        // === NOMBRE DEL PACIENTE ===
                                        $nombre = trim($rs_lbuscat->fields["clie_nombre"] ?? '');
                                        $apellido = trim($rs_lbuscat->fields["clie_apellido"] ?? '');
                                        $primer_apellido = explode(" ", $apellido)[0] ?? '';
                                        $paciente_data = htmlspecialchars($nombre . " " . $primer_apellido, ENT_QUOTES, 'UTF-8');

                                        // === MOTIVO ===
                                        if (!empty($rs_lbuscat->fields["terap_motivo"])) {
                                            $terap_motivo = '<span style="color:#0033CC"> (' . htmlspecialchars($rs_lbuscat->fields["terap_motivo"]) . ')</span>';
                                        }

                                        // === QUIROFANO ===
                                        if (!empty($rs_lbuscat->fields["quiro_id"])) {
                                            $busca_quirofano = "SELECT quiro_nombre FROM lospinos_quirofanos WHERE quiro_id = ?";
                                            $rs_quiro = $DB_gogess->executec($busca_quirofano, [$rs_lbuscat->fields["quiro_id"]]);
                                            if ($rs_quiro && !$rs_quiro->EOF) {
                                                $n_quirofano = "<br>" . htmlspecialchars($rs_quiro->fields["quiro_nombre"]);
                                            }
                                        }

                                        // === ASISTENCIA ===
                                        $function_tomaasi = 'activar_asis("' . $rs_lbuscat->fields["terap_id"] . '")';
                                        $checked = ($rs_lbuscat->fields["terap_asiste"] == 1) ? ' checked' : '';
                                        $check_asistencia = '<input type="checkbox" onclick="' . $function_tomaasi . '" name="asistencia_id' . $rs_lbuscat->fields["terap_id"] . '" id="asistencia_id' . $rs_lbuscat->fields["terap_id"] . '" value="1"' . $checked . ' />';

                                        // === ENLACES ===
                                        $link_alerta = 'onclick="abrir_standar(\'aplicativos/documental/opciones/panel/calendariodiario/obs.php\',\'OBSERVACION\',\'divBody_obs\',\'divDialog_obs\',400,250,\'' . $rs_lbuscat->fields["terap_id"] . '\',0,0,0,0,0,0);" style="cursor:pointer"';
                                        $link_datosperson = 'onclick="ver_formularioenpantalla(\'aplicativos/documental/datos_pacientes.php\',\'Editar\',\'divBody_ext\',\'' . $rs_lbuscat->fields["clie_id"] . '\',\'25\',0,0,0,0,1);" style="cursor:pointer"';

                                        // === PREPARAR CONTENIDO DE OBSERVACIÓN ===
                                        $link_obs_modal = 'onclick="abrir_standar(\'aplicativos/documental/opciones/panel/calendariodiario/obs.php\',\'OBSERVACION\',\'divBody_obs\',\'divDialog_obs\',400,250,\'' . $rs_lbuscat->fields["terap_id"] . '\',0,0,0,0,0,0);" style="cursor:pointer"';

                                        if ($es_turno_extra) {
                                            $contenido_observacion = '<img src="extra.jpg" width="70" height="70" title="TURNO EXTRA " style="display:block; margin:0; transition:transform 0.2s ease;" ' . ' onmouseover="this.style.transform=\'scale(1.1)\'" onmouseout="this.style.transform=\'scale(1)\'" />';
                                        } else {
                                            $contenido_observacion = '<div '  . ' style="transition:color 0.2s ease; font-size:18px;" >' . nl2br(htmlspecialchars($observacion)) . '</div>';
                                        }

                                        // === MOSTRAR EN FORMATO DE COLUMNAS ===
                                        echo '<div style="display:flex; align-items:stretch; border:2px solid #2c3e50; margin:3px 0; border-radius:6px; overflow:hidden; box-shadow:0 2px 4px rgba(0,0,0,0.1); width:100%;">
                   <!-- Columna 1: Ícono alerta -->
                   <div ' . $link_alerta . ' style="flex:1; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-right:2px solid #2c3e50; cursor:pointer; transition:transform 0.2s ease; padding:12px; min-height:80px;" onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'scale(1)\'">
                       <img src="images/alertaasistencia.png" width="60" height="60" style="filter:drop-shadow(0 2px 3px rgba(0,0,0,0.3));" />
                   </div>
                   
                   <!-- Columna 2: Paciente + Motivo + Quirófano -->
                   <div style="flex:2; background:linear-gradient(to bottom, #E1EFF4 0%, #d4e8f0 100%); padding:12px 15px; display:flex; align-items:center; justify-content:center; border-right:2px solid #2c3e50;">
                       <div style="text-align:center; font-size:17px; line-height:1.5;"><b style="color:#2c3e50; text-shadow:0 1px 2px rgba(255,255,255,0.8);">' . $paciente_data . $terap_motivo . $n_quirofano . '</b></div>
                   </div>
                   
                   <!-- Columna 3: Observación o imagen TURNO EXTRA -->
                   <div style="flex:1.5; background:linear-gradient(to bottom, #FFF8DC 0%, #ffeeb8 100%); padding:12px 15px; display:flex; align-items:center; justify-content:center; border-right:2px solid #2c3e50; text-align:center; font-weight:800; color:#8b6914;">
                       ' . $contenido_observacion . '
                   </div>
                   
                   <!-- Columna 4: Ícono persona -->
                   <div ' . $link_datosperson . ' style="flex:1; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-right:2px solid #2c3e50; cursor:pointer; transition:transform 0.2s ease; padding:12px;" onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'scale(1)\'">
                       <img src="images/person2.png" width="60" height="60" style="filter:drop-shadow(0 2px 3px rgba(0,0,0,0.3));" />
                   </div>
                   
                   <!-- Columna 5: Asistencia -->
                   <div style="flex:1; background:linear-gradient(to bottom, #a8e6cf 0%, #88d8b0 100%); display:flex; flex-direction:column; align-items:center; justify-content:center; font-size:13px; font-weight:bold; color:#2c5530; padding:12px 15px;">
                       <div style="margin-bottom:8px; text-shadow:0 1px 2px rgba(255,255,255,0.8);">ATENDIDO:</div>
                       <div style="transform:scale(1.6);">' . $check_asistencia . '</div>
                   </div>
               </div>';

                                        $rs_lbuscat->MoveNext();
                                    }
                                }

                                echo bevolucion($rs_personal->fields["usua_id"],$fecha_valor,$arreglo_horas[$hi],$DB_gogess);
                                $ndia_valor=date('N',strtotime($fecha_valor));
                                echo horario_maniana($rs_personal->fields["usua_id"],$ndia_valor,$arreglo_horas[$hi],$DB_gogess);

                                echo '</td>';

                                $rs_personal->MoveNext();
                            }
                        }
                        ?>
                    </tr>
                    <?php
                }
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
  
  $("#actu_asistencia").load("aplicativos/documental/opciones/panel/calendariodiario/aplicar_asistencia.php",{   

	 terap_id:terap_id,
	 estado:$('#asistencia_id'+terap_id).prop('checked')
	 

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