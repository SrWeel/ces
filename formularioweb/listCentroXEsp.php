<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","4600000");
ini_set("session.gc_maxlifetime","4600000");
date_default_timezone_set("America/Guayaquil");
session_start();

$director="../director/";

include ("../director/cfgclases/clases.php");

$dateSelected = $_REQUEST["date"];
$daySelected = $_REQUEST["dow"];
$daySelectedF = $daySelected == 0 ? 7 : $daySelected;

        
$query = <<<QUERY
    select UE.usua_enlace, APPU.usua_id, APPU.usua_nombre, APPU.usua_apellido, APPU.usua_piefirma, CS.centro_nombre, CS.centro_direccion,CH.horario_hora, CH.horario_horafin, CS.centro_id 
	from app_usuario APPU inner join dns_gridfuncionprofesional UE on APPU.usua_enlace=UE.usua_enlace
	INNER JOIN dns_centrosalud CS ON CS.centro_id = APPU.centro_id 
	INNER JOIN clinica_horarios CH ON CH.usua_id = APPU.usua_id AND CH.dia_id = '{$daySelectedF}' 
	WHERE UE.prof_id = '{$_REQUEST["esp"]}' AND UE.grdifun_activo = 1 and horario_centro='{$_REQUEST["centro_id"]}'
QUERY;
$rsDisp = $DB_gogess->Execute($query);


//Calcular intervalos de atencion
function calcAtencion($dateSelected, $HIni, $HFin, $Intervalo, $RecesoIni, $RecesoFin, $opts, $DB_gogess){
    //$var1 = '08:00';
    //$var2 = '16:00';
    //$intervarlo = '15';

    $fechaInicio = new DateTime($HIni);
    $fechaFinInicio = new DateTime($RecesoIni);
    
    $fechaInicioFin = new DateTime($RecesoFin);
    $fechaFin = new DateTime($HFin);
    //$fechaFin = new DateTime("20:00");
    //$fechaFin = $fechaFin->modify( "+{$intervarlo} minutes" ); 
    
    if($fechaInicio > $fechaInicioFin){
        $fechaInicioFin = $fechaInicio;
    }

    $rangoFechasIni = new DatePeriod($fechaInicio, new DateInterval("PT{$Intervalo}M"), $fechaFinInicio);
    $rangoFechasFin = new DatePeriod($fechaInicioFin, new DateInterval("PT{$Intervalo}M"), $fechaFin);
    //echo "date current: ";
    //print_r(date("d/m/Y H:i:s"));
    //print_r($fechaInicio);
    
    
    
    $lstBtnAgendaRes = "";
    //1era jornada
    foreach($rangoFechasIni as $fecha){
        $dateSelectedQ = date("Y-m-d", strtotime(str_replace("/","-",$dateSelected))); 
        $detectHorasOcupadas = <<<QUERY
            SELECT terap_id FROM faesa_terapiasregistro
            WHERE especi_id = '{$opts["espID"]}'
            AND usua_id = '{$opts["profID"]}'
            AND terap_fecha = '{$dateSelectedQ}'
            AND terap_hora LIKE '{$fecha->format("H:i")}%'
            AND centro_id = '{$opts["centroID"]}'
        QUERY;
        $rsQ = $DB_gogess->Execute($detectHorasOcupadas);
        if($rsQ->EOF){
            $lstBtnAgendaRes .= <<<INTERVALO
                <button 
                    class="btn btn-primary" 
                    onclick="verif_datos('{$dateSelected}','{$fecha->format("H:i")}','{$opts["centroID"]}','{$opts["profID"]}','{$opts["espID"]}')">{$fecha->format("H:i")}
                </button>
            INTERVALO;
        } else {
            $lstBtnAgendaRes .= <<<INTERVALO
                <button 
                    class="btn btn-primary" disabled>{$fecha->format("H:i")}
                </button>
            INTERVALO;
        }
        
        //if($fecha->format("H:i")!=$RecesoIni){
            
        //}
    }
    //2da jornada
    foreach($rangoFechasFin as $fecha){
        $dateSelectedQ = date("Y-m-d", strtotime(str_replace("/","-",$dateSelected))); 
        $detectHorasOcupadas = <<<QUERY
            SELECT terap_id FROM faesa_terapiasregistro
            WHERE especi_id = '{$opts["espID"]}'
            AND usua_id = '{$opts["profID"]}'
            AND terap_fecha = '{$dateSelectedQ}'
            AND terap_hora LIKE '{$fecha->format("H:i")}%'
            AND centro_id = '{$opts["centroID"]}'
        QUERY;
        $rsQ = $DB_gogess->Execute($detectHorasOcupadas);
        if($rsQ->EOF){
            $lstBtnAgendaRes .= <<<INTERVALO
                <button 
                    class="btn btn-primary" 
                    onclick="verif_datos('{$dateSelected}','{$fecha->format("H:i")}','{$opts["centroID"]}','{$opts["profID"]}','{$opts["espID"]}')">{$fecha->format("H:i")}
                </button>
            INTERVALO;
        } else {
            $lstBtnAgendaRes .= <<<INTERVALO
                <button 
                    class="btn btn-primary" disabled>{$fecha->format("H:i")}
                </button>
            INTERVALO;
        }
    }
    return $lstBtnAgendaRes;
}
//echo "..." . $_REQUEST["esp"]; 
?>
<table style="font-size: 0.8em;">
    <thead>
        <tr style="background: #EEE; border-bottom: 1px solid #000;">
            <th colspan="5" align="center"><h4>Horarios y disponibilidad</h4></th>
        </tr>
        <tr style="background: #EEE;">
        <th width="120">Centro M&eacute;dico</th>
        <th width="200">Direcci&oacute;n</th>
        <th width="200">Tratante</th>
        <th width="100">Atenci&oacute;n</th>
        <th>Seleccione un horario para Agendar</th>
    </tr>
    </thead>
    <tbody style="overflow-y: auto; "><?php
        if(!$rsDisp->EOF){
        $cont=0;
        $intervalBetween = 30;
        while(!$rsDisp->EOF){
            $horaIni = $rsDisp->fields["horario_hora"];
            if($dateSelected==date("d/m/Y")){
                $currentTime = time();
                $horaIni = date('H:i',ceil($currentTime / ($intervalBetween * 60)) * ($intervalBetween * 60));
            }
            
            $lstBtnAgenda = calcAtencion($dateSelected, $horaIni, $rsDisp->fields["horario_horafin"], $intervalBetween, "12:00", "12:30", [
                "centroID" => $rsDisp->fields["centro_id"],
                "profID" => $rsDisp->fields["usua_id"],
                "espID" => $_REQUEST["esp"],
            ], $DB_gogess);
            $stiloRow = "#EEE;";
            if($cont % 2 == 0){
                $stiloRow = "#FFF;";
            }
            echo <<<ROW
                <tr style="margin-bottom:1em; background: $stiloRow ">
                    <td>{$rsDisp->fields["centro_nombre"]}</td>
                    <td>{$rsDisp->fields["centro_direccion"]}</td>
                    <td>{$rsDisp->fields["usua_piefirma"]}. {$rsDisp->fields["usua_nombre"]} {$rsDisp->fields["usua_apellido"]}</td>
                    <td>{$rsDisp->fields["horario_hora"]} - {$rsDisp->fields["horario_horafin"]}</td>
                    <td>{$lstBtnAgenda} </br></br></td>
                </tr>
            ROW;
            $cont++;
            $rsDisp->MoveNext();
        }
        } else {
            echo <<<ROW
                <tr style="margin-bottom:1em;">
                    <td colspan="5" align="center">No hay horarios disponibles</td>
                </tr>
            ROW;
        }
    ?>
    </tbody>
</table>

<script>
    function verif_datos($date, $hour, $centroID, $profID, $espID){
        if($('#clie_tpedad').val()==0){
            alert("Por favor seleccione si es Adulto o menor de Edad");
            return false;
        }
        
        if($('#ncedula').val().trim().length==0){
            alert("Por favor digite la cédula del paciente");
            return false;
        }
        
        $("#formulario_id").load("formulario/verifPac.php",
            {
                valor_clie: document.querySelector("#formulario_id").getAttribute("data-id-cli"),
                clie_tpedad:$('#clie_tpedad').val(),
                pDate: $date,
                pHour: $hour,
                pCentroID: $centroID,
                pProfID: $profID,
                pEspID: $espID,
                cedulaPaciente: $('#ncedula').val(),
            },
        function(result){
            let res = JSON.parse(result);

            if(res.action=="registrar"){
                pedir_formulario($date, $hour, $centroID, $profID, $espID,res.cedula);
            } else {
                //agendar y notif
                pedirAgendar($date, $hour, $centroID, $profID, $espID, res.clieID);
            }
        });
        $("#formulario_id").html("<center><img src='carga.gif' width='300' height='250'></center>");
    }
    
    function pedir_formulario($date, $hour, $centroID, $profID,$espID,$ncedula){
	    
        $("#formulario_id").load("formulario/datos_discipulado2.php",{
         valor_clie: document.querySelector("#formulario_id").getAttribute("data-id-cli"),
         clie_tpedad:$('#clie_tpedad').val(),
         pDate: $date,
         pHour: $hour,
         pCentroID: $centroID,
         pProfID: $profID,
         pEspID: $espID,
         cedulaPaciente: $ncedula,
       },function(result){

       });
    }
    
    function pedirAgendar($date, $hour, $centroID, $profID, $espID, $clieID){
        $("#formulario_id").load("formulario/agendar.php",{
         valor_clie: document.querySelector("#formulario_id").getAttribute("data-id-cli"),
         clie_tpedad:$('#clie_tpedad').val(),
         pDate: $date,
         pHour: $hour,
         pCentroID: $centroID,
         pProfID: $profID,
         pEspID: $espID,
         pClieID: $clieID,
         cedulaPaciente: $('#ncedula').val(),
       },function(result){
           
       });
    }
</script>