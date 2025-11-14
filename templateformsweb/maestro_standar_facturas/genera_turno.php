<?php
$tiempossss=4440000000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$doccab_identificacionpaciente=$_POST["doccab_identificacionpaciente"];
$doccab_id=$_POST["doccab_id"];
$centro_id=$_POST["centro_id"];
$tipo_doc=$_POST["tipo_doc"];


if($_SESSION['ces1313777_sessid_inicio'])
{

//busca medico facturado

$array_lista=array();
$cuenta=0;

$lista_espe="select distinct usuaat_id,dns_especialidad.especi_id from beko_documentodetalle inner join cesdb_arextension.dns_profesion profe on beko_documentodetalle.prof_id=profe.prof_id inner join dns_especialidad on dns_especialidad.especi_id=profe.especienc_id where doccab_id='".$doccab_id."'";
$rs_espe = $DB_gogess->executec($lista_espe);

if($rs_espe)
{
   while (!$rs_espe->EOF) {
   
	   $array_lista[$cuenta]["usuaat_id"]=$rs_espe->fields["usuaat_id"];
	   $array_lista[$cuenta]["especi_id"]=$rs_espe->fields["especi_id"];
	   $cuenta++;
	   
	   $rs_espe->MoveNext();
   }
}

//print_r($array_lista);

//actualiza_turnos
$ac_turnos="delete from cesdb_arextension.dns_gridturnos where doccab_id='".$doccab_id."'";
$rs_bturnos = $DB_gogess->executec($ac_turnos);

//busca paciente
$busca_paciente="select * from app_cliente where clie_rucci='".$doccab_identificacionpaciente."'";
$rs_paciente = $DB_gogess->executec($busca_paciente,array());



for($i=0;$i<count($array_lista);$i++)
{
   
	//busca turno
	$busca_siguiente="select gridtur_turno from cesdb_arextension.dns_gridturnos where especi_id=".$array_lista[$i]["especi_id"]." and gridtur_fecha='".date("Y-m-d")."' and centro_id='".$centro_id."' and usuaat_id=".$array_lista[$i]["usuaat_id"]." order by gridtur_turno desc limit 1";				   
	$rs_bturno = $DB_gogess->executec($busca_siguiente,array());
	$numturno=0;
	if($rs_bturno->fields["gridtur_turno"])
	{
	  $numturno=$rs_bturno->fields["gridtur_turno"]+1;
	}
	else
	{
	  $numturno=1;
	}
	//busca turno
   
    $atenc_enlace='';
	$especi_id=$array_lista[$i]["especi_id"];
	$gridtur_fecha=date("Y-m-d");
	$gridtur_turno=$numturno;
	$gridtur_observacion='';
	$usua_id=$_SESSION['ces1313777_sessid_inicio'];
	$gridtur_fecharegistro=date("Y-m-d H:i:s");
	$gridtur_estado='';
	$centro_id=$centro_id;
	$clie_id=$rs_paciente->fields["clie_id"];
	$gridtur_tipo=1;
	$usuaat_id=$array_lista[$i]["usuaat_id"];
	
	$insert_t="INSERT INTO cesdb_arextension.dns_gridturnos ( atenc_enlace, especi_id, gridtur_fecha, gridtur_turno, gridtur_observacion, usua_id, gridtur_fecharegistro, gridtur_estado, centro_id, clie_id, doccab_id, gridtur_tipo, usuaat_id) VALUES ('".$atenc_enlace."','".$especi_id."','".$gridtur_fecha."','".$gridtur_turno."','".$gridtur_observacion."','".$usua_id."','".$gridtur_fecharegistro."','".$gridtur_estado."','".$centro_id."','".$clie_id."','".$doccab_id."','".$gridtur_tipo."','".$usuaat_id."');";
	
	$rs_intt = $DB_gogess->executec($insert_t,array());
	
$file = fopen("e_gturno".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$insert_t . PHP_EOL);
fclose($file);
	
	

   
   


}

//busca paciente y atencion


}

?>