<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=45540000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

function calcular_edad2($fechan,$fechafin){
$resultado=array();
$separa_anios=array();
$valor_anio=0;
$valor_mes=0;
$fechainicial = new DateTime($fechan);
$fechafinal = new DateTime($fechafin);
$diferencia = $fechainicial->diff($fechafinal);
$meses = ( $diferencia->y * 12 ) + $diferencia->m;

$anios=$meses/12;
$separa_anios=explode(".",$anios);
$valor_anio=@$separa_anios[0];
//echo "0.".@$separa_anios[1];
$valor_mes="0.".@$separa_anios[1];
$valor_rmes=number_format($valor_mes, 3, '.', '')*12;
$valor_mes=round($valor_mes*12);

//-----------------
$recidual_mes1=explode(".",$valor_rmes);
$recidual_mes="0.".@$recidual_mes1[1];
$resultado["semana"]=$recidual_mes*4;
//-----------------

$resultado["anio"]=$valor_anio;
$resultado["mes"]=$valor_mes;

return $resultado;
}
$num_mes=array();

$lista_data='';
$lista_data=str_replace("null","00",@$_POST["clie_fechanacimiento"]);

if(@$_POST["clie_fechanacimiento"]!='null-null-null')
{
	if(@$_POST["clie_fechanacimiento"]!='')
    {
$num_mes=calcular_edad2($lista_data,date("Y-m-d"));
   }
}
echo "Edad: ".@$num_mes["anio"]." a&ntildeos y ".@$num_mes["mes"]." meses";

$valoranio=0;
$valoranio=(@$num_mes["semana"]/52)+@$num_mes["anio"];

		
		$busca_lista="select * from dns_tensionarterial where tarterial_inicioanio<=".$valoranio." and tarterial_finanio>=".$valoranio;
        $rs_obtiene = $DB_gogess->executec($busca_lista,array());
		$valorop=$rs_obtiene->fields["tarterial_id"];
$nvalorop=$rs_obtiene->fields["tarterial_nombre"];
		
//echo $valoranio;
?>
<script>
$('#tarterial_id').val(<?php echo $valorop; ?>);
$('#despliegue_tarterial_id').html("<?php echo $nvalorop; ?>");

</script>