<?php

ini_set('display_errors',0);

error_reporting(E_ALL);

ini_set("session.cookie_lifetime","4600000");

ini_set("session.gc_maxlifetime","4600000");

session_start();

$director="../director/";

include ("../director/cfgclases/clases.php");

//Obtener dias festivos para deshabilitar en calendario
$query = <<<QUERY
    SELECT fecha FROM clinica_diasfestivos WHERE activo = 1 
QUERY;
$rsDiasFest = $DB_gogess->Execute($query);
$fechasNot = [];
while(!$rsDiasFest->EOF){
    $fechasNot[] = $rsDiasFest->fields["fecha"];
    $rsDiasFest->MoveNext();
}
$fechasNotJSON = json_encode($fechasNot);

$centro_id=$_REQUEST["centro_id"];
//echo $_REQUEST["esp"];
?>

<p>&nbsp;</p>
<div>
    <input type="hidden" id="datesNot" value='<?php echo $fechasNotJSON; ?>'/>
    <input type="hidden" id="globalCalendarH"/>
    <table>
        <tr>
            <td align="center"><b>Seleccione la fecha que desea agendar</b></td>
            <td rowspan="2" valign="top">
                <b>Seleccione el tipo de paciente:</b>
                <select name="clie_tpedad" id="clie_tpedad" class="form-control"  >
                    <option value="0" selected="selected">----</option>
                    <option value="1">Adulto</option>
                    <option value="2">Menor de Edad</option>
                </select>
                <b>Ingrese el n&uacute;mero de c&eacute;dula del paciente:</b>
                <input class="form-control" type="text" maxlength="10" id="ncedula" name="ncedula" value=""/>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <div class="lstDispAgendar" style="margin-left: 1em;">
                    
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="agendaCalendar"></div>
            </td>
        </tr>
    </table>
</div>


<script>
    //make an array of disable dates
    var datesNot = JSON.parse(document.querySelector("#datesNot").value); //["19/05/2022", "21/05/2022", "24/05/2022"];
    //console.log(" datesNot ", datesNot);
    let gCalendar = $("#agendaCalendar"),
    dateToday = new Date();
    
    gCalendar.datepicker({
        //buttonImage: "@/assets/calendar.png",
        //buttonImageOnly: true,
        //buttonText: "Choose",
        
        dateFormat: "dd/mm/yy",
        showWeek: true,
        changeYear: true,
        changeMonth: true,
        //showButtonPanel: true,
        altField: "#globalCalendarH",
        beforeShowDay: disableDates,
        minDate: dateToday,
        maxDate: "+90d", //3 meses
        //defaultDate: new Date(),
        //maxDate: '0'
    });
    
    function disableDates(date){
        if (date.getDay() === 0)  /* Sunday */
            return [ false, "closed", "Cerrado en Domingo" ]
        else {
            if(datesNot.length > 0){
                var string = $.datepicker.formatDate('yy-mm-dd', date);
                return [datesNot.indexOf(string) == -1];
            } else return [ true, "", "" ]
        }
    }
        
    gCalendar.on("change",function(){
        var date = $(this).datepicker('getDate');
        var dayOfWeek = date.getUTCDay();
    
        $(".lstDispAgendar").load("./listCentroXEsp.php?centro_id=<?php echo $centro_id; ?>&esp=<?php echo $_REQUEST["esp"]?>&date="+$(this).val() + "&dow="+dayOfWeek);
    });
    
    function changeAgenda(){
        var date = gCalendar.datepicker('getDate');
        var dayOfWeek = date.getUTCDay();
        
        $(".lstDispAgendar").load("./listCentroXEsp.php?centro_id=<?php echo $centro_id; ?>&esp=<?php echo $_REQUEST["esp"]?>&date="+gCalendar.val() + "&dow="+dayOfWeek);
    }
    changeAgenda();
</script>

<style>
    div.ui-datepicker {
        font-size: 200.0%;
    }
</style>