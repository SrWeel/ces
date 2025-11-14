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

$obj_funciones=new util_funciones();

if($_SESSION['ces1313777_sessid_inicio'])
{

$usua_id=$_POST["usua_id"];
$obtiene_anios="select * from app_usuario inner join grid_infolaboral3 on app_usuario.clie_enlace=grid_infolaboral3.standar_enlace where app_usuario.usua_id='".$usua_id."' order by info_id desc limit 1";
$rs_anios=$DB_gogess->executec($obtiene_anios,array());

$info_fechaingreso=$rs_anios->fields["info_fechaingreso"];
$fecha_hoy=date("Y-m-d");

$info_regimenlaboral=$rs_anios->fields["info_regimenlaboral"];

$anio_mes=array();
$anio_mes["anio"]='';
$anio_mes["mes"]='';

if($info_fechaingreso)
{
$anio_mes=$obj_funciones->calcular_tiempoaniomes($info_fechaingreso,$fecha_hoy);

$fechainicial = new DateTime($info_fechaingreso);
$fechafinal = new DateTime($fecha_hoy);
$diferencia = $fechainicial->diff($fechafinal);
$meses_cl = ( $diferencia->y * 12 ) + $diferencia->m;

}

$busca_politica="select * from faesa_politicasasistencia where centro_id=1 order by polasis_id desc limit 1";
$rs_politica = $DB_gogess->executec($busca_politica,array());

?>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td bgcolor="#BFDCE3"><strong>Fecha de Ingreso </strong></td>
    <td bgcolor="#BFDCE3"><strong>A&ntilde;os </strong></td>
    <td bgcolor="#BFDCE3"><strong>Dias Vacaciones </strong></td>
  </tr>
  <tr>
    <td bgcolor="#E8F2F7"><?php echo $info_fechaingreso; ?></td>
    <td bgcolor="#E8F2F7"><?php  echo $anio_mes["anio"]." a&ntilde;os ".$anio_mes["mes"]." meses"; ?></td>
    <td bgcolor="#E8F2F7"><?php
	// 1 LOSEP
	// 2 CODIGO DE TRABAJO
	$obtiene_vaca="select sum(vactoma_dias) as totalvaca from conco_vacacionestomadas where usua_id='".$usua_id."'";
    $rs_vaca=$DB_gogess->executec($obtiene_vaca,array());
	$totalvaca=0;
	$totalvaca=$rs_vaca->fields["totalvaca"];
	
	//========================================
	$obtiene_vacaper="select sum(permi_dias) as totalvacapermi from faesa_permisos where tipervaca_id=1 and usua_id='".$usua_id."'";
    $rs_vacaper=$DB_gogess->executec($obtiene_vacaper,array());
	$totalvacaper=0;
	$totalvacaper=$rs_vacaper->fields["totalvacapermi"];
	
	
	if($info_regimenlaboral==1)
	{
		
	$anios_paravaca=$rs_politica->fields["polasis_tiempominimovacalosep"];
	$polasis_alcumplirelanio=$rs_politica->fields["polasis_alcumplirelaniolosep"];
	$polasis_anioaumentauno=$rs_politica->fields["polasis_anioaumentaunolosep"];
	$polasis_maximoacumulalosep=$rs_politica->fields["polasis_maximoacumulalosep"];
		
		
	$dias_vacaciones=0;
	if($meses_cl>=$anios_paravaca)
	{
	   $dias_vacaciones=$polasis_alcumplirelanio;
	}
	$numero_aumenta=0;	
	//echo $anio_mes["anio"]."<br>";
	//echo $meses_cl."<br>";
	//echo $anios_paravaca."<br>";
	if($meses_cl>=$anios_paravaca)
	{
	    $numero_aumenta=$anio_mes["anio"]-1;
	}
	//echo $numero_aumenta."<br>";
	//echo $dias_vacaciones+$numero_aumenta;
	
	$dias_vacacionest=$dias_vacaciones+($dias_vacaciones*$numero_aumenta);
	
		if($dias_vacacionest>$polasis_maximoacumulalosep)
		{
			  $dias_vacacionest=$polasis_maximoacumulalosep;
		}
	
	if($totalvaca>0)
	{
		 $dias_vacacionest=$dias_vacacionest-$totalvaca;
	}
	
	if($totalvacaper>0)
	{
		$dias_vacacionest=$dias_vacacionest-$totalvacaper;
		
	}
	
      echo $dias_vacacionest;	
		
	}
	
	if($info_regimenlaboral==2)
	{
	
	$anios_paravaca=$rs_politica->fields["polasis_tiempominimovaca"];
	$polasis_alcumplirelanio=$rs_politica->fields["polasis_alcumplirelanio"];
	$polasis_anioaumentauno=$rs_politica->fields["polasis_anioaumentauno"];
		
	$dias_vacaciones=0;
	//echo $meses_cl."<br>";
	//echo $anios_paravaca."<br>";
	if($meses_cl>=$anios_paravaca)
	{
	   $dias_vacaciones=$polasis_alcumplirelanio;
	}
	$numero_aumenta=0;	
	//echo $anio_mes["anio"]."<br>";
	//echo $polasis_anioaumentauno."<br>";
	if($meses_cl>=$polasis_anioaumentauno)
	{
	    $numero_aumenta=$anio_mes["anio"]-1;
	}
	
	//echo "Aumento:".$numero_aumenta."<br>";
	//echo $dias_vacaciones+$numero_aumenta;
	//echo $anio_mes["anio"]."<br>";
	$numan=$anio_mes["anio"]*1;
	$dias_vacacionest=0;
	//$cuenta_ext=0;
	for($i=1;$i<=$numan;$i++)
	{	 
		 if($i<=5)
		  {
			 $dias_vacacionest=$dias_vacacionest+15; 
			  
		  }
		  else
		  {
			  $cuenta_ext++;
			  $dias_vacacionest=$dias_vacacionest+15+$cuenta_ext;
			  
		  }
		 //echo $dias_vacacionest."<br>";
	}
	
	
	
	if($totalvaca>0)
	{
		 $dias_vacacionest=$dias_vacacionest-$totalvaca;
	}
	
	if($totalvacaper>0)
	{
		$dias_vacacionest=$dias_vacacionest-$totalvacaper;
		
	}
	
	echo $dias_vacacionest;
	
	}

	?></td>
  </tr>
</table>
<br />


<?php
}
?>

